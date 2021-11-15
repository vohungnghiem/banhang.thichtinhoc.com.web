<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AdminLoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('admincp.login');
        }
    }

    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
        ];
        if (Auth::attempt($login)) {
            return redirect('/');
        } else {
            return redirect()->back()->with('error', 'Email hoặc Password không chính xác');
        }
    }

    /**
     * action logout
     * @return RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
