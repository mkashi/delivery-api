<?php

namespace Delivery\ApiBundle\Serializer;

use Delivery\ApiBundle\Entity\Localisation\City;
use Delivery\ApiBundle\Entity\Localisation\Department;
use Delivery\ApiBundle\Entity\Order\Order;
use Delivery\ApiBundle\Entity\Product;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class DepartmentNormalizer
 */
class DepartmentNormalizer implements NormalizerInterface, NormalizerAwareInterface
{

    use NormalizerAwareTrait;

    /**
     * @param Department $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|string
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            'id' => $object->getId(),
            'name' => (string) $object,
        ];

        if (!empty($context['department.cities'])) {
            $data['cities'] = $this->normalizer->normalize($object->getCities(), $format, $context);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Department;
    }
}
