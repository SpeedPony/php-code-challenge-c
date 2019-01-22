<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 17:02
 */

namespace App\Service;

use App\Service\WeatherApi\OpenWeatherMapApiService;
use App\Service\WeatherFormatter\OpenWeatherMapFormatterService;


/**
 * Class WeatherService
 * @package App\Service
 */
class WeatherService {

    /**
     * @var GeolocationService
     */
    protected $geolocationService;

    /**
     * @var OpenWeatherMapApiService
     */
    protected $openWeatherMapApiService;

    /**
     * @var OpenWeatherMapFormatterService
     */
    protected $openWeatherMapFormatterService;

    /**
     * WeatherService constructor.
     * @param GeolocationService $geolocationService
     * @param OpenWeatherMapApiService $openWeatherMapApiService
     * @param OpenWeatherMapFormatterService $openWeatherMapFormatterService
     */
    public function __construct(GeolocationService $geolocationService,
                                OpenWeatherMapApiService $openWeatherMapApiService,
                                OpenWeatherMapFormatterService $openWeatherMapFormatterService
    ) {
        $this->geolocationService = $geolocationService;
        $this->openWeatherMapApiService = $openWeatherMapApiService;
        $this->openWeatherMapFormatterService = $openWeatherMapFormatterService;
    }

    /**
     * Get and format weather datas by service
     * @param string $ipAddress
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDatasFromAPI(string $ipAddress) {

        // Get geolocation data from ip
        $geolocationDatas = $this->geolocationService->getDatasForWeather($ipAddress);

        // Call weather api
        $apiResult = $this->openWeatherMapApiService->getWeather($geolocationDatas);

        // Fromat Data
        return $this->openWeatherMapFormatterService->format($apiResult, $ipAddress);
    }
}