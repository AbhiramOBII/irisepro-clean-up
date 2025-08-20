<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\EnrollmentController;

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

Route::get('/', [LandingController::class, 'index']);
Route::get('/challenges', [LandingController::class, 'challenges'])
    ->name('challenges.all');

// Challenge Details and Enrollment Routes
Route::get('/challenge/{id}', [EnrollmentController::class, 'showChallengeDetails'])
    ->name('challenge.details');
// Enrollment & Payment Routes
Route::post('/enrollment/pay', [EnrollmentController::class, 'startPayment'])
    ->name('enrollment.pay');
Route::get('/enrollment/{enrollment}/pay', [EnrollmentController::class, 'paymentPage'])
    ->name('enrollment.pay.page');
Route::post('/payment/verify', [EnrollmentController::class, 'verifyPayment'])
    ->name('payment.verify');
Route::post('/payment/webhook', [EnrollmentController::class, 'webhook'])
    ->name('payment.webhook');
