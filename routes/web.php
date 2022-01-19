<?php

use Illuminate\Support\Facades\Route;

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

                    // For Home

Route::get('/', [App\Http\Controllers\PostController::class, 'homeindex']);


Route::get('/register/post', [App\Http\Controllers\PostController::class, 'create'])->name('CreatePost');
// ->middleware(['can:isAdmin'])->name('CreatePost');

Route::get('/show/post', [App\Http\Controllers\PostController::class, 'index'])->name('showPost');
Route::post('/store/post', [App\Http\Controllers\PostController::class, 'store'])->name('storePost');
Route::get('/edit/post/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('editPost');
Route::get('/update/post/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('updatePost');
Route::get('/delete/post/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('destroyPost');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

                // For Contact

Route::get('/manager', [App\Http\Controllers\ContactController::class, 'homeindex']);


Route::get('/register/post_contact', [App\Http\Controllers\ContactController::class, 'create'])->name('ManagerCreatePost');
// ->middleware(['can:isManger'])
Route::get('/show/post_contact', [App\Http\Controllers\ContactController::class, 'index'])->name('ManagershowPost');
Route::post('/store/post_contact', [App\Http\Controllers\ContactController::class, 'store'])->name('ManagerstorePost');
Route::get('/edit/post_contact/{id}', [App\Http\Controllers\ContactController::class, 'edit'])->name('ManagereditPost');
Route::get('/update/post_contact/{id}', [App\Http\Controllers\ContactController::class, 'update'])->name('ManagerupdatePost');
Route::get('/delete/post_contact/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('ManagerdestroyPost');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// For Editor Blog

Route::get('/editor', [App\Http\Controllers\EditorController::class, 'homeindex']);


Route::get('/editor/register/post_contact', [App\Http\Controllers\EditorController::class, 'create'])->name('EditorCreatePost');
// ->middleware(['can:isEditor'])
Route::get('/editor/show/post_contact', [App\Http\Controllers\EditorController::class, 'index'])->name('EditorshowPost');
Route::post('/editor/store/post_contact', [App\Http\Controllers\EditorController::class, 'store'])->name('EditorstorePost');
Route::get('/editor/edit/post_contact/{id}', [App\Http\Controllers\EditorController::class, 'edit'])->name('EditoreditPost');
Route::get('/editor/update/post_contact/{id}', [App\Http\Controllers\EditorController::class, 'update'])->name('EditorupdatePost');
Route::get('/editor/delete/post_contact/{id}', [App\Http\Controllers\EditorController::class, 'destroy'])->name('EditordestroyPost');
