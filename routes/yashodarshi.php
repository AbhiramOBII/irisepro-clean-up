<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\YashodarshiAuthController;

// Yashodarshi Authentication Routes
Route::get('/login', [YashodarshiAuthController::class, 'showLoginForm'])
    ->name('yashodarshi.login');
Route::post('/send-otp', [YashodarshiAuthController::class, 'sendOtp'])
    ->name('yashodarshi.send-otp');
Route::get('/verify-otp', [YashodarshiAuthController::class, 'showOtpForm'])
    ->name('yashodarshi.verify-otp');
Route::post('/verify-otp', [YashodarshiAuthController::class, 'verifyOtp']);
Route::post('/resend-otp', [YashodarshiAuthController::class, 'resendOtp'])
    ->name('yashodarshi.resend-otp');
Route::get('/dashboard', [YashodarshiAuthController::class, 'dashboard'])
    ->name('yashodarshi.dashboard');
Route::get('/batch/{id}', [YashodarshiAuthController::class, 'viewBatch'])
    ->name('yashodarshi.batch.view');
Route::get('/task/{batchId}/{taskId}/evaluate', [YashodarshiAuthController::class, 'evaluateTask'])
    ->name('yashodarshi.task.evaluate');
Route::get('/task/submission/{submissionId}/evaluate-detail', [YashodarshiAuthController::class, 'evaluateDetail'])
    ->name('yashodarshi.submission.evaluate-detail');
Route::post('/task/submission/{submissionId}/evaluate', [YashodarshiAuthController::class, 'submitEvaluation'])
    ->name('yashodarshi.submission.evaluate');
Route::post('/task/submission/{submissionId}/evaluate-detail', [YashodarshiAuthController::class, 'submitDetailedEvaluation'])
    ->name('yashodarshi.submission.evaluate-detail.submit');
Route::post('/task/submission/{submissionId}/store-evaluation', [YashodarshiAuthController::class, 'storeEvaluationResult'])
    ->name('yashodarshi.submission.store-evaluation');
Route::get('/task/submission/{submissionId}/view-full-score', [YashodarshiAuthController::class, 'viewFullScore'])
    ->name('yashodarshi.submission.view-full-score');
Route::post('/logout', [YashodarshiAuthController::class, 'logout'])
    ->name('yashodarshi.logout');
