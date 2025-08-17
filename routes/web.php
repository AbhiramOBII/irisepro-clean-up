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

Route::get('/', function () {
    return view('welcome');
});

// SuperAdmin Routes
Route::prefix('superadmin')->middleware('web')->group(function () {
    Route::get('/login', 'SuperAdminAuthController@showLogin')->name('superadmin.login');
    Route::post('/login', 'SuperAdminAuthController@login');
    Route::get('/dashboard', 'SuperAdminAuthController@dashboard')->name('superadmin.dashboard');
    Route::get('/logout', 'SuperAdminAuthController@logout')->name('superadmin.logout');
    
    // Student Bulk Upload Routes (must be before resource routes)
    Route::get('students/bulk-upload', 'StudentController@bulkUpload')->name('students.bulk-upload');
    Route::post('students/process-bulk-upload', 'StudentController@processBulkUpload')->name('students.process-bulk-upload');
    Route::get('students/download-template', 'StudentController@downloadTemplate')->name('students.download-template');
    
    // Student CRUD Routes
    Route::resource('students', 'StudentController');
    
    // Yashodarshi Bulk Upload Routes (must be before resource routes)
    Route::get('yashodarshis/bulk-upload', 'YashodarshiController@bulkUpload')->name('yashodarshis.bulk-upload');
    Route::post('yashodarshis/process-bulk-upload', 'YashodarshiController@processBulkUpload')->name('yashodarshis.process-bulk-upload');
    Route::get('yashodarshis/download-template', 'YashodarshiController@downloadTemplate')->name('yashodarshis.download-template');
    
    // Yashodarshi CRUD Routes
    Route::resource('yashodarshis', 'YashodarshiController');
    
    // Task Management Routes
    Route::resource('tasks', 'TaskController')->names([
        'index' => 'superadmin.tasks.index',
        'create' => 'superadmin.tasks.create',
        'store' => 'superadmin.tasks.store',
        'show' => 'superadmin.tasks.show',
        'edit' => 'superadmin.tasks.edit',
        'update' => 'superadmin.tasks.update',
        'destroy' => 'superadmin.tasks.destroy'
    ]);
    Route::get('tasks/{task}/score', 'TaskController@score')->name('superadmin.tasks.score');
    
    // Task Score Management Routes
    Route::resource('task-scores', 'TaskScoreController')->names([
        'index' => 'superadmin.task-scores.index',
        'create' => 'superadmin.task-scores.create',
        'store' => 'superadmin.task-scores.store',
        'show' => 'superadmin.task-scores.show',
        'edit' => 'superadmin.task-scores.edit',
        'update' => 'superadmin.task-scores.update',
        'destroy' => 'superadmin.task-scores.destroy'
    ]);
    Route::get('tasks/{task}/create-score', 'TaskScoreController@create')->name('superadmin.task-scores.create-for-task');
    
    // Challenge Management Routes
    Route::resource('challenges', 'ChallengeController');
    
    // Batch Management Routes
    Route::resource('batches', 'BatchController');
    Route::put('batches/{batch}/students/{student}/payment', 'BatchController@updatePayment')->name('batches.update-payment');
    
    // Habit Management Routes
    Route::resource('habits', 'HabitController');
    
    // Settings Routes
    Route::get('settings', 'SettingsController@index')->name('superadmin.settings');
    Route::put('settings/password', 'SettingsController@updatePassword')->name('superadmin.settings.password');
});

