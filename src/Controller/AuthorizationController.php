<?php

namespace DcodeGroup\InstagramFeed\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\OAuth2\Client\Provider\Instagram;

class AuthorizationController
{
    public function form()
    {
        return view('instagram::authorize');
    }

    public function action(Request $request, Instagram $instagramProvider)
    {
        $authUrl = $instagramProvider->getAuthorizationUrl([
            'state' => Str::random(32),
            'scope' => config('instagram.oauth.scopes'),
        ]);

        $request->session()->put(config('instagram.oauth.state_session_key'), $instagramProvider->getState());

        return redirect()->away($authUrl);
    }
}
