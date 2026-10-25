<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RayEmployeeLoginRequest;
use App\Http\Requests\StoreRayEmployeeRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RayEmployeeController extends Controller
{

    public function index(){


          return view("Dashboard.RayEmployee.index");
    }//End Method

    public function store(RayEmployeeLoginRequest $request): RedirectResponse{
      try {

        $request->authenticate();

        $request->session()->regenerate();

        $notificaton = [
            'message' => trans('Dashboard/messages.Admin Login Successfully'),
            'alert-type' => 'success',
        ];

        return redirect()->intended(route('ray_employee.dashboard', absolute: false))->with($notificaton);

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
       Auth::guard('ray_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

            $notification = [
        'message' => trans('Dashboard/messages.Admin Logout Successfully'),
        'alert-type' => 'success'
    ];

        return redirect('/user/login')->with($notification);
   
    }//
}
