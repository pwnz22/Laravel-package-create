<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        body {
            font-family: 'Avenir';
        }

        .comment:not(:first-child) {
            margin: 20px 0 40px 60px;
            border-left: 1px solid #ccc;
            padding-left: 20px;
        }
    </style>

</head>
<body>

<h1>{{ $article->title }}</h1>

@foreach($comments as $comment)
    <div class="comment">
        <h4>
            {{ $comment->user->name }}

            @if ($comment->parent_id)
                <small>In reply to {{ $comment->parent->user->name }}</small>
            @endif
        </h4>

        <p>{{ $comment->body }}</p>

        @foreach($comment->replies as $reply)
            <div class="comment">
                <h4>
                    {{ $reply->user->name }}

                    @if ($reply->parent_id)
                        <small>In reply to {{ $reply->parent->user->name }}</small>
                    @endif
                </h4>

                <p>{{ $reply->body }}</p>

                @foreach($reply->replies as $reply2)
                    <div class="comment">
                        <h4>
                            {{ $reply2->user->name }}

                            @if ($reply2->parent_id)
                                <small>In reply to {{ $reply2->parent->user->name }}</small>
                            @endif
                        </h4>

                        <p>{{ $reply2->body }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endforeach

</body>
</html>
