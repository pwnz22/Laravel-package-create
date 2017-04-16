<?php

namespace App\Traits\Eloquent;

trait NestableCommentsTrait
{
    public function nestedComments($page = 1, $perPage = 10)
    {
        $comments = $this->comments();

        $grouped = $comments->get()->groupBy('parent_id');
        $root = $grouped->get(null)->forPage($page, $perPage);

        $ids = $this->buildIdNest($root, $grouped);

        $grouped = $comments->whereIn('id', $ids)->with(['user', 'parent.user'])->get()->groupBy('parent_id');
        $root = $grouped->get(null);

        return $this->buildNest($root, $grouped);
    }

    protected function buildIdNest($root, $grouped, &$ids = [])
    {
        foreach ($root as $comment) {
            $ids[] = $comment->id;

            if ($replies = $grouped->get($comment->id)) {
                $this->buildIdNest($replies, $grouped, $ids);
            }
        }

        return $ids;
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