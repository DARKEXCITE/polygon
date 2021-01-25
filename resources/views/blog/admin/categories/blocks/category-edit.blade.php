@php
    /** @var App\Models\BlogCategory $category */
    /** @var App\Models\BlogCategory $categories */
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <a href="#main" class="nav-link active" data-toggle="tab" role="tab">Основные данные</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="main" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input
                                type="text"
                                class="form-control"
                                id="title"
                                name="title"
                                minlength="3"
                                required
                                value="{{ $category->title }}"
                            >
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input
                                type="text"
                                class="form-control"
                                id="slug"
                                name="slug"
                                value="{{ $category->slug }}"
                            >
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="parent">Родительская категория</label>
                            <select name="parent_id" id="parent" class="form-control">
                                @foreach($categories as $option)
                                    <option
                                        value="{{ $option->id }}"
                                        @if($option->id == $category->parent_id)
                                            selected
                                        @endif
                                    >{{ $option->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
