<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository {
    /**
     * Получение модели постов
     *
     * @return string
     */
    protected function getModelClass() {
        return Model::class;
    }

    /**
     * Получение постов для вывода пагинации
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate() {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        /** @var LengthAwarePaginator $paginate */
        $paginate = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            /* Подгрузка к каждому посту отношения к категории и автору */
            ->with(['category', 'user'])
            /* ... */
            ->paginate(15);

        return $paginate;
    }

    /**
     * Получение модели для редактирования поста
     *
     * @param $id
     * @return mixed
     */
    public function getEdit($id) {
        return $this
            ->startConditions()
            ->find($id);
    }
}
