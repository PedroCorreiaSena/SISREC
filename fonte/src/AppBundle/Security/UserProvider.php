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
        $qb->select('u.senha, p.tpPerfil')
            ->from('AppBundle:TbUsuario', 'u')
            ->join("u.idPerfil", 'p')
            ->where('u.cpf = :cpf AND u.stUsuario = 1')
            ->setParameter('cpf', str_replace('.', '', str_replace('-', '', $username)));

        $rsUsuario = $qb->getQuery()->getOneOrNullResult();

        if($rsUsuario) {
            return new User($username, $rsUsuario['senha'], '', array($rsUsuario['tpPerfil']));
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