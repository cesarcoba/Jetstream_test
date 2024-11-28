<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Showposts;
use App\Livewire\Productos;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', )->name('dashboard');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/productos',Productos::class);

    Route::get('/items', function () {
        return view('items');
    })->name('items');

    Route::view('/prueba', 'prueba')->name('prueba');

});
