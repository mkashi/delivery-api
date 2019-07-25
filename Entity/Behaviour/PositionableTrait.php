<?php
/**
 * Created by PhpStorm.
 * User: Gis
 * Date: 07/03/2019
 * Time: 00:53
 */

namespace Delivery\ApiBundle\Entity\Behaviour;

use Doctrine\ORM\Mapping as ORM;

trait PositionableTrait
{
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}