<?php

namespace Delivery\ApiBundle\Serializer;

use Delivery\ApiBundle\Entity\Localisation\City;
use Delivery\ApiBundle\Entity\Order\Order;
use Delivery\ApiBundle\Entity\Product;
use Delivery\ApiBundle\Manager\Image\ProductImageFileManager;
use Liip\ImagineBundle\Service\FilterService;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ProductNormalizer
 */
class ProductNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @var FilterService
     */
    private $filterService;

    /**
     * @var ProductImageFileManager
     */
    private $productImageManager;

    /**
     * ProductNormalizer constructor.
     * @param FilterService $filterService
     * @param ProductImageFileManager $productImageFileManager
     */
    public function __construct(FilterService $filterService, ProductImageFileManager $productImageFileManager)
    {
        $this->filterService = $filterService;
        $this->productImageManager = $productImageFileManager;
    }

    /**
     * @param Product $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|string
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            'id' => $object->getId(),
            'price' => $object->getPrice(),
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'position' => $object->getPosition(),
            'published' => $object->getPublished(),
            'image' => $this->filterService->getUrlOfFilteredImage($this->productImageManager->getPath($object->getDefaultImage()), 'phone_product_thumb'),
        ];

        if (!empty($context['product.category'])) {
            $data['category'] = $this->normalizer->normalize($object->getCategory(), $format, $context);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Product;
    }
}
