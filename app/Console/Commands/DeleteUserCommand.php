<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete unactive user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()
        ->whereHas('cycle', function ($query) {
            $query->where('start_date', '<=', Carbon::now()->subDays(20))
                ->where('type', '=', 'est');
        })->delete();
        $this->info('success');
    }
}
