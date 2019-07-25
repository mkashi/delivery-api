<?php

namespace Delivery\ApiBundle\Serializer;

class CircularReferenceHandler {

    public function __invoke($object)
    {
        $object->getId();
    }
}