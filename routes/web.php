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

/*Route::group([
    'prefix' => 'admin',
    'name' => 'admin.' ,
    'middleware' => ['auth', 'verified']
], function () {

});*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return view('layouts.dashboard');
        })->name('dashboard');

        Route::get('/posts/trash', [PostController::class, 'trashIndex'])->name('posts.trash');
        Route::resource('posts', PostController::class, [
           'names' => [
               'index' => 'posts',
               'create' => 'posts.new',
               'show' => 'posts.show',
               'update' => 'posts.update',
               'edit' => 'posts.edit',
               'destroy' => 'posts.delete',
           ]
        ]);
    }
);



require __DIR__.'/auth.php';
