<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 17:02
 */

namespace App\Service;

use App\Service\GeolocationApi\IpApiService;
use App\Service\GeolocationApi\IpStackService;
use App\Service\GeolocationFormatter\IpApiFormatterService;
use App\Service\GeolocationFormatter\IpStackFormatterService;

/**
 * Class GeolocationService
 * @package App\Service
 */
class GeolocationService {

    /**
     * @var IpApiService
     */
    protected $ipApiService;

    /**
     * @var IpStackService
     */
    protected $ipStackService;

    /**
     * @var IpApiFormatterService
     */
    protected $ipApiFormatterService;

    /**
     * @var IpStackFormatterService
     */
    protected $ipStackFormatterService;

    /**
     * GeolocationService constructor.
     * @param IpApiService $ipApiService
     * @param IpStackService $ipStackService
     * @param IpApiFormatterService $ipApiFormatterService
     * @param IpStackFormatterService $ipStackFormatterService
     */
    public function __construct(IpApiService $ipApiService,
                                IpStackService $ipStackService,
                                IpApiFormatterService $ipApiFormatterService,
                                IpStackFormatterService $ipStackFormatterService
    ) {
        $this->ipApiService = $ipApiService;
        $this->ipStackService = $ipStackService;
        $this->ipApiFormatterService = $ipApiFormatterService;
        $this->ipStackFormatterService = $ipStackFormatterService;
    }

    /**
     * @param string $ipAddress
     * @param string|null $apiName
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDatasFromAPI(string $ipAddress, $apiName) {
        // Call Ipstack if call
        if($apiName === IpStackService::APINAME) {
            $apiResult = $this->ipStackService->getGeolocation($ipAddress);
            return $this->ipStackFormatterService->format($apiResult, $ipAddress);
        }

        // Call ipApi by default
        $apiResult = $this->ipApiService->getGeolocation($ipAddress);
        return $this->ipApiFormatterService->format($apiResult, $ipAddress);
    }
}