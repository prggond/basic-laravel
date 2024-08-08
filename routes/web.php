<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Test;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Prince;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [Home::class, 'index'])->name('home');
// Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
Route::POST('/form',[StudentController::class,'store',])->name('store');
Route::get('/fetch',[StudentController::class,'fetch'])->name('fetch');
Route::get('/destroy/{id}', [StudentController::class, 'destroy'])->name('destroy');
Route::get('edit/{id}',[StudentController::class,'edit'])->name('edit');
Route::POST('/update/{id}', [StudentController::class, 'update'])->name('update');
// Route::get('register',[Home::class,'showRegistrationForm']);
// Route::POST('/chek',[Home::class,'done'])->name('chek');
// Route::get('login',[Home::class,'loginform']);

// Route::POST('home',[Home::class,'login'])->name('login');

