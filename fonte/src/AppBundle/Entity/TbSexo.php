<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbSexo
 */
class TbSexo
{
    /**
     * @var string
     */
    private $tpSexo;

    /**
     * @var integer
     */
    private $idSexo;


    /**
     * Set tpSexo
     *
     * @param string $tpSexo
     * @return TbSexo
     */
    public function setTpSexo($tpSexo)
    {
        $this->tpSexo = $tpSexo;

        return $this;
    }

    /**
     * Get tpSexo
     *
     * @return string 
     */
    public function getTpSexo()
    {
        return $this->tpSexo;
    }

    /**
     * Get idSexo
     *
     * @return integer 
     */
    public function getIdSexo()
    {
        return $this->idSexo;
    }
}
