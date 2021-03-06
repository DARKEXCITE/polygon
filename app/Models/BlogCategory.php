<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 *
 * @package App\Models
 *
 * @property-read BlogCategory  $parentCategory
 * @property-read string        $parentTitle
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'parent_id'
    ];

    /**
     * Родительская категория
     *
     * @return BelongsTo
     */
    public function parentCategory() {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }
}
