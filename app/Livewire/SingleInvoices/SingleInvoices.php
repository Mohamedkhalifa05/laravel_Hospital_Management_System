<?php

namespace App\Livewire\SingleInvoices;

use App\Events\CreateInvoice;
use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Service;
use App\Models\single_invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SingleInvoices extends Component
{
    public $InvoiceSaved,$InvoiceUpdated;
    public $show_table = true;
    public $username;
    public $tax_rate = 17;
    public $AlreadyExisted = false;
    public $updateMode = false;
    public $price,$discount_value = 0,$invoice_type ,$patient_id,$doctor_id,$section_id,$type,$Service_id,$single_invoice_id,$catchError;


    public function mount(){

        $this->username = auth()->user()?->name;
     }



    public function render()
    {
        return view('livewire.single_invoices.single-invoices', [
            'single_invoices'=>Invoice::get(),
            'Patients'=> Patient::all(),
            'Doctors'=> Doctor::all(),
            'Services'=> Service::all(),
            // "single-invoices" => single_invoice::all(),
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]);
    }

    public function show_form_add()
{
    $this->show_table = false;

    $this->updateMode = false;
    $this->single_invoice_id = null;

    $this->InvoiceSaved = false;
    $this->InvoiceUpdated = false;
    $this->AlreadyExisted = false;
    $this->catchError = null;

    $this->patient_id = null;
    $this->doctor_id = null;
    $this->section_id = null;
    $this->Service_id = null;
    $this->price = null;
    $this->discount_value = 0;
    $this->tax_rate = 17;
    $this->invoice_type = null;
}

    public function print($id)
    {
        $single_invoice = Invoice::findorfail($id);
        return Redirect::route('Print_single_invoices',[
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->Doctor->name,
            'section_id' => $single_invoice->Section->name,
            'Service_id' => $single_invoice->Service->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);

    }

    public function get_section()
    {
        $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;

    }

    public function get_price()
    {
        $this->price = Service::where('id', $this->Service_id)->first()->price;
    }


    public function edit($id){

        $this->show_table = false;
        $this->updateMode = true;
        $single_invoice = Invoice::findorfail($id);
        $this->single_invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        $this->section_id = DB::table('section_translations')->where('id', $single_invoice->section_id)->first()->name;
        $this->Service_id = $single_invoice->Service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;


    }






public function store()
{
    DB::beginTransaction();

    try {

        // =========================================================
        // الفاتورة النقدية
        // =========================================================
        if ($this->invoice_type == 1) {

            // =====================================================
            // في حالة التعديل
            // =====================================================
            if ($this->updateMode) {

                $single_invoices = Invoice::findOrFail($this->single_invoice_id);

                $single_invoices->invoice_type = 1;
                $single_invoices->invoice_date = date('Y-m-d');
                $single_invoices->patient_id = $this->patient_id;
                $single_invoices->doctor_id = $this->doctor_id;

                // الحصول على القسم
                $section = DB::table('section_translations')
                    ->where('name', $this->section_id)
                    ->first();

                if (!$section) {
                    throw new \Exception(
                        'القسم غير موجود: ' . $this->section_id
                    );
                }

                $single_invoices->section_id = $section->section_id;

                $single_invoices->Service_id = $this->Service_id;
                $single_invoices->price = $this->price;
                $single_invoices->discount_value = $this->discount_value;
                $single_invoices->tax_rate = $this->tax_rate;

                // قيمة الضريبة
                $single_invoices->tax_value =
                    ($this->price - $this->discount_value)
                    * ((is_numeric($this->tax_rate)
                        ? $this->tax_rate
                        : 0) / 100);

                // الإجمالي شامل الضريبة
                $single_invoices->total_with_tax =
                    $single_invoices->price
                    - $single_invoices->discount_value
                    + $single_invoices->tax_value;

                // $single_invoices->type = $this->type;

                $single_invoices->save();


                // تحديث حساب الصندوق
                $fund_accounts = FundAccount::where(
                    'invoice_id',
                    $this->single_invoice_id
                )->first();

                if (!$fund_accounts) {
                    $fund_accounts = new FundAccount();
                }

                $fund_accounts->date = date('Y-m-d');
                $fund_accounts->invoice_id = $single_invoices->id;
                $fund_accounts->Debit = $single_invoices->total_with_tax;
                $fund_accounts->credit = 0.00;
                $fund_accounts->save();

                $this->InvoiceUpdated = true;
                $this->show_table = true;
            }

            // =====================================================
            // في حالة الإضافة
            // =====================================================
            else {

                // التحقق هل الخدمة مسجلة بالفعل لنفس المريض
                $alreadyExists = Invoice::where(
                    'patient_id',
                    $this->patient_id
                )
                    ->where('Service_id', $this->Service_id)
                    ->where('doctor_id', $this->doctor_id)
                    ->exists();

                if ($alreadyExists) {

                    $this->AlreadyExisted = true;
                    $this->show_table = true;

                    DB::rollBack();
                    return;
                }


                // إنشاء الفاتورة
                $single_invoices = new Invoice();

                $single_invoices->invoice_type = 1;
                $single_invoices->invoice_date = date('Y-m-d');
                $single_invoices->patient_id = $this->patient_id;
                $single_invoices->doctor_id = $this->doctor_id;

                // الحصول على القسم
                $section = DB::table('section_translations')
                    ->where('name', $this->section_id)
                    ->first();

                if (!$section) {
                    throw new \Exception(
                        'القسم غير موجود: ' . $this->section_id
                    );
                }

                $single_invoices->section_id = $section->section_id;

                $single_invoices->Service_id = $this->Service_id;
                $single_invoices->price = $this->price;
                $single_invoices->discount_value = $this->discount_value;
                $single_invoices->tax_rate = $this->tax_rate;

                // قيمة الضريبة
                $single_invoices->tax_value =
                    ($this->price - $this->discount_value)
                    * ((is_numeric($this->tax_rate)
                        ? $this->tax_rate
                        : 0) / 100);

                // الإجمالي شامل الضريبة
                $single_invoices->total_with_tax =
                    $single_invoices->price
                    - $single_invoices->discount_value
                    + $single_invoices->tax_value;

                $single_invoices->invoice_status = 1;

                $single_invoices->save();


                // =================================================
                // إضافة الحساب في الصندوق
                // =================================================
                $fund_accounts = new FundAccount();

                $fund_accounts->date = date('Y-m-d');
                $fund_accounts->invoice_id = $single_invoices->id;
                $fund_accounts->Debit = $single_invoices->total_with_tax;
                $fund_accounts->credit = 0.00;

                $fund_accounts->save();


                $this->InvoiceSaved = true;
                $this->show_table = true;

               $this->updateMode = false;
               $this->single_invoice_id = null;
            }
        }


        // =========================================================
        // الفاتورة الآجلة
        // =========================================================
        else {

            // =====================================================
            // في حالة التعديل
            // =====================================================
            if ($this->updateMode) {

                $single_invoices = Invoice::findOrFail(
                    $this->single_invoice_id
                );

                $single_invoices->invoice_type = 2;
                $single_invoices->invoice_date = date('Y-m-d');
                $single_invoices->patient_id = $this->patient_id;
                $single_invoices->doctor_id = $this->doctor_id;

                // الحصول على القسم
                $section = DB::table('section_translations')
                    ->where('name', $this->section_id)
                    ->first();

                if (!$section) {
                    throw new \Exception(
                        'القسم غير موجود: ' . $this->section_id
                    );
                }

                $single_invoices->section_id = $section->section_id;

                $single_invoices->Service_id = $this->Service_id;
                $single_invoices->price = $this->price;
                $single_invoices->discount_value = $this->discount_value;
                $single_invoices->tax_rate = $this->tax_rate;

                // قيمة الضريبة
                $single_invoices->tax_value =
                    ($this->price - $this->discount_value)
                    * ((is_numeric($this->tax_rate)
                        ? $this->tax_rate
                        : 0) / 100);

                // الإجمالي شامل الضريبة
                $single_invoices->total_with_tax =
                    $single_invoices->price
                    - $single_invoices->discount_value
                    + $single_invoices->tax_value;

                $single_invoices->type = $this->type;

                $single_invoices->save();


                // =================================================
                // تحديث حساب المريض
                // =================================================
                $patient_accounts = PatientAccount::where(
                    'invoice_id',
                    $this->single_invoice_id
                )->first();

                if (!$patient_accounts) {
                    $patient_accounts = new PatientAccount();
                }

                $patient_accounts->date = date('Y-m-d');
                $patient_accounts->invoice_id = $single_invoices->id;
                $patient_accounts->patient_id = $single_invoices->patient_id;
                $patient_accounts->Debit = $single_invoices->total_with_tax;
                $patient_accounts->credit = 0.00;

                $patient_accounts->save();

                $this->InvoiceUpdated = true;
                $this->show_table = true;
            }


            // =====================================================
            // في حالة الإضافة
            // =====================================================
            else {


                // التحقق هل الخدمة مسجلة بالفعل
                $alreadyExists = Invoice::where(
                    'patient_id',
                    $this->patient_id
                )
                    ->where('Service_id', $this->Service_id)
                    ->where('doctor_id', $this->doctor_id)
                    ->exists();

                if ($alreadyExists) {

                    $this->AlreadyExisted = true;
                    $this->show_table = true;

                    DB::rollBack();
                    return;
                }


                // =================================================
                // إنشاء الفاتورة
                // =================================================
                $single_invoices = new Invoice();


                // مهم:
                // هنا نستخدم invoice_type الخاص بالفاتورة الآجلة
                $single_invoices->invoice_type = 2;


                $single_invoices->invoice_date = date('Y-m-d');
                $single_invoices->patient_id = $this->patient_id;
                $single_invoices->doctor_id = $this->doctor_id;

                // الحصول على القسم
                $section = DB::table('section_translations')
                    ->where('name', $this->section_id)
                    ->first();

                if (!$section) {
                    throw new \Exception(
                        'القسم غير موجود: ' . $this->section_id
                    );
                }

                $single_invoices->section_id = $section->section_id;

                $single_invoices->Service_id = $this->Service_id;
                $single_invoices->price = $this->price;
                $single_invoices->discount_value = $this->discount_value;
                $single_invoices->tax_rate = $this->tax_rate;

                // =================================================
                // قيمة الضريبة
                // =================================================
                $single_invoices->tax_value =
                    ($this->price - $this->discount_value)
                    * ((is_numeric($this->tax_rate)
                        ? $this->tax_rate
                        : 0) / 100);

                // =================================================
                // الإجمالي شامل الضريبة
                // =================================================
                $single_invoices->total_with_tax =
                    $single_invoices->price
                    - $single_invoices->discount_value
                    + $single_invoices->tax_value;

                // $single_invoices->type = $this->type;
                $single_invoices->invoice_status = 1;


                // حفظ الفاتورة
                $single_invoices->save();


                // =================================================
                // إضافة حساب المريض
                // =================================================
                $patient_accounts = new PatientAccount();

                $patient_accounts->date = date('Y-m-d');
                $patient_accounts->invoice_id = $single_invoices->id;
                $patient_accounts->patient_id = $single_invoices->patient_id;
                $patient_accounts->Debit = $single_invoices->total_with_tax;
                $patient_accounts->credit = 0.00;

                $patient_accounts->save();


                // نجاح العملية
                $this->InvoiceSaved = true;
                $this->show_table = true;
                $this->updateMode = false;
                $this->single_invoice_id = null;
            }
        }


        // =========================================================
        // تأكيد العملية بالكامل
        // =========================================================
        DB::commit();

    } catch (\Exception $e) {

        // إلغاء جميع العمليات
        DB::rollBack();

        // إظهار الخطأ أثناء التجربة
        $this->catchError = $e->getMessage();

        // لو تريد إظهار الخطأ مباشرة أثناء التجربة:
        // dd($e->getMessage());
    }
}


    public function delete($id){

     $this->single_invoice_id = $id;

    }

    public function destroy(){
        Invoice::destroy($this->single_invoice_id);
        return redirect()->to('/single_invoices');
    }

public function create()
{
    $this->updateMode = false;
    $this->single_invoice_id = null;

    $this->reset([
        'patient_id',
        'doctor_id',
        'section_id',
        'Service_id',
        'price',
        'discount_value',
        'tax_rate',
        'invoice_type',
    ]);
}



}
