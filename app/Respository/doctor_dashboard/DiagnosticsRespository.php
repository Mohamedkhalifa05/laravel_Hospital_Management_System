<?php

namespace App\Respository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\DiagnosticsRespositoryInterface;
use App\Models\Diagnostics;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DiagnosticsRespository  implements DiagnosticsRespositoryInterface
{
    
    public function store($request)
    {
        DB::beginTransaction();

        try {

            $this->invoice_status($request->invoice_id,3);
            $diagnosis = new Diagnostics();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {

        $patient = Patient::findOrFail($id);
        $patient_records = Diagnostics::where('patient_id',$id)->get();

        return view('Dashboard.Doctor.invoices.patient_record',compact('patient_records',"patient"));
    }

    public function addReview($request)
    {
        DB::beginTransaction();
        try {

            $this->invoice_status($request->invoice_id,2);
            $diagnosis = new Diagnostics();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->review_date = date('Y-m-d H:i:s');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function invoice_status($invoice_id,$id_status){
        $invoice_status = Invoice::findorFail($invoice_id);
        $invoice_status->update([
            'invoice_status'=>$id_status
        ]);
    }
}
