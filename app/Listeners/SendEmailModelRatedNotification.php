<?php

namespace App\Listeners;

use App\Events\ModelRated;
use App\Models\Product;
use App\Notifications\ModelRatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailModelRatedNotification
{
    // php artisan make:listener SendEmailModelRatedNotification
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
    public function handle(ModelRated $event): void
    {
        /** @var Product $rateable */
        $rateable = $event->getRateable();

        if($rateable instanceof Product){
            $notification = new ModelRatedNotification(
                $event->getQualifier()->name,
                $rateable->name,
                $event->getScore()
            );
            $rateable->createdBy->notify($notification);
        }
    }
}
