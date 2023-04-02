<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            // 'user info' => new UserResource(
            //     $this->type
            // ),
            'id' => $this->id,
            'avatar'=>$this->avatar,
            'national_id'=>$this->national_id,
            'gender'=>$this->gender,
            'birth_day'=> $this->birth_day,
            'mobile'=>$this->mobile,

        ];
    }
}