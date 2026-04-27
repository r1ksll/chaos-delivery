<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courier_id',
        'total_price',
        'status',
        'delivery_time',
        'address',
        'entrance',
        'apartment',
        'floor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}