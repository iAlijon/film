<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function loginShowForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
           'username' => 'required|string',
            'password' => 'required|string'
	    ]);

        if (Auth::attempt($request->only('username', 'password')))
	    {
		    return redirect()->route('dashboard');
        }
            throw ValidationException::withMessages(['username' => 'Login yoki Parol noto\'g\'ri qayta tekshiring']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
