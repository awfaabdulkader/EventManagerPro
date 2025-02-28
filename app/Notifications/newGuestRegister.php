<?php

namespace App\Notifications;

use App\Models\FormTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newGuestRegister extends Notification
{
    use Queueable;
    protected $guest;

    /**
     * Create a new notification instance.
     */
    public function __construct(FormTicket $guest)
    {
        $this->guest = $guest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via( $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray( $notifiable)
    {
        return [
            'message' => 'A new guest has been submitted.',
            'name'=> $this->guest->firstName,
            'guest_id' => $this->guest->id ?? null,
            'subject' => $this->guest->subject ?? 'No subject',
            'created_at' => now()->toDateTimeString(),

        ];
    }
    }
        

