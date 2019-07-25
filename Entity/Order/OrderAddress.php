<?php

namespace Delivery\ApiBundle\Entity\Order;

use Delivery\ApiBundle\Entity\Localisation\City;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_address")
 */
class OrderAddress
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="Delivery\ApiBundle\Entity\Localisation\City")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, length=200)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, length=250)
     */
    private $address;

    /**
     * Used to map.
     *
     * @var Order
     *
     * @ORM\OneToOne(targetEntity="Delivery\ApiBundle\Entity\Order\Order", mappedBy="address")
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=25)
     */
    private $phone;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}