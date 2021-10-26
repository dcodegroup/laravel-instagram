<?php

namespace DcodeGroup\InstagramFeed\Exception;

use Throwable;

class ProfileNotAuthorized extends \Exception
{
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?? 'Instagram profile is not authorized.', $code, $previous);
    }
}
