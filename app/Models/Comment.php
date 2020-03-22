<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'publication_id', 'text'
    ];

    public function answerComments(){
        return $this->hasMany(AnswerComment::class);
    }
}
