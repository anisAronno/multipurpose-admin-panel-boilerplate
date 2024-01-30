<?php

namespace App\Http\Middleware;

use App\Models\Option;
use App\Services\User\LoginHistoryService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTimeZone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = LoginHistoryService::getFields($request->ip);

        if(is_array($userAgent['time_zone']) && isset($userAgent['time_zone']) && !empty($userAgent['time_zone'])) {
            date_default_timezone_set(session()->get($userAgent['time_zone'], Option::getOption('time_zone')));
        }

        return $next($request);
    }
}
