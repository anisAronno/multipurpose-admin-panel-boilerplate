<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserResources extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'gender' => $this->gender,
            'email_verified_at' => $this->email_verified_at,
            'ip' => $this->ip,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'time_zone' => $this->time_zone,
            'language' => $this->language,
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(), 
        ];
    }
}