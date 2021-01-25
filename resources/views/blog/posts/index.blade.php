@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="posts">
            @foreach($posts as $post)
                <article class="post">
                    <h2 class="post__title">
                        {{ $post->title  }}
                    </h2>
                    <div class="post__meta">
                        <span>{{ $post->published_at }}</span>
                    </div>
                    <p class="post__content">
                        {{ $post->content_html }}
                    </p>
                </article>
            @endforeach
        </div>
    </div>
@endsection
