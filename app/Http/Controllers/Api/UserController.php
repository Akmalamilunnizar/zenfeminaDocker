<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use ApiResponser;
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $user->assignRole('user');

        return $this->success(
            UserResource::make($user),
            "Berhasil mendapatkan data"
        );
    }

    public function login(LoginRequest $request)
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

        return $this->success(
            UserResource::make($user),
            "Berhasil Login"
        );
    }

    public function getUser(Request $request)
    {
        $user = Auth::user();

        return $this->success(
            UserResource::make($user),
            "Berhasil mendapatkan data"
        );

    }

    public function update(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        if (isset($data['image']))
            $data['image'] = $data['image']->storePublicly('users', 'public');

        $user->update($data);
        return $this->success(
            message: "Berhasil mengubah data"
        );
    }

    public function logOut(Request $request) :JsonResponse
    {
        $user = Auth::user();
        $user->token = null;
        $user->save();

        return $this->success(
            message: "Berhasil Keluar"
        );
    }
}
