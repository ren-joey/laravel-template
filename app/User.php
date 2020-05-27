<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // 將 name 的資料解密
    public function getNameAttribute($name)
    {
        return decrypt($name);
    }

    // 將 name 的資料加密
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = encrypt($name);
    }

    // 將 email 的資料解密
    public function getEmailAttribute($email)
    {
        return decrypt($email);
    }

    // 將 email 的資料加密
    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = encrypt($email);
    }
}
