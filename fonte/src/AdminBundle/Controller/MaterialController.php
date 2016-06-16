<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\MaterialType;
use AdminBundle\Form\UsuarioType;
use AppBundle\Entity\TbTelefone;
use AppBundle\Entity\TbMaterial;
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
 * Class MaterialController
 * @package AdminBundle\Controller
 */
class MaterialController extends Controller
{
    /**
     * Funcionalidade de alterar/incluir material
     *
     * @Route("material/manter/{idMaterial}", name="admin_material_manter")
     * @Security("has_role('ROLE_ADMIN')")
     * @param int $idMaterial
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function manterAction($idMaterial) {
        $form = $this->createForm(new MaterialType());

        $em = $this->getDoctrine()->getManager();

        if($idMaterial) {
            $material = $em->getRepository('AppBundle:TbMaterial')->find($idMaterial);

            if(!$material){
                throw new NotFoundHttpException('Material não encontrado!');
            }
        }else{
            $material = new TbMaterial();
        }

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));
            $material->setIdTpMaterial($form->get('idTpMaterial')->getData());
            $material->setQtMaterial($form->get('qtMaterial')->getData());
            $material->setVlMaterial($form->get('vlMaterial')->getData());
            $material->setDsMaterial($form->get('dsMaterial')->getData());
            $material->setTotalMaterial($material->getQtMaterial() * $material->getVlMaterial());

            try {
                if($material->getIdMaterial() == 0){
                    $qb = $em->createQueryBuilder();

                    $username = $this->get('security.context')->getToken()->getUser()->getUsername();
                    $username = str_replace('.', '', str_replace('-', '', $username));

                    $qb->select('u')
                        ->from('AppBundle:TbUsuario', 'u')
                        ->where('u.cpf = :cpf')
                        ->setParameter('cpf', $username);

                    $usuario = $qb->getQuery()->getSingleResult();

                    $material->setDtInclusao(\DateTime::createFromFormat('d/m/Y', date('d/m/Y')));
                    $material->setIdUsuario($usuario);

                    $em->persist($material);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Material de Reciclagem cadastrado com sucesso!");

                    return $this->redirectToRoute('admin_material_listar');
                } else {
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Material de Reciclagem alteado com sucesso!");
                }
            } catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
            }

            return $this->redirectToRoute('admin_material_manter', array(
                'idMaterial' => (int) @$material->getIdMaterial()
            ));
        }else{
            $form->get('idTpMaterial')->setData($material->getIdTpMaterial());
            $form->get('qtMaterial')->setData($material->getQtMaterial());
            $form->get('vlMaterial')->setData($material->getVlMaterial());
            $form->get('dsMaterial')->setData($material->getDsMaterial());
        }

        return $this->render('AdminBundle:Material:manter.html.twig', array(
            'form' => $form->createView(),
            'idMaterial' => $idMaterial
        ));
    }

    /**
     * Funcionalidade de listar material
     *
     * @Route("material/listar", name="admin_material_listar")
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function listarAction() {
        $dql = "SELECT m FROM AppBundle:TbMaterial m";

        $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $material = $query->getResult();

        return $this->render('AdminBundle:Material:listar.html.twig', array(
            'material' => $material
        ));
    }

    /**
     * Funcionalidade de excluir material
     *
     * @Route("material/excluir/{idMaterial}", name="admin_material_excluir")
     * @Security("has_role('ROLE_ADMIN')")
     * @param int $idMaterial
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function excluirAction($idMaterial){
        $em = $this->getDoctrine()->getEntityManager();
        $material = $em->getRepository('AppBundle:TbMaterial')->find($idMaterial);

        try {
            $em->remove($material);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', "Material de Reciclagem excluído com sucesso!”;");
        }catch (DBALException $e){
            $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
        }

        return $this->redirectToRoute('admin_material_listar');
    }
}
