<?php

namespace Delivery\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthenticationController
 */
class AuthenticationController extends Controller
{
    /**
     *  @Route("/check_login", name="loginCheck", methods={"GET"})
     */
    public function loginCheckAction() {
        return new JsonResponse([
            'status' => 'ok'
        ], 200);
    }
}
