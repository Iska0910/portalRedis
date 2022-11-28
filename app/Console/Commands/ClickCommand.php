<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Predis\Client;

class ClickCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $allKeys = $delKeys = 0;

        $keys = $client->keys('*');
        $allKeys = count($keys);

        foreach ($keys as $key) {
            if ( !(strpos($key, '_ru_') > 0 || strpos($key, '_tm_') > 0 || strpos($key, '_en_') > 0 || strpos($key, '_tr_') > 0) ) {
                $client->del($key);
                $delKeys++;
            }
        }



        $this->info("Found $allKeys && deleted $delKeys keys!");
        return 0;
    }
}
