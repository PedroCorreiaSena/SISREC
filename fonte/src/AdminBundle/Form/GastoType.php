<?php
namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class GastoType
 * @package AdminBundle\Form
 */
class GastoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idTpGasto', 'entity', array(
            'label' => 'Tipo de Gasto',
            'attr' => array(
                'class' => 'form-control',
                'required' => "required",
            ),
            'class' => 'AppBundle:TbTipoGasto',
            'property' => 'tpGasto',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('tg')->where("tg.stTpGasto = 1");
            },
        ));

        $builder->add('vlGasto', 'text', array(
            'label' => 'Valor do gasto',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 18,
                'required' => "required",
            )
        ));

        $builder->add('numNotaFiscal', 'text', array(
            'label' => 'Número da Compra',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 15,
                'required' => "required",
            )
        ));

        $builder->add('qtGasto', 'text', array(
            'label' => 'Quantidade',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 11,
                'required' => "required",
            )
        ));

        $builder->add('dtGasto', 'text', array(
            'label' => 'Data do Gasto',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 11,
                'required' => "required",
                'mask' => '99/99/9999'
            )
        ));

        $builder->add('dtPagamento', 'text', array(
            'label' => 'Data do pagamento do gasto',
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 11,
                'required' => "required",
                'mask' => '99/99/9999'
            )
        ));

        $builder->add('stPagamento', 'choice', array(
            'label' => 'Situação',
            'attr' => array(
                'class' => 'form-control'
            ),
            'choices' => array(1 => 'Ativo', 0 => 'Inativo')
        ));

        $builder->add('datInicio', 'text', array(
            'label' => 'Data Inicio',
            'required' => false,
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 200,
                'mask' => '99/99/9999',
                'placeholder' => 'Data Inicio'
            )
        ));

        $builder->add('datFim', 'text', array(
            'label' => 'Data Fim',
            'required' => false,
            'attr' => array(
                'class' => 'form-control',
                'maxlength' => 200,
                'mask' => '99/99/9999',
                'placeholder' => 'Data Fim'
            )
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gasto';
    }
}