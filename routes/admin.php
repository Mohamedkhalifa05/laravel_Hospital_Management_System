<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;





Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	  'middleware' => [
        'localize',
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function(){


      Route::prefix('admin')->middleware("admin")->group(function(){
      Route::get("/dashboard",[DashboardController::class,"index"])->name("admin.dashboard");
       Route::post('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
       Route::resource('Sections',SectionController::class);
       Route::resource('Doctors',DoctorController::class);


      });

      Route::post("/admin/login",[AdminController::class,"store" ])->name("admin.login");
});

