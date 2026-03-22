<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUpdateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'check-status'])->name('dashboard');

Route::middleware(['auth', 'verified', 'check-status'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');

    // Admin Routes - User Management
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update', 'destroy']);
    });

    // PM & Member Routes - Project Access
    Route::middleware('role:pm,member')->group(function () {
        Route::resource('projects', ProjectController::class);
    });

    // PM Routes - Task Creation
    Route::middleware('role:pm')->group(function () {
        Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('projects/{project}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create-standalone');
    });

    // Task Management Routes - Granular Authorization via Policy
    Route::resource('tasks', TaskController::class)->only(['show', 'edit', 'update', 'destroy']);
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    // Task Status Update - PM & Member
    Route::middleware('role:pm,member')->group(function () {
        Route::patch('tasks/{task}/status/{status}', [TaskController::class, 'updateStatus'])->name('tasks.update-status');
    });

    // Task Updates - PM & Member
    Route::middleware('role:member,pm')->group(function () {
        Route::get('tasks/{task}/updates', [TaskUpdateController::class, 'show'])->name('task-updates.show');
        Route::post('tasks/{task}/updates', [TaskUpdateController::class, 'store'])->name('task-updates.store');
        Route::get('task-files/{taskFile}/download', [TaskUpdateController::class, 'downloadFile'])->name('task-files.download');
    });
});

require __DIR__ . '/auth.php';
