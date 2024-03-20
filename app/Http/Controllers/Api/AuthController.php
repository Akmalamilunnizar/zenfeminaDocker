<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) :AuthResource
    {
        $data = $request->validated();
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $user->assignRole('user');
        return new AuthResource($user);
    }

    public function login(LoginRequest $request) :AuthResource
    {
        $data = $request->validated();
        $res = Auth::attempt($request->validated());
        if(!$res){
            throw new HttpResponseException(response([
                    'errors' => [
                        'username or password is wrong'
                    ]
                ]
            ), 401);
        }

        $user = User::where('email', $data['email'])->first();
        $user->token = Str::uuid()->toString();
        $user->save();
        return new AuthResource($user);
    }
}
