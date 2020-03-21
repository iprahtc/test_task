<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'heading', 'text_heading', 'description', 'user_id'
    ];
}
