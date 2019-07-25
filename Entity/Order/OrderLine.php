<?php

namespace Delivery\ApiBundle\Entity\Order;

use Delivery\ApiBundle\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_line")
 */
class OrderLine
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="decimal", scale=2)
     */
    private $total;

    /**
     * @var float
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Delivery\ApiBundle\Entity\Product")
     */
    private $product;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="Delivery\ApiBundle\Entity\Order\Order", inversedBy="lines")
     */
    private $order;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }
}