<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
include_once __DIR__ . "/types/blog.php";
include_once __DIR__ . "/types/blog-admin.php";

Route::get('/home', 'HomeController@index')->name('home');
