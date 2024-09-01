<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('projects')->group(function () {
        Route::post('/add', [ProjectsController::class, 'createProject']);
        Route::delete('/{id}', [ProjectsController::class, 'deleteProject']);
        Route::get('/list/{page}', [ProjectsController::class, 'listProjects']);
        Route::get('/{id}', [ProjectsController::class, 'selectProject']);
        Route::put('/{id}', [ProjectsController::class, 'updateProject']);
    });
    
    Route::prefix('tasks')->group(function () {
        Route::post('/add', [TasksController::class, 'createTask']);
        Route::delete('/{id}', [TasksController::class, 'deleteTask']);
        Route::get('/list/{page}', [TasksController::class, 'listTasks']);
        Route::get('/{id}', [TasksController::class, 'selectTask']);
        Route::put('/{id}', [TasksController::class, 'updateTask']);
    });
});
