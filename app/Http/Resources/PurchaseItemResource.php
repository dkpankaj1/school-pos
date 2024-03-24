<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "resource_id"=> $this->id,
            "id"=> $this->product->id,
            "name"=> $this->product->name,
            "code"=> $this->product->code ,
            "mrp"=> $this->mrp,
            "cost"=> $this->cost,
            "quantity"=> $this->quantity,
            "status"=> $this->status,               
        ];
    }
}
