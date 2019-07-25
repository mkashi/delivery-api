<?php

namespace Delivery\ApiBundle\Manager\Image;

use Delivery\ApiBundle\Entity\Image;
use Delivery\ApiBundle\Entity\Product;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ProductImageFileManager
 */
class ProductImageFileManager implements ImageManagerInterface
{
    const SOURCE_DIRECTORY = '/images/product/default';

    /**
     * @var string
     */
    private $noImageName;

    /**
     * @var string
     */
    private $sourceDirectory;


    /**
     * @var string
     */
    private $destinationDirectory;

    /**
     * ProductImageFileManager constructor.
     * @param string $noImageName placeholder no image name.
     * @param string $sourceDirectory (for the browser path ie: /images/product/default)
     */
    public function __construct($noImageName, $destinationDirectory, $sourceDirectory = self::SOURCE_DIRECTORY)
    {
        $this->noImageName = $noImageName;
        $this->sourceDirectory = $sourceDirectory;
        $this->destinationDirectory = $destinationDirectory;
    }

    /**
     * @param UploadedFile $file
     * @param array $options
     * @return Image|void
     */
    public function upload($file, $options = [])
    {
        /**
         * @var Product
         */
        $product = $options['product'];
        $movedFile = $file->move($this->destinationDirectory, $product->getId().'.'.$file->getClientOriginalExtension());

        $image = new Image();
        $image->setPath($movedFile->getFilename());
        $image->setAlt($product->getName());

        return $image;
    }

    /**
     * Get the path used for browsers.
     *
     * @param Image $image
     *
     * @return string
     */
    public function getPath(Image $image = null)
    {
        return ($image) ? $this->sourceDirectory.'/'.$image->getPath() : $this->sourceDirectory.'/'.$this->noImageName;
    }
}