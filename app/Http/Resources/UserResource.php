<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'city' => $this->city,
            'age' => $this->age,
            'phone' => $this->phone,
            'about' => $this->about,
            'img' => $this->img,
            'online' => false,
            'user_route' => route('user', ['id' => $this->id])
        ];
    }
}
