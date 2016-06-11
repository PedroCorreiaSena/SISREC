<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\UsuarioType;
use AppBundle\Entity\TbTelefone;
use AppBundle\Entity\TbUsuario;
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
        $em = $this->getDoctrine()->getManager();

        if($this->get('session')->get('username') != $username) {
            $qb = $em->createQueryBuilder();
            $qb->select('u.cpf, u.nmUsuario, u.idUsuario')
                ->from('AppBundle:TbUsuario', 'u')
                ->where('u.cpf = :cpf')
                ->setParameter('cpf', str_replace('.', '', str_replace('-', '', $username)));

            $rsUsuario = $qb->getQuery()->getOneOrNullResult();

            $this->get('session')->set('username', $username);
            $this->get('session')->set('cpf', '-', '', $rsUsuario['cpf']);
            $this->get('session')->set('nmUsuario', $rsUsuario['nmUsuario']);
            $this->get('session')->set('idUsuario', $rsUsuario['idUsuario']);

            $this->get('session')->getFlashBag()->add('notice', "Obrigado pelo acesso");
        }

        $dql = "SELECT u FROM AppBundle:TbUsuario u WHERE u.stUsuario = false";
        $query = $em->createQuery($dql);
        $usuario = $query->getResult();

        return $this->render('AdminBundle:Default:index.html.twig', array(
            'usuario' => $usuario
        ));
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

    /**
     * @Route("/solicitaracesso", name="admin_solicitaracesso")
     */
    public function solicitaracessoAction() {
        $form = $this->createForm(new UsuarioType());
        $em = $this->getDoctrine()->getManager();

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));
            $usuario = new TbUsuario();

            try{
                if(!$form->get('cpf')->getData()){
                    throw new \Exception("Campo CPF Obrigatório");
                }

                if($form->get('email')->getData() != $form->get('email_c')->getData()){
                    throw new \Exception("Os e-mails estão diferentes");
                }

                $usuario->setCpf(str_replace('.', '', str_replace('-', '', $form->get('cpf')->getData())));
                $usuario->setNmUsuario($form->get('nmUsuario')->getData());
                $usuario->setEmail($form->get('email')->getData());
                $usuario->setObservacao($form->get('observacao')->getData());
                $usuario->setSenha('010203');
                $usuario->setTpSexo($form->get('sexo')->getData());
                $usuario->setCep($form->get('cep')->getData());
                $usuario->setUf($form->get('uf')->getData());
                $usuario->setEndereco($form->get('endereco')->getData());
                $usuario->setCidade($form->get('cidade')->getData());
                $usuario->setBairro($form->get('bairro')->getData());
                $usuario->setCep(str_replace('.', '', str_replace('-', '', $form->get('cep')->getData())));
                $usuario->setComplemento($form->get('complemento')->getData());
                $usuario->setStUsuario(false);

                $usuario->setIdPerfil($em->getRepository('AppBundle:TbPerfil')->find(2));

                $em->persist($usuario);
                $em->flush();

                // TELEFONE
                $telefone = new TbTelefone();
                $telefone->setIdUsuario($usuario);
                $telefone->setDddTelefone($form->get('ddd_p')->getData());
                $telefone->setNumTelefone($form->get('telefone_p')->getData());
                $em->persist($telefone);
                $em->flush();

                $telefone = new TbTelefone();
                $telefone->setIdUsuario($usuario);
                $telefone->setDddTelefone($form->get('ddd_a')->getData());
                $telefone->setNumTelefone($form->get('telefone_a')->getData());
                $em->persist($telefone);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', "Cadastro realizado com sucesso! Será enviada uma confirmação de cadastro para o e-mail informado");

                return $this->redirectToRoute('admin_login');
            } catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
            }
        }

        return $this->render('AdminBundle:Default:solicitarAcesso.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/recuperarsenha", name="admin_recuperarsenha")
     */
    public function recuperarsenhaAction() {
        $form = $this->createForm(new UsuarioType());
        $em = $this->getDoctrine()->getManager();

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));

            $qb = $em->createQueryBuilder();
            $qb->select('u')
                ->from('AppBundle:TbUsuario', 'u')
                ->where('u.email = :email')
                ->setParameter('email', $form->get('email')->getData());

            $rsUsuario = $qb->getQuery()->getOneOrNullResult();

            if($rsUsuario){
                try {
                    $body = $this->renderView('AdminBundle:Util:emailRecuperarAcesso.html.twig', array(
                        'nome' => $rsUsuario->getNmUsuario(),
                        'email' => $rsUsuario->getEmail(),
                        'login' => $rsUsuario->getCpf(),
                        'senha' => $rsUsuario->getSenha()
                    ));

                    $message = \Swift_Message::newInstance()
                        ->setSubject("Recuperação Acesso SISREC")
                        ->setTo($rsUsuario->getEmail())
                        ->setFrom('no-reply@sisrec.com.br')
                        ->setContentType("text/html")
                        ->setBody($body);

                    $this->get('mailer')->send($message);

                    $msg = "Solicitação de recuperação de senha enviada com sucesso! ";
                    $msg .= "Aguarde o recebimento do e-mail de recuperação ";

                    $this->get('session')->getFlashBag()->add('notice', $msg);
                }catch(\Exception $e){
                    $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
                }
            }else{
                $this->get('session')->getFlashBag()->add('warning', "Cadastro Inexistente");
            }
        }

        return $this->render('AdminBundle:Default:recuperarSenha.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
