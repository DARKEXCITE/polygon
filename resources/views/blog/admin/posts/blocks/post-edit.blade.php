@php
    /** @var App\Models\BlogPost $post */
    /** @var App\Models\BlogCategory $categories */
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Статус:
                @if($post->is_published)
                    <span class="text-success">Опубликован</span>
                @else
                    <span class="text-dark">Черновик</span>
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <a href="#main" class="nav-link active" data-toggle="tab" role="tab">Основные данные</a>
                    </li>
                    <li class="nav-item">
                        <a href="#meta" class="nav-link" data-toggle="tab" role="tab">Мета-данные</a>
                    </li>
                </ul>

                <div class="tab-content">
                    @include('blog.admin.posts.blocks.main-tab')
                    @include('blog.admin.posts.blocks.meta-tab')
                </div>
            </div>
        </div>
    </div>
</div>
