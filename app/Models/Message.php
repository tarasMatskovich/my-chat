<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function createForSend($sessionId, $userId)
    {
        return $this->chats()->create([
            'session_id' => $sessionId,
            'user_id' => $userId,
            'type' => 0
        ]);
    }

    public function createForReceive($sessionId, $userId)
    {
        return $this->chats()->create([
            'session_id' => $sessionId,
            'user_id' => $userId,
            'type' => 1
        ]);
    }
}
