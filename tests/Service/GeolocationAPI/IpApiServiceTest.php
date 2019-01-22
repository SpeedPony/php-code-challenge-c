<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 22/01/2019
 * Time: 17:25
 */

namespace App\Tests\Service\GeolocationAPI;

use PHPUnit\Framework\TestCase;
use App\Service\GeolocationApi\IpApiService;

class IpApiServiceTest extends TestCase {

    public function testGetGeolocationOk()
    {
        $ipAdress = "8.8.8.8";

        $ipApiService = new IpApiService();
        $result = $ipApiService->getGeolocation($ipAdress);

        $excepted = \GuzzleHttp\json_encode(array("city" => "Mountain View",
            "country" => "United States",
            "countryCode" => "US",
            "regionName" => "California",
            "status" => "success"));

        $this->assertEquals($result, $result);
    }

    public function testGetGeolocationKO()
    {
        $ipAdress = "127.0.0.1";
        $ipApiService = new IpApiService();

        $this->expectException(\Exception::class);
        $ipApiService->getGeolocation($ipAdress);
    }
}