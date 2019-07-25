<?php

namespace Delivery\ApiBundle\Serializer;

use Delivery\ApiBundle\Entity\Localisation\City;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class CityNormalizer
 */
class CityNormalizer implements NormalizerInterface
{
    /**
     * @param City $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|string
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'name' => (string) $object,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof City;
    }
}
