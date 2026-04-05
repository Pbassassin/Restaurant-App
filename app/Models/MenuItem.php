<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'is_available'
    ];

    public function category() {
        return $this->belongsTo((Category::class));
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function recommendations() {
        return $this->hasMany(Recommendation::class, 'menu_item_id');
    }

    public function inventory() {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }
}
