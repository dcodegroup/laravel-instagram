<?php

namespace DcodeGroup\InstagramFeed\Exception;

use Throwable;

class TokenExpired extends \Exception
{
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?? 'OAuth token has expired. Please reauthenticate.', $code, $previous);
    }
}
