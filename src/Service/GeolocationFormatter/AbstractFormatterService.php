<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:37
 */

namespace App\Service\GeolocationFormatter;

/**
 * Class AbstractFormatterService
 * @package App\Service\GeolocationFormatter
 */
abstract class AbstractFormatterService {

    /**
     * Format common datas
     * @param $serviceName
     * @param $ip_adress
     * @return array
     */
    public function commonFormat(string $serviceName, string $ip_adress) : array {
        $return = array();
        $return["ip"] = $ip_adress;
        $return["geo"]["service"] = $serviceName;

        return $return;
    }
}