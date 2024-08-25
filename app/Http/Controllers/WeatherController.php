<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WeatherForecast;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');

        $weather = $this->weatherService->fetchWeatherData($city);
        
        if ($weather) {
            $this->saveWeather($city, $weather);

            return view('weather', ['weather' => $weather]);
        }

        return redirect('/')->withErrors(['error' => 'City not found']);
    }

    protected function saveWeather($city, $weather)
    {
        $weatherForecast = new WeatherForecast();
        $weatherForecast->city = $city;
        $weatherForecast->temperature = $weather['main']['temp'];
        $weatherForecast->humidity = $weather['main']['humidity'];
        $weatherForecast->wind_speed = $weather['wind']['speed'];
        $weatherForecast->condition = $weather['weather'][0]['description'];
        $weatherForecast->save();
    }

    public function getWeatherApi(Request $request)
    {
        $request->validate([
            'city' => 'required|string'
        ]);
        $city = $request->input('city');
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
        $response = Http::get($url);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'error' => 'Unable to fetch weather data or check if city is entered correctly'
            ], $response->status());
        }
    }
}
