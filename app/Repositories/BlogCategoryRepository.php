<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository {
    /**
     * Получение модели категорий
     *
     * @return string
     */
    protected function getModelClass() {
        return Model::class;
    }

    /**
     * Получение модели для редактирования категории
     *
     * @param $id
     * @return mixed
     */
    public function getEdit($id) {
        return $this
            ->startConditions()
            ->find($id);
    }

    /**
     * Получить список категорий для вывода в выпадающем списке родительской категории
     *
     * @return Collection
     */
    public function getForSelect() {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS title'
        ]);

        /**
         * @var Collection $result
         */
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Получение катетогрии для вывода пагинации
     *
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null) {
        $columns = [
            'id',
            'title',
            'parent_id'
        ];

        /** @var LengthAwarePaginator $paginate */
        $paginate = $this
            ->startConditions()
            ->select($columns)
            ->with(['parentCategory:id,title'])
            /* ... */
            ->paginate($perPage);

        return $paginate;
    }
}
