<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "date" => Carbon::parse($this->date)->format("Y-m-d"),
            "reference_number" => $this->reference_number,
            "supplier" => $this->supplier->name,
            "supplier_id" => $this->supplier->id,
            "total_amount" => $this->total_amount,
            "paid_amount" => $this->paid_amount,
            "payment_status" => $this->payment_status,
            "other_amount" => $this->other_amount,
            "discount" => $this->discount,
            "purchase_notes" => $this->purchase_notes,
            "order_status" => $this->order_status,
            "purchase_items" => PurchaseItemResource::collection($this->purchaseItems)
        ];
    }
}
