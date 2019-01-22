<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:27
 */

namespace App\Service\WeatherApi;

use Symfony\Component\Config\Definition\Exception\Exception;
use App\Service\AbstractApiService;

/**
 * Class OpenWeatherMapApiService
 * @package App\Service\GeolocationApi
 */
class OpenWeatherMapApiService extends AbstractApiService implements WeatherApiInterface {

    /**
     * @var string
     */
    private $apiUrl = "https://api.openweathermap.org/data/2.5/weather";

    /**
     * @var string
     */
    private $apiKey;

    /**
     * OpenWeatherMapApiService constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * Prepare, execute and check API request
     * @param $inputs
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeather($inputs) : string {

        // Building options query
        $options = array();
        $options["APPID"] = $this->apiKey;
        $options["q"] = sprintf("%s,%s", $inputs["cityName"], $inputs["countryCode"]);
        $options["units"] = "metric";
        $options = array("query" => $options);

        // Call API
        return $this->callApi($this->apiUrl, null, $options);
    }
}