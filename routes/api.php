<?php

use App\Http\Controllers\Api\Payment\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['public.api', 'app.api']], function () {
    Route::post('pay', [PaymentController::class, 'pay']);
    Route::post('verify', [PaymentController::class, 'verify']);
});

Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');

