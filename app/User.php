<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
        'city',
        'age',
        'phone',
        'about',
        'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that are guarded
     * @var array
     */
    protected $guarded = [];

    public function deleteImage()
    {
        app(\Illuminate\Filesystem\Filesystem::class)->delete(public_path('img/users/' . $this->img));
    }
}
