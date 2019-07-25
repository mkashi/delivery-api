<?php

namespace Delivery\ApiBundle\Event;

use Delivery\ApiBundle\Entity\Order\Order;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class OrderEvent
 */
class OrderEvent extends Event
{
    const ORDER_CREATED = 'api.order.created';

    /**
     * @var Order
     */
    private $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }
}