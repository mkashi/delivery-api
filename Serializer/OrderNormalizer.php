<?php

namespace Delivery\ApiBundle\Serializer;

use Delivery\ApiBundle\Entity\Localisation\City;
use Delivery\ApiBundle\Entity\Order\Order;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class OrderNormalizer
 */
class OrderNormalizer implements NormalizerInterface, NormalizerAwareInterface
{

    use NormalizerAwareTrait;

    /**
     * @param Order $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|string
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'status' => $object->getStatus(),
            'total' => $object->getTotal(),
            'address' => $this->normalizer->normalize($object->getAddress(), $format, $context),
            'lines' => $this->normalizer->normalize($object->getLines(), $format, $context),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Order;
    }
}
