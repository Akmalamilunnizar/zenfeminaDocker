<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CycleRequest;
use App\Http\Resources\Api\CycleResource;
use App\Models\Cycle;
use App\Repository\Api\CycleRepo;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

class CycleController extends Controller
{
    use ApiResponser;
    public function getAll(CycleRequest $request)
    {
        $data = $request->validated();
        $cycle = Cycle::where([
            ['type', $data['type']],
            ['useR_id', Auth::user()->id]
        ])->get();

        return $this->success(
            CycleResource::collection($cycle),
            "Bergasil mengambil seluruh data"
        );
    }

    public function beginCycle(CycleRequest $request){
        CycleRepo::beginCycle($request);

        return $this->success(
            message: 'Berhasil memulai siklus'
        );
    }

    public function continueCycle(CycleRequest $request){
        CycleRepo::continueCycle();

        return $this->success(
            message: 'Berhasil melanjutkan siklus'
        );
    }

    public function completeCycle(CycleRequest $request){
        CycleRepo::endCycle($request);

        return $this->success(
            message: 'Berhasil mengakhiri Siklus'
        );
    }
}
