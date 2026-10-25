<?php

use App\Http\Middleware\DoctorMiddleware;
use App\Http\Middleware\userMiddleware;
use App\Models\Admin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
         then: function () {
     Route::middleware('web')
    ->group(base_path('routes/admin.php'));
    Route::middleware('web')
    ->group(base_path('routes/doctor.php'));
    Route::middleware('web')
    ->group(base_path('routes/ray_employee.php'));

    }

    )
    ->withMiddleware(function (Middleware $middleware): void {
          $middleware->alias([

             "user" =>  App\Http\Middleware\UserMiddleware::class,
             'admin' => App\Http\Middleware\AdminMiddleware::class,
             'doctor' => App\Http\Middleware\DoctorMiddleware::class,
             "ray_employee" => App\Http\Middleware\RayEmployeeMiddleware::class,



            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
        ]);

  $middleware->redirectGuestsTo(function ($request) {
    return route('user.login');
});

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
