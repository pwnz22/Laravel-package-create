<?php

namespace App\Traits\Eloquent;

trait NestableCommentsTrait
{
    public function nestedComments()
    {
        $comments = $this->comments();

        $grouped = $comments->with(['user', 'parent.user'])->get()->groupBy('parent_id');

        $root = $grouped->get(null);

        return $this->buildNest($root, $grouped);
    }

    protected function buildNest($comments, $groupedComments)
    {
        return $comments->each(function ($comment) use ($groupedComments) {
            if ($replies = $groupedComments->get($comment->id)) {
                $comment->children = $replies;
                $this->buildNest($comment->children, $groupedComments);
            }
        });
    }
}