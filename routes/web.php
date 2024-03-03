<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartyNamesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModelHasRolesController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/customer_names', PartyNamesController::class);
    Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::resource('tickets', TicketController::class);
    Route::resource('usertickets', UserTicketController::class);
    Route::resource('roles', RoleController::class);
});




