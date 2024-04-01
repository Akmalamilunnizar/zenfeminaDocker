<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminCount =User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'admin')->toArray()
        )->count();

        $userCount =User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'user')->toArray()
        )->count();

        $eduCount = Education::all()->count();
        $old = User::query()->selectRaw('CAST(AVG(DATEDIFF(CURDATE(), birthDate) / 365) AS UNSIGNED) AS old')
            ->first();

        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'adminCount' => $adminCount,
            'userCount' => $userCount,
            'eduCount' => $eduCount,
            'old' => $old
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
