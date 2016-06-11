<?php

namespace AdminBundle\Controller;
use AdminBundle\Form\UsuarioType;
use AppBundle\Entity\TbTelefone;
use AppBundle\Entity\TbUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UsuarioController extends Controller
{
    /**
     * @Route("usuario/listar", name="admin_usuario_listar")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function listarAction() {
        $dql = "SELECT m FROM AppBundle:TbUsuario m";

        $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $usuario = $query->getResult();

        return $this->render('AdminBundle:Usuario:listar.html.twig', array(
            'usuario' => $usuario
        ));
    }

    /**
     * @Route("usuario/manter/{idUsuario}", name="admin_usuario_manter")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function manterAction($idUsuario) {
        $form = $this->createForm(new UsuarioType());

        $em = $this->getDoctrine()->getManager();

        if($idUsuario) {
            $usuario = $em->getRepository('AppBundle:TbUsuario')->find($idUsuario);

            if(!$usuario){
                throw new NotFoundHttpException('Usuario não encontrado!');
            }
        }else{
            $usuario = new TbUsuario();
        }

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));

            try {
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
                $usuario->setTpSexo($form->get('sexo')->getData());
                $usuario->setCep($form->get('cep')->getData());
                $usuario->setUf($form->get('uf')->getData());
                $usuario->setEndereco($form->get('endereco')->getData());
                $usuario->setCidade($form->get('cidade')->getData());
                $usuario->setBairro($form->get('bairro')->getData());
                $usuario->setCep(str_replace('.', '', str_replace('-', '', $form->get('cep')->getData())));
                $usuario->setComplemento($form->get('complemento')->getData());

                if($usuario->getIdUsuario() == 0){
                    $usuario->setIdPerfil($em->getRepository('AppBundle:TbPerfil')->find(2));
                    $usuario->setStUsuario(false);
                    $usuario->setSenha('010203');

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

                    $this->get('session')->getFlashBag()->add('notice', "Usuario cadastrado com sucesso!");
                } else {
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Usuario alteado com sucesso!");
                }
            } catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
            }

            return $this->redirectToRoute('admin_usuario_manter', array(
                'idUsuario' => (int) @$usuario->getIdUsuario()
            ));
        }else{
            $form->get('cpf')->setData($usuario->getCpf());
            $form->get('nmUsuario')->setData($usuario->getNmUsuario());
            $form->get('email')->setData($usuario->getEmail());
            $form->get('email_c')->setData($usuario->getEmail());
            $form->get('observacao')->setData($usuario->getObservacao());
            $form->get('sexo')->setData($usuario->getSenha());
            $form->get('uf')->setData($usuario->getUf());
            $form->get('cep')->setData($usuario->getCep());
            $form->get('endereco')->setData($usuario->getEndereco());
            $form->get('cidade')->setData($usuario->getCidade());
            $form->get('bairro')->setData($usuario->getBairro());
            $form->get('complemento')->setData($usuario->getComplemento());
        }

        return $this->render('AdminBundle:Usuario:manter.html.twig', array(
            'form' => $form->createView(),
            'idUsuario' => $idUsuario,
            'usuario' => $usuario
        ));
    }

    /**
     * @Route("usuario/situacao/{idUsuario}", name="admin_usuario_situacao")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function situacaoAction($idUsuario) {
        $form = $this->createForm(new UsuarioType());
        $em = $this->getDoctrine()->getManager();

        if($this->get('request')->getMethod() == 'POST') {
            $form->handleRequest($this->get('request'));

            $usuario = $em->getRepository('AppBundle:TbUsuario')->find($idUsuario);

            $usuario->setStUsuario($form->get('stUsuario')->getData());

            if($usuario->getStUsuario()) {
                $usuario->setSenha(substr(md5(uniqid()), 1, 6));

                try {
                    $body = $this->renderView('AdminBundle:Util:emailRecuperarAcesso.html.twig', array(
                        'login' => $usuario->getCpf(),
                        'senha' => $usuario->getSenha()
                    ));

                    $message = \Swift_Message::newInstance()
                        ->setSubject("E-mail de aprovação de acesso")
                        ->setTo($usuario->getEmail())
                        ->setFrom('no-reply@sisrec.com.br')
                        ->setContentType("text/html")
                        ->setBody($body);

                    $this->get('mailer')->send($message);

                    $this->get('session')->getFlashBag()->add('notice', "Usuário aprovado com sucesso");
                }catch(\Exception $e){
                    $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
                }
            }else{
                $this->get('session')->getFlashBag()->add('notice', "Usuário reprovado com sucesso");
            }

            $em->flush();
        }

        return $this->redirectToRoute('admin_usuario_manter', array(
            'idUsuario' => $idUsuario
        ));
    }
}
