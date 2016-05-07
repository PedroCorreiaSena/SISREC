<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbGasto
 */
class TbGasto
{
    /**
     * @var string
     */
    private $vlGasto;

    /**
     * @var integer
     */
    private $numNotaFiscal;

    /**
     * @var integer
     */
    private $qtGasto;

    /**
     * @var \DateTime
     */
    private $dtGasto;

    /**
     * @var string
     */
    private $totalCompra;

    /**
     * @var \DateTime
     */
    private $dtPagamento;

    /**
     * @var boolean
     */
    private $stPagamento;

    /**
     * @var integer
     */
    private $idGastos;

    /**
     * @var \AppBundle\Entity\TbTipoGasto
     */
    private $idTpGasto;

    /**
     * @var \AppBundle\Entity\TbUsuario
     */
    private $idUsuario;


    /**
     * Set vlGasto
     *
     * @param string $vlGasto
     * @return TbGasto
     */
    public function setVlGasto($vlGasto)
    {
        $this->vlGasto = $vlGasto;

        return $this;
    }

    /**
     * Get vlGasto
     *
     * @return string 
     */
    public function getVlGasto()
    {
        return $this->vlGasto;
    }

    /**
     * Set numNotaFiscal
     *
     * @param integer $numNotaFiscal
     * @return TbGasto
     */
    public function setNumNotaFiscal($numNotaFiscal)
    {
        $this->numNotaFiscal = $numNotaFiscal;

        return $this;
    }

    /**
     * Get numNotaFiscal
     *
     * @return integer 
     */
    public function getNumNotaFiscal()
    {
        return $this->numNotaFiscal;
    }

    /**
     * Set qtGasto
     *
     * @param integer $qtGasto
     * @return TbGasto
     */
    public function setQtGasto($qtGasto)
    {
        $this->qtGasto = $qtGasto;

        return $this;
    }

    /**
     * Get qtGasto
     *
     * @return integer 
     */
    public function getQtGasto()
    {
        return $this->qtGasto;
    }

    /**
     * Set dtGasto
     *
     * @param \DateTime $dtGasto
     * @return TbGasto
     */
    public function setDtGasto($dtGasto)
    {
        $this->dtGasto = $dtGasto;

        return $this;
    }

    /**
     * Get dtGasto
     *
     * @return \DateTime 
     */
    public function getDtGasto()
    {
        return $this->dtGasto;
    }

    /**
     * Set totalCompra
     *
     * @param string $totalCompra
     * @return TbGasto
     */
    public function setTotalCompra($totalCompra)
    {
        $this->totalCompra = $totalCompra;

        return $this;
    }

    /**
     * Get totalCompra
     *
     * @return string 
     */
    public function getTotalCompra()
    {
        return $this->totalCompra;
    }

    /**
     * Set dtPagamento
     *
     * @param \DateTime $dtPagamento
     * @return TbGasto
     */
    public function setDtPagamento($dtPagamento)
    {
        $this->dtPagamento = $dtPagamento;

        return $this;
    }

    /**
     * Get dtPagamento
     *
     * @return \DateTime 
     */
    public function getDtPagamento()
    {
        return $this->dtPagamento;
    }

    /**
     * Set stPagamento
     *
     * @param boolean $stPagamento
     * @return TbGasto
     */
    public function setStPagamento($stPagamento)
    {
        $this->stPagamento = $stPagamento;

        return $this;
    }

    /**
     * Get stPagamento
     *
     * @return boolean 
     */
    public function getStPagamento()
    {
        return $this->stPagamento;
    }

    /**
     * Get idGastos
     *
     * @return integer 
     */
    public function getIdGastos()
    {
        return $this->idGastos;
    }

    /**
     * Set idTpGasto
     *
     * @param \AppBundle\Entity\TbTipoGasto $idTpGasto
     * @return TbGasto
     */
    public function setIdTpGasto(\AppBundle\Entity\TbTipoGasto $idTpGasto = null)
    {
        $this->idTpGasto = $idTpGasto;

        return $this;
    }

    /**
     * Get idTpGasto
     *
     * @return \AppBundle\Entity\TbTipoGasto 
     */
    public function getIdTpGasto()
    {
        return $this->idTpGasto;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\TbUsuario $idUsuario
     * @return TbGasto
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
