<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Обработка перед созданием поста
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost) {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHTML($blogPost);
        $this->setUser($blogPost);
    }

    /**
     * Обработка перед обновлентем поста
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost) {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHTML($blogPost);
        $this->setUser($blogPost);
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Если дата публикации не установлена и выставляется флаг - Опубликовано,
     * то устанавливается текущая дата публикации
     *
     * @param BlogPost $blogPost
     */
    protected function setPublishedAt(BlogPost $blogPost) {
        if (empty($blogPost->published_at) && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * Если идентификатор поста не установлен, то он выставляется на основании заголовка публикации
     *
     * @param BlogPost $blogPost
     */
    protected function setSlug(BlogPost $blogPost) {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * Преобразование маркировки контента поста в HTML
     *
     * @param BlogPost $blogPost
     */
    protected function setHTML(BlogPost $blogPost) {
        if ($blogPost->isDirty('content_raw')) {
            // TODO: Презобразование маркировки в HTML
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     * Если не указан user_id, устанавливается пользователь по-умолчанию
     *
     * @param BlogPost $blogPost
     */
    protected function setUser(BlogPost $blogPost) {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }
}
