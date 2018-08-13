<?php

namespace App\Form\Security;

use App\Entity\Security\User;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $inDelegatedMode = $options['in_delegated_mode'];
        $builder
            ->add('profil')
        ;
        if($inDelegatedMode){
            $builder
                ->add('enabled')
                ->add('paticularAccesse')
            ;
        }
    }

    /**
     * @return null|string
     */
    public function getParent()
    {
        return RegistrationFormType::class;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'in_delegated_mode' => false,

        ]);
    }
}
