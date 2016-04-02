<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbTpMaterial
 */
class TbTpMaterial
{
    /**
     * @var string
     */
    private $tpMaterial;

    /**
     * @var boolean
     */
    private $stMaterial;

    /**
     * @var integer
     */
    private $idTpMaterial;


    /**
     * Set tpMaterial
     *
     * @param string $tpMaterial
     * @return TbTpMaterial
     */
    public function setTpMaterial($tpMaterial)
    {
        $this->tpMaterial = $tpMaterial;

        return $this;
    }

    /**
     * Get tpMaterial
     *
     * @return string 
     */
    public function getTpMaterial()
    {
        return $this->tpMaterial;
    }

    /**
     * Set stMaterial
     *
     * @param boolean $stMaterial
     * @return TbTpMaterial
     */
    public function setStMaterial($stMaterial)
    {
        $this->stMaterial = $stMaterial;

        return $this;
    }

    /**
     * Get stMaterial
     *
     * @return boolean 
     */
    public function getStMaterial()
    {
        return $this->stMaterial;
    }

    /**
     * Get idTpMaterial
     *
     * @return integer 
     */
    public function getIdTpMaterial()
    {
        return $this->idTpMaterial;
    }
}
