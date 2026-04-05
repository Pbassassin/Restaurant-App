<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\MenuItem;
use App\Models\Order;

class OrderItemController extends Controller
{
    public function store(Request $request) {
        $menu = MenuItem::findOrFail($request->menu_item_id);

            $item = OrderItem::where('order_id', $request->order_id)
            ->where('menu_item_id', $request->menu_item_id)
            ->first();

            if ($item) {
                $item->quantity += $request->quantity;
                $item->save();
            } else {
                OrderItem::create([
                    'order_id' => $request->order_id,
                    'menu_item_id' => $request->menu_item_id,
                    'quantity' => $request->quantity,
                    'price' => $menu->price
                ]);
            }

        if ($menu->inventory) {
            $inventory = $menu->inventory;

            if ($inventory->quantity < $request->quantity) {
                return back()->with('error', 'Out of Stock');
            }

            $inventory->quantity -= $request->quantity;
            $inventory->save();
        }

        $order = Order::findOrFail($request->order_id);

        $total = $order->items->sum(fn($i) => $i->price * $i->quantity);

        $order->update([
            'total_amount' => $total
        ]);

        return back();
    }

    public function destroy($id) {
        $item = OrderItem::findOrFail($id);
        $order = Order::findOrFail($item->order_id);
        $item->delete();

        $total = 0;
        foreach ($order->items as $i) {
            $total += $i->price * $i->quantity;
        }
        
        $order->update([
            'total_amount' =>$total
        ]);

        return back();
    }
}
