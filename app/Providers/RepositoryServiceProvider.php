<?php

namespace App\Providers;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
// use App\Repository\Doctors\DoctorRepository;
use App\Respository\Doctors\DoctorRepository as DoctorsDoctorRepository;
use App\Respository\Sections\SectionRespository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class,SectionRespository::class);
        $this->app->bind(DoctorRepositoryInterface::class,DoctorsDoctorRepository::class);
    }



    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
