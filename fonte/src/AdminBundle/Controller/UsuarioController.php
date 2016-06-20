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

/**
 * Class UsuarioController
 * @package AdminBundle\Controller
 */
class UsuarioController extends Controller
{
    /**
     * Funcionalidade de listar usuário
     *
     * @Route("usuario/listar", name="admin_usuario_listar")
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
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
     * Funcionalidade de incluir/alterar usuário
     *
     * @Route("usuario/manter/{idUsuario}", name="admin_usuario_manter")
     * @Security("has_role('ROLE_ADMIN')")
     * @param $idUsuario
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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
                $usuario->setDtNascimento($form->get('dtNascimento')->getData());
                $usuario->setNumCasa($form->get('casa')->getData());
                $usuario->setIdPerfil($form->get('idPerfil')->getData());

                if($usuario->getIdUsuario() == 0){
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
                    // Telefone
                    $dql = "SELECT t FROM AppBundle:TbTelefone t WHERE t.idUsuario = :idUsuario";
                    $query = $em->createQuery($dql);
                    $query->setParameter('idUsuario', $idUsuario);
                    $rsTelefone = $query->getResult();

                    if(count($rsTelefone) == 2){
                        $rsTelefone[0]->setDddTelefone($form->get('ddd_p')->getData());
                        $rsTelefone[0]->setNumTelefone($form->get('telefone_p')->getData());
                        $rsTelefone[1]->setDddTelefone($form->get('ddd_a')->getData());
                        $rsTelefone[1]->setNumTelefone($form->get('telefone_a')->getData());
                    }

                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Usuario alteado com sucesso!");
                }
            } catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
            }

            if($idUsuario == 0) {
                return $this->redirectToRoute('admin_usuario_listar');
            }else{
                return $this->redirectToRoute('admin_usuario_manter', array(
                    'idUsuario' => (int) @$usuario->getIdUsuario()
                ));
            }
        }else{
            $dql = "SELECT t FROM AppBundle:TbTelefone t WHERE t.idUsuario = :idUsuario";
            $query = $em->createQuery($dql);
            $query->setParameter('idUsuario', $idUsuario);
            $rsTelefone = $query->getResult();

            if(count($rsTelefone) == 2){
                $form->get('ddd_p')->setData($rsTelefone[0]->getDddTelefone());
                $form->get('telefone_p')->setData($rsTelefone[0]->getNumTelefone());
                $form->get('ddd_a')->setData($rsTelefone[1]->getDddTelefone());
                $form->get('telefone_a')->setData($rsTelefone[1]->getNumTelefone());
            }

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
            $form->get('dtNascimento')->setData($usuario->getDtNascimento());
            $form->get('casa')->setData($usuario->getDtNascimento());
            $form->get('idPerfil')->setData($usuario->getIdPerfil());
        }

        return $this->render('AdminBundle:Usuario:manter.html.twig', array(
            'form' => $form->createView(),
            'idUsuario' => $idUsuario,
            'usuario' => $usuario
        ));
    }

    /**
     * Funcionalidade de manter situação do usuário
     *
     * @Route("usuario/situacao/{idUsuario}", name="admin_usuario_situacao")
     * @Security("has_role('ROLE_ADMIN')")
     * @param $idUsuario
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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

    /**
     * Funcionalidade de excluir usuário
     *
     * @Route("usuario/excluir/{idUsuario}", name="admin_usuario_excluir")
     * @Security("has_role('ROLE_ADMIN')")
     * @param int $idUsuario
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function excluirAction($idUsuario){
        $em = $this->getDoctrine()->getEntityManager();

        try {
            // Excluir telefones
            $dql = "SELECT t FROM AppBundle:TbTelefone t WHERE t.idUsuario = :idUsuario";
            $query = $em->createQuery($dql);
            $query->setParameter('idUsuario', $idUsuario);
            $rsTelefone = $query->getResult();

            foreach($rsTelefone as $item){
                $em->remove($item);
            }

            // Excluir Usuário
            $em->remove($em->getRepository('AppBundle:TbUsuario')->find($idUsuario));

            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', "Usuário excluído com sucesso!");
        }catch (DBALException $e){
            $this->get('session')->getFlashBag()->add('warning', $e->getMessage());
        }

        return $this->redirectToRoute('admin_usuario_listar');
    }
}
