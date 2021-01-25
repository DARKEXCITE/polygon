<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Blog'], function () {
    Route::resource('', 'PostController')->names('blog.posts');
});

Route::group(['prefix' => 'digging-deeper'], function () {
    Route::get('collections', 'DiggingDeeperController@collections')
        ->name('digging_deeper.collections');
    Route::get('prepare-catalog', 'DiggingDeeperController@prepareCatalog')
        ->name('digging_deeper.catalog');
});
