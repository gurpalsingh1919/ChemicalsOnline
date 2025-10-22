<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // You can create a Blade view or return JSON for API
    }

    public function login(Request $request)
    {
       // echo "<pre>";print_r($request->all());die;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role !== 'super_admin') {
                Auth::logout();
                return back()->withErrors(['error' => 'Only super admins can log in here']);
            }

            return redirect('/admin/dashboard'); // redirect to admin dashboard
        }

        return back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/admin/login');
    }
     public function dashboard()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin')->with('error', 'Please login first.');
        }

        return view('admin.dashboard');
    }

}
