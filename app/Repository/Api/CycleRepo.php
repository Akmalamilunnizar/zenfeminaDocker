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

        $difference = Carbon::parse($data['inputDate'])->diffInDays(Carbon::parse($cycleHist->end_date));
        if($difference < 15 ){
            if(($difference + $cycleHist->period_length) < 15){
                $cycleEst->delete();
                $cycleHist->type = 'est';
                $cycleHist->end_date = null;
                $cycleHist->save();
            } else {
                Istihadhah::create([
                    'start_date' => $data['inputDate'],
                    'user_id' => $user->id
                ]);
            }
        } else {
            $cycleEst->on_started = 1;
            $cycleEst->start_date = Carbon::parse($data['inputDate']);
            $cycleEst->save();
        }
    }

    public static function continueCycle(){
        $user = Auth::user();

        $cycleEst = Cycle::where([
            ['user_id', $user->id],
            ['type', 'est']
        ])->first();

        $startEst = $cycleEst->start_date;
        $endDate = Carbon::parse($startEst)->addDays(14);
        $cycleEst->end_date = $endDate;
        $cycleEst->on_started = 0;
        $cycleEst->type = 'hist';
        $cycleEst->save();

        $avgCycle = static::getAvg('cycle_length');
        $avgPeriod = static::getAvg('period_length');
        $val = ($avgCycle- $avgPeriod) + 1;
        Cycle::create([
            'type' => 'est' ,
            'cycle_length' => $avgCycle,
            'period_length' => $avgPeriod,
            'start_date' => $endDate->addDays($val),
            'user_id' => $user->id,
            'on_started' => 0
        ]);

        Istihadhah::create([
            'start_date' => Carbon::parse($startEst)->addDays(15),
            'user_id' => $user->id
        ]);

    }

    public static function endCycle(CycleRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        $cycleEst = Cycle::where([
            ['user_id', $user->id],
            ['type', 'est']
        ])->first();

        $istihadhah = Istihadhah::where([
            'user_id' => $user->id
        ])->orderBy('id', 'desc')->first();

        if($istihadhah->end_date == null){
            $istihadhah->end_date = Carbon::parse($data['inputDate']);
            $istihadhah->save();
        } else {
            $startDate = Carbon::parse($cycleEst->start_date)->subDays(1);
            $difference = Carbon::parse($data['inputDate'])->diffInDays($startDate);
            $cycleBefore = $cycleEst->cycle_length;

            $cycleEst->end_date = Carbon::parse($data['inputDate']);
            if($cycleEst->period_length != $difference){
                $cycleEst->cycle_length = $cycleBefore + ($difference - $cycleEst->period_length);
                $cycleEst->period_length = $difference;
            }
            $cycleEst->type = 'hist';
            $cycleEst->save();

            // set Est
            $avgCycle = static::getAvg('cycle_length');
            $avgPeriod = static::getAvg('period_length');
            $value = ($avgCycle- $avgPeriod) + 1;
            Cycle::create([
                'type' => 'est',
                'cycle_length' => $avgCycle,
                'period_length' => $avgPeriod,
                'start_date' => Carbon::parse($data['inputDate'])->addDays($value),
                'end_date' => null,
                'user_id' => $user->id
            ]);
        }
    }

    public static function getAvg($type) :int
    {
        return Cycle::query()
            ->where('type', 'hist')
            ->avg($type);
    }

}
