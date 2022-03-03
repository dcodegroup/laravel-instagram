<?php

namespace DcodeGroup\InstagramFeed;

use Carbon\Carbon;
use DcodeGroup\InstagramFeed\Exception\ProfileNotAuthorized;
use DcodeGroup\InstagramFeed\Exception\TokenExpired;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * @package DcodeGroup\InstagramFeed
 *
 * @property ?string $access_token
 * @property Carbon $expires_at
 */
class Profile extends Model
{
    protected $table = 'instagram_profiles';

    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function token(): ?string
    {
        if ($this->access_token === null) {
            throw new ProfileNotAuthorized();
        }

        // If the token has expired, refresh it now.
        if ($this->expires_at < now()) {
            try {
                $this->refreshToken();
            } catch (\Exception $e) {
                throw new TokenExpired();
            }
        } elseif ($this->expires_at < now()->addWeek()) {
            // If the token is not expired yet, but will expire in a week, refresh it.
            $this->refreshToken();
        }

        return $this->access_token;
    }

    protected function refreshToken(): void
    {
        $authService = app()->make(InstagramAuthService::class);
        $newAccessToken = $authService->refreshToken($this->access_token);
        $this->access_token = $newAccessToken->getToken();
        $this->expires_at = Carbon::createFromTimestamp($newAccessToken->getExpires());
        $this->save();
    }
}
