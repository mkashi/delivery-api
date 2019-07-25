<?php

namespace Delivery\ApiBundle\Entity\Behaviour;

use Doctrine\ORM\Mapping as ORM;

trait PublishableTrait
{
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": false})
     */
    private $published;

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }
}