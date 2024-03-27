<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'reference_number' => $this->reference_number,
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
            'student' => $this->student->name,
            'class' => $this->student->classes->name,
            'order_status' => $this->order_status,
            'other_amount' => $this->other_amount,
            'paid_amount' => $this->paid_amount,
            'payment_status' => $this->payment_status,
            'total_amount' => $this->total_amount,
        ];
    }
}
