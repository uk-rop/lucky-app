<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\Auth\RegisterController;

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

Auth::routes([
    'getRegister' => true // Routes of Registration
    //     'verify' => false, // Routes of Email Verification
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MainPageController::class, 'index']);
    // Route::get('/getregister', [RegisterController::class, 'showRegistrationForm'])->name('getRegister');
    // Route::post('/register', [RegisterController::class, 'register']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/infopage', [App\Http\Controllers\InfoPageController::class, 'index'])->name('infopage');
