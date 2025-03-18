<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::resource('categories',   CategoryController::class);
Route::resource('posts', PostController::class);