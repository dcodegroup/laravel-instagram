<?php

namespace DcodeGroup\InstagramFeed\Controller;

use DcodeGroup\InstagramFeed\InstagramService;
use DcodeGroup\InstagramFeed\Profile;
use Illuminate\Http\Request;

class RedirectController
{
    public function __invoke(Request $request, InstagramService $instagramService)
    {
        // Try to get an access token (using the authorization code grant)
        $token = $instagramService->getAccessToken($request->input('code'));

        $user = $instagramService->getUser($token);

        $longLivedToken = $instagramService->acquireLongLivedToken($token);

        Profile::create([
            'profile_id' => $user->getId(),
            'access_token' => $longLivedToken->getToken(),
            'expires_at' => now()->addSeconds($longLivedToken->getExpires()),
        ]);
    }
}
