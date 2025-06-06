<?php

use App\Http\Controllers\Brand;
use App\Http\Controllers\Category;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::resource('/brand', Brand::class);
Route::resource('/category', Category::class);
Route::resource('/product', ProductController::class);