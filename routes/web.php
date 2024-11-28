<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
})->name('home');

Route::resource('/books', BookController::class);
Route::resource('/authors', AuthorController::class);
Route::resource('/categories', CategoryController::class);

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
