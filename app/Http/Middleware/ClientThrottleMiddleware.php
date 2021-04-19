<?php


namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests;

class ClientThrottleMiddleware extends ThrottleRequests
{
    protected function resolveRequestSignature($request)
    {
        return $request->user()->hasRole('client');
    }
}
