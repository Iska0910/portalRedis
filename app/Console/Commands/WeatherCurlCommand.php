<?php

namespace App\Console\Commands;

use App\Http\Controllers\WeatherController;
use Illuminate\Console\Command;

class WeatherCurlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get';

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
//        $cities = array(1290, 1281, 1282, 1284, 1291, 25870, 25872, 25875, 25876, 25883, 25885, 11620, 11623, 1279);
        $cities = [
            '1279',
            '1280',
            '1281',
            '1282',
            '1283',
            '1284',
            '1285',
            '1286',
            '1287',
            '1288',
            '1289',
            '1290',
            '1291',
            '11616',
            '11617',
            '11618',
            '11619',
            '11620',
            '11621',
            '11622',
            '11623',
            '25870',
            '25871',
            '25872',
            '25873',
            '25874',
            '25875',
            '25876',
            '25877',
            '25878',
            '25879',
            '25880',
            '25881',
            '25882',
            '25883',
            '25884',
            '25885',
            '25886',
            '31096',
            '31097'
        ];

        $weatherControler = new WeatherController();

        foreach ($cities as $key => $item) {

            $curl = $weatherControler->getJson($item);

            $data = $curl;

            $name = $data[1];

            $response = $data[0];

            $path = "/var/www/turkmenportal.com/public_html/protected/runtime/OpenWeather/$name";

            if (!is_dir($path))
                $path = "/Users/macbookair/Projects/turkmenportal/protected/runtime/OpenWeather/$name";

            file_put_contents($path, $response);

            $this->info($key + 1 . ") $item  => $name, success!");
        }

        $this->info('WeatherCurl command finished succes!');

    }
}
