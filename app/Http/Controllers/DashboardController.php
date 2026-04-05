<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\InventoryItem;

class DashboardController extends Controller
{
    public function index() {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        $topItems = OrderItem::selectRaw('menu_item_id, SUM(quantity) as total')
        ->groupBy('menu_item_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
        $lowStock = InventoryItem::whereColumn('quantity', '<=', 'min_level')->get();

        $dailyRevenue = Order::selectRaw('Date(created_at) as date, SUM(total_amount) as total')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $topItems = OrderItem::selectRaw('menu_item_id, SUM(quantity) as total')
        ->groupBy('menu_item_id')
        ->orderByDesc('total')
        ->limit(5)
        ->with('menuItem')
        ->get();

        $itemLabels = $topItems->map(function ($item) {
            return $item->menuItem->name ?? 'N/A';
        });

        $itemData = $topItems->pluck('total');

        return view('/admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'topItems',
            'lowStock',
            'dailyRevenue',
            'itemLabels',
            'itemData'
        ));
    }
}