// Mobile Student Routes (Frontend App)
Route::prefix('mobile')->middleware('web')->group(function () {
    // Splash screen route
    Route::get('/', function () {
        return view('frontendapp.splash');
    })->name('mobile.splash');
    
    // Student Authentication Routes
    Route::get('/login', 'MobileStudentController@showLogin')->name('mobile.login');
    Route::post('/send-otp', 'MobileStudentController@sendOtp')->name('mobile.send-otp');
    Route::get('/otp-verification', 'MobileStudentController@showOtpVerification')->name('mobile.otp-verification');
    Route::post('/verify-otp', 'MobileStudentController@verifyOtp')->name('mobile.verify-otp');
    Route::post('/logout', 'MobileStudentController@logout')->name('mobile.logout');
    
    // Welcome Screen Routes
    Route::get('/welcome', [MobileStudentController::class, 'welcome'])->name('mobile.welcome');
    Route::get('/welcome', 'MobileStudentController@showWelcome')->name('mobile.welcome');
    Route::post('/mark-welcome-seen', 'MobileStudentController@markWelcomeSeen')->name('mobile.mark-welcome-seen');
    
    // Habit Selection Routes
    Route::get('/select-habit', [MobileStudentController::class, 'selectHabit'])->name('mobile.select-habit');
    Route::post('/save-habits', [MobileStudentController::class, 'saveHabits'])->name('mobile.save-habits');
    Route::get('/select-habit', 'MobileStudentController@selectHabit')->name('mobile.select-habit');
    Route::post('/save-habit', 'MobileStudentController@saveHabit')->name('mobile.save-habit');
    
    // Student Dashboard and Main Routes
    Route::get('/dashboard', 'MobileStudentController@dashboard')->name('mobile.dashboard');
    Route::get('/profile', 'MobileStudentController@profile')->name('mobile.profile');
    Route::put('/profile', 'MobileStudentController@updateProfile')->name('mobile.profile.update');
    
    // Student Features Routes (to be expanded)
    Route::get('/tasks', 'MobileStudentController@tasks')->name('mobile.tasks');
    Route::get('/challenges', 'MobileStudentController@challenges')->name('mobile.challenges');
    Route::get('/habits', 'MobileStudentController@habits')->name('mobile.habits');
    Route::get('/achievements', 'MobileStudentController@achievements')->name('mobile.achievements');
    Route::get('/performance', 'MobileStudentController@performance')->name('mobile.performance');
    Route::get('/performance/{taskId}', 'MobileStudentController@performanceDetail')->name('mobile.performance.detail');
    
    // Habit Submission Route
    Route::post('/habit-submit', 'MobileStudentController@submitHabit')->name('habit.submit');
    
    // Task Details Routes
    Route::get('/task/{batch_id}/{task_id}', [\App\Http\Controllers\TaskDetailsController::class, 'show'])->name('mobile.task.details');
    Route::get('/task/submission/{task_id}/{batch_id}/', [\App\Http\Controllers\TaskDetailsController::class, 'showSubmission'])->name('mobile.task.submission');
    Route::get('/task/confirmation/{task_id}/{batch_id}/', [\App\Http\Controllers\TaskDetailsController::class, 'showConfirmation'])->name('mobile.task.confirmation');
    Route::get('/task/success/{taskId}/{batch_id}/', [\App\Http\Controllers\TaskDetailsController::class, 'showSuccess'])->name('mobile.task.success');
    Route::post('/task/{taskId}/start', [\App\Http\Controllers\TaskDetailsController::class, 'startTask'])->name('mobile.task.start');
    Route::post('/task/submit/{task_id}/{batch_id}', [\App\Http\Controllers\TaskDetailsController::class, 'submitTask'])->name('mobile.task.submit');
});

// Yashodarshi Authentication Routes
Route::prefix('yashodarshi')->middleware('web')->group(function () {
    Route::get('/login', 'YashodarshiAuthController@showLoginForm')->name('yashodarshi.login');
    Route::post('/send-otp', 'YashodarshiAuthController@sendOtp')->name('yashodarshi.send-otp');
    Route::get('/verify-otp', 'YashodarshiAuthController@showOtpForm')->name('yashodarshi.verify-otp');
    Route::post('/verify-otp', 'YashodarshiAuthController@verifyOtp');
    Route::post('/resend-otp', 'YashodarshiAuthController@resendOtp')->name('yashodarshi.resend-otp');
    Route::get('/dashboard', 'YashodarshiAuthController@dashboard')->name('yashodarshi.dashboard');
    Route::get('/batch/{id}', 'YashodarshiAuthController@viewBatch')->name('yashodarshi.batch.view');
    Route::get('/task/{batchId}/{taskId}/evaluate', 'YashodarshiAuthController@evaluateTask')->name('yashodarshi.task.evaluate');
    Route::get('/task/submission/{submissionId}/evaluate-detail', 'YashodarshiAuthController@evaluateDetail')->name('yashodarshi.submission.evaluate-detail');
    Route::post('/task/submission/{submissionId}/evaluate', 'YashodarshiAuthController@submitEvaluation')->name('yashodarshi.submission.evaluate');
    Route::post('/task/submission/{submissionId}/evaluate-detail', 'YashodarshiAuthController@submitDetailedEvaluation')->name('yashodarshi.submission.evaluate-detail.submit');
    Route::post('/task/submission/{submissionId}/store-evaluation', 'YashodarshiAuthController@storeEvaluationResult')->name('yashodarshi.submission.store-evaluation');
    Route::get('/task/submission/{submissionId}/view-full-score', 'YashodarshiAuthController@viewFullScore')->name('yashodarshi.submission.view-full-score');
    Route::post('/logout', 'YashodarshiAuthController@logout')->name('yashodarshi.logout');
});
