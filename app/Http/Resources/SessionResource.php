<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = null;
        if ($this->user1_id != auth()->id()) {
            $user = $this->user1;
        } elseif($this->user2_id != auth()->id()) {
            $user = $this->user2;
        }
        return [
            "block" => $this->block,
            "blocked_by" => $this->blocked_by,
            "created_at" => $this->created_at,
            "id" => $this->id,
            "updated_at" => $this->updated_at,
            "user" => $user,
            "last_message" => new DialogMessageResource(
                $this->chats()->where("type", 0)->orderBy("id", "desc")->first()
            )
        ];
    }
}
