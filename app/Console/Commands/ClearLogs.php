<?php

namespace App\Console\Commands;

use App\Models\Log;
use Illuminate\Console\Command;

class ClearLogs extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $logs = Log::whereBetween('created_at', [now()->subMonths(3), now()->subMonths(2)])->get();
        foreach ($logs as $log) {
            $log->delete();
        }
        rh_log('Logs Cleared', 'Clear ' . $logs->count() . ' logs. (' . now()->subMonths(3)->format('j M, Y') . ' to ' . now()->subMonths(2)->format('j M, Y') . ')', 'Cleared');
        return 0;
    }
}
