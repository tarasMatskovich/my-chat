<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DialogMessageResource extends JsonResource
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
            'message' => $this->message->content,
            'id' => $this->id,
            'type' => $this->type,
            'read_at' => $this->read_at,
            'send_at' => $this->created_at->format("H:m:s"),
            'user' => $this->user
        ];
    }
}
