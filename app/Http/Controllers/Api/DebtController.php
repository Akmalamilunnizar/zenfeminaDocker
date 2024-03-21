<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DebtRequest;
use App\Http\Resources\DebtResource;
use App\Models\Debt;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{
    public function get(DebtRequest $request)
    {
        $data = $request->validated();
        $debt = Debt::query()->where([
            ['type', $data['type']],
            ['is_done', $data['is_done']]
        ])->get();

        if($debt->isEmpty()){
            throw new HttpResponseException(response([
                'errors' => 'data tidak tersedia'
            ]), 401);
        }

        return DebtResource::collection($debt);
    }

    public function add(DebtRequest $request) :JsonResponse
    {
        $user = Auth::user();
        $data = $request->validated();
        Debt::create([
            'type' => $data['type'],
            'details' => $data['details'],
            'is_done' => $data['is_done'],
            'date' => $data['date'],
            'user_id' => $user->id
        ]);

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }

    public function update(Request $request) :JsonResponse
    {
        $debt = Debt::find($request->id);
        if(!$debt){
            throw new HttpResponseException(response([
                'errors' => 'data tidak tersedia'
            ]), 401);
        }
        $debt->is_done = 1;
        $debt->save();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
