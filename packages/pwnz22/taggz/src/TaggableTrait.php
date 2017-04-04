<?php

namespace Pwnz22\Taggz;

use Pwnz22\Taggz\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait TaggableTrait
{
    private function getWorkableTags($tags)
    {
        if (is_array($tags)) {
            return $this->getTagModels($tags);
        }

        if ($tags instanceof Model) {
            return $this->getTagModels([$tags->slug]);
        }

        return $this->filterTagsCollection($tags);
    }

    private function getTagModels(array $tags)
    {
        return Tag::whereIn('slug', $this->normalizeTagNames($tags))->get();
    }

    private function normalizeTagNames(array $tags)
    {
        return array_map(function ($tag) {
            return str_slug($tag);
        }, $tags);
    }

    private function filterTagsCollection(Collection $tags)
    {
        return $tags->filter(function ($tag) {
            return $tag instanceof Model;
        });
    }

    private function addTags(Collection $tags)
    {
        $sync = $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tag($tags)
    {
        $this->addTags($this->getWorkableTags($tags));
    }
}