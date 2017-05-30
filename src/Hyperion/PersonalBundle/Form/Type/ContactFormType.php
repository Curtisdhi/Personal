<?php

namespace Hyperion\PersonalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as Type;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', Type\TextType::class, array(
            'attr' => array(
                'class' => 'validate',
            )));
        $builder->add('email', Type\EmailType::class, array(
            'attr' => array(
                'class' => 'validate',
            )));
        $builder->add('message', Type\TextareaType::class, array(
            'attr' => array(
                'class' => 'validate',
                'minlength' => 10,
            )));
        $builder->add('recaptcha', EWZRecaptchaType::class);
        
        $builder->add('submit', Type\SubmitType::class, array(
            'attr' => array(
                'class' => 'btn waves-effect waves-light'
            )));
    }

    public function getName()
    {
        return 'contactForm';
    }
}