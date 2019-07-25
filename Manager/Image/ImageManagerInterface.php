<?php

namespace Delivery\ApiBundle\Manager\Image;

use Delivery\ApiBundle\Entity\Image;

/**
 * Interface ImageManagerInterface
 */
interface ImageManagerInterface
{
    /**
     * @param       $file
     * @param array $options
     *
     * @return Image
     */
    public function upload($file, $options = []);

    /**
     * Get the path used to the html page.
     *
     * @param Image $image
     *
     * @return string
     */
    public function getPath(Image $image);
}