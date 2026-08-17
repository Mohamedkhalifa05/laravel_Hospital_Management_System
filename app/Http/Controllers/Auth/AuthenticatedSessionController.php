<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('Dashboard.User.auth.signin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse

    {

    try {

        $request->authenticate();

        $request->session()->regenerate();

        $notificaton = [
            'message' => trans('Dashboard/messages.User Login Successfully'),
            'alert-type' => 'success',
        ];

        return redirect()->intended(route('dashboard', absolute: false))->with($notificaton);

    } catch (\Illuminate\Validation\ValidationException $e) {


    $notificaton = [
                'message' => trans('Dashboard/messages.User Email or Password is Not Correct'),
                'alert-type' => 'error',
            ];
        return redirect()->back() ->with($notificaton);
    }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
            $notification = [
        'message' => trans('Dashboard/messages.User Logout Successfully'),
        'alert-type' => 'success'
    ];

        return redirect('/user/login')->with($notification);
    }
}
