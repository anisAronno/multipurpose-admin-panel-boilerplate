<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;

class DeleteOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete log files older than 30 days';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $log_path = storage_path('logs');
        $files = File::allFiles($log_path);
        $now = Carbon::now();
        foreach ($files as $file) {
            if ($now->diffInDays(Carbon::createFromTimestamp(File::lastModified($file))) >= 30) {
                File::delete($file);
            }
        }
        $this->info('Log files older than 30 days have been deleted.');
    }
}
