<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request){
        
        // Validate the request data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        // Attempt log in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if ok, then redirect to dashboard
            return \redirect()->intended(route('admin.dashboard'));    
        }
        
        // if not ok, then redirect back with inputs
        return \redirect()->back()->withInput($request->only('email','remember'));

    }
}
