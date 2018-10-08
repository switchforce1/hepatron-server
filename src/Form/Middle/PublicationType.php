<?php

namespace App\Form\Middle;

use App\Entity\Middle\Publication;
use App\Form\Admin\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('description')
            ->add('creationDate')
            ->add('visibility')
            ->add('subscriber')
            ->add('medias', CollectionType::class, [
                'entry_type' => MediaType::class,
                'entry_options' => [
                    'attr' => array('class' => 'form-controler'),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
        ]);
    }
}
