<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    // dd([
    //     'url' => $request->url(),
    //     'method' => $request->method(),
    //     'admin_check' => auth()->guard('admin')->check(),
    // ]);


    if (! auth()->guard('admin')->check()) {
        return redirect('/user/login');
    }
        return $next($request);
    }
}
