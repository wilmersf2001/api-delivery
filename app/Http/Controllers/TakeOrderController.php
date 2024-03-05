<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TakeOrderController extends Controller
{
    public function takeOrder(Order $order)
    {
        abort_unless(
            Auth::user()->tokenCan('Order:take'),
            403,
            'No tienes permisos para realizar esta acción'
        );

        abort_if($order->status !== 'pending', 403, 'La orden ya fue tomada');

        $order->delivery_id = auth()->id();
        $order->status = 'processing';
        $order->save();

        return new OrderResource($order);
    }
}
