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
     * @var integer
     */
    private $idTelefone;


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
     * Get idTelefone
     *
     * @return integer 
     */
    public function getIdTelefone()
    {
        return $this->idTelefone;
    }
}
