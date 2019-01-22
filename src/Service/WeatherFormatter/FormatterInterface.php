<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:41
 */

namespace App\Service\WeatherFormatter;

/**
 * Interface FormatterInterface
 * @package App\Service\WeatherFormatter
 */
interface FormatterInterface {

    /**
     * Format API specific data
     * @param string $json
     * @param string $ipAddress
     * @return array
     */
    public function format(string $json, string $ipAddress) : array;
}