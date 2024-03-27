<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
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
            "code" => $this->code,
            "date" => Carbon::parse($this->date)->format("Y-m-d"),
            "other_charges" => $this->other_amount,
            "discount" => $this->discount,
            "total_amt" => $this->total_amount,
        ];
    }
}
