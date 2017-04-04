<?php

use App\Lesson;
use App\Topic;

Route::get('/', function () {
    $tags = \Pwnz22\Taggz\Models\Tag::usedGte(1);
    dd($tags->get());
});