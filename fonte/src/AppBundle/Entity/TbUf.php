<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbUf
 */
class TbUf
{
    /**
     * @var string
     */
    private $dsUf;

    /**
     * @var integer
     */
    private $idUf;


    /**
     * Set dsUf
     *
     * @param string $dsUf
     * @return TbUf
     */
    public function setDsUf($dsUf)
    {
        $this->dsUf = $dsUf;

        return $this;
    }

    /**
     * Get dsUf
     *
     * @return string 
     */
    public function getDsUf()
    {
        return $this->dsUf;
    }

    /**
     * Get idUf
     *
     * @return integer 
     */
    public function getIdUf()
    {
        return $this->idUf;
    }
}
