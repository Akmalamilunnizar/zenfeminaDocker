<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CycleRequest;
use App\Http\Resources\Api\CycleResource;
use App\Models\Cycle;
use Illuminate\Support\Facades\Auth;

class CycleController extends Controller
{
    public function getAll(CycleRequest $request)
    {
        $data = $request->validated();
        $cycle = Cycle::where([
            ['type', $data['type']],
            ['useR_id', Auth::user()->id]
        ])->get();
        return CycleResource::collection($cycle);
    }

    public function beginCycle(){}

    public function continueCycle(){}

    public function completeCycle(){}
}
