<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbEndereco
 */
class TbEndereco
{
    /**
     * @var string
     */
    private $cep;

    /**
     * @var string
     */
    private $endereco;

    /**
     * @var string
     */
    private $casa;

    /**
     * @var string
     */
    private $bairro;

    /**
     * @var string
     */
    private $complemento;

    /**
     * @var integer
     */
    private $idEndereco;

    /**
     * @var \AppBundle\Entity\TbMunicipio
     */
    private $idMunicipio;


    /**
     * Set cep
     *
     * @param string $cep
     * @return TbEndereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     * @return TbEndereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string 
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set casa
     *
     * @param string $casa
     * @return TbEndereco
     */
    public function setCasa($casa)
    {
        $this->casa = $casa;

        return $this;
    }

    /**
     * Get casa
     *
     * @return string 
     */
    public function getCasa()
    {
        return $this->casa;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     * @return TbEndereco
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return string 
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set complemento
     *
     * @param string $complemento
     * @return TbEndereco
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get complemento
     *
     * @return string 
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Get idEndereco
     *
     * @return integer 
     */
    public function getIdEndereco()
    {
        return $this->idEndereco;
    }

    /**
     * Set idMunicipio
     *
     * @param \AppBundle\Entity\TbMunicipio $idMunicipio
     * @return TbEndereco
     */
    public function setIdMunicipio(\AppBundle\Entity\TbMunicipio $idMunicipio = null)
    {
        $this->idMunicipio = $idMunicipio;

        return $this;
    }

    /**
     * Get idMunicipio
     *
     * @return \AppBundle\Entity\TbMunicipio 
     */
    public function getIdMunicipio()
    {
        return $this->idMunicipio;
    }
}
