<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DashboardRequest;
use App\Http\Resources\Api\DashboardResource;
use App\Models\Cycle;
use App\Models\Debt;
use App\Repository\Api\DashboardRepo;
use App\Traits\ApiResponser;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use ApiResponser;
    public function question(DashboardRequest $request) :JsonResponse
    {
        $data = $request->validated();
        try {
            DB::transaction(function () use ($data){
                DashboardRepo::question($data);
            });
            return $this->success(
                message: "Berhasil menambahkan data"
            );
        } catch (QueryException $e){
            throw new HttpResponseException(response([
                'errors' => $e->getMessage()
            ]), 400);
        }
    }

    public function getCycle(DashboardRequest $request) :JsonResponse
    {
        $data = $request->validated();
        $cycle = Cycle::where([
            ['type', $data['type']],
            ['user_id', Auth::user()->id]
        ])
            ->orderBy('id', 'desc')
            ->first();

        return $this->success(
            DashboardResource::make($cycle),
            "Berhasil mendapatkan data"
        );
    }

    public function getDebt(DashboardRequest $request) :JsonResponse
    {
        $data = $request->validated();
        $debt = Debt::where([
            ['type', $data['type']],
            ['is_done', '0'],
            ['user_id', Auth::user()->id]
        ])->count();

        return $this->success(
            $debt,
            'Berhasil mendapatkan data'
        );
    }
}
