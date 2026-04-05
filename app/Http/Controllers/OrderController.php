<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\MenuItem;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        Order::create([
            'customer_id' => $customer->id,
            'total_amount' => 0,
            'status' => 'pending'
        ]);

        return redirect('/orders');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('items.menuItem')->findOrFail($id);
        $menu = MenuItem::all();

        $itemIds = $order->items->pluck('menu_item_id');
        $totalOrders = Order::count();

        $suggestionMap = [];
        foreach ($itemIds as $itemId) {
            $ordersWithItem = OrderItem::where('menu_item_id', $itemId)->pluck('order_id');
            $countItem = $ordersWithItem->count();

            $coItems = OrderItem::whereIn('order_id', $ordersWithItem)
                ->where('menu_item_id', '!=', $itemId)
                ->selectRaw('menu_item_id, COUNT(*) as count')
                ->groupBy('menu_item_id')
                ->get();

            foreach ($coItems as $c) {
                $support = $c->count / $totalOrders;
                $confidence = $c->count / $countItem;

                if ($confidence < 0.3)
                    continue;

                if (!isset($suggestionMap[$c->menu_item_id])) {

                    $suggestionMap[$c->menu_item_id] = [
                        'item' => MenuItem::find($c->menu_item_id),
                        'support' => $support,
                        'confidence' => $confidence,
                        'count' => 1
                    ];

                } else {
                    $suggestionMap[$c->menu_item_id]['support'] += $support;
                    $suggestionMap[$c->menu_item_id]['confidence'] += $confidence;
                    $suggestionMap[$c->menu_item_id]['count']++;
                }
            }
        }

        $suggestions = [];

        foreach ($suggestionMap as $s) {
            $suggestions[] = [
                'item' => $s['item'],
                'support' => $s['support'] / $s['count'],
                'confidence' => $s['confidence'] / $s['count']
            ];
        }

        usort($suggestions, function ($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        $suggestions = array_slice($suggestions, 0, 5);

        return view('/orders.show', compact('order', 'menu', 'suggestions'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();
        return back();
    }

    public function bill($id)
    {
        $order = Order::with('items.menuItem')->findOrFail($id);
        return view('orders.bill', compact('order'));
    }

    public function pdf($id)
    {
        $order = Order::with('items.menuItem')->findOrFail($id);
        $pdf = Pdf::loadView('orders.bill_pdf', compact('order'));
        return $pdf->download('invoice ' . $order->id . '.pdf');
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
