<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Support\Facades\Http;
use League\OAuth2\Client\Provider\Instagram;
use League\OAuth2\Client\Provider\InstagramResourceOwner;
use League\OAuth2\Client\Token\AccessToken;

class InstagramAuthService
{
    private Instagram $provider;

    public function __construct(Instagram $provider)
    {
        $this->provider = $provider;
    }

    public function getAccessToken(string $code): AccessToken
    {
        return $this->provider->getAccessToken('authorization_code', [
            'code' => $code
        ]);
    }

    public function getUser(AccessToken $token): InstagramResourceOwner
    {
        return $this->provider->getResourceOwner($token);
    }

    public function acquireLongLivedToken(AccessToken $token): AccessToken
    {
        $response = Http::get($this->provider->getGraphHost() . '/access_token', [
            'grant_type' => 'ig_exchange_token',
            'client_secret' => config('instagram.client_secret'),
            'access_token' => $token->getToken(),
        ])
            ->json();

        return new AccessToken($response);
    }

    public function isAuthorized(?string $userId = null): bool
    {
        $query = Profile::query()
            ->where('expires_at', '>', now());

        if ($userId) {
            $query->where('profile_id', $userId);
        }

        return $query->exists();
    }
}
