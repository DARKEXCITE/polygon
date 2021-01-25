<div class="tab-pane" id="meta" role="tabpanel">
    <div class="form-group">
        <div class="form-group">
            <label for="slug">Идентификатор</label>
            <input
                type="text"
                class="form-control"
                id="slug"
                name="slug"
                value="{{ $post->slug }}"
            >
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label for="category_id">Категория</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $option)
                    <option
                        value="{{ $option->id }}"
                        @if($option->id == $post->category_id)
                        selected
                        @endif
                    >{{ $option->title }}</option>
                @endforeach
            </select>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label for="excerpt">Отрывок</label>
            <textarea id="excerpt" name="excerpt" class="form-control" rows="5">{{ $post->excerpt }}</textarea>
        </div>
        <!-- /.form-group -->

        <div class="form-check">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" id="is_published" class="form-check-input" value="1" @if($post->is_published) checked @endif>
            <label for="is_published">Опубликовано</label>
        </div>
        <!-- /.form-group -->
    </div>
</div>
