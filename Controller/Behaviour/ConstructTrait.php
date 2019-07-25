<?php

namespace Delivery\ApiBundle\Controller\Behaviour;

use Doctrine\ORM\EntityManagerInterface;

trait ConstructTrait
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}