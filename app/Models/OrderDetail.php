<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'tb_order_detail';

    protected $fillable = [
        'product_name',
        'product_price',
        'product_qty',
        'product_subtotal',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
