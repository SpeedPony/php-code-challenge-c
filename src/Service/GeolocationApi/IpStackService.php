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
class IpStackService extends AbstractApiService implements GeolocationApiInterface {

    const APINAME = "freegeoip";

    /**
     * @var string
     */
    private $apiUrl = "http://api.ipstack.com/";

    /**
     * @var array
     */
    private $queryFields = array("success", "city", "region_name", "country_name");

    /**
     * @var string
     */
    private $apiKey;

    /**
     * IpStackService constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * Prepare, execute and check API request
     * @param string $ipAddress
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGeolocation(string $ipAddress): string {
        // Prepare API request
        $url = sprintf('%s%s', $this->apiUrl, $ipAddress);
        $options = array("query" => array("access_key" => $this->apiKey, "fields" => implode(",", $this->queryFields)));
        // Call API
        $response = $this->callApi($url, null, $options);
        // Check APi reponse
        if(!$this->isSuccess($response)) {
            throw new Exception('IpStackAPI returns error');
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
        if(isset($responseArray["success"]) && $responseArray["success"] === false) {
            return false;
        }
        return true;
    }
}