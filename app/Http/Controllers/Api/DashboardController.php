<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DashboardRequest;
use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function question(DashboardRequest $request) :JsonResponse
    {
        $data = $request->validated();

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
            'type' => 'hist',
            'cycle_length' => $data['cycle'],
            'period_length' => $data['period'],
            'start_date' => Carbon::parse($data['lastDate'])->addDays($value),
            'end_date' => null,
            'user_id' => $user->id
        ]);

    }


}
