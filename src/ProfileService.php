<?php

namespace DcodeGroup\InstagramFeed;

use DcodeGroup\InstagramFeed\Media\MediaResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ProfileService
{
    private InstagramAuthService $instagramAuthService;

    public function __construct(InstagramAuthService $instagramAuthService)
    {
        $this->instagramAuthService = $instagramAuthService;
    }

    public function getMedias(Profile $profile, ?array $fields = null): MediaResponse
    {
        if (is_null($fields)) {
            $fields = ['media_url', 'media_type', 'timestamp'];
        }

        $response = Http::withToken($profile->token())
            ->get($this->getEndpoint('/me/media'), ['fields' => join(',', $fields)])
            ->json();

        return new MediaResponse($response);
    }

    protected function getEndpoint(string $uri): string
    {
        return $this->instagramAuthService->getGraphHost() . $uri;
    }
}
