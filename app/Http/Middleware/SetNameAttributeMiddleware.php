<?php

namespace App\Http\Middleware;

use Closure;

class SetNameAttributeMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->has('first_name') && $request->has('last_name')) {
            $request->merge(['name' => $request->first_name . ' ' . $request->last_name]);
        }

        return $next($request);
    }
}
