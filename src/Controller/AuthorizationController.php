<?php

namespace DcodeGroup\InstagramFeed\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\OAuth2\Client\Provider\Instagram;

class AuthorizationController
{
    public function __invoke(Request $request, Instagram $instagramProvider)
    {
        $authUrl = $instagramProvider->getAuthorizationUrl([
            'state' => Str::random(32),
            'scope' => config('instagram.scopes')
        ]);

        $request->session()->put('oauth2state', $instagramProvider->getState());

        return redirect()->away($authUrl);
    }
}
