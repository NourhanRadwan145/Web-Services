
<?php
class WeatherAPI {
    private $apiKey;
    private $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getWeatherByCity($cityName) {
        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrl . "?q=$cityName&appid=" . $this->apiKey . "&units=metric",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json"
            ],
        ]);

        // Execute cURL request
        $response = curl_exec($curl);

        // Check for errors
        if ($response === false) {
            echo 'cURL error: ' . curl_error($curl);
            return null;
        }

        // Close cURL session
        curl_close($curl);

        // Decode JSON response
        $data = json_decode($response, true);

        // Return weather data
        return $data;
    }
}
?>