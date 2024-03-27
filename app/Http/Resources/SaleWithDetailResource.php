<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleWithDetailResource extends JsonResource
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
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
            'reference_number' => $this->reference_number,
            'student' => [
                'student_id' => $this->student_id,
                'student_name' => $this->student->name,
                'class_id' => $this->student->classes->id,
                'class_name' => $this->student->classes->name,
            ],
            'other_amount' => $this->other_amount,
            'discount' => $this->discount,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount,
            'order_status' => $this->order_status,
            'payment_status' => $this->payment_status,
            'note' => $this->notes,
            'sale_items' => SaleDetailResource::collection($this->saleItems)
        ];
    }
}
