<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\TipoGastoType;
use AppBundle\Entity\TbTipoGasto;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TipoGastoController extends Controller
{
    /**
     * @Route("tipoGasto/manter/{idTpGasto}", name="admin_tipogasto_manter")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function manterAction($idTpGasto) {
        $form = $this->createForm(new TipoGastoType());

        $em = $this->getDoctrine()->getManager();

        if($idTpGasto) {
            $tipoGasto = $em->getRepository('AppBundle:TbTipoGasto')->find($idTpGasto);

            if(!$tipoGasto){
                throw new NotFoundHttpException('Tipo Gasto não encontrado!');
            }
        }else{
            $tipoGasto = new TbTipoGasto();
        }

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));
            $tipoGasto->setTpGasto($form->get('tpGasto')->getData());
            $tipoGasto->setStTpGasto($form->get('stTpGasto')->getData());

            try {
                if($tipoGasto->getIdTpGasto() == 0){
                    $em->persist($tipoGasto);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Tipo Gasto cadastrado com sucesso!");
                } else {
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Tipo Gasto de Reciclagem alteado com sucesso!");
                }
            } catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
            }

            return $this->redirectToRoute('admin_tipogasto_manter', array(
                'idTpGasto' => (int) @$tipoGasto->getIdTpGasto()
            ));
        }else{
            $form->get('tpGasto')->setData($tipoGasto->getTpGasto());
            $form->get('stTpGasto')->setData($tipoGasto->getTpGasto());
        }

        return $this->render('AdminBundle:TipoGasto:manter.html.twig', array(
            'form' => $form->createView(),
            'idTpGasto' => $idTpGasto
        ));
    }

    /**
     * @Route("tipoGasto/listar", name="admin_tipogasto_listar")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function listarAction() {
        $dql = "SELECT m FROM AppBundle:TbTipoGasto m";

        $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $tipoGasto = $query->getResult();

        return $this->render('AdminBundle:TipoGasto:listar.html.twig', array(
            'tipoGasto' => $tipoGasto
        ));
    }

    /**
     * @Route("tipoGasto/excluir/{idTpGasto}", name="admin_tipogasto_excluir")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function excluirAction($idTpGasto){
        $em = $this->getDoctrine()->getEntityManager();
        $tipoGasto = $em->getRepository('AppBundle:TbTipoGasto')->find($idTpGasto);

        try {
            $em->remove($tipoGasto);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', "Tipo Gasto excluído com sucesso!");
        }catch (DBALException $e){
            $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
        }

        return $this->redirectToRoute('admin_tipogasto_listar');
    }
}
