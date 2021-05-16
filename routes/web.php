<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Users\{
    UserController,
    AdminUserController,
    EditorUserController,
    AuthorUserController
};
use App\Http\Controllers\Dashboard\Posts\{
    PostController,
    PublishedPostController,
    DraftPostController,
    PostTrashController
};
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

    Route::resource('posts', PostController::class)->except('show');
    Route::middleware('can:see-post')->prefix('/posts')->name('posts.')->group(function () {
        Route::get('published', [PublishedPostController::class, 'index'])->name('published.index');
        Route::get('drafts', [DraftPostController::class, 'index'])->name('drafts.index');
        Route::get('trash', [PostTrashController::class, 'index'])->name('trash.index');
    });

    Route::resource('users', UserController::class)->except('show');
    Route::middleware('can:see-other-users')->prefix('/users')->name('users.')->group(function () {
        Route::get('admins', [AdminUserController::class, 'index'])->name('admins.index');
        Route::get('editors', [EditorUserController::class, 'index'])->name('editors.index');
        Route::get('authors', [AuthorUserController::class, 'index'])->name('authors.index');
    });
});

route::middleware(['guest'])->group(function () {
    Route::get('blog/{post}', [PostController::class, 'show'])->name('posts.show');
});


require __DIR__.'/auth.php';
