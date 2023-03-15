<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            "title"=> $this->title,
            "address"=> $this->address,
            "city"=> $this->city,
            "state"=> $this->state,
            "district"=> $this->district,
            "zip_code"=> $this->zip_code,
            "country"=> $this->country,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
