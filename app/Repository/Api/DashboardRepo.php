<?php

namespace App\Repository\Api;

use App\Models\Cycle;
use App\Models\Istihadhah;
use Carbon\Carbon;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;

class DashboardRepo
{

    public static function question($data)
    {
        $user = Auth::user();
        $user->birthDate = $data['birthDate'];
        $user->save();

        if($data['is_holy'])
        {
            // set Hist
            Cycle::query()->create([
                'type' => 'hist',
                'cycle_length' => $data['cycle'],
                'period_length' => $data['period'],
                'start_date' => Carbon::parse($data['lastDate'])->subDays($data['period'] - 1),
                'end_date' => $data['lastDate'],
                'user_id' => $user->id
            ]);

            // set Est
            $value = ($data['cycle'] - $data['period']) + 1;
            Cycle::create([
                'type' => 'est',
                'cycle_length' => $data['cycle'],
                'period_length' => $data['period'],
                'start_date' => Carbon::parse($data['lastDate'])->addDays($value),
                'end_date' => null,
                'user_id' => $user->id
            ]);
        }

        if(!$data['is_holy'])
        {
            //disini, last date = first time she is getting mens
            $firstDate = Carbon::parse($data['lastDate']);

            $totalDays = Carbon::now()->diffInDays($firstDate);
            if($totalDays <= 15) // getting mens
            {
                Cycle::create([
                    'type' => 'est',
                    'cycle_length' => $data['cycle'],
                    'period_length' => $data['period'],
                    'start_date' => $firstDate,
                    'end_date' => null,
                    'user_id' => $user->id
                ]);
            }

            if($totalDays > 15) // getting istihadhah
            {
                //set hist
                Cycle::create([
                    'type' => 'hist',
                    'cycle_length' => $data['cycle'],
                    'period_length' => $data['period'],
                    'start_date' => $firstDate,
                    'end_date' => Carbon::parse($data['lastDate'])->addDays(14),
                    'user_id' => $user->id
                ]);

                //set est
                $value = $data['cycle'] - $data['period'] + 15;
                Cycle::create([
                    'type' => 'est',
                    'cycle_length' => $data['cycle'],
                    'period_length' => $data['period'],
                    'start_date' => Carbon::parse($data['lastDate'])->addDays($value),
                    'end_date' => null,
                    'user_id' => $user->id
                ]);

                //set istihadhah
                Istihadhah::create([
                    'start_date' => Carbon::parse($data['lastDate'])->addDays(15),
                    'end_date' => Carbon::parse($data['lastDate'])->addDays(29),
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
