<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin', function () {
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }
    return "Admin Panel";
})->middleware(['auth']);

use App\Http\Controllers\MenuItemController;
Route::resource('menu-items', MenuItemController::class)->middleware(['admin']);

use App\Http\Controllers\CategoryController;
Route::resource('categories', CategoryController::class)->middleware(['admin']);

use App\Http\Controllers\InventoryItemController;
Route::resource('inventory', InventoryItemController::class)->middleware(['admin']);

use App\Http\Controllers\OrderController;
Route::resource('orders', OrderController::class)->middleware('auth');

use App\Http\Controllers\OrderItemController;
Route::post('/order-items', [OrderItemController::class, 'store'])->middleware('auth');

Route::delete('/order-items/{id}', [OrderItemController::class, 'destroy'])->middleware('auth');

use App\Http\Controllers\DashboardController;
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('admin');

Route::post('/orders/{id}/complete', [OrderController::class, 'complete'])->middleware('auth');

use App\Http\Controllers\BookingController;
Route::resource('bookings', BookingController::class);

use App\Http\Controllers\TableController;
Route::resource('tables', TableController::class);

Route::get('/orders/{id}/bill', [OrderController::class, 'bill']);

Route::get('/orders/{id}/pdf', [OrderController::class, 'pdf']);