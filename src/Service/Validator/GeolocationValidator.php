<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 22/01/2019
 * Time: 15:18
 */

namespace App\Service\Validator;

/**
 * Class GeolocationValidator
 * @package App\Service\Validator
 */
class GeolocationValidator {

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
     * @param string|null $serviceName
     * @return bool
     */
    public function validateGeolocation(string $ip, $serviceName) :bool {
        return $this->commonValidator->validateIp($ip) && $this->commonValidator->validateService($serviceName);
    }
}