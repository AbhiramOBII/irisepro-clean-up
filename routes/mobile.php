<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileStudentController;
use App\Http\Controllers\TaskDetailsController;
use App\Http\Controllers\LeaderboardController;

// Mobile Student Routes (Frontend App)
// Splash screen route
Route::get('/', function () {
    return view('frontendapp.splash');
})->name('mobile.splash');

// Student Authentication Routes
Route::get('/login', [MobileStudentController::class, 'showLogin'])->name('mobile.login');
Route::post('/send-otp', [MobileStudentController::class, 'sendOtp'])->name('mobile.send-otp');
Route::get('/otp-verification', [MobileStudentController::class, 'showOtpVerification'])->name('mobile.otp-verification');
Route::post('/verify-otp', [MobileStudentController::class, 'verifyOtp'])->name('mobile.verify-otp');
Route::post('/logout', [MobileStudentController::class, 'logout'])->name('mobile.logout');

// Welcome Screen Routes
Route::get('/welcome', [MobileStudentController::class, 'showWelcome'])->name('mobile.welcome');
Route::post('/mark-welcome-seen', [MobileStudentController::class, 'markWelcomeSeen'])->name('mobile.mark-welcome-seen');

// Habit Selection Routes
Route::get('/select-habit', [MobileStudentController::class, 'selectHabit'])->name('mobile.select-habit');
Route::post('/save-habit', [MobileStudentController::class, 'saveHabit'])->name('mobile.save-habit');

// Student Dashboard and Main Routes
Route::get('/dashboard', [MobileStudentController::class, 'dashboard'])->name('mobile.dashboard');
Route::get('/profile', [MobileStudentController::class, 'profile'])->name('mobile.profile');
Route::put('/profile', [MobileStudentController::class, 'updateProfile'])->name('mobile.profile.update');
Route::get('/support', [MobileStudentController::class, 'support'])->name('mobile.support');
Route::post('/support', [MobileStudentController::class, 'submitSupport'])->name('mobile.support.submit');
Route::get('/tasks', [MobileStudentController::class, 'tasks'])->name('mobile.tasks');
Route::get('/challenges', [MobileStudentController::class, 'challenges'])->name('mobile.challenges');
Route::get('/habits', [MobileStudentController::class, 'habits'])->name('mobile.habits');
Route::get('/achievements', [MobileStudentController::class, 'achievements'])->name('mobile.achievements');
Route::get('/performance', [MobileStudentController::class, 'performance'])->name('mobile.performance');
Route::get('/performance/{taskId}', [MobileStudentController::class, 'performanceDetail'])->name('mobile.performance.detail');
Route::get('/leaderboard/{period?}', [LeaderboardController::class, 'index'])->name('mobile.leaderboard');

// Habit Submission Route
Route::post('/habit-submit', [MobileStudentController::class, 'submitHabit'])->name('habit.submit');

// Task Details Routes
Route::get('/task/{batch_id}/{task_id}', [TaskDetailsController::class, 'show'])->name('mobile.task.details');
Route::get('/task/submission/{task_id}/{batch_id}/', [TaskDetailsController::class, 'showSubmission'])->name('mobile.task.submission');
Route::get('/task/confirmation/{task_id}/{batch_id}/', [TaskDetailsController::class, 'showConfirmation'])->name('mobile.task.confirmation');
Route::get('/task/success/{taskId}/{batch_id}/', [TaskDetailsController::class, 'showSuccess'])->name('mobile.task.success');
Route::post('/task/submit/{task_id}/{batch_id}/', [TaskDetailsController::class, 'submitTask'])->name('mobile.task.submit');
