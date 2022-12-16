<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use App\Http\Controllers\VerifieEmailController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/email/verify/{id}/{hash}', [VerifieEmailController::class, 'send_email'])->middleware(['signed'])->name('verification.verify');