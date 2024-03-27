<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReminderRequest;
use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    public function getAll()
    {
        $user = Auth::user();
        $reminder = Reminder::where([
            'user_id' => $user->id
        ])->get();

        return ReminderResource::collection($reminder);
    }

    public function getById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:reminders,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reminder = Reminder::find($request->id);
        return new ReminderResource($reminder);
    }

    public function update(ReminderRequest $request) :JsonResponse
    {
        $data = $request->validated();
        $reminder = Reminder::find($data['id']);
        $reminder->update($data);

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
