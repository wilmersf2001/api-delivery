<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstablishmentResource extends JsonResource
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
            'name' => $this->name,
            'stars' => $this->stars,
            'category' => $this->category,
            'address' => $this->address,
            'phone' => $this->phone,
            'logo' => $this->logo,
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
