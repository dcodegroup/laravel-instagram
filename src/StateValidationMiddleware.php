<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Http\Request;

class StateValidationMiddleware
{
    public function handle(Request $request, $next)
    {
        // TODO: better error handling

        if (!$request->has('state')) {
            exit;
        }

        if($request->get('state') !== $request->session()->get('oauth2state')) {
            // TODO: move oauth2state to variable or config
            $request->session()->remove('oauth2state');

            exit;
        }

        return $next($request);
    }
}
