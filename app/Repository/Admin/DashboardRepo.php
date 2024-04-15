<?php

namespace App\Repository\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardRepo{
    public static function chart($column)
    {
        $data = User::with('roles')
            ->select(DB::raw('COALESCE(TIMESTAMPDIFF(YEAR, birthdate, CURDATE()), 0) as age, COUNT(*) as total'))
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->groupBy('age')
            ->orderBy('age')
            ->pluck($column);
        return $data;
    }
}
