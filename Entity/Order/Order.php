<?php

namespace Delivery\ApiBundle\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="Delivery\ApiBundle\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order
{
    use TimestampableEntity;

    const STATUS_CREATED = 'created';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_VALIATED = 'validated';

    const ALL_STATUS = [
        self::STATUS_CANCELLED => self::STATUS_CANCELLED,
        self::STATUS_CREATED => self::STATUS_CREATED,
        self::STATUS_VALIATED => self::STATUS_VALIATED,
    ];

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @var OrderLine[]
     *
     * @ORM\OneToMany(targetEntity="Delivery\ApiBundle\Entity\Order\OrderLine", mappedBy="order", cascade={"persist", "remove"})
     */
    private $lines;

    /**
     * @var OrderAddress
     *
     * @ORM\OneToOne(targetEntity="Delivery\ApiBundle\Entity\Order\OrderAddress", inversedBy="order", cascade={"persist", "remove"})
     */
    private $address;

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
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return OrderLine[]
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * @param OrderLine[] $lines
     */
    public function setLines($lines)
    {
        $this->lines = [];

        foreach ($lines as $line) {
            $this->addLine($line);
        }
    }

    /**
     * @param OrderLine $line
     */
    public function addLine($line)
    {
        $line->setOrder($this);

        $this->lines[] = $line;
    }

    /**
     * @return OrderAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param OrderAddress $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return float|int
     */
    public function getTotal()
    {
        $total = 0.0;

        foreach ($this->getLines() as $line) {
            $total += $line->getTotal();
        }

        return $total;
    }
}
