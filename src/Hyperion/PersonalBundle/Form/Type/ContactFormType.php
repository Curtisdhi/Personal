<?php

namespace Hyperion\PersonalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'attr' => array(
                'class' => 'validate',
            )));
        $builder->add('email', 'email', array(
            'attr' => array(
                'class' => 'validate',
            )));
        $builder->add('message', 'textarea', array(
            'attr' => array(
                'class' => 'validate',
                'minlength' => 10,
            )));
        $builder->add('recaptcha', 'ewz_recaptcha');
        
        $builder->add('submit', 'submit', array(
            'attr' => array(
                'class' => 'btn waves-effect waves-light'
            )));
    }

    public function getName()
    {
        return 'contactForm';
    }
}