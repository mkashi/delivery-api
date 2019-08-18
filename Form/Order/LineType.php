<?php

namespace Delivery\ApiBundle\Form\Order;

use Delivery\ApiBundle\Entity\Localisation\City;
use Delivery\ApiBundle\Entity\Localisation\Department;
use Delivery\ApiBundle\Entity\Order\OrderAddress;
use Delivery\ApiBundle\Entity\Order\OrderLine;
use Delivery\ApiBundle\Repository\CityRepository;
use Delivery\ApiBundle\Repository\DepartmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddressType
 */
class LineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product')
            ->add('quantity');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderLine::class,
            'csrf_protection' => false,
        ]);
    }

    /**
     * @return null
     */
    public function getBlockPrefix()
    {
        return;
    }
}
