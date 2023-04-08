<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateLastLogin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    /**
     * Execute the job.
     */
    public function handle(Login $event): void
    {

        $user = $event->user;
        $user->last_login = Carbon::now();
        $user->save();
    }
}
