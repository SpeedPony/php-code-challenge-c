<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 22/01/2019
 * Time: 15:18
 */

namespace App\Service\Validator;

/**
 * Class WeatherValidator
 * @package App\Service\Validator
 */
class WeatherValidator {

    /**
     * @var CommonValidator
     */
    protected $commonValidator;

    /**
     * GeolocationValidator constructor.
     * @param CommonValidator $validator
     */
    public function __construct(CommonValidator $validator) {
        $this->commonValidator = $validator;
    }

    /**
     * Validate datas
     * @param string $ip
     * @return bool
     */
    public function validateGeolocation(string $ip) :bool {
        return $this->commonValidator->validateIp($ip);
    }
}