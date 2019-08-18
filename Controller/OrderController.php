<?php

namespace Delivery\ApiBundle\Controller;

use Delivery\ApiBundle\Controller\Behaviour\ConstructTrait;
use Delivery\ApiBundle\Entity\Order\Order;
use Delivery\ApiBundle\Form\Order\CreateOrderType;
use Delivery\ApiBundle\Manager\OrderManager;
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

    /**
     * @Route("/new/client", name="order_create_client", methods={"POST"})
     *
     * @param Request      $request
     * @param OrderManager $orderManager
     *
     * @return JsonResponse
     */
    public function createOrderForClient(Request $request, OrderManager $orderManager)
    {
        $order = new Order();
        $form = $this->createForm(CreateOrderType::class, $order);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $orderManager->generateLines($order, $order->getLines());
            $orderManager->createOrder($order);

            return $this->json($order, 200);
        }

        return $this->json($form->getErrors(), 400);
    }
}
