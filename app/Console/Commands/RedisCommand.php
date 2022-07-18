<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Predis\Client;

class RedisCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:start';

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

        $keys = $client->keys('*');


        foreach ($keys as $key){
            $id = (int)substr($key, strpos($key, '_', 11) + 1);
            $value = (int)$client->get($key);
//            var_dump($value);
            $db = DB::table('tbl_blog')
                ->where('id', $id)
                ->update([
                    'visited_count' => DB::raw("visited_count + $value")
                ]);

            $client->del($key);
        }


        return 0;
    }
}
