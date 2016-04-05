<?php
namespace AdminBundle\Service;

use AdminBundle\Util\MenuUtil;

class TwigService extends \Twig_Extension
{

    public function getFunctions()
    {
        return array(
            'get_menu' => new \Twig_Function_Method($this, 'getMenu'),
        );
    }

    public function getMenu($role){
        $menu = new MenuUtil();
        return $menu->get($role);
    }

    public function getName() {
        return 'twig_service';
    }
}