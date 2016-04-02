<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbTipoGasto
 */
class TbTipoGasto
{
    /**
     * @var string
     */
    private $tpGasto;

    /**
     * @var boolean
     */
    private $stTpGasto;

    /**
     * @var integer
     */
    private $idTpGasto;


    /**
     * Set tpGasto
     *
     * @param string $tpGasto
     * @return TbTipoGasto
     */
    public function setTpGasto($tpGasto)
    {
        $this->tpGasto = $tpGasto;

        return $this;
    }

    /**
     * Get tpGasto
     *
     * @return string 
     */
    public function getTpGasto()
    {
        return $this->tpGasto;
    }

    /**
     * Set stTpGasto
     *
     * @param boolean $stTpGasto
     * @return TbTipoGasto
     */
    public function setStTpGasto($stTpGasto)
    {
        $this->stTpGasto = $stTpGasto;

        return $this;
    }

    /**
     * Get stTpGasto
     *
     * @return boolean 
     */
    public function getStTpGasto()
    {
        return $this->stTpGasto;
    }

    /**
     * Get idTpGasto
     *
     * @return integer 
     */
    public function getIdTpGasto()
    {
        return $this->idTpGasto;
    }
}
