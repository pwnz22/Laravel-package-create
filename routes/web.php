<?php

use App\Article;

Route::get('/', function () {

    $article = Article::find(1);

    $comments = $article->nestedComments();

    return view('comments.index', compact('article', 'comments'));

});
Auth::routes();

Route::get('/home', 'HomeController@index');
