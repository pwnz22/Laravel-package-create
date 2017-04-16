<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article = factory('App\Article')->create();

        $comments = factory('App\Comment', 100)->create()->each(function ($comment) use ($article) {
            $comment->replies()->saveMany($this->createComments($comment, $article, 4));
        });

        $article->comments()->saveMany($comments);
    }

    protected function createComments($comment, $article, $depth = 3, $currentDepth = 0)
    {
        if ($currentDepth === $depth) {
            return;
        }
        return $comment->replies()->saveMany(
            factory('App\Comment', 3)->create()->each(function ($reply) use ($depth, $currentDepth, $article) {
                $article->comments()->save($reply);

                $this->createComments($reply, $article, $depth, ++$currentDepth);
            })
        );
    }
}
