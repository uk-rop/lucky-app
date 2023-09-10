<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RandomController;
use App\Http\Controllers\InfoPageController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\UserCodesController;

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
    Route::get('/', [MainPageController::class, 'index'])->name('mainpage');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/infopage', [InfoPageController::class, 'index'])->name('infopage');
    Route::post('/random', [RandomController::class, 'tryYourLuck'])->name('random');
    Route::get('history', [RandomController::class, 'history'])->name('history');
    Route::get('/generateLink', [UserCodesController::class, 'generateLink'])->name('generateLink');
    Route::post('/removeAll', [UserCodesController::class, 'removeAll'])->name('removeAll');
    Route::post('/{code}/remove', [UserCodesController::class, 'remove'])->name('removeOne');
});



Route::get('/{code}', [App\Http\Controllers\AuthController::class, 'loginWithCode'])->name('loginWithCode');

// Route::get('/')
