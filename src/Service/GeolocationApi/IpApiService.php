<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:27
 */

namespace App\Service\GeolocationApi;

use Symfony\Component\Config\Definition\Exception\Exception;
use App\Service\AbstractApiService;

/**
 * Class IpApiService
 * @package App\Service
 */
class IpApiService extends AbstractApiService implements GeolocationApiInterface {

    const APINAME = "ip-api";

    /**
     * @var string
     */
    private $apiUrl = "http://ip-api.com/json/";

    /**
     * @var array
     */
    private $queryFields = array("status", "city", "regionName", "country", "countryCode");

    /**
     * Prepare, execute and check API request
     * @param string $ipAddress
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGeolocation(string $ipAddress) : string {
        // Prepare API request
        $url = sprintf('%s%s', $this->apiUrl, $ipAddress);
        $options = array("query" => array("fields" => implode(",",$this->queryFields)));
        // Call API
        $response = $this->callApi($url, null, $options);
        // Check APi reponse
        if(!$this->isSuccess($response)) {
            throw new Exception('IpAPI returns error');
        }
        return $response;
    }

    /**
     * Check if the response is sucessful
     * @param $response
     * @return bool
     */
    private function isSuccess($response) : bool {
        $responseArray = \GuzzleHttp\json_decode($response, true);
        return $responseArray["status"] === "success";
    }
}