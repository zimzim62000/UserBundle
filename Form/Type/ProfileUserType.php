<?php

namespace ZIMZIM\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileUserType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->remove('current_password');
        $builder->add(
            'plainPassword',
            'password',
            array('label' => 'form.user.form.type.profileusertype.label', 'required' => false)
        );
        $builder->add('submit', 'submit', array('label' => 'button.update', 'attr' => array('class' => 'tiny button success')));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
                'validation_groups' => array('profile')
            ));
    }

    public function getName()
    {
        return 'zimzim_user_profile';
    }
}