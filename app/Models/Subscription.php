<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'to_user_id'
    ];
}

