<?php

use App\Lesson;
use App\Topic;

Route::get('/', function () {
    $lesson = Lesson::find(1);

    $lesson->retag(['navy', 'green']);
});