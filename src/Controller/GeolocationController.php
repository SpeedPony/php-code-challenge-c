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
 * Class GeolocationController
 * @package App\Controller
 */
class GeolocationController extends AbstractController {

    /**
     * @Route("/geolocation", name="geolocation")
     * @param Request $request
     */
    public function geolocation(Request $request) {
        $ip_address = $request->getClientIp();
        $response = $this->forward('App\Controller\GeolocationController::geolocationWithIP', [
            'ip_address' => $ip_address
        ]);
    }

    /**
     * @Route("/geolocation/{ip_address}", name="geolocation_with_ip")
     * @param Request $request
     * @param $ip_address
     * @return JsonResponse
     */
    public function geolocationWithIP(Request $request, $ip_address) {
        $apiService = $request->get('service');
        // Validate input
        if(!$this->get('geolocation.validator')->validateGeolocation($ip_address, $apiService)) {
            throw new NotFoundHttpException('Incorrect inputs');
        }

        // Call API
        try {
            $geolocationDatas = $this->get('geolocation.geolocation_service')->getDatasFromAPI($ip_address, $apiService);

            // Return Json response
            return new JsonResponse($geolocationDatas);
        }
        catch(\Exception $e) {
            throw new NotFoundHttpException('An error occurred');
        }
    }
}