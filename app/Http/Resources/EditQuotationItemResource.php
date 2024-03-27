<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditQuotationItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->product_id,
            'name'=> $this->product->name,
            'code'=> $this->product->name,
            'quantity'=> $this->quantity,
            'mrp'=> $this->mrp,
            'unit' =>$this->product->unit->short_name,
            'category' => $this->product->category->name
        ];
    }
}
