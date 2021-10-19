<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Http\Request;

class StateValidationMiddleware
{
    public function handle(Request $request, $next)
    {
        if (!$request->has('state')) {
            abort(403);
        }

        if($request->get('state') !== $request->session()->get('oauth2state')) {
            // TODO: move oauth2state to variable or config
            $request->session()->remove('oauth2state');

            abort(403);
        }

        return $next($request);
    }
}
