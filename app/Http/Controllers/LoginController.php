<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validasi inputan
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('name'));
        }

        // Simpan status alert di session
        session()->flash('loginAlert', true);

        // Mendapatkan kredensial dari inputan
        $credentials = $request->only('name', 'password');

        // Coba untuk melakukan login dengan mencocokkan data di tabel users
        if (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password']])) {
            // Jika login berhasil
            return redirect()->route('dashboard.index');
        }

        // Jika login gagal
        return redirect()->back()->withErrors([
            'login_error' => 'Nama pengguna atau sandi salah.',
        ])->withInput($request->only('name'));
    }
}
