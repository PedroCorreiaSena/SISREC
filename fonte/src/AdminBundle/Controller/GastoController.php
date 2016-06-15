<?php

namespace AdminBundle\Controller;

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

class GastoController extends Controller
{
    /**
     * @Route("gasto/manter/{idGastos}", name="admin_gasto_manter")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function manterAction($idGastos) {
        $form = $this->createForm(new GastoType());

        $em = $this->getDoctrine()->getManager();

        if($idGastos) {
            $gasto = $em->getRepository('AppBundle:TbGasto')->find($idGastos);

            if(!$gasto){
                throw new NotFoundHttpException('Gasto não encontrado!');
            }
        }else{
            $gasto = new TbGasto();
        }

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));

            $gasto->setIdTpGasto($form->get('idTpGasto')->getData());
            $gasto->setVlGasto((int) $form->get('vlGasto')->getData());
            $gasto->setNumNotaFiscal((int) $form->get('numNotaFiscal')->getData());
            $gasto->setQtGasto((int) $form->get('qtGasto')->getData());
            $gasto->setDtGasto(\DateTime::createFromFormat('d/m/Y', $form->get('dtGasto')->getData()));
            $gasto->setTotalCompra($gasto->getVlGasto() * $gasto->getVlGasto());
            $gasto->setDtPagamento(\DateTime::createFromFormat('d/m/Y', $form->get('dtPagamento')->getData()));
            $gasto->setStPagamento($form->get('stPagamento')->getData());

            try {
                if($gasto->getIdGastos() == 0){
                    $qb = $em->createQueryBuilder();

                    $username = $this->get('security.context')->getToken()->getUser()->getUsername();
                    $username = str_replace('.', '', str_replace('-', '', $username));

                    $qb->select('u')
                        ->from('AppBundle:TbUsuario', 'u')
                        ->where('u.cpf = :cpf')
                        ->setParameter('cpf', $username);

                    $usuario = $qb->getQuery()->getSingleResult();

                    $gasto->setIdUsuario($usuario);

                    $em->persist($gasto);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Gasto cadastrado com sucesso!");
                } else {
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Gasto alterado com sucesso!");
                }
            } catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
            }

            return $this->redirectToRoute('admin_gasto_manter', array(
                'idGastos' => (int) @$gasto->getIdGastos()
            ));
        }else{
            $form->get('idTpGasto')->setData($gasto->getIdTpGasto());
            $form->get('vlGasto')->setData($gasto->getVlGasto());
            $form->get('numNotaFiscal')->setData($gasto->getNumNotaFiscal());
            $form->get('qtGasto')->setData($gasto->getQtGasto());
            $form->get('stPagamento')->setData($gasto->getStPagamento());

            if($gasto->getDtGasto() != null) {
                $form->get('dtGasto')->setData($gasto->getDtGasto()->format('d/m/Y'));
            }

            if($gasto->getDtPagamento() != null) {
                $form->get('dtPagamento')->setData($gasto->getDtPagamento()->format('d/m/Y'));
            }
        }

        return $this->render('AdminBundle:Gasto:manter.html.twig', array(
            'form' => $form->createView(),
            'idGastos' => $idGastos
        ));
    }

    /**
     * @Route("gasto/listar", name="admin_gasto_listar")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function listarAction() {
        $dql = "SELECT m FROM AppBundle:TbGasto m";

        $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $gasto = $query->getResult();

        return $this->render('AdminBundle:Gasto:listar.html.twig', array(
            'gasto' => $gasto
        ));
    }

    /**
     * @Route("gasto/excluir/{idGastos}", name="admin_gasto_excluir")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function excluirAction($idGastos){
        $em = $this->getDoctrine()->getEntityManager();
        $gasto = $em->getRepository('AppBundle:TbGasto')->find($idGastos);

        try {
            $em->remove($gasto);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', "Gasto excluído com sucesso!");
        }catch (DBALException $e){
            $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
        }

        return $this->redirectToRoute('admin_gasto_listar');
    }
}
