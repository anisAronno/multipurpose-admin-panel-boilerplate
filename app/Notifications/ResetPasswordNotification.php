<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordNotification extends ResetPassword implements ShouldQueue
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
}
