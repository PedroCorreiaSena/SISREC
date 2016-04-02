<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbMaterial
 */
class TbMaterial
{
    /**
     * @var integer
     */
    private $qtMaterial;

    /**
     * @var \DateTime
     */
    private $dtInclusao;

    /**
     * @var string
     */
    private $vlMaterial;

    /**
     * @var string
     */
    private $dsMaterial;

    /**
     * @var string
     */
    private $totalMaterial;

    /**
     * @var integer
     */
    private $idMaterial;

    /**
     * @var \AppBundle\Entity\TbTpMaterial
     */
    private $idTpMaterial;

    /**
     * @var \AppBundle\Entity\TbUsuario
     */
    private $cpf;


    /**
     * Set qtMaterial
     *
     * @param integer $qtMaterial
     * @return TbMaterial
     */
    public function setQtMaterial($qtMaterial)
    {
        $this->qtMaterial = $qtMaterial;

        return $this;
    }

    /**
     * Get qtMaterial
     *
     * @return integer 
     */
    public function getQtMaterial()
    {
        return $this->qtMaterial;
    }

    /**
     * Set dtInclusao
     *
     * @param \DateTime $dtInclusao
     * @return TbMaterial
     */
    public function setDtInclusao($dtInclusao)
    {
        $this->dtInclusao = $dtInclusao;

        return $this;
    }

    /**
     * Get dtInclusao
     *
     * @return \DateTime 
     */
    public function getDtInclusao()
    {
        return $this->dtInclusao;
    }

    /**
     * Set vlMaterial
     *
     * @param string $vlMaterial
     * @return TbMaterial
     */
    public function setVlMaterial($vlMaterial)
    {
        $this->vlMaterial = $vlMaterial;

        return $this;
    }

    /**
     * Get vlMaterial
     *
     * @return string 
     */
    public function getVlMaterial()
    {
        return $this->vlMaterial;
    }

    /**
     * Set dsMaterial
     *
     * @param string $dsMaterial
     * @return TbMaterial
     */
    public function setDsMaterial($dsMaterial)
    {
        $this->dsMaterial = $dsMaterial;

        return $this;
    }

    /**
     * Get dsMaterial
     *
     * @return string 
     */
    public function getDsMaterial()
    {
        return $this->dsMaterial;
    }

    /**
     * Set totalMaterial
     *
     * @param string $totalMaterial
     * @return TbMaterial
     */
    public function setTotalMaterial($totalMaterial)
    {
        $this->totalMaterial = $totalMaterial;

        return $this;
    }

    /**
     * Get totalMaterial
     *
     * @return string 
     */
    public function getTotalMaterial()
    {
        return $this->totalMaterial;
    }

    /**
     * Get idMaterial
     *
     * @return integer 
     */
    public function getIdMaterial()
    {
        return $this->idMaterial;
    }

    /**
     * Set idTpMaterial
     *
     * @param \AppBundle\Entity\TbTpMaterial $idTpMaterial
     * @return TbMaterial
     */
    public function setIdTpMaterial(\AppBundle\Entity\TbTpMaterial $idTpMaterial = null)
    {
        $this->idTpMaterial = $idTpMaterial;

        return $this;
    }

    /**
     * Get idTpMaterial
     *
     * @return \AppBundle\Entity\TbTpMaterial 
     */
    public function getIdTpMaterial()
    {
        return $this->idTpMaterial;
    }

    /**
     * Set cpf
     *
     * @param \AppBundle\Entity\TbUsuario $cpf
     * @return TbMaterial
     */
    public function setCpf(\AppBundle\Entity\TbUsuario $cpf = null)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return \AppBundle\Entity\TbUsuario 
     */
    public function getCpf()
    {
        return $this->cpf;
    }
}
