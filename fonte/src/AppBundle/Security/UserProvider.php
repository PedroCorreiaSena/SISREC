<?php
namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;

/**
 * Class UserProvider
 * @package AppBundle\Security
 */
class UserProvider implements UserProviderInterface {
    protected $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function loadUserByUsername($username) {
        $qb = $this->em->createQueryBuilder();
        $qb->select('u.senha')
            ->from('AppBundle:TbUsuario', 'u')
            ->where('u.cpf = :cpf AND u.stUsuario = 1')
            ->setParameter('cpf', str_replace('.', '', str_replace('-', '', $username)));

        $rsUsuario = $qb->getQuery()->getOneOrNullResult();

        if($rsUsuario) {
            /*$qb = $this->em->createQueryBuilder();
            $qb->select('u')
                ->from('AppBundle:TblUsuario', 'u')
                ->where('u.desEmail = :desEmail AND u.sitAtivo = 1')
                ->setParameter('desEmail', $username);

            $rs = $qb->getQuery()->getResult();

            $roles = array();

            if(count($rs)){
                foreach($rs as $item) {
                    $roles[] = $item->getDesNivel();
                }
            }*/

            return new User($username, $rsUsuario['senha'], '', array('ROLE_ADMIN'));
        }else{
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'AppBundle\Security\User';
    }
}