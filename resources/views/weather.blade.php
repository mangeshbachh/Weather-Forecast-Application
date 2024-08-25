<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .weather-info {
            margin-top: 20px;
        }
        .error {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Weather Forecast Application</h1>
        <form id="weatherForm" method="POST" action="/weather">
            @csrf <!-- This is important for CSRF protection -->
            <div class="form-group">
                <label for="city">Enter City Name:</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Get Weather</button>
        </form>

        @if(isset($weather))
            <div id="weatherInfo" class="weather-info">
                <h3>Weather in {{ $weather['name'] }}</h3>
                <p>Temperature: {{ $weather['main']['temp'] }} °C</p>
                <p>Humidity: {{ $weather['main']['humidity'] }}%</p>
                <p>Wind Speed: {{ $weather['wind']['speed'] }} m/s</p>
                <p>Condition: {{ $weather['weather'][0]['description'] }}</p>
            </div>
        @endif

        @if($errors->any())
            <div id="error" class="error">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
</body>
</html>
