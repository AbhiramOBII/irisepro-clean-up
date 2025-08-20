<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\YashodarshiController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskScoreController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\SupportRequestController;
use App\Http\Controllers\SuperAdminEnrollmentController;
use App\Http\Controllers\SettingsController;

// SuperAdmin Routes
Route::get('/login', [SuperAdminAuthController::class, 'showLogin'])->name('superadmin.login');
Route::post('/login', [SuperAdminAuthController::class, 'login']);
Route::get('/dashboard', [SuperAdminAuthController::class, 'dashboard'])->name('superadmin.dashboard');
Route::get('/logout', [SuperAdminAuthController::class, 'logout'])->name('superadmin.logout');

// Student Bulk Upload Routes (must be before resource routes)
Route::get('students/bulk-upload', [StudentController::class, 'bulkUpload'])->name('students.bulk-upload');
Route::post('students/process-bulk-upload', [StudentController::class, 'processBulkUpload'])->name('students.process-bulk-upload');
Route::get('students/download-template', [StudentController::class, 'downloadTemplate'])->name('students.download-template');

// Student CRUD Routes
Route::resource('students', StudentController::class);

// Yashodarshi Bulk Upload Routes (must be before resource routes)
Route::get('yashodarshis/bulk-upload', [YashodarshiController::class, 'bulkUpload'])->name('yashodarshis.bulk-upload');
Route::post('yashodarshis/process-bulk-upload', [YashodarshiController::class, 'processBulkUpload'])->name('yashodarshis.process-bulk-upload');
Route::get('yashodarshis/download-template', [YashodarshiController::class, 'downloadTemplate'])->name('yashodarshis.download-template');

// Yashodarshi CRUD Routes
Route::resource('yashodarshis', YashodarshiController::class);

// Task Management Routes
Route::resource('tasks', TaskController::class)->names([
    'index' => 'superadmin.tasks.index',
    'create' => 'superadmin.tasks.create',
    'store' => 'superadmin.tasks.store',
    'show' => 'superadmin.tasks.show',
    'edit' => 'superadmin.tasks.edit',
    'update' => 'superadmin.tasks.update',
    'destroy' => 'superadmin.tasks.destroy'
]);
Route::get('tasks/{task}/score', [TaskController::class, 'score'])->name('superadmin.tasks.score');

// Task Score Management Routes
Route::resource('task-scores', TaskScoreController::class)->names([
    'index' => 'superadmin.task-scores.index',
    'create' => 'superadmin.task-scores.create',
    'store' => 'superadmin.task-scores.store',
    'show' => 'superadmin.task-scores.show',
    'edit' => 'superadmin.task-scores.edit',
    'update' => 'superadmin.task-scores.update',
    'destroy' => 'superadmin.task-scores.destroy'
]);
Route::get('tasks/{task}/create-score', [TaskScoreController::class, 'create'])->name('superadmin.task-scores.create-for-task');

// Challenge Management Routes
Route::resource('challenges', ChallengeController::class);

// Batch Management Routes
Route::resource('batches', BatchController::class);
Route::put('batches/{batch}/students/{student}/payment', [BatchController::class, 'updatePayment'])->name('batches.update-payment');

// Habit Management Routes
Route::resource('habits', HabitController::class);

// Achievement Management Routes
Route::resource('achievements', AchievementController::class);

// Support Request Management Routes
Route::get('support-requests', [SupportRequestController::class, 'index'])->name('superadmin.support-requests.index');
Route::get('support-requests/{id}', [SupportRequestController::class, 'show'])->name('superadmin.support-requests.show');
Route::get('support-requests/{id}/details', [SupportRequestController::class, 'getDetails'])->name('superadmin.support-requests.details');
Route::put('support-requests/{id}/status', [SupportRequestController::class, 'updateStatus'])->name('superadmin.support-requests.update-status');
Route::delete('support-requests/{id}', [SupportRequestController::class, 'destroy'])->name('superadmin.support-requests.destroy');

// Enrollment Management Routes
Route::get('enrollments', [SuperAdminEnrollmentController::class, 'index'])->name('superadmin.enrollments.index');
Route::get('enrollments/{id}', [SuperAdminEnrollmentController::class, 'show'])->name('superadmin.enrollments.show');
Route::put('enrollments/{id}/payment', [SuperAdminEnrollmentController::class, 'updatePaymentStatus'])->name('superadmin.enrollments.payment');
Route::delete('enrollments/{id}', [SuperAdminEnrollmentController::class, 'destroy'])->name('superadmin.enrollments.destroy');

// Settings Routes
Route::get('settings', [SettingsController::class, 'index'])->name('superadmin.settings');
Route::put('settings/password', [SettingsController::class, 'updatePassword'])->name('superadmin.settings.password');
