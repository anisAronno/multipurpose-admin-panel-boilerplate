<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Models\LoginHistory;
use App\Services\User\LoginHistoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

class LoginListener implements ShouldQueue
{
    /**
     * Handle the Login Listener.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        try {
            $user = $event->user;

            if (! empty($user['ip']) && $user['user_id']) {
                $locaition = LoginHistoryService::getLocation($user['ip']);

                if (count(array_keys($locaition)) > 0) {
                    $loginHistoryData = array_merge($locaition, $user);

                    $loginHistoryData['created_at'] = Carbon::now();
                    $loginHistoryData['updated_at'] = Carbon::now();

                    LoginHistory::insert($loginHistoryData);
                }
            }
        } catch (\Throwable $th) {
            logger()->info($th->getMessage());
        }
    }
}
