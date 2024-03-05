<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_code' => $this->order_code,
            'customer_name' => $this->customer_name,
            'customer_ap_paterno' => $this->customer_ap_paterno,
            'customer_ap_materno' => $this->customer_ap_materno,
            'status' => $this->status,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'delivery_id' => $this->delivery_id,
            'order_details' => OrderDetailResource::collection(
                $this->whenLoaded('orderDetails')
            ),
        ];
    }
}
