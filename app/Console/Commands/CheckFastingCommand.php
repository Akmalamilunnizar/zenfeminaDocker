<?php

namespace App\Console\Commands;

use App\Models\Cycle;
use App\Models\Debt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckFastingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-fasting-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $users = Cycle::query()
            ->where('type', 'est')
            ->where(function ($cycle) use ($now){
                $cycle->whereDate('start_date', '<=', $now)
                    ->WhereDate('end_date', '>=', $now);
            })
            ->pluck('user_id');

        $month = Http::get('http://api.aladhan.com/v1/gToH/' . $now->format('d-m-Y'));
        $data = $month->json();
        $val = $data['data']['hijri']['month']['en'];

        if($val === 'Ramaḍān')
        {
            foreach ($users as $user)
            {
                Debt::create([
                    'user_id' => $user,
                    'date' => $now,
                    'type' => 'fasting',
                    'details' => 'haid'
                ]);
            }
        }

        $this->info('success');
    }
}
