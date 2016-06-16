<?php
namespace AdminBundle\Service;

/**
 * Class TwigService
 * @package AdminBundle\Service
 */
class TwigService extends \Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'twig_service';
    }
}