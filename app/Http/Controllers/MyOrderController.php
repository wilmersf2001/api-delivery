<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('delivery_id', auth()->id())
            ->paginate(10);

        return OrderResource::collection($orders);
    }

    public function stateUpdate(Order $order, Request $request)
    {
        request()->validate([
            'status' => 'required|in:pending,processing,completed,decline,cancel',
        ]);

        abort_unless(
            Auth::user()->role === 'delivery',
            403,
            'No tienes permisos para realizar esta acción'
        );

        abort_if(
            $order->delivery_id === null,
            403,
            'La orden no ha sido tomada por un repartidor, no puedes actualizar su estado'
        );

        abort_if(
            $order->delivery_id !== Auth::id(),
            403,
            'La orden no te pertenece'
        );

        $order->status = $request->status;
        $order->save();

        return new OrderResource($order);
    }
}
