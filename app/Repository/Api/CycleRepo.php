<?php

namespace App\Repository\Api;

use App\Http\Requests\Api\CycleRequest;
use App\Models\Cycle;
use App\Models\Istihadhah;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CycleRepo{

    public static function beginCycle(CycleRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        $cycleHist = Cycle::where([
            ['user_id', $user->id],
            ['type', 'hist']
        ])->orderBy('id', 'desc')->first();

        $cycleEst = Cycle::where([
            ['user_id', $user->id],
            ['type', 'est']
        ])->first();

        $difference = ($cycleHist->end_date - $data['beginDate']);
        if($difference < 15 ){
            if(($difference + $cycleHist->period) < 15){
                $cycleEst->type = 'hist';
            } else {
                Istihadhah::create([
                    'start_date' => $data['beginDate'],
                    'end_date' => Carbon::parse($data['beginDate'])->addDays(15),
                    'user_id' => $user->id
                ]);
            }
        } else {
            //haid
        }
    }

    public static function continueCycle(){}

    public static function completeCycle(){}

}
