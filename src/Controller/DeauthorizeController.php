<?php

namespace DcodeGroup\InstagramFeed\Controller;

use DcodeGroup\InstagramFeed\Profile;
use DcodeGroup\InstagramFeed\SignedRequest;

class DeauthorizeController
{
    public function __invoke(SignedRequest $request)
    {
        $request->validateSignature();

        Profile::query()
            ->where('profile_id', $request->payload('user_id'))
            ->delete();

        return response()->noContent();
    }
}
