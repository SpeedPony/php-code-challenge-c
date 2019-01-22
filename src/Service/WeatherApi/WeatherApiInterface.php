<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 22/01/2019
 * Time: 16:29
 */

namespace App\Service\WeatherApi;

use Symfony\Component\Config\Definition\Exception\Exception;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Interface WeatherApiInterface
 * @package App\Service\WeatherApi
 */
interface WeatherApiInterface {

    /**
     * Prepare, execute and check API request
     * @param $inputs
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeather($inputs) : string;

    /**
     * Call the API using Guzzle
     * @param string $url
     * @param string|null $type
     * @param array $options
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     * @throws Exception
     */
    public function callApi(string $url, $type = 'GET', array $options);

}