<?php

namespace App\Respository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    public function index()
    {
        $invoices = Invoice::where("doctor_id",Auth::guard('doctor')->user()->id)->get();
        return view("Dashboard.doctor.invoices.index",compact('invoices'));
    }
}
