<?php

namespace App\Console\Commands;

use App\Blog_View;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Predis\Client;

class ViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:view:start';

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
        $sum = $updates = $allKeys = 0;

        $tables = array(
            'blog'          =>  'tbl_blog_view',
            'catalog'       =>  'tbl_catalog_view',
            'compositions'  =>  'tbl_compositions_view',
        );

        $table_id = array(
            'blog'          =>  'blog_id',
            'catalog'       =>  'catalog_id',
            'compositions'  =>  'composition_id',
        );

        $langs = [
            1   => 'ru',
            2   => 'tm',
            3   => 'en',
            4   => 'tr',
        ];

        $allKeys = count($client->keys('*'));

        foreach ($langs as $lang) {

            $keys = $client->keys("view_count_$lang" . "_*");

            if (!empty($keys)) {

                $sum += count($keys);

                foreach ($keys as $key) {
                    $table = substr($key, 14, strpos($key, '_', 14) - 14);

                    $id = (int)substr($key, strpos($key, '_', 14) + 1);

                    $value = (int)$client->get($key);

//                    $this->info("$table, $table_id[$table], $id, $lang, $value");

                    if(DB::table($tables[$table])->where($table_id[$table], $id)->exists()){
                        DB::table($tables[$table])
                            ->where($table_id[$table], $id)
                            ->update([
                                $lang => DB::raw("$lang + $value")
                            ]);
                    } else {
                        DB::table($tables[$table])->insert([
                            $table_id[$table]   => $id,
                            $lang               => $value,
                            'created_at'        => now(),
                            'updated_at'        => now()
                        ]);
                    }

                    if ($value < (int)$client->get($key)) {
                        $client->set($key, ((int)$client->get($key)) - $value);
                        $updates++;
                    }else
                        $client->del($key);
                }
            }
        }

        $this->info("Fixed $allKeys keys. Fixed view counts of $sum && updated $updates keys!");

        return 0;
    }
}
