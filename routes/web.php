<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// ...
// Route::get('/', 'HomeController@index')->name('home')->middleware(['auth']);
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth']);
Route::get('/projectsdetails', [HomeController::class, 'show'])->name('projectsdetails')->middleware(['auth']);

// Route::get('/', function () {
//     return view('home');
// })->name('home')->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');
    
    // Other Resource Routes
    Route::resource('category', CategoryController::class);
    Route::resource('status', StatusController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('projects', ProjectController::class);
    Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::get('/projects/{project}/tasks/show', [TaskController::class, 'show'])->name('all.show');
    Route::get('/archive', [ProjectController::class, 'archive'])->name('projects.archive');
    Route::delete('/trash/{id}', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::get('/restore/{id}', [ProjectController::class, 'restore'])->name('projects.restore');
    
});

require 'auth.php';
