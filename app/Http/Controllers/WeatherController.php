<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Service\Weather\WeatherService;

class WeatherController extends Controller
{
    public function getJson(int $id = null)
    {
        if ($id === null)
            $id = 1290;

        $service = new WeatherService();

        $model = City::query()->find($id);


        if (isset($model)){
            $service->lat = $model->lat;
            $service->lon = $model->lon;
        }

        $weatherData  = json_decode($service->getWeather(), true);

        $name = $service->apiQ.$service->dt.$service->lat.$service->lon.'openweather.json';

        $response[0] = json_encode($weatherData);
        $response[1] = $name;

        //Storage::disk('local')->put($service->apiQ.$service->dt.$service->lat.$service->lon.'openweather.json', $weatherData);

        return $response;
    }
}
