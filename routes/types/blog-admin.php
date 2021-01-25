<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Blog\Admin', 'prefix' => 'admin/blog'], function () {
    $methods = ['index', 'edit', 'store', 'update', 'create'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
});
