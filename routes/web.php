<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// login
Route::view('/', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// register
Route::view('/register', 'auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    
    // TASK
    // task list
    Route::get('/task/list', [TaskController::class, 'list'])->name('task.list');

    // task single view
    Route::get('/task/details/{id}', [TaskController::class, 'single'])->name('task.detail');

    // task create
    Route::view('/task/new', 'task');
    Route::post('/task/create', [TaskController::class, 'create'])->name('task.create');

    // task edit
    Route::post('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');

    // task delete
    Route::delete('/task/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');

    // CATEGORY
    // category list
    Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');

    // category create and edit
    Route::get('/category/create', [CategoryController::class, 'form']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'form'])->name('category.edit');
    Route::post('/category/save', [CategoryController::class, 'save'])->name('category.save');

    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
});