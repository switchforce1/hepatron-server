<?php

namespace App\Form\Admin;

use App\Entity\Admin\Media;
use App\Model\Admin\MediaFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder
            ->add('defaultWidth')
            ->add('defaultHeigth')
            ->add('relativePath')
            ->add('name')
            ->add('description')
            ->add('creationDate')
            ->add('updateDate')
            ->add('filePath')
            ->add('detail')
            ->add('subscriber')
            ->add('publication')
        ;*/

        $builder
            ->add('defaultWidth')
            ->add('defaultHeight')
            ->add('file', FileType::class, [
                'label'=> 'Selectionner un fichier',
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
            'data_class' => MediaFormModel::class,
        ]);
    }
}
