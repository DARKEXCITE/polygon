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
            value="{{ $post->title }}"
        >
    </div>
    <!-- /.form-group -->

    <div class="form-group">
        <label for="content">Содержание</label>
        <textarea id="content" name="content_raw" class="form-control" rows="20">{{ $post->content_raw }}</textarea>
    </div>
    <!-- /.form-group -->
</div>
