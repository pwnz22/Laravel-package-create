<?php

use App\Article;

Route::get('/', function () {

    $article = Article::find(1);

    $comments = $article->comments()->with([
        'user',
        'replies.user',
        'replies.parent.user',
        'replies.replies.user',
        'replies.replies.parent.user',
        'replies.replies.replies.user',
        'replies.replies.replies.parent.user',
        'replies.replies.replies.replies.user',
        'replies.replies.replies.replies.parent.user',
        'replies.replies.replies.replies.replies.user'
    ])->paginate(10);

    return view('comments.index', compact('article', 'comments'));

});
Auth::routes();

Route::get('/home', 'HomeController@index');
