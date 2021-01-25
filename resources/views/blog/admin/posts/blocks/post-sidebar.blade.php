@php
    /** @var App\Models\BlogPost $post */
@endphp

<aside class="row justify-content-center">
    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>


        @if($post->exists)
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <ul class="card-body list-unstyled mb-0">
                        <li>ID: {{ $post->id }}</li>
                        <li>Автор: {{ $post->user->name }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="main" role="tabpanel">
                                <div class="form-group">
                                    <label for="createdAt">Создано:</label>
                                    <input type="text" name="created_at" id="createdAt" value="{{ $post->created_at }}" class="form-control" readonly>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="updatedAt">Изменено:</label>
                                    <input type="text" name="updated_at" id="updatedAt" value="{{ $post->updated_at }}" class="form-control" readonly>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="published_at">Опубликовано:</label>
                                    <input type="text" name="published_at" id="publishedAt" value="{{ $post->published_at }}" class="form-control" readonly>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="deletedAt">Удалено:</label>
                                    <input type="text" name="deleted_at" id="deletedAt" value="{{ $post->deleted_at }}" class="form-control" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</aside>
