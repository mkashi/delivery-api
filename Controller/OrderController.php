<?php

namespace Delivery\ApiBundle\Controller;

use Delivery\ApiBundle\Controller\Behaviour\ConstructTrait;
use Delivery\ApiBundle\Entity\Order\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("orders")
 */
class OrderController extends Controller
{
    use ConstructTrait;

    /**
     * Lists all orders entities.
     *
     * @Route("/", name="orders_list", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function listAction()
    {
        $categories = $this->em->getRepository(Order::class)->findAll();

        return $this->json($categories);
    }

    /**
     * Remove an order entity.
     *
     * @Route("/{id}/delete", name="delete_order", methods={"DELETE"})
     *
     * @param Order $order
     *
     * @return JsonResponse
     */
    public function removeAction(Order $order)
    {
        $this->em->remove($order);
        $this->em->flush();

        return $this->json([
            "status" => "ok",
        ]);
    }

    /**
     * Finds and displays an orders entity.
     *
     * @Route("/{id}", name="order_show", methods={"GET"})
     * @param Order $order
     * @return JsonResponse
     */
    public function showAction(Order $order)
    {
        return $this->json($order);
    }

    /**
     * Update order status.
     *
     * @Route("/{id}", name="order_edit_status", methods={"PATCH"})
     * @param Order $order
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatusAction(Order $order, Request $request)
    {
        $status = $request->get('status');

        $order->setStatus($status);

        $this->em->flush();

        return $this->json($order);
    }
}