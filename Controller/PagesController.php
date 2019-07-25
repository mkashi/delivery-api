<?php

namespace Delivery\ApiBundle\Controller;

use Delivery\ApiBundle\Controller\Behaviour\ConstructTrait;
use Delivery\ApiBundle\Service\RoutesFactoryService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Product controller.
 *
 * @Route("pages")
 */
class PagesController extends Controller
{
    use ConstructTrait;

    /**
     * @Route("/routes", name="routes", methods={"GET"})
     * @param RoutesFactoryService $routesFactory
     * @return JsonResponse
     */
    public function routesAction(RoutesFactoryService $routesFactory)
    {
        $routes = $routesFactory->generateRoutesPages();

        return $this->json($routes);
    }


    /**
     * @Route("/menus", name="menus", methods={"GET"})
     * @param RoutesFactoryService $routesFactory
     * @return JsonResponse
     */
    public function menusAction(RoutesFactoryService $routesFactory)
    {
        $menus = $routesFactory->generateMenus();

        return $this->json($menus);
    }

}
