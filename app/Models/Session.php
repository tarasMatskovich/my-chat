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

    public function block()
    {
        $this->block = true;
        $this->blocked_by = auth()->id();
        $this->save();
        return $this->hasOne(User::class, 'id', 'bloked_by');
    }

    public function unblock()
    {
        $this->block = false;
        $this->blocked_by = null;
        $this->save();
    }
}
