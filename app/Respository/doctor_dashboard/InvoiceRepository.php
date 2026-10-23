<?php

namespace App\Respository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    public function index()
    {
        $invoices = Invoice::where("doctor_id",Auth::guard('doctor')->user()->id)->where("invoice_status",1)->get();
        return view("Dashboard.doctor.invoices.index",compact('invoices'));
    }
    public function completedInvoices() {
$invoices = Invoice::where("doctor_id",Auth::guard('doctor')->user()->id)->where("invoice_status",3)->get();
        return view("Dashboard.doctor.invoices.completed_invoices",compact('invoices'));
    }//End Method
    public function reviewInvoices() {
        $invoices = Invoice::where("doctor_id",Auth::guard('doctor')->user()->id)->where("invoice_status",2)->get();
        return view("Dashboard.doctor.invoices.review_invoices",compact('invoices'));

    }//End Method
}
