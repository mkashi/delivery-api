<?php


namespace Delivery\ApiBundle\EventListener;

use Delivery\ApiBundle\Manager\File\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ImageUploadListener
 */
class ImageUploadListener
{
    /**
     * @var FileUploader
     */
    private $uploader;

    /**
     * ImageUploadListener constructor.
     * @param $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        if (!$entity instanceof Image) {
            return;
        }

        $file = $entity->getPath();

        if ($file instanceof UploadedFile) {
            $filename = $this->uploader->upload($file);
            $entity->setPath($filename);
        }
    }
}