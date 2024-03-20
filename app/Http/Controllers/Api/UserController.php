<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(RegisterRequest $request) :UserResource
    {
        $data = $request->validated();
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $user->assignRole('user');
        return new UserResource($user);
    }

    public function login(LoginRequest $request) :UserResource
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
        return new UserResource($user);
    }

    public function getUser(Request $request) :UserResource
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request) :JsonResponse
    {
        $user = Auth::user();
        $user->update($request->validated());
        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }

    public function logOut(Request $request) :JsonResponse
    {
        $user = Auth::user();
        $user->token = null;
        $user->save();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
