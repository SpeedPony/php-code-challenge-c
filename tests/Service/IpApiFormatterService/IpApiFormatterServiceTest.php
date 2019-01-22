<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 22/01/2019
 * Time: 17:25
 */

namespace App\Tests\Service\GeolocationFormatter;

use PHPUnit\Framework\TestCase;
use App\Service\GeolocationFormatter\IpApiFormatterService;

class IpApiFormatterServiceTest extends TestCase {

    public function testFormat() {

        $inputJson = $excepted = \GuzzleHttp\json_encode(
            array(
                "city" => "Mountain View",
                "country" => "United States",
                "countryCode" => "US",
                "regionName" => "California",
                "status" => "success",
            )
        );

        $ipAdress = "8.8.8.8";

        $ipApiFormatterService = new IpApiFormatterService();
        $result = $ipApiFormatterService->format($inputJson, $ipAdress);

        $expected = array(
            "ip" => "8.8.8.8",
            "geo" =>array(
                "service" => "ip-api",
                "city" => "Mountain View",
                "region" => "California",
                "country" => "United States",
            )
        );

        $this->assertSame($expected, $result);
    }
}