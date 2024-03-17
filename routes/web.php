<?php

use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
   Route::get('/', function(){
      return redirect()->route('login');
   });
   Route::get('/login', [AuthSessionController::class, 'create'])->name('login');
   Route::post('login', [AuthSessionController::class, 'store'])->name('login');
});

Route::middleware('auth')->group(function () {

   Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

   Route::resource('categories',CategoriesController::class);
   
   Route::get('setting',[SettingsController::class,'index'])->name('setting.index');
   Route::put('setting/update',[SettingsController::class,'update'])->name('setting.update');

   Route::post('logout', [AuthSessionController::class, 'destroy'])->name('logout');
});

Route::get('users', [UserController::class, 'index']);