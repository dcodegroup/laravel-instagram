<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'instagram_profiles';

    protected $guarded = [];

    protected $casts = [
        'expire_at' => 'datetime',
    ];
}
