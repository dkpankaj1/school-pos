<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'name' => $this->product->name,
            'code' => $this->product->code,
            'mrp' => $this->product->mrp,
            'images' => $this->product->images,
            'unit' => $this->product->unit->name,
            'quantity' => $this->quantity
        ];
    }
}
