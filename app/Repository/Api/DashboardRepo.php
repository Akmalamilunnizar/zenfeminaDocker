<?php

namespace App\Repository\Api;

use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardRepo
{
    public static function question($data)
    {
        //set birthdate
        $user = Auth::user();
        $user->birthdate = $data['birthDate'];
        $user->save();

        // set cycleHist
        Cycle::create([
            'type' => 'hist',
            'cycle_length' => $data['cycle'],
            'period_length' => $data['period'],
            'start_date' => Carbon::parse($data['lastDate'])->subDays($data['period']),
            'end_date' => $data['lastDate'],
            'user_id' => $user->id
        ]);

        // set Est
        $value = $data['cycle'] - $data['period'];
        Cycle::create([
            'type' => 'est',
            'cycle_length' => $data['cycle'],
            'period_length' => $data['period'],
            'start_date' => Carbon::parse($data['lastDate'])->addDays($value),
            'end_date' => null,
            'user_id' => $user->id
        ]);
    }
}
