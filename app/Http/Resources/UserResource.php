<?php

namespace App\Http\Resources;

use App\Models\Session;
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
        $session = Session::where(['user1_id' => auth()->id(), 'user2_id' => $this->id])->orWhere(function($query) {
            $query->where(['user2_id' => auth()->id(), 'user1_id' => $this->id]);
        })->first();
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
            'session' => $session,
            'user_route' => route('user', ['id' => $this->id])
        ];
    }
}
