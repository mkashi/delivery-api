<?php

namespace Delivery\ApiBundle\Manager;

use Delivery\ApiBundle\Entity\Order\Order;
use Delivery\ApiBundle\Entity\Order\OrderLine;
use Delivery\ApiBundle\Event\OrderEvent;
use Delivery\ApiBundle\Repository\OrderRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class OrderManager
 */
class OrderManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * OrderManager constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $dispatcher)
    {
        $this->em = $em;
        $this->orderRepository = $em->getRepository(Order::class);
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Order $order
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createOrder(Order $order)
    {
        $order->setStatus(Order::STATUS_CREATED);

        $this->em->persist($order);
        $this->em->flush();

        $this->dispatcher->dispatch(OrderEvent::ORDER_CREATED, new OrderEvent($order));
    }

    /**
     * @param Order $order
     * @param $lines
     */
    public function generateLines(Order $order, $lines)
    {
        foreach ($lines as $line) {
            $line->setTotal($line->getProduct()->getPrice() * $line->getQuantity());
        }

        $order->setLines($lines);
    }
}
