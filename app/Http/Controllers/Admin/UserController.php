<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'user')->toArray()
        );
        return view('pages.user.index', [
            'title' => 'User',
            'users' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->assignRole('user');

        return $this->success(
            UserResource::make($user),
            'Berhasil menambahkan Data Pengguna'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->success(
            UserResource::make($user),
            'Berhasil mengambil detail user'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $this->success(
            UserResource::make($user),
            'Berhasil mengubah Data pengguna'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->success(
            message: 'Berhasil menghapus Data Pengguna'
        );
    }

    public function datatables()
    {
        return datatables(User::with('roles')->get()->filter(
                fn ($user) => $user->roles->where('name', 'user')->toArray()
            ))
            ->addIndexColumn()
            ->addColumn('age', function($user) {
                return $user->age;
            })
            ->addColumn('action', fn ($user) => view('pages.user.action', compact('user')))
            ->toJson();
    }

    public function json()
    {
        $users = User::all();

        return $this->success(
            UserResource::collection($users),
            'Berhasil mengambil semua data'
        );
    }
}
