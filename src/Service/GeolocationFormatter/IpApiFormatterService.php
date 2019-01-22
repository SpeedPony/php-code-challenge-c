<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:27
 */

namespace App\Service\GeolocationFormatter;

use App\Service\GeolocationApi\IpApiService;

/**
 * Class IpApiFormatterService
 * @package App\Service\GeolocationFormatter
 */
class IpApiFormatterService extends AbstractFormatterService implements FormatterInterface {

    /**
     * @param string $json
     * @param string $ip_adress
     * @return array
     */
    public function format(string $json, string $ip_adress) : array {
        $return = parent::commonFormat(IpApiService::APINAME, $ip_adress);

        $datas = \GuzzleHttp\json_decode($json, true);
        $return["geo"]["city"] = $datas["city"];
        $return["geo"]["region"] = $datas["regionName"];
        $return["geo"]["country"] = $datas["country"];
        return $return;
    }
}