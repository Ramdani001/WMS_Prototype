<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;

Route::get('/', function () {
    return view('auth/pages/login');
})->name('login');;

Route::get('/register', function () {
    return view('auth/pages/register');
})->name('register');;

Route::controller(ViewController::class)->group(function() {
    Route::get('/dashboard', 'index')->name('dashboard');
}); 
 