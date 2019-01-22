<?php
/**
 * Created by PhpStorm.
 * User: Speed
 * Date: 21/01/2019
 * Time: 16:14
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WeatherController
 * @package App\Controller
 */
class WeatherController extends AbstractController {

    /**
     * @Route("/weather", name="weather")
     * @param Request $request
     */
    public function weather(Request $request) {
        $ip_address = $request->getClientIp();
        $response = $this->forward('App\Controller\WeatherController::weatherWithIP', [
            'ip_address' => $ip_address
        ]);
    }

    /**
     * @Route("/weather/{ip_address}", name="weather_with_ip")
     * @param Request $request
     * @param $ip_address
     * @return JsonResponse
     */
    public function weatherWithIP(Request $request, $ip_address) {
        // Validate input
        if(!$this->get('weather.validator')->validateGeolocation($ip_address)) {
            throw new NotFoundHttpException('Incorrect inputs');
        }

        // Call API
        try {
            $weatherDatas = $this->get('weather.weather_service')->getDatasFromAPI($ip_address);

            // Return Json response
            return new JsonResponse($weatherDatas);
        }
        catch(\Exception $e) {
            var_dump($e->getMessage()); die();
            throw new NotFoundHttpException('An error occurred');
        }
    }
}