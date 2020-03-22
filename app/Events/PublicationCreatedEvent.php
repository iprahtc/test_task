<?php

namespace App\Events;

use App\Models\Publication;
use Illuminate\Queue\SerializesModels;

class PublicationCreatedEvent
{
    use SerializesModels;

    public $publication;

    /**
     * PublicationCreatedListener constructor.
     * @param Publication $publication
     */

    public function __construct(Publication $publication)
    {
        $this->publication = $publication;
    }
}