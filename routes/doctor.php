<?php


use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\SingleServiceController;
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

      Route::middleware("admin")->group(function(){
       Route::resource('Doctors',DoctorController::class);
       Route::post('Doctors/update_password',[DoctorController::class,"UpdatePassword"])->name('update_password');
       Route::post('Doctors/update_status',[DoctorController::class,"update_status"])->name('update_status');
       Route::post('Doctors/clear_password_errors', [DoctorController::class, 'clearPasswordErrors'])
       ->name('clear_password_errors');
       Route::resource("Service",SingleServiceController::class);
     Route::view('Add_GroupServices','livewire.group-services.include_create')->name('Add_GroupServices');


      });


});

