<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:41
 */

namespace App\Service\GeolocationFormatter;

/**
 * Interface FormatterInterface
 * @package App\Service\GeolocationFormatter
 */
interface FormatterInterface {

    /**
     * Format API specific data
     * @param string $json
     * @param string $ip_adress
     * @return array
     */
    public function format(string $json, string $ip_adress);

    /**
     * Format common datas
     * @param $serviceName
     * @param $ip_adress
     * @return array
     */
    public function commonFormat(string $serviceName, string $ip_adress) : array;
}