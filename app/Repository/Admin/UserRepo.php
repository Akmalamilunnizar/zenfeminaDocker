<?php

namespace App\Repository\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepo{
    public static function create(array $data) :User
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $user->assignRole('user');

        return $user;
    }

    public static function update(User $user, array $data) :User
    {
        if(is_null($data['password'] ?? null)) unset($data['password']);

        if(isset($data['password'])) $data['password'] = Hash::make($data['password']);

        $user->update($data);
        return $user;
    }
}
