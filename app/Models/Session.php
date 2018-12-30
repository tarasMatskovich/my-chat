<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $guarded = [];

    public function chats()
    {
        return $this->hasManyThrough(Chat::class,Message::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user1()
    {
        return $this->belongsTo(User::class, "user1_id", "id");
    }

    public function user2()
    {
        return $this->belongsTo(User::class, "user2_id", "id");
    }
}
