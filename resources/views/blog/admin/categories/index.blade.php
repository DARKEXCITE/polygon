@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Список категорий (всего: {{ $categories->total() }}):</h1>
            <a href="{{ route('blog.admin.categories.create') }}" class="btn btn-primary">Добавить</a>
        </div>

        <div class="categories-list mb-5">
            <div class="categories-list__item categories-list__header">
                <div class="text-center">ID</div>
                <div>Заголовок</div>
                <div class="text-center">Родитель</div>
            </div>

            @foreach($categories as $category)
                <div class="categories-list__item">
                    <div class="category__id text-center">{{ $category->id }}</div>
                    <div class="category__title">
                        <a href="{{ route('blog.admin.categories.edit', $category->id) }}">
                            <h3>{{ $category->title }}</h3>
                        </a>
                    </div>
                    <div class="category__parent-id text-center @if(in_array($category->parent_id, [0, 1])) text-gray @endif">
                        {{ optional($category->parentCategory)->title }}
                    </div>
                </div>
            @endforeach
        </div>

        @if($categories->total() > $categories->count())
            <div class="d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
