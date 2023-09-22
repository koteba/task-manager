<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// ...

Route::get('/', function () {
    return view('home');
})->name('home')->middleware(['auth']);

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
    
});

require 'auth.php';
