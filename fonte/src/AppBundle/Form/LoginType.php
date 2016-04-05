<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('_username', 'text', array(
            'label' => 'CPF',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'CPF:',
                'maxlength' => 45
            )
        ));

        $builder->add('_password', 'password', array(
            'label' => 'Senha',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Senha:',
                'maxlength' => 6
            )
        ));

        $builder->add('btn_login', 'submit', array(
            'label' => 'Acessar',
            'attr' => array(
                'class' => 'btn btn-lg btn-primary btn-block'
            )
        ));
    }

    public function getName() {
        return 'login';
    }
}
