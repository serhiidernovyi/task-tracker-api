<?php

use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['fake-auth'])->prefix('tasks')->group(function () {
    Route::post('/', [TaskController::class, 'create']);
    Route::get('/', [TaskController::class, 'getAll']);
    Route::get('/{id}', [TaskController::class, 'getById']);
    Route::patch('/{id}/status', [TaskController::class, 'updateStatus']);
    Route::patch('/{id}/assign', [TaskController::class, 'assign']);
});

