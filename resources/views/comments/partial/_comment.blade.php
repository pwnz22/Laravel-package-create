<div class="comment">
    <h4>
        {{ $comment->user->name }}

        @if ($comment->parent_id)
            <small>In reply to {{ $comment->parent->user->name }}</small>
        @endif
    </h4>

    <p>{{ $comment->body }}</p>

    @foreach($comment->replies as $reply)
        @include('comments.partial._comment', ['comment' => $reply])
    @endforeach
</div>
