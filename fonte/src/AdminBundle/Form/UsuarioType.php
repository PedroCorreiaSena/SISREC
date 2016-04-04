<?php
namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomUsuario', 'text', array(
            'label' => 'Nome',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 200,
                'required' => "required",
            )
        ));

        $builder->add('desEmail', 'email', array(
            'label' => 'E-mail',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 200,
                'required' => "required",
            )
        ));

        $builder->add('desSenha', 'password', array(
            'label' => 'Senha',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 200,
                'required' => "required",
            )
        ));

        $builder->add('desNivel', 'choice', array(
            'label' => 'Nível',
            'attr' => array(
                'class' => 'form-control'
            ),
            'choices' => array(
                'ROLE_ADMIN' => 'Administrador',
                'ROLE_GESTOR' => 'Gestor',
                'ROLE_EMPRESA' => 'Empresa',
                'ROLE_ENCARREGADO' => 'Encarregado',
                'ROLE_SUPERVISAO' => 'Supervisão',
            )
        ));

        $builder->add('sitAtivo', 'choice', array(
            'label' => 'Ativo',
            'attr' => array(
                'class' => 'form-control'
            ),
            'choices' => array(1 => 'Sim', 0 => 'Não')
        ));

        $builder->add('seqOrgao', 'entity', array(
            'label' => 'Orgão',
            'attr' => array(
                'class' => 'form-control'
            ),
            'class' => 'AppBundle:TblOrgao',
            'property' => 'nomFantasia',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('o')
                    ->where("o.sitAtivo = 1")
                    ->orderBy('o.nomFantasia', 'ASC');
            },
        ));

        $builder->add('seqCargo', 'entity', array(
            'label' => 'Cargo',
            'attr' => array(
                'class' => 'form-control'
            ),
            'class' => 'AppBundle:TblCargo',
            'property' => 'nomCargo',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->where("c.sitAtivo = 1")
                    ->orderBy('c.nomCargo', 'ASC');
            },
        ));
    }

    public function getName() {
        return 'usuario';
    }
}