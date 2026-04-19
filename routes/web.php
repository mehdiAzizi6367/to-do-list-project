<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('todos.index') : view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('todos', \App\Http\Controllers\TodoController::class);
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::patch('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');

    // Task Management
    Route::get('/todos', [AdminController::class, 'todos'])->name('todos');
    Route::get('/todos/{todo}', [AdminController::class, 'showTodo'])->name('todos.show');
    Route::patch('/todos/{todo}', [AdminController::class, 'updateTodo'])->name('todos.update');
    Route::delete('/todos/{todo}', [AdminController::class, 'deleteTodo'])->name('todos.destroy');

    // Admin Creation
    Route::get('/create-admin', [AdminController::class, 'createAdmin'])->name('create-admin');
    Route::post('/create-admin', [AdminController::class, 'storeAdmin'])->name('store-admin');
});

require __DIR__.'/auth.php';
