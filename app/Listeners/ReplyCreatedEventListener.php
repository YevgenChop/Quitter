<?php

namespace App\Listeners;

use App\Events\ReplyCreated;
use App\Notifications\GotReplyNotification;

class ReplyCreatedEventListener
{
    /**
     * Handle the event.
     *
     * @param ReplyCreated $event
     * @return void
     */
    public function handle(ReplyCreated $event): void
    {
        $message = $event->getReply();

        $message->user->notify(new GotReplyNotification($message));
    }
}
