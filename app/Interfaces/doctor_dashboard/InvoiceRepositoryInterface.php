<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoiceRepositoryInterface
{
    public function index();


     public function completedInvoices() ;

     public function reviewInvoices();


    
}
