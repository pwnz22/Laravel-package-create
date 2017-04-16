<?php

use App\Article;

Route::get('/', function () {

    $article = Article::find(1);

    $comments = $article->comments()->with([
        'user',
        'replies.parent.user',
        'replies.user',
        'replies.replies.parent.user',
        'replies.replies.user'
    ])->get();

    return view('comments.index', compact('article', 'comments'));

});
Auth::routes();

Route::get('/home', 'HomeController@index');
