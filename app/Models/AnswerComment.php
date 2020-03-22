<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    protected $fillable = [
        'user_id', 'comment_id', 'text'
    ];
}
