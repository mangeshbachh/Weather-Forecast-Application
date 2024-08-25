<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherForecastsTable extends Migration
{
    public function up()
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->float('temperature');
            $table->integer('humidity');
            $table->float('wind_speed');
            $table->string('condition');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('weather_forecasts');
    }
}
