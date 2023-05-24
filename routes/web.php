<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\System\ApiKey\ApiKeyController;
use App\Http\Controllers\System\Config\ConfigController;
use App\Http\Controllers\System\Payment\PaymentController;
use App\Http\Controllers\System\TransactionLog\TransactionLogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'index'])->name('profile');
Route::resource('/config', ConfigController::class)->only('index', 'update');
Route::resource('/transactionLog', TransactionLogController::class)->only('index', 'show');
Route::resource('/payment', PaymentController::class);
Route::get('/payment/{id}/config/', [PaymentController::class, 'showConfigForm'])->name('payment.mode.config.form');
Route::post('/payment/config', [PaymentController::class, 'storeConfigForm'])->name('payment.mode.config.store');
Route::get('/apiKey', [ApiKeyController::class, 'index'])->name('apiKey');


//for logs
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('system.logs');

