<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', ['title' => 'login']);
    }

    public function store(AuthRequest $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'success' => false,
                'password' => 'Password tidak sesuai',
            ]);
        }

        $request->session()->regenerate();
        return response()->json([
            'status' => 'success',
            'redirect' => '/dashboard'
        ]);
    }

    public function signOut()
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();

        return response()->json([
            'message' => 'Anda Berhasil Keluar'
        ]);
    }
}
