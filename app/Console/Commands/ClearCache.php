<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-cache {--doNotCacheConfig} {--doNotGenerateVars}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear application cache and cache config';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('clear-compiled');
        $this->call('cache:clear');
        $this->call('view:clear');
        if ($this->option('doNotCacheConfig')) {
            $this->call('config:clear');
        } else {
            $this->call('config:cache'); 
            if (function_exists('opcache_invalidate')) {
                opcache_invalidate(app()->getCachedConfigPath());
            }
        }
       
        \App\Jobs\RestartQueueWorker::dispatch()->onQueue('default');
    }
}
