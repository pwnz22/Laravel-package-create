<?php

use App\Article;

Route::get('/', function () {

    $page = request()->get('page', 1);
    $perPage = 20;

    $article = Article::find(1);

    $comments = $article->nestedComments($page, $perPage);

    $comments = new \Illuminate\Pagination\LengthAwarePaginator(
        $comments,
        count($article->comments->where('parent_id', null)),
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]

    );

    return view('comments.index', compact('article', 'comments'));

});
Auth::routes();

Route::get('/home', 'HomeController@index');
