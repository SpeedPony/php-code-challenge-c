<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:27
 */

namespace App\Service\WeatherFormatter;

/**
 * Class OpenWeatherMapFormatterService
 * @package App\Service\GeolocationFormatter
 */
class OpenWeatherMapFormatterService implements FormatterInterface {

    /**
     * Format API specific data
     * @param string $json
     * @param string $ipAddress
     * @return array
     */
    public function format(string $json, string $ipAddress): array {

        $datas = \GuzzleHttp\json_decode($json, true);

        // Température
        $temperature = array();
        $temperature["current"] = $datas["main"]["temp"];
        $temperature["low"] = $datas["main"]["temp_min"];
        $temperature["high"] = $datas["main"]["temp_max"];

        // Wind
        $wind = array();
        $wind["speed"] = $datas["wind"]["speed"];
        $wind["direction"] = $datas["wind"]["deg"];

        return array("ip" => $ipAddress, "city" => $datas["name"], "temperature" => $temperature, "wind" => $wind);
    }
}