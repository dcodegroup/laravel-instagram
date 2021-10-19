<?php

namespace DcodeGroup\InstagramFeed\Controller;

use Carbon\Carbon;
use DcodeGroup\InstagramFeed\InstagramAuthService;
use DcodeGroup\InstagramFeed\Profile;
use Illuminate\Http\Request;

class RedirectController
{
    public function __invoke(Request $request, InstagramAuthService $instagramService)
    {
        // Try to get an access token (using the authorization code grant)
        $token = $instagramService->getAccessToken($request->input('code'));

        $user = $instagramService->getUser($token);

        $longLivedToken = $instagramService->acquireLongLivedToken($token);

        Profile::create([
            'profile_id' => $user->getId(),
            'access_token' => $longLivedToken->getToken(),
            'expires_at' => Carbon::createFromTimestamp($longLivedToken->getExpires()),
        ]);

        return redirect()->route(config('instagram.auth_redirect_route'));
    }
}
