<?php

namespace Delivery\ApiBundle\Manager\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 */
class FileUploader
{
    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * FileUploader constructor.
     *
     * @param string $targetDirectory
     */
    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        $filename = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDirectory, $filename);

        return $filename;
    }
}