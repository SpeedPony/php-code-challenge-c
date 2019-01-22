<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:41
 */

namespace App\Service\GeolocationApi;

use Symfony\Component\Config\Definition\Exception\Exception;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Interface GeolocationApiInterface
 * @package App\Service\Interfaces
 */
interface GeolocationApiInterface {

    /**
     * Prepare, execute and check API request
     * @param string $ipAddress
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGeolocation(string $ipAddress) : string;

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