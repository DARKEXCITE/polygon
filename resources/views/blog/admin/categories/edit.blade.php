@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            @php /** @var App\Models\BlogCategory $category */ @endphp

            @if($category->exists)
                <h1>Редактирование категории «{{ $category->title }}»</h1>
            @else
                <h1>Создание категории</h1>
            @endif

            <a href="{{ route('blog.admin.categories.index') }}" class="btn btn-primary">Назад</a>
        </div>

        @include('blog.admin.blocks.messages')

        @if($category->exists)
            <form class="category-edit" method="POST" action="{{ route('blog.admin.categories.update', $category->id) }}">
            @method('PATCH')
        @else
            <form class="category-edit" method="POST" action="{{ route('blog.admin.categories.store') }}">
        @endif
            @csrf
            <div class="row">
                <div class="col-md-9">
                    @include('blog.admin.categories.blocks.category-edit')
                </div>

                <div class="col-md-3">
                    @include('blog.admin.categories.blocks.category-sidebar')
                </div>
            </div>
        </form>
    </div>
@endsection
