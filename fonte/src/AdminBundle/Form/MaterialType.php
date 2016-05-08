<?php
namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class MaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idTpMaterial', 'entity', array(
            'label' => 'Tipo de Material',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
            ),
            'class' => 'AppBundle:TbTpMaterial',
            'property' => 'tpMaterial',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('m')->where("m.stMaterial = 1");
            },
        ));

        $builder->add('qtMaterial', 'text', array(
            'label' => 'Quantidade de material',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 5,
                'required' => "required",
            )
        ));

        $builder->add('vlMaterial', 'text', array(
            'label' => 'Valor do Material',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 18,
                'required' => "required",
            )
        ));

        $builder->add('dsMaterial', 'text', array(
            'label' => 'Descrição do Material',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'required' => "required",
            )
        ));
    }

    public function getName() {
        return 'material';
    }
}