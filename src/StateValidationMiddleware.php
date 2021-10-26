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

        if($request->input('state') !== $this->getState($request)) {
            $request->session()->remove(config('instagram.oauth.state_session_key'));

            abort(403);
        }

        return $next($request);
    }

    protected function getState(Request $request)
    {
        return $request->session()->get(config('instagram.oauth.state_session_key'));
    }
}
