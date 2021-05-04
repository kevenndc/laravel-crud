<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.dashboard');
    })->name('dashboard');

    Route::prefix('posts')->group(function () {
        Route::resource('posts', PostController::class)->except('show');
    });
});

route::middleware(['guest'])->group(function () {
    Route::get('blog/{post}', [PostController::class, 'show'])->name('posts.show');
});


require __DIR__.'/auth.php';
