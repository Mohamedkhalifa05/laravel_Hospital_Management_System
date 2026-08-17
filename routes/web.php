<?php

use App\Http\Controllers\Dashboard\DashboardController;
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
     Route::get('/test-locale', function () {
        return 'OK';
    });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/dashboard', function () {
    $notification = array([
         "message" => "Admin Login Successfully",
         "alert-type" => "success"
        ]);
    return view('Dashboard.User.auth.dashboard')->with($notification);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


});






