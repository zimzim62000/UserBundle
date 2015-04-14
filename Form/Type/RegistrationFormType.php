<?php

namespace ZIMZIM\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->remove('plainPassword');
        $builder->add('plainPassword', 'password', array('label' => 'mot de passe'))
            ->add('submit', 'submit', array('label' => 'button.register', 'attr' => array('class' => 'tiny button success')));
    }


    public function getName()
    {
        return 'zimzim_user_registration';
    }
}