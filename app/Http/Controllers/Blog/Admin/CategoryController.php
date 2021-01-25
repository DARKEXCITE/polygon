<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends BaseController {
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct() {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Отображение страницы категорий
     *
     * @return View
     */
    public function index() {
        $categories = $this->blogCategoryRepository->getAllWithPaginate(15);

        return view('blog.admin.categories.index',
            compact('categories'));
    }

    /**
     * Отображение страницы создания категории
     *
     * @return View
     */
    public function create() {
        $category = BlogCategory::make();
        $categories = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.categories.edit',
            compact('categories', 'category'));
    }

    /**
     * Сохранение новой категории
     *
     * @param BlogCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request) {
        // Создание объекта и добавление в БД
        $category = BlogCategory::create($request->input());

        if ($category) {
            return redirect()
                ->route('blog.admin.categories.edit', [$category->id])
                ->with(['success' => 'Категория добавлена']);
        }

        return back()
            ->withErrors(['err' => 'Ошибка сохранения категории'])
            ->withInput();
    }

    /**
     * Отображение страницы редактирования категории
     *
     * @param int $id
     * @return View
     */
    public function edit($id) {
        $category = $this->blogCategoryRepository->getEdit($id);
        if (empty($category)) {
            abort(404);
        }

        $categories = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.categories.edit',
            compact('category', 'categories'));
    }

    /**
     * Обновление категории
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id) {
        $category = $this->blogCategoryRepository->getEdit($id);
        if (empty($category)) {
           return back()
               ->withErrors(['err' => "Запись ID=[{$id}] не найдена"])
               ->withInput();
        }

        $result = $category->update($request->all());
        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $category->id)
                ->with(['success' => 'Изменения категории сохранены']);
        } else {
            return back()
                ->withErrors(['err' => 'Ошибка сохранения изменений'])
                ->withInput();
        }
    }
}
