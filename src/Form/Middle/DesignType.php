<?php

namespace App\Form\Middle;

use App\DTO\Middle\DesignDTO;
use App\Entity\Middle\Design;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DesignType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DesignDTO::class,
        ]);
    }

    /**
     * @return null|string
     */
    public function getParent()
    {
        return PublicationType::class;
    }


}
