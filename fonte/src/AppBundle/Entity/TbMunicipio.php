<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbMunicipio
 */
class TbMunicipio
{
    /**
     * @var string
     */
    private $nmMunicipio;

    /**
     * @var integer
     */
    private $idMunicipio;

    /**
     * @var \AppBundle\Entity\TbUf
     */
    private $tbUfUf;


    /**
     * Set nmMunicipio
     *
     * @param string $nmMunicipio
     * @return TbMunicipio
     */
    public function setNmMunicipio($nmMunicipio)
    {
        $this->nmMunicipio = $nmMunicipio;

        return $this;
    }

    /**
     * Get nmMunicipio
     *
     * @return string 
     */
    public function getNmMunicipio()
    {
        return $this->nmMunicipio;
    }

    /**
     * Set idMunicipio
     *
     * @param integer $idMunicipio
     * @return TbMunicipio
     */
    public function setIdMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;

        return $this;
    }

    /**
     * Get idMunicipio
     *
     * @return integer 
     */
    public function getIdMunicipio()
    {
        return $this->idMunicipio;
    }

    /**
     * Set tbUfUf
     *
     * @param \AppBundle\Entity\TbUf $tbUfUf
     * @return TbMunicipio
     */
    public function setTbUfUf(\AppBundle\Entity\TbUf $tbUfUf)
    {
        $this->tbUfUf = $tbUfUf;

        return $this;
    }

    /**
     * Get tbUfUf
     *
     * @return \AppBundle\Entity\TbUf 
     */
    public function getTbUfUf()
    {
        return $this->tbUfUf;
    }
}
