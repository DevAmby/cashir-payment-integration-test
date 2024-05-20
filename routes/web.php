<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
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
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }
});

Route::get('login', function () {
    return view('pages.login');
});


Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');

Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);
Route::get('/rave/callback', [PaymentController::class, 'handleFlutterwaveCallback'])->name('flutterwave.callback');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
