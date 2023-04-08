<?php

namespace App\Listeners;

use App\Events\ModelUnrated;
use App\Models\Product;
use App\Notifications\ModelUnratedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailModelUnratedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ModelUnrated $event): void
    {
        /** @var Product $rateable */
        $rateable = $event->getRateable();
        /** @var User $qualifier */
        $qualifier = $event->getQualifier();
        if ($rateable instanceof Product) {
            $notification = new ModelUnratedNotification(
                $qualifier->name,
                $rateable->name
            );
        }

        $rateable->createdBy->notify($notification);
    }
}
