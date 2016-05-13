<?php
namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class TipoGastoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tpGasto', 'text', array(
            'label' => 'Tipo de Gasto',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'required' => "required",
            )
        ));

        $builder->add('stTpGasto', 'choice', array(
            'label' => 'Situação',
            'attr' => array(
                'class' => 'form-control'
            ),
            'choices' => array(1 => 'Sim', 0 => 'Não')
        ));
    }

    public function getName() {
        return 'tipogasto';
    }
}