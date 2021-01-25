@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            @php /** @var App\Models\BlogPost $post */ @endphp

            @if($post->exists)
                <h1>Редактирование поста «{{ $post->title }}»</h1>
            @else
                <h1>Создание поста</h1>
            @endif

            <a href="{{ route('blog.admin.posts.index') }}" class="btn btn-primary">Назад</a>
        </div>

        @include('blog.admin.blocks.messages')

        @if($post->exists)
            <form class="category-edit mb-2" method="POST" action="{{ route('blog.admin.posts.update', $post->id) }}">
            @method('PATCH')
        @else
            <form class="category-edit" method="POST" action="{{ route('blog.admin.posts.store') }}">
        @endif
            @csrf
            <div class="row">
                <div class="col-md-9">
                    @include('blog.admin.posts.blocks.post-edit')
                </div>

                <div class="col-md-3">
                    @include('blog.admin.posts.blocks.post-sidebar')
                </div>
            </div>
        </form>

        @if($post->exists)
            <form action="{{ route('blog.admin.posts.destroy', $post->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-block">
                            <div class="card-body">
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
