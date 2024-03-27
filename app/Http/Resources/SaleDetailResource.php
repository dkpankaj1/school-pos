<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->product->id,
            'name'=> $this->product->name,
            'code'=> $this->product->code,
            'available'=> $this->product->stocks->sum('quantity'),
            'quantity'=> $this->quantity,
            'unit'=> $this->product->unit->name,
            'mrp'=> $this->product->mrp,
        ];
    }
}
