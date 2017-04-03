<?php

namespace Pwnz22\Taggz;

use Pwnz22\Taggz\Models\Tag;

trait TaggableTrait
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}