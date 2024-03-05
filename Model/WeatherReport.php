<?php
class WeatherReport {
    public function displayWeather($dateTime, $temperature, $minTemperature, $maxTemperature, $humidity, $skyStatus, $windSpeed, $windDirection, $weatherIcon) {
        echo "<h2>Weather Information</h2>";
        echo "<p>Date and Time: $dateTime</p>";
        echo "<p>Temperature: $temperature °C</p>";
        echo "<p>Min Temperature: $minTemperature °C</p>";
        echo "<p>Max Temperature: $maxTemperature °C</p>";
        echo "<p>Humidity: $humidity%</p>";
        echo "<p>Sky Status: $skyStatus</p>";
        echo "<p>Wind Speed: $windSpeed m/s</p>";
        echo "<p>Wind Direction: $windDirection °</p>";
        echo "<img src='http://openweathermap.org/img/w/$weatherIcon.png' alt='Weather Icon'>";
    }
}
?>