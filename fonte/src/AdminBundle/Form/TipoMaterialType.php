<?php
namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class TipoMaterialType
 * @package AdminBundle\Form
 */
class TipoMaterialType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tpMaterial', 'text', array(
            'label' => 'Tipo de Material',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'required' => "required",
            )
        ));

        $builder->add('stMaterial', 'choice', array(
            'label' => 'Situação',
            'attr' => array(
                'class' => 'form-control'
            ),
            'choices' => array(1 => 'Ativo', 0 => 'Inativo')
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'tipomaterial';
    }
}