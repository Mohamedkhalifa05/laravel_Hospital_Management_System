<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\RayEmployeeController;
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


      Route::prefix('ray_employee')->middleware("ray_employee")->group(function(){
      Route::get("/dashboard",[RayEmployeeController::class,"index"])->name("ray_employee.dashboard");
       Route::post('/logout', [RayEmployeeController::class, 'destroy'])->name('ray_employee.logout');
       
      });

      Route::post("/ray_employee/login",[RayEmployeeController::class,"store" ])->name("ray_employee.login");
});

