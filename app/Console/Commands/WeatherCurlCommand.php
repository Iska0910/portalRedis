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
        $cities = array(1290, 1281, 1282, 1284, 1291, 25870, 25872, 25875, 25876, 25883, 25885, 11620, 11623, 1279);

        $weatherControler = new WeatherController();

        foreach ($cities as $key => $item) {

            $curl = $weatherControler->getJson($item);

            $data = $curl;

            $name = $data[1];

            $response = $data[0];

//            $path = "C:/OSPanel/domains/turkmenportal/protected/runtime/OpenWeather/$name";
            $path = "/var/www/turkmenportal.com/public_html/protected/runtime/OpenWeather/$name";

            file_put_contents($path, $response);

            $this->info($key + 1 . ") $item  => $name, success!");
        }

        $this->info('WeatherCurl command finished succes!');

    }
}
