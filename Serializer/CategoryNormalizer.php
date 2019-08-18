<?php

namespace Delivery\ApiBundle\Serializer;

use Delivery\ApiBundle\Entity\Category;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class CategoryNormalizer
 */
class CategoryNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @param Category $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|string
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'position' => $object->getPosition(),
            'published' => $object->getPublished(),
        ];

        if (!empty($context['category.products'])) {
            $data['products'] = $this->normalizer->normalize($object->getProducts(), $format, $context);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Category;
    }
}
