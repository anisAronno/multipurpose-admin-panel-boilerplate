<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\UserRegistrationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistrationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $administrativeUser = User::with('roles')->where('status', 'Active')->whereHas('roles', function ($q) {
            $q->where('name', '=', 'superadmin');
        })->get();

        foreach ($administrativeUser as $admin) {
            $admin->notify(new UserRegistrationNotification($event->user));
        }
    }
}
