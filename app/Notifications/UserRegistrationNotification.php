<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistrationNotification extends Notification
{
    use Queueable;


    /**
     * @TODO
     * Add This Construct for Seinding Post Mark  smtp Mail
     * if you are not interast with post mark you can remove this constact method
     */

    public function __construct()
    {
        $this->callbacks[] =(function ($message) {
            $message->getHeaders()->addTextHeader('X-PM-Message-Stream', 'Transactional');
        });
    }

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->line('New User Registered')
        ->line('User Email: '.$this->user->email)
        ->line('User id: '.$this->user->id)
        ->line('Thanks For Choose us');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'message' => 'Registered new user ( '.$this->user->name.' ).',
        ];
    }
}
