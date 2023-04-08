<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ModelRatedNotification extends Notification
{
    //php artisan make:notification ModelRatedNotification
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private string $qualifierName,
        private string $productName,
        private float $score
    ){
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line("{$this->qualifierName} ha calificado tu producto
                    {$this->productName} con {$this->score} estrellas
                    ");
    }

}
