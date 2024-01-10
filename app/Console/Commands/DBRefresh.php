<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DBRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DB refresh';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate:fresh');

        $this->call('db:seed');
    }
}
