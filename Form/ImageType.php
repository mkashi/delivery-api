<?php


namespace Delivery\ApiBundle\Form;

use Delivery\ApiBundle\Entity\Image;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends FileType
{
    private $imagePath;

    /**
     * ImageType constructor.
     * @param $imagePath
     */
    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->addModelTransformer(new CallbackTransformer(
            function($images = null) {
                $imagesArray = [];
                foreach ($images as $image) {
                    if ($image instanceof Image) {
                        array_push($imagesArray, new File($this->imagePath . $image->getPath()));
                    }
                }
                return $imagesArray;
            },
            function($uploadedFiles = null) {
                $images = [];
                foreach ($uploadedFiles as $uploadedFile) {
                    if ($uploadedFile instanceof UploadedFile) {
                        $image = new Image();
                        $image->setPath($uploadedFile);
                        array_push($images, $image);
                    }
                }
                return new ArrayCollection($images);
            }
        ));
    }
    public function getBlockPrefix()
    {
        return '';
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'required' => false
        ]);
    }
}