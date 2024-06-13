<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function showUpdatePasswordForm()
    {
        $user = Auth::user();
        $title = 'Update Password';
        return view('pages.profile.update_password', compact('user', 'title'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if ($user instanceof \App\Models\User) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('profile.index')->with('status', 'Password updated successfully!');
        } else {
            return redirect()->back()->with('error', 'User authentication failed.');
        }
    }

    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.profile', [
            'title' => 'Profile',
            'user' => $user,
        ]);
    }
}
