<?php

Route::get('/', function () {
    $tags = \Pwnz22\Taggz\Models\Tag::get();
    dd($tags);
});
