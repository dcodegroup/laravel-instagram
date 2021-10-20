<?php

namespace DcodeGroup\InstagramFeed\Media;

use Illuminate\Support\Collection;

class MediaResponse
{
    protected Collection $media;
    protected Collection $pagination;

    public function __construct(array $response)
    {
        $this->pagination = Collection::make($response['paging']);
        $this->media = Collection::make($response['data'])->mapInto(Media::class);
    }

    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function getPagination(): Collection
    {
        return $this->pagination;
    }
}
