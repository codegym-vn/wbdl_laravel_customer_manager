<?php

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

Route::prefix('customers')->group(function (){
    Route::get('/', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/create', [\App\Http\Controllers\CustomerController::class, 'create'])->name('customers.create');
});
