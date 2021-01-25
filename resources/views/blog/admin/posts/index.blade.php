@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Список постов (всего: {{ $posts->total() }}):</h1>
            <a href="{{ route('blog.admin.posts.create') }}" class="btn btn-primary">Добавить</a>
        </div>

        @include('blog.admin.blocks.messages')

        <div class="posts-table mb-5">
            <div class="posts-table__item posts-table__header">
                <div class="text-center">ID</div>
                <div>Заголовок</div>
                <div class="text-right">Автор</div>
                <div class="text-center">Категория</div>
                <div class="text-center">Дата публикации</div>
            </div>

            @foreach($posts as $post)
                @php
                    /** @var App\Models\BlogPost $post */
                @endphp
                <div class="posts-table__item py-2 @if(!$post->is_published) bg-gray @endif">
                    <div class="post__id text-center">{{ $post->id }}</div>
                    <div class="post__title">
                        <a href="{{ route('blog.admin.posts.edit', $post->id) }}">
                            <h3>{{ $post->title }}</h3>
                        </a>
                    </div>
                    <div class="text-right">{{ $post->user->name }}</div>
                    <div class="text-center">{{ $post->category->title }}</div>
                    <div class="text-center">{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d M 20y - H:i') : 'Не опубликован' }}</div>
                </div>
            @endforeach
        </div>

        @if($posts->total() > $posts->count())
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
