<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'mrp' => $this->mrp,
            'cost' => $this->cost,
            'images' => $this->images,
            'category' => $this->category->name,
            'unit' => $this->unit->short_name,
            'stock' => $this->stocks->sum('quantity'),
        ];
    }
}
