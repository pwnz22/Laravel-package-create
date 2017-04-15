<?php

use App\Article;

Route::get('/', function () {

    $article = Article::find(1);

    dd($article->comments()->get());

});