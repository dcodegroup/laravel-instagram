<?php

namespace DcodeGroup\InstagramFeed\Controller;

use DcodeGroup\InstagramFeed\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use League\OAuth2\Client\Provider\Instagram;
use League\OAuth2\Client\Provider\InstagramResourceOwner;
use League\OAuth2\Client\Token\AccessToken;

class RedirectController
{
    public function __invoke(Request $request, Instagram $instagramProvider)
    {
        // Try to get an access token (using the authorization code grant)
        $token = $instagramProvider->getAccessToken('authorization_code', [
            'code' => $request->input('code')
        ]);

        $user = $instagramProvider->getResourceOwner($token);

        // Exchange short-lived token to long-lived
        $longLivedToken = $this->exchangeToken($instagramProvider, $token);

        Profile::create([
            'profile_id' => $user->getId(),
            'access_token' => $longLivedToken['access_token'],
            'expires_at' => now()->addSeconds($longLivedToken['expires_in']),
        ]);
    }

    /**
     * @param Instagram $instagramProvider
     * @param AccessToken $token
     * @return array|mixed
     *
     * @TODO: move this method to a service
     */
    protected function exchangeToken(Instagram $instagramProvider, AccessToken $token)
    {
        return Http::get($instagramProvider->getGraphHost() . '/access_token', [
            'grant_type' => 'ig_exchange_token',
            'client_secret' => config('instagram.client_secret'),
            'access_token' => $token->getToken(),
        ])
            ->json();
    }
}
