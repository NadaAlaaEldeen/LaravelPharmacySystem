<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalPrice = 0;
        // foreach (MedicineResource::collection($this->medicines) as $medicine) {
        //     $totalPrice += $medicine->price;
        // }
        return [
            'id' => $this->id,
            'medicine' => MedicineResource::collection($this->medicine),
            'status' => $this->status,
            'total_price' => $this->total_price,
            'is_insured' => $this->is_insured,
            'user_id' => $this->user_id,
            // 'pharmacy' => new PharmacyResource($this->pharmacy),
        ];
        // return parent::toArray($request);
    }
}
