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
    protected $signature = 'redis:click:start';

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

        $tables = array(
            'banner'    =>  'click_count', //+
        );

        $keys = $client->keys('click_count_*');

        if (!empty($keys)) {
            foreach ($keys as $key) {

                $table = substr($key, 12, strpos($key, '_', 12) - 12);

                $id = (int)substr($key, strpos($key, '_', 12) + 1);

                $value = (int)$client->get($key);

                $column = $tables[$table];

                $db = DB::table('tbl_' . $table)
                    ->where('id', $id)
                    ->update([
                        "$column" => DB::raw("$column + $value")
                    ]);

                $client->del($key);
            }
        }
//        SELECT view_count FROM `tbl_banner` WHERE id in (297, 303, 364, 369, 386, 389, 423, 481, 500, 545, 554, 571, 578, 645, 670, 707, 708, 714);
        return 0;
    }
}
