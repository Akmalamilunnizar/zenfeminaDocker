<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReminderRequest;
use App\Http\Resources\Api\ReminderResource;
use App\Models\Reminder;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    use  ApiResponser;
    public function getAll()
    {
        $user = Auth::user();
        $reminder = Reminder::where([
            'user_id' => $user->id
        ])->get();

        return $this->success(
            ReminderResource::collection($reminder),
            "Berhasil mendapatkan data"
        );
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

        return $this->success(
            ReminderResource::make($reminder),
            'Berhasil mendapatkan data'
        );
    }

    public function update(ReminderRequest $request) :JsonResponse
    {
        $data = $request->validated();
        $reminder = Reminder::find($data['id']);
        $reminder->update($data);

        return $this->success(
            message: "Berhasil mengubah data"
        );
    }
}
