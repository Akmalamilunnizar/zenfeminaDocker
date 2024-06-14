<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PasswordRequest;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.profile', [
            'title' => 'Profile',
            'user' => $user,
        ]);
    }

    public function update(ProfileRequest $request, User $user){
        $user->update($request->validated());

        return back()->with('alert_s', 'Berhasil mengubah profile');
    }

    public function updatePassword(PasswordRequest $request, User $user){
//        dd($request->all());
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);

        return back()->with('alert_s', 'Berhasil mengubah Password');
    }

}
