<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelRated
{
    // php artisan make:event ModelRated
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        private Model $qualifier,
        private Model $rateable,
        private float $score)
    {
        //
    }

    public function getQualifier(): Model
    {
        return $this->qualifier;
    }

    public function getRateable(): Model
    {
        return $this->rateable;
    }

    public function getScore(): float
    {
        return $this->score;
    }



}
