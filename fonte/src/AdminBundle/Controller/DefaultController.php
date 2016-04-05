<?php

namespace AdminBundle\Controller;

use AppBundle\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     */
    public function indexAction() {
        $username = $this->get('security.context')->getToken()->getUser()->getUsername();

        if($this->get('session')->get('username') != $username) {
            $em = $this->getDoctrine()->getManager();

            $qb = $em->createQueryBuilder();
            $qb->select('u.cpf, u.nmUsuario')
                ->from('AppBundle:TbUsuario', 'u')
                ->where('u.cpf = :cpf')
                ->setParameter('cpf', str_replace('.', '', str_replace('-', '', $username)));

            $rsUsuario = $qb->getQuery()->getSingleResult();

            $this->get('session')->set('username', $username);
            $this->get('session')->set('cpf', '-', '', $rsUsuario['cpf']);
            $this->get('session')->set('nmUsuario', $rsUsuario['nmUsuario']);

            $this->get('session')->getFlashBag()->add('notice', "Obrigado pelo acesso");
        }

        return $this->render('AdminBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login", name="admin_login")
     */
    public function loginAction(Request $request){
        $form = $this->createForm(new LoginType());

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('AdminBundle:Default:login.html.twig', array(
            'form' => $form->createView(),
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
        ));
    }

    /**
     * @Route("/login_check", name="admin_security_check")
     */
    public function securityCheckAction(){}

    /**
     * @Route("/logout", name="admin_logout")
     */
    public function logoutAction(){}
}
