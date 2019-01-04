<?php

namespace App\Form\Admin;

use App\Entity\Admin\Media;
use App\Model\Admin\MediaDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('file', FileType::class, [
                'label'=> 'Selectionner un fichier',
                'required' => false,
                'attr'=>[
                    'accept'=>'image/*'
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     *
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => Media::class,
            'mapped' =>false
        ]);
    }
}
