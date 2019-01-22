<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:27
 */

namespace App\Service\GeolocationFormatter;

use App\Service\GeolocationApi\IpStackService;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class IpStackFormatterService
 * @package App\Service\GeolocationFormatter
 */
class IpStackFormatterService extends AbstractFormatterService implements FormatterInterface {

    /**
     * Format API specific data
     * @param string $json
     * @param string $ip_adress
     * @return array
     */
    public function format(string $json, string $ip_adress) : array {
        $return = parent::commonFormat(IpStackService::APINAME, $ip_adress);

        $datas = \GuzzleHttp\json_decode($json, true);
        $return["geo"]["city"] = $datas["city"];
        $return["geo"]["region"] = $datas["region_name"];
        $return["geo"]["country"] = $datas["country_name"];
        return $return;
    }
}