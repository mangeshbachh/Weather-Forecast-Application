<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{

    public function fetchWeatherData($city)
    {
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
