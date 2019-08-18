<?php

namespace Delivery\ApiBundle\Serializer;

use Delivery\ApiBundle\Entity\Localisation\City;
use Delivery\ApiBundle\Entity\Order\Order;
use Delivery\ApiBundle\Entity\Order\OrderAddress;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class AddressNormalizer
 */
class OrderAddressNormalizer implements NormalizerInterface, NormalizerAwareInterface
{

    use NormalizerAwareTrait;

    /**
     * @param OrderAddress $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|string
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'city' => $this->normalizer->normalize($object->getCity(), $format, $context),
            'address' => $object->getAddress(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof OrderAddress;
    }
}
