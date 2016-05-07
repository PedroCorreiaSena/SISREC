<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbTelefone
 */
class TbTelefone
{
    /**
     * @var string
     */
    private $dddTelefone;

    /**
     * @var string
     */
    private $numTelefone;

    /**
     * @var integer
     */
    private $idTelefone;

    /**
     * @var \AppBundle\Entity\TbUsuario
     */
    private $idUsuario;


    /**
     * Set dddTelefone
     *
     * @param string $dddTelefone
     * @return TbTelefone
     */
    public function setDddTelefone($dddTelefone)
    {
        $this->dddTelefone = $dddTelefone;

        return $this;
    }

    /**
     * Get dddTelefone
     *
     * @return string 
     */
    public function getDddTelefone()
    {
        return $this->dddTelefone;
    }

    /**
     * Set numTelefone
     *
     * @param string $numTelefone
     * @return TbTelefone
     */
    public function setNumTelefone($numTelefone)
    {
        $this->numTelefone = $numTelefone;

        return $this;
    }

    /**
     * Get numTelefone
     *
     * @return string 
     */
    public function getNumTelefone()
    {
        return $this->numTelefone;
    }

    /**
     * Get idTelefone
     *
     * @return integer 
     */
    public function getIdTelefone()
    {
        return $this->idTelefone;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\TbUsuario $idUsuario
     * @return TbTelefone
     */
    public function setIdUsuario(\AppBundle\Entity\TbUsuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\TbUsuario 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
