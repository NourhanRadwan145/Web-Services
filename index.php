<?php
require_once "vendor/autoload.php";

$apiKey = 'ab88e9304267befb6062a70e4ebda67c'; 
$weatherAPI = new WeatherAPI($apiKey);

// Read city names from file.txt
$file = fopen("cities.txt", "r") or die("Unable to open file!");
$cities = [];
while (!feof($file)) {
    $line = trim(fgets($file));
    if (!empty($line)) {
        $cities[] = $line;
    }
}
fclose($file);

if (isset($_POST['city'])) {
    $cityName = urlencode($_POST['city']); // Encode city name for URL
    $weatherData = $weatherAPI->getWeatherByCity($cityName);

    if ($weatherData && isset($weatherData['cod']) && $weatherData['cod'] === 200) {
        // Weather data is available and there are no error codes
        $temperature = $weatherData['main']['temp'];
        $minTemperature = $weatherData['main']['temp_min'];
        $maxTemperature = $weatherData['main']['temp_max'];
        $humidity = $weatherData['main']['humidity'];
        $skyStatus = $weatherData['weather'][0]['description']; // Sky status description
        $windSpeed = $weatherData['wind']['speed']; // Wind speed
        $windDirection = $weatherData['wind']['deg']; // Wind direction
        $weatherIcon = $weatherData['weather'][0]['icon']; // Weather icon code

        // Convert Unix timestamp to readable date and time
        $currentTime = time();
        $dateTime = date('l, F jS Y - h:i A', $currentTime);

        // Pass weather data to WeatherReport class for display
        $weatherReport = new WeatherReport();
        $weatherReport->displayWeather($dateTime, $temperature, $minTemperature, $maxTemperature, $humidity, $skyStatus, $windSpeed, $windDirection, $weatherIcon);
    } else {
        // Either weather data is not available or there's an error
        echo "Weather data not available.<br>";
        // Debugging: Print out the error code and message
        if (isset($weatherData['cod'])) {
            echo "Error code: " . $weatherData['cod'] . "<br>";
            echo "Message: " . $weatherData['message'] . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weather Report</title>
</head>
<body>

<form method="post" action="">
    <select name="city">
        <?php foreach ($cities as $city): ?>
            <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Get Weather</button>
</form>



</body>
</html>