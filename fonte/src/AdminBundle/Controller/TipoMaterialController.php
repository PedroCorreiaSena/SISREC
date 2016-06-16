<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\TipoMaterialType;
use AdminBundle\Form\UsuarioType;
use AppBundle\Entity\TbTelefone;
use AppBundle\Entity\TbTpMaterial;
use AppBundle\Entity\TbUsuario;
use AppBundle\Form\LoginType;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class TipoMaterialController
 * @package AdminBundle\Controller
 */
class TipoMaterialController extends Controller
{
    /**
     * Funcionalidade de incluir/alterar tipo material
     *
     * @Route("tipoMaterial/manter/{idTpMaterial}", name="admin_tipomaterial_manter")
     * @Security("has_role('ROLE_ADMIN')")
     * @param $idTpMaterial
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function manterAction($idTpMaterial) {
        $form = $this->createForm(new TipoMaterialType());

        $em = $this->getDoctrine()->getManager();

        if($idTpMaterial) {
            $tipoMaterial = $em->getRepository('AppBundle:TbTpMaterial')->find($idTpMaterial);

            if(!$tipoMaterial){
                throw new NotFoundHttpException('Tipo Material não encontrado!');
            }
        }else{
            $tipoMaterial = new TbTpMaterial();
        }

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));
            $tipoMaterial->setTpMaterial($form->get('tpMaterial')->getData());
            $tipoMaterial->setStMaterial($form->get('stMaterial')->getData());

            try {
                if($tipoMaterial->getIdTpMaterial() == 0){
                    $em->persist($tipoMaterial);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Material de Reciclagem cadastrado com sucesso!");

                    return $this->redirectToRoute('admin_tipomaterial_listar');
                } else {
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Material de Reciclagem alterado com sucesso!");
                }
            } catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
            }

            return $this->redirectToRoute('admin_tipomaterial_manter', array(
                'idTpMaterial' => (int) @$tipoMaterial->getIdTpMaterial()
            ));
        }else{
            $form->get('tpMaterial')->setData($tipoMaterial->getTpMaterial());
            $form->get('stMaterial')->setData($tipoMaterial->getStMaterial());
        }

        return $this->render('AdminBundle:TipoMaterial:manter.html.twig', array(
            'form' => $form->createView(),
            'idTpMaterial' => $idTpMaterial
        ));
    }

    /**
     * Funcionalidade de listar tipo material
     *
     * @Route("tipoMaterial/listar", name="admin_tipomaterial_listar")
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function listarAction() {
        $dql = "SELECT m FROM AppBundle:TbTpMaterial m";

        $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $material = $query->getResult();

        return $this->render('AdminBundle:TipoMaterial:listar.html.twig', array(
            'material' => $material
        ));
    }

    /**
     * Funcionalidade de excluir tipo material
     *
     * @Route("tipoMaterial/excluir/{idTpMaterial}", name="admin_tipomaterial_excluir")
     * @Security("has_role('ROLE_ADMIN')")
     * @param $idTpMaterial
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function excluirAction($idTpMaterial){
        $em = $this->getDoctrine()->getEntityManager();
        $material = $em->getRepository('AppBundle:TbTpMaterial')->find($idTpMaterial);

        if($material->getStMaterial()){
            $this->get('session')->getFlashBag()->add('warning', "O tipo de Material não pode está ativo para a exclusão!");
            return $this->redirectToRoute('admin_tipomaterial_listar');
        }

        try {
            $em->remove($material);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', "Material de Reciclagem excluído com sucesso!");
        }catch (DBALException $e){
            $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
        }

        return $this->redirectToRoute('admin_tipomaterial_listar');
    }
}
