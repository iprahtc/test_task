<?php

namespace App\Models;

use App\Events\PublicationCreatedEvent;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'heading', 'description', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
        'created' => PublicationCreatedEvent::class,
    ];

}
