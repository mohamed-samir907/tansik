<?php

namespace App\Http\Controllers\Admin\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    /**
     * Show the login form
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Make a login process
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email'
        ]);

        $remember = $request->remember == 1 ? true : false;

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
            ], $remember)) 
        {
            return redirect()->route('admin.home');
        } else {
            session()->flash('error', 'These credentials do not match our records.');
            return back();
        }
    }

    /**
     * Logout the admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
