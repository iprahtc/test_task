<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified_key'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verified_key'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function publications(){
        return $this->hasMany(Publication::class);
    }

    public function subscribers(){
        return $this->hasMany(Subscription::class, 'to_user_id');
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function answerComments(){
        return $this->hasMany(AnswerComment::class);
    }
}
