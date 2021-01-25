<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 *
 * @package App\Models
 *
 * @property BlogCategory $category
 * @property User $user
 * @property string $title
 * @property string $slug
 * @property string $category_id
 * @property string $content_raw
 * @property string $content_html
 * @property string $published_at
 * @property string $excerpt
 * @property boolean $is_published
 */
class BlogPost extends Model
{
    use SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $dates = [
      'published_at'
    ];

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content_raw',
        'published_at',
        'excerpt',
        'is_published'
    ];

    /**
     * Категория статьи
     *
     * @return BelongsTo
     */
    public function category() {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Автор статьи
     *
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
