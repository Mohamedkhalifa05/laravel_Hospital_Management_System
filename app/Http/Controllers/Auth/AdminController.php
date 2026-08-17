<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\AdminLoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(AdminLoginRequest $request): RedirectResponse
    {


        try {

        $request->authenticate();

        $request->session()->regenerate();

        $notificaton = [
            'message' => trans('Dashboard/messages.Admin Login Successfully'),
            'alert-type' => 'success',
        ];

        return redirect()->intended(route('admin.dashboard', absolute: false))->with($notificaton);

    } catch (\Illuminate\Validation\ValidationException $e) {


    $notificaton = [
                'message' => trans('Dashboard/messages.Admin Email or Password is Not Correct'),
                'alert-type' => 'error',
            ];
        return redirect()->back() ->with($notificaton);
    }


    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(Request $request)
    {

       Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

            $notification = [
        'message' => trans('Dashboard/messages.Admin Logout Successfully'),
        'alert-type' => 'success'
    ];

        return redirect('/user/login')->with($notification);
    }
}
