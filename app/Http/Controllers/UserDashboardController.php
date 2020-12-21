<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
        auth()->setDefaultDriver('user');
    }

    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function dashboard()
    {
        // return 'hello';
        return view('user.dashboard');
    }
}
