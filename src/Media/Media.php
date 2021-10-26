<?php

namespace DcodeGroup\InstagramFeed\Media;

use Illuminate\Support\Str;

class Media
{
    public string $id;
    public ?string $timestamp;
    public ?string $mediaType;
    public ?string $mediaUrl;
    public ?string $caption;
    public ?string $permalink;
    public ?string $thumbnailUrl;
    public ?string $username;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $key = Str::camel($key);
            $this->{$key} = $value;
        }
    }
}
