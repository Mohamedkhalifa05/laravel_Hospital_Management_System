<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\DoctorLoginRequest as AuthDoctorLoginRequest;
use App\Http\Requests\DoctorLoginRequest;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function DoctorDashboard(){


  return view("Dashboard.Doctors.dashboard");
    }//End Method


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

public function DoctorLoginstore(AuthDoctorLoginRequest $request): RedirectResponse
    {


        try {

        $request->authenticate();

        $request->session()->regenerate();

        $notificaton = [
            'message' => trans('Dashboard/messages.Admin Login Successfully'),
            'alert-type' => 'success',
        ];

          return redirect()
            ->route('doctor.dashboard')
            ->with($notificaton);

    } catch (\Illuminate\Validation\ValidationException $e) {


    $notificaton = [
                'message' => trans('Dashboard/messages.Admin Email or Password is Not Correct'),
                'alert-type' => 'error',
            ];
        return redirect()->back() ->with($notificaton);
    }


    }
   public function destroy(Request $request)
    {
      $this->Doctors->destroy($request);

    session()->flash('delete');

    return redirect()->route('Doctors.index');
    }//End Method


    public function DoctorLogindestroy(Request $request)
    {

       Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

            $notification = [
        'message' => trans('Dashboard/messages.Admin Logout Successfully'),
        'alert-type' => 'success'
    ];

        return redirect('/user/login')->with($notification);
    }


}
