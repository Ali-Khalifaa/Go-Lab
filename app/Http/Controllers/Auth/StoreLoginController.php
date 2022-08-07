<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:store')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.store-login');
    }

    public function logout (Request $request) {

        Auth::guard('store')->logout();

        $request->session()->flush();

        $request->session()->regenerate();


        // redirect to homepage
        return redirect('/admin/store');
    }

    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // Attempt to log the user in
        if(Auth::guard('store')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('store.dashboard'));
        }

        // if unsuccessful
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
