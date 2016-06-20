<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbPerfil
 */
class TbPerfil
{
    /**
     * @var string
     */
    private $tpPerfil;

    /**
     * @var boolean
     */
    private $stPerfil;

    /**
     * @var integer
     */
    private $idPerfil;


    /**
     * Set tpPerfil
     *
     * @param string $tpPerfil
     * @return TbPerfil
     */
    public function setTpPerfil($tpPerfil)
    {
        $this->tpPerfil = $tpPerfil;

        return $this;
    }

    /**
     * Get tpPerfil
     *
     * @return string 
     */
    public function getTpPerfil()
    {
        return $this->tpPerfil;
    }

    /**
     * Set stPerfil
     *
     * @param boolean $stPerfil
     * @return TbPerfil
     */
    public function setStPerfil($stPerfil)
    {
        $this->stPerfil = $stPerfil;

        return $this;
    }

    /**
     * Get stPerfil
     *
     * @return boolean 
     */
    public function getStPerfil()
    {
        return $this->stPerfil;
    }

    /**
     * Get idPerfil
     *
     * @return integer 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }
    /**
     * @var string
     */
    private $desPerfil;


    /**
     * Set desPerfil
     *
     * @param string $desPerfil
     * @return TbPerfil
     */
    public function setDesPerfil($desPerfil)
    {
        $this->desPerfil = $desPerfil;

        return $this;
    }

    /**
     * Get desPerfil
     *
     * @return string 
     */
    public function getDesPerfil()
    {
        return $this->desPerfil;
    }
}
