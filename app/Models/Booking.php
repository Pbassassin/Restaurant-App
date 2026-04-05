<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'date',
        'time',
        'people',
        'table_id'
    ];

    public function table() {
        return $this->belongsTo(Table::class);
    }
}
