<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'area' => new AreaResource($this->area),
            'id'=> $this->id,
            'street_name' => $this->street_name,
            'building_number' => $this->building_number,
            'floor_number' => $this->floor_number,
            'flat_number' => $this->flat_number,
            'is_main' => $this->is_main == 1 ? 'YES' : 'NO',
        ];
    }
}
