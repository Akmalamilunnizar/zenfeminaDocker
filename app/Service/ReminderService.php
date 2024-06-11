<?php

namespace App\Service;

use App\Models\Cycle;
use App\Models\Debt;
use App\Models\Reminder;
use App\Models\User;
use App\Notifications\BaseNotification;
use Carbon\Carbon;

class ReminderService
{
    public static function sendNotification(Reminder $reminder)
    {
        $user = User::find($reminder->user_id);
        date_default_timezone_set('Asia/Jakarta');

        //fasting
        if($reminder->type == 'fasting')
        {
            $debts = Debt::query()
                ->where('user_id', $reminder->user_id)
                ->where('type', 'fasting')
                ->where('is_done', '0')
                ->count();

            $now = Carbon::now();
            if($debts > 0 && $now->format('H:i:s') == $reminder->time )
            {
                $user->notify(new BaseNotification('Pengingat Hutang Puasa', 'Anda memiliki' . $debts . 'hutang puasa'));
            }
        }

        //praying
        if($reminder->type == 'praying')
        {
            $debts = Debt::query()
                ->where('user_id', $reminder->user_id)
                ->where('type', 'praying')
                ->where('is_done', '0')
                ->count();

            $now = Carbon::now();
            if($debts > 0 && $now->format('H:i:s') == $reminder->time )
            {
                $user->notify(new BaseNotification('Pengingat Hutang Sholat', 'Anda memiliki' . $debts . 'hutang sholat'));
            }
        }

        //periodStart
        if($reminder->type == 'periodStart')
        {
            $cycle = Cycle::query()
                ->where('user_id', $reminder->user_id)
                ->where('type', '=', 'est')
                ->first();
            $periodStart = Carbon::parse($cycle->start_date);
            $dateReminder = $periodStart->subDays($reminder->day);

            $now = Carbon::now();
            if($now->format('d-m-Y') == $dateReminder->format('d-m-Y') && $now->format('H:i:s') == $reminder->time)
            {
                $user->notify( new BaseNotification('Pengingat siklus Haid', 'Siklus anda akan segera dimulai'));
            }
        }

        //periodEnd
        if($reminder->type == 'periodEnd')
        {
            $cycle = Cycle::query()
                ->where('user_id', $reminder->user_id)
                ->where('type', '=','est')
                ->first();
            $periodEnd = Carbon::parse($cycle->start_date)->addDays($cycle->period_length);
            $dateReminder = $periodEnd->subDays($reminder->day);

            $now = Carbon::now();
            if($now->format('d-m-Y') == $dateReminder->format('d-m-Y') && $now->format('H:i:s') == $reminder->time)
            {
                $user->notify( new BaseNotification('Pengingat siklus Haid', 'Siklus anda akan segera berakhir'));
            }
        }

    }
}
