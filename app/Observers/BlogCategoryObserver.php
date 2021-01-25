<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{
    /**
     * Обработка перед созданием категории
     *
     * @param  BlogCategory  $blogCategory
     * @return void
     */
    public function creating(BlogCategory $blogCategory) {
        $this->setSlug($blogCategory);
    }

    /**
     * Обработка перед обновлентем категории
     *
     * @param  BlogCategory  $blogCategory
     * @return void
     */
    public function updating(BlogCategory $blogCategory) {
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param  BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Если идентификатор категории не установлен, то он выставляется на основании заголовка категории
     *
     * @param BlogCategory $blogCategory
     */
    protected function setSlug(BlogCategory $blogCategory) {
        if (empty($blogCategory->slug)) {
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }
}
