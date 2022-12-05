<?php

use App\Http\Controllers\PickPlayerController;
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

Route::controller(PickPlayerController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::post('/', 'submit')->name('submit');
});