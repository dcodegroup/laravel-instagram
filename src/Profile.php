<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $casts = [
        'expire_at' => 'datetime',
        'refresh_token_expires_at' => 'datetime',
    ];
}
