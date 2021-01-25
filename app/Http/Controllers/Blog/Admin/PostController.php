<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends BaseController {
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct() {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }
    /**
     * Страница отображения всех постов
     *
     * @return View
     */
    public function index() {
        $posts = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index',
            compact('posts'));
    }

    /**
     * Страница создания нового поста
     *
     * @return View
     */
    public function create() {
        // Создание объекта без сохранения в БД
        $post = BlogPost::make();
        $categories = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.posts.edit',
            compact('post', 'categories'));
    }

    /**
     * Сохранение нового поста
     *
     * @param BlogPostCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogPostCreateRequest $request) {
        // Создание объекта и добавление в БД
        $post = BlogPost::create($request->input());

        if ($post) {
            $job = new BlogPostAfterCreateJob($post);
            $this->dispatch($job);

            return redirect()
                ->route('blog.admin.posts.edit', [$post->id])
                ->with(['success' => 'Пост добавлен']);
        }

        return back()
            ->withErrors(['err' => 'Ошибка сохранения поста'])
            ->withInput();
    }

    /**
     * Страница редактирования поста
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id) {
        $post = $this->blogPostRepository->getEdit($id);
        if (empty($post)) {
            abort(404);
        }

        $categories = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.posts.edit',
            compact('post', 'categories'));
    }

    /**
     * Обновление поста
     *
     * @param BlogPostUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogPostUpdateRequest $request, $id) {
        $post = $this->blogPostRepository->getEdit($id);
        if (empty($post)) {
            return back()
                ->withErrors(['err' => "Запись ID=[{$id}] не найдена"])
                ->withInput();
        }

        $result = $post->update($request->all());
        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $post->id)
                ->with(['success' => 'Изменения поста сохранены']);
        } else {
            return back()
                ->withErrors(['err' => 'Ошибка сохранения изменений'])
                ->withInput();
        }
    }

    /**
     * Удаление поста
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id) {
        $result = BlogPost::destroy($id);

        if ($result) {
            BlogPostAfterDeleteJob::dispatch($id);

            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => "Запись id[$id] удалена"]);
        } else {
            return back()
                ->withErrors(['err' => 'Ошибка удаления']);
        }
    }
}
