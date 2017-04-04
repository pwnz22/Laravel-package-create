<?php

use App\Lesson;
use App\Topic;

Route::get('/', function () {
    $lessons = Lesson::withAnyTag(['orangered', 'navy']);

    dd($lessons->get());
});