<?php

namespace App\Form\Middle;

use App\DTO\Middle\PublicationDTO;
use App\Entity\Middle\Publication;
use App\Entity\Middle\Visibility;
use App\Form\Admin\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, array())
            ->add('description', TextareaType::class, array())
            ->add('creationDate', DateTimeType::class, array(
            ))
            ->add('visibility', EntityType::class, array(
                'class'=> Visibility::class,
            ))
            ->add('medias', CollectionType::class, [
                'entry_type' => MediaType::class,
                'entry_options' => [
                    'attr' => array('class' => 'form-controler'),
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PublicationDTO::class,
        ]);
    }
}
