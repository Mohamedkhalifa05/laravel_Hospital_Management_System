<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Interfaces\insurances\insuranceRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Interfaces\SingleServiceRepositoryInterface;
use App\Respository\Finance\PaymentRepository;
use App\Respository\Finance\ReceiptRepository ;
use App\Repository\insurances\insuranceRespository;
use App\Respository\Ambulances\AmbulanceRespository;
use App\Respository\Doctors\DoctorRepository as DoctorsDoctorRepository;
use App\Respository\insurances\insuranceRespository as InsurancesInsuranceRespository;
use App\Respository\Patients\PatientRespository;
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
        $this->app->bind(PatientRepositoryInterface::class, PatientRespository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);


    }



    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
