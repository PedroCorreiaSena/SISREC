<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\UsuarioType;
use AdminBundle\Util\MenuUtil;
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
            $qb->select('u.seqUsuario, u.nomUsuario, u.desNivel')
                ->from('AppBundle:TblUsuario', 'u')
                ->where('u.desEmail = :desEmail')
                ->setParameter('desEmail', $username);

            $rsUsuario = $qb->getQuery()->getSingleResult();

            $this->get('session')->set('seqUsuario', $rsUsuario['seqUsuario']);
            $this->get('session')->set('nomUsuario', $rsUsuario['nomUsuario']);
            $this->get('session')->set('desNivel', str_replace('ROLE_', '', $rsUsuario['desNivel']));
        }

        return $this->render('AdminBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login", name="admin_login")
     */
    public function loginAction(Request $request){
        $form = $this->createForm(new LoginType());
        $usuarioForm = $this->createForm(new UsuarioType());

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('AdminBundle:Default:login.html.twig', array(
            'form' => $form->createView(),
            'usuarioform' => $usuarioForm->createView(),
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
