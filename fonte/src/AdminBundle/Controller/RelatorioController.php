<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\MaterialType;
use AdminBundle\Form\GastoType;
use AppBundle\Entity\TbGasto;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class RelatorioController
 * @package AdminBundle\Controller
 */
class RelatorioController extends Controller
{
    const MSG_DATA = "Data fim não pode ser menor que a data inicio.";

    /**
     * Relatório de material
     *
     * @Route("relatorio/material", name="admin_relatorio_material")
     * @Security("has_role('ROLE_ASSOCIADO')")
     * @return Response
     */
    public function materialAction() {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new MaterialType());
        $material = null;

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));

            $bind = array();
            $dql = "SELECT m FROM AppBundle:TbMaterial m WHERE 1=1 ";

            if ($form->get('idTpMaterial')->getData()) {
                $dql .= " AND m.idTpMaterial = :idTpMaterial ";
                $bind['idTpMaterial'] = $form->get('idTpMaterial')->getData()->getIdTpMaterial();
            }

            if($form->get('datInicio')->getData()){
                $dql .= " AND m.dtInclusao >= :datInicio ";
                $bind['datInicio'] = sprintf('%s 00:00:00', $form->get('datInicio')->getData());
                $bind['datInicio'] = \DateTime::createFromFormat('d/m/Y H:i:s', $bind['datInicio']);
            }

            if($form->get('datFim')->getData()){
                $dql .= " AND m.dtInclusao <= :datFim ";
                $bind['datFim'] = sprintf('%s 00:00:00', $form->get('datFim')->getData());
                $bind['datFim'] = \DateTime::createFromFormat('d/m/Y H:i:s', $bind['datFim']);

                if(isset($bind['datInicio'])){
                    if($bind['datFim'] < $bind['datInicio']){
                        $this->get('session')->getFlashBag()->add('warning', self::MSG_DATA);
                    }
                }
            }

            $query = $em->createQuery($dql);

            if(count($bind)) {
                foreach($bind as $param => $value) {
                    $query->setParameter($param, $value);
                }
            }

            $material = $query->getResult();
        }

        return $this->render('AdminBundle:Relatorio:material.html.twig', array(
            'material' => $material,
            'form' => $form->createView()
        ));
    }

    /**
     * Relatório de gasto
     *
     * @Route("relatorio/gasto", name="admin_relatorio_gasto")
     * @Security("has_role('ROLE_ASSOCIADO')")
     * @return Response
     */
    public function gastoAction() {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new GastoType());
        $gasto = null;

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));

            $bind = array();
            $dql = "SELECT m FROM AppBundle:TbGasto m WHERE 1=1 ";

            if ($form->get('idTpGasto')->getData()) {
                $dql .= " AND m.idTpGasto = :idTpGasto ";
                $bind['idTpGasto'] = $form->get('idTpGasto')->getData()->getIdTpGasto();
            }

            if($form->get('datInicio')->getData()){
                $dql .= " AND m.dtGasto >= :datInicio ";
                $bind['datInicio'] = sprintf('%s 00:00:00', $form->get('datInicio')->getData());
                $bind['datInicio'] = \DateTime::createFromFormat('d/m/Y H:i:s', $bind['datInicio']);
            }

            if($form->get('datFim')->getData()){
                $dql .= " AND m.dtGasto <= :datFim ";
                $bind['datFim'] = sprintf('%s 00:00:00', $form->get('datFim')->getData());
                $bind['datFim'] = \DateTime::createFromFormat('d/m/Y H:i:s', $bind['datFim']);

                if(isset($bind['datInicio'])){
                    if($bind['datFim'] < $bind['datInicio']){
                        $this->get('session')->getFlashBag()->add('warning', self::MSG_DATA);
                    }
                }
            }

            $query = $em->createQuery($dql);

            if(count($bind)) {
                foreach($bind as $param => $value) {
                    $query->setParameter($param, $value);
                }
            }

            $gasto = $query->getResult();
        }

        return $this->render('AdminBundle:Relatorio:gasto.html.twig', array(
            'gasto' => $gasto,
            'form' => $form->createView()
        ));
    }
}
