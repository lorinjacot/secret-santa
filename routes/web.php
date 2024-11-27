<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::redirect('/', '/dashboard');

Route::get('dashboard', function () {
    return view('dashboard', ['users_count' => User::count(), 'user' => auth()->user()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('conversation/with-santa', 'pages.conversation.with-santa')
        ->name('conversation.santa');
    Volt::route('conversation/with-target', 'pages.conversation.with-target')
        ->name('conversation.target');
});

require __DIR__.'/auth.php';
