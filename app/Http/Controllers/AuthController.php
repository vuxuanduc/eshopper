<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $remember = $request->remember;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if (Auth::user()->role_id == 2) {
                return redirect('/');
            } else {
                return redirect('panel/dashboard');
            }
        } else {
            return redirect()->back()->with('error', "Email hoặc mật khẩu không đúng");
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function auth_register(Request $request)
    {
        $data = $request->all();
        $data['role_id'] = 2;

        $newUser = User::query()->create($data);

        if ($newUser) {
            return redirect('/login')->with('success', "Đăng kí tài khoản thành công.");
        } else {
            return redirect('/register')->with('error', "Đăng kí tài khoản thất bại");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('/login'));
    }
}
