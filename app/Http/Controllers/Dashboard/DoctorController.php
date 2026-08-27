<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $Doctors ;

  public function __construct(DoctorRepositoryInterface $Doctors) {

  $this->Doctors = $Doctors ;
  }

    public function index()
    {
       return $this->Doctors->index();
    }


    public function create()
    {
      return  $this->Doctors->create();
    }


    public function store(Request $request)
    {
      return $this->Doctors->store($request);
    }

    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        return $this->Doctors->edit($id);
    }


    public function update(Request $request, string $id)
    {
        $this->Doctors->update($request);

    session()->flash('edit');

    return redirect()->route('Doctors.index');

    }
public function UpdatePassword(Request $request)
{
    $result = $this->Doctors->UpdatePassword($request);

    if ($result !== true) {
        return $result;
    }

    session()->flash('edit');

    return redirect()->route('Doctors.index');
}

public function update_status( Request $request){
$this->Doctors->update_status($request);

 session()->flash('edit');

    return redirect()->route('Doctors.index');
}

    public function clearPasswordErrors()
{
    session()->forget([
        'errors',
        'open_password_modal',
    ]);

    return response()->json([
        'success' => true
    ]);
}


   public function destroy(Request $request)
    {
      $this->Doctors->destroy($request);

    session()->flash('delete');

    return redirect()->route('Doctors.index');
    }//End Method
}
