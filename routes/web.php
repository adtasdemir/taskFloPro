<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [ProjectsController::class, 'listProjectsWeb'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
Route::get('/tasks/list', [TasksController::class, 'listTasksWeb'])
    ->middleware(['auth'])
    ->name('tasks');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('projects')->group(function () {
        Route::get('/statuses', [ProjectsController::class, 'getStatuses']);
        Route::get('/{id}', [ProjectsController::class, 'selectProject']);
        Route::put('/{id}', [ProjectsController::class, 'updateProject'])->name('projects.update');
        Route::post('/add', [ProjectsController::class, 'createProject'])->name('projects.add');;
        Route::delete('/{id}', [ProjectsController::class, 'deleteProject']);
    });
    
    Route::prefix('tasks')->group(function () {
        Route::get('/statuses', [TasksController::class, 'getStatuses']);
        Route::get('/{id}', [TasksController::class, 'selectTask']);
        Route::put('/{id}', [TasksController::class, 'updateTask'])->name('tasks.update');
        Route::post('/add', [TasksController::class, 'createTask'])->name('tasks.add');;
        Route::delete('/{id}', [TasksController::class, 'deleteTask']);
    });
});

require __DIR__.'/auth.php';
