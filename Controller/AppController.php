<?php

namespace Delivery\ApiBundle\Controller;

use Delivery\ApiBundle\Manager\Hour\HourManagerConfig;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthenticationController
 * @Route("app")
 */
class AppController extends Controller
{
    /**
     * @Route("/config/", name="config", methods={"GET"})
     *
     * @param HourManagerConfig $hourManager
     * @return JsonResponse
     */
    public function configAction(HourManagerConfig $hourManager) {
        return $this->json([
            'contact' => [
                'phone' => $this->getParameter('phone.default_contact'),
                'mail' => $this->getParameter('mail.default_contact'),
            ],
            'hours' => [
                'start' => $hourManager->getTodayStartHour(),
                'end' => $hourManager->getTodayEndHour(),
            ],
            'version' => '0.1.1',
        ]);
    }
}
