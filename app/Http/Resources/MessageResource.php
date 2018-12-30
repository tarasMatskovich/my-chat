<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
        ];
    }
}
