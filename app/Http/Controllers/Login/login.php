<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class login extends Controller
{
    public function index()
    {
        return view('Login.login');
    }

    public function LoginCheck(Request $request)
    {
        $message = [
            'email.required' => 'Please Enter Valid Email Id.',
            'password.required' => 'Please Enter Valid Password.',
            'password.min' => 'Please Enter Minimum 6 digits Password.',
        ];

        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ], $message);

        $credentials = $request->only('email', 'password');

        $user = admin::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Session::put('email', $credentials['email']);
            return redirect('admin')->with('login_success', 'Login Successful. Redirecting....')->with('redirect_to', 'dashboard');
        }

        return redirect('admin')->with('error', 'Please Enter Valid email or password.');
    }

    public function logout()
    {
        Session::flush();

        return redirect('admin')->with('success', 'Logout Successfully.');
    }
}