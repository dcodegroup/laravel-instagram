<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ProfileService
{
    private InstagramAuthService $instagramAuthService;

    public function __construct(InstagramAuthService $instagramAuthService)
    {
        $this->instagramAuthService = $instagramAuthService;
    }

    public function getMedia(Profile $profile, ?array $fields = null): Collection
    {
        if (is_null($fields)) {
            $fields = ['media_url', 'media_type', 'timestamp'];
        }

        $items = Http::withToken($profile->access_token)
            ->get($this->getEndpoint('/me/media'), ['fields' => join(',', $fields)])
            ->json();

        return collect($items);
    }

    protected function getEndpoint(string $uri): string
    {
        return $this->instagramAuthService->getGraphHost() . $uri;
    }
}
