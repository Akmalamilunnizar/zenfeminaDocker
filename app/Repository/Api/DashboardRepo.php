<?php

namespace App\Repository\Api;

use App\Models\Cycle;
use App\Models\Istihadhah;
use Carbon\Carbon;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Scalar\String_;

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

    public static function cardView()
    {
        $message = null;
        $condition = null;
        $user = Auth::user();
        $cycleEst = Cycle::query()
            ->where('user_id', $user->id)
            ->where('type', '=', 'est')->first();

        $istihadhah = Istihadhah::query()
            ->where('user_id', $user->id)
            ->orderBy('start_date', 'desc')
            ->first();

        $now = Carbon::now();
        $startDateEst = Carbon::parse($cycleEst->start_date);
        $startDateIstihadhah = null;
        if($istihadhah){
            $startDateIstihadhah = Carbon::parse($istihadhah->start_date);
        }

        if($now->gte($startDateEst)){
            $dateNow1 = Carbon::now();
            $value = ($dateNow1->diffInDays($startDateEst)) + 1;
            $condition = 'Hari ke-' . $value;
            $message = 'Anda dalam keadaan Haid';
        } else {

            $dateNow3 = Carbon::now();
            $value = $startDateEst->diffInDays($dateNow3);
            $condition = $value . ' Hari lagi';
            $message = 'menuju siklus haid selanjutnya';

            if($istihadhah){
                if($now->gte($startDateIstihadhah)){
                    $dateNow2 = Carbon::now();
                    $value = ($dateNow2->diffInDays($startDateIstihadhah)) + 1;
                    $condition = 'Hari ke-' . $value;
                    $message = 'Anda dalam keadaan Istihadhah';
                }
            }
        }

        $data = [];
        $data['condition'] = $condition;
        $data['message'] = $message;
        return $data;
    }
}
