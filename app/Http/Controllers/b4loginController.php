<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class b4loginController extends Controller
{
    public function login()
    {
        return view('b4login');
    }

    public function postlogin(Request $request)
    {
        if(Auth::attempt($request->only('name','password'))){
            return redirect('/berhasil');
        }
        return redirect('/gagal');
    }

    public function berhasil()
    {
        return view('berhasil');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
