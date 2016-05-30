<?php
namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nmUsuario', 'text', array(
            'label' => 'Nome',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'required' => "required",
            )
        ));

        $builder->add('sexo', 'choice', array(
            'label' => 'Sexo',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
            ),
            'choices' => array(1 => 'Masculino', 0 => 'Feminino')
        ));

        $builder->add('cpf', 'text', array(
            'label' => 'CPF',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'required' => "required",
                'mask' => '999.999.999-99'
            )
        ));

        $builder->add('email', 'email', array(
            'label' => 'E-mail',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'required' => "required"
            )
        ));

        $builder->add('email_c', 'email', array(
            'label' => 'Confirmação de E-mail',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'required' => "required"
            )
        ));

        $builder->add('ddd_p', 'text', array(
            'label' => 'DDD telefone principal',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 2,
                'required' => "required",
                'mask' => '99'
            )
        ));

        $builder->add('ddd_a', 'text', array(
            'label' => 'DDD telefone alternativo',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 2,
                'mask' => '99'
            )
        ));

        $builder->add('telefone_p', 'text', array(
            'label' => 'Telefone Principal',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
                'mask' => '9999-9999'
            )
        ));

        $builder->add('telefone_a', 'text', array(
            'label' => 'Telefone alternativo',
            'attr' => array(
                'class' => 'form-control',
                'mask' => '9999-9999'
            )
        ));

        $builder->add('dtNascimento', 'text', array(
            'label' => 'Data de Nascimento',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'required' => "required",
                'mask' => '99/99/9999'
            )
        ));

        $builder->add('cep', 'text', array(
            'label' => 'CEP',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
                'mask' => '99.999-999'
            )
        ));

        $builder->add('uf', 'text', array(
            'label' => 'UF',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
                'maxlength' => 100,
            )
        ));

        $builder->add('cidade', 'text', array(
            'label' => 'Cidade',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
                'maxlength' => 100,
            )
        ));

        $builder->add('endereco', 'text', array(
            'label' => 'Endereço',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
                'maxlength' => 100,
            )
        ));

        $builder->add('casa', 'text', array(
            'label' => 'Casa',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
                'maxlength' => 100,
            )
        ));

        $builder->add('bairro', 'text', array(
            'label' => 'Bairro',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
                'maxlength' => 100,
            )
        ));

        $builder->add('complemento', 'text', array(
            'label' => 'Complemento',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
                'maxlength' => 100,
            )
        ));

        $builder->add('observacao', 'textarea', array(
            'label' => 'Observação',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 4000
            )
        ));

        $builder->add('stUsuario', 'hidden', array(
            'label' => 'Situação',
            'required' => false
        ));
    }

    public function getName() {
        return 'usuario';
    }
}