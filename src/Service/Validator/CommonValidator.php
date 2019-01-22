<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 22/01/2019
 * Time: 15:18
 */

namespace App\Service\Validator;

use App\Service\GeolocationApi\IpApiService;
use App\Service\GeolocationApi\IpStackService;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CommonValidator
 * @package App\Service\Validator
 */
class CommonValidator {

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * GeolocationValidator constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator) {
        $this->validator = $validator;
    }

    /**
     * Validate IP
     * @param string $ip
     * @return mixed
     */
    public function validateIp(string $ip) :bool {
        $ipConstraint = new Assert\Ip();

        $errors = $this->validator->validate(
            $ip,
            $ipConstraint
        );

        if (0 !== count($errors)) {
            return false;
        }

        return true;
    }

    /**
     * Validate service name
     * @param $serviceName
     * @return bool
     */
    public function validateService($serviceName) :bool {
        $serviceList = array(IpApiService::APINAME, IpStackService::APINAME);
        if(!is_null($serviceName) && !in_array($serviceName, $serviceList)) {
            return false;
        }

        return true;
    }
}