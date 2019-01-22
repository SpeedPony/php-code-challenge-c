<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:37
 */

namespace App\Service;
use GuzzleHttp;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class AbstractApiService
 * @package App\Service
 */
abstract class AbstractApiService {

    /**
     * Call the API using Guzzle
     * @param string $url
     * @param string|null $type
     * @param array $options
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     */
    public function callApi(string $url, $type = 'GET', array $options) {
        $client = new GuzzleHttp\Client();
        $response = $client->request('GET', $url, $options);

        // If API error
        if($response->getStatusCode() !== 200) {
            throw new Exception(sprintf('API %s is not responding', $url));
        }

        return $response->getBody();
    }
}