<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Logincontroller extends Controller
{
    function index()
    {
        return view("login");
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email wajib diisi',
                'password.required' => 'password wajib diisi',
            ],
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth::attempt($infologin)) {
            if (auth::user()->role == 'operator') {
                return redirect('operator');
            } elseif (auth::user()->role == 'kaprodi') {
                return redirect('kaprodi');
            } elseif (auth::user()->role == 'dosen') {
                return redirect('dosen');
            }
            elseif (auth::user()->role == 'mahasiswa') {
                return redirect('-mahasiswa');
            }
        } else {
            return redirect('')->withErrors('username atau pasword yang anda masukkan tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
