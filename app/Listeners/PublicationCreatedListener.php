<?php

namespace App\Listeners;

use App\Events\PublicationCreatedEvent;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\PublicationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PublicationCreatedListener
{
    /**
     * PublicationCreatedListener constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param PublicationCreatedEvent $event
     */
    public function handle(PublicationCreatedEvent $event)
    {
        $subscribers = Subscription::where('to_user_id', $event->publication->user_id)->pluck('user_id');
        $users = User::findMany($subscribers);

        foreach ($users as $user){
            $user->notify(new PublicationNotification($event->publication));
        }
    }
}
