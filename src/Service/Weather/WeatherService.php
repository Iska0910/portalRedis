<?php

namespace Service\Weather;

class WeatherService
{
    public $apiURL ;
    public $lang;
    public $lon;
    public $lat;
    public $dt;
    public $units;
    public $apiKey;
    public $apiQ = '';
    public $data;
    public $wind_direction = 1; // 1 Direction, 0 Coordinates
    public $iconsInfo;

    private $_inHG = 33.8638866667;

    public function __construct()
    {
        $this->apiURL = "https://api.openweathermap.org/data/2.5/onecall?";
        $this->apiKey = "65c4fa09382b60e6c1c302916cfcb197";
        $this->lang = "en";
        $this->units = "metric";
        $this->iconsInfo = array(

            '200' => 'H6',
            '201' => 'H6',
            '202' => 'H8',
            '210' => 'H4',
            '211' => 'H4',
            '212' => 'H8',
            '221' => 'H8',
            '230' => 'H6',
            '231' => 'H6',
            '232' => 'H8',

            '300' => 'K4',
            '301' => 'K1',
            '302' => 'H6',
            '310' => 'K8',
            '311' => 'K8',
            '312' => 'K8',
            '313' => 'K8',
            '314' => 'E8',
            '321' => 'E6',

            '500' => 'D4',
            '501' => 'D6',
            '502' => 'D8',
            '503' => 'D8',
            '504' => 'D8',
            '511' => 'E8',
            '520' => 'I6',
            '521' => 'D6',
            '522' => 'I8',
            '531' => 'D8',

            '600' => 'F4',
            '601' => 'F1',
            '602' => 'F8',
            '611' => 'F1',
            '612' => 'E6',
            '613' => 'E4',
            '615' => 'E6',
            '616' => 'E8',
            '620' => 'F6',
            '621' => 'F1',
            '622' => 'F8',

            '701' => 'C1',
            '711' => 'B1',
            '721' => 'C1',
            '731' => 'C1',
            '741' => 'C1',
            '751' => 'C1',
            '761' => 'C1',
            '762' => 'C1',
            '771' => 'C1',
            '781' => 'C1',

            '800' => 'A2',
            '801' => 'A4',
            '802' => 'A6',
            '803' => 'A8',
            '804' => 'A8',

        );
    }

    public function getWeather(){

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->apiURL . 'lat='.$this->lat .'&lon='. $this->lon.'&units='.$this->units. '&appid=' . $this->apiKey. '&lang=' . $this->lang);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($curl);

        dd(curl_getinfo($curl, CURLINFO_SIZE_DOWNLOAD));

        return $data;
    }

    public function getGeoCode()
    {
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBDJ1dE9OjJtp33gBzRMad6iasRnAW_4xQ&language='.$this->lang.'&latlng='.$this->lat.','.$this->lon.'&sensor=false');
        $output= json_decode($geocode);

        if ($this->lang === 'ru'){
            if (isset($output->results[2])){
                $results = $output->results[2]->address_components;
            } elseif (isset($output->results[1])){
                $results = $output->results[1]->address_components;
            }
        } else {
            $results = $output->results[0]->address_components;
        }

        foreach ($results as $result){
            $geoCodeInfo[$result->types[0]] = $result->long_name;
        }

        return $geoCodeInfo;

    }
}
