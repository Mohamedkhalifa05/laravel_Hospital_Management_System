<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\insurances\insuranceRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Interfaces\SingleServiceRepositoryInterface;
use App\Repository\insurances\insuranceRespository;
use App\Respository\Ambulances\AmbulanceRespository;
use App\Respository\Doctors\DoctorRepository as DoctorsDoctorRepository;
use App\Respository\insurances\insuranceRespository as InsurancesInsuranceRespository;
use App\Respository\Services\SingleServiceRepository;
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
        $this->app->bind(SingleServiceRepositoryInterface::class,SingleServiceRepository::class);
        $this->app->bind(insuranceRepositoryInterface::class,InsurancesInsuranceRespository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class,AmbulanceRespository::class);


    }



    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
