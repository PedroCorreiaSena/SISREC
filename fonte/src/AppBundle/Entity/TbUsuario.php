<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbUsuario
 */
class TbUsuario
{
    /**
     * @var string
     */
    private $nmUsuario;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $observacao;

    /**
     * @var string
     */
    private $senha;

    /**
     * @var boolean
     */
    private $stUsuario;

    /**
     * @var string
     */
    private $cpf;

    /**
     * @var \AppBundle\Entity\TbPerfil
     */
    private $idPerfil;

    /**
     * @var \AppBundle\Entity\TbTelefone
     */
    private $idTelefone;

    /**
     * @var \AppBundle\Entity\TbEndereco
     */
    private $idEndereco;

    /**
     * @var \AppBundle\Entity\TbSexo
     */
    private $idSexo;


    /**
     * Set nmUsuario
     *
     * @param string $nmUsuario
     * @return TbUsuario
     */
    public function setNmUsuario($nmUsuario)
    {
        $this->nmUsuario = $nmUsuario;

        return $this;
    }

    /**
     * Get nmUsuario
     *
     * @return string 
     */
    public function getNmUsuario()
    {
        return $this->nmUsuario;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return TbUsuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     * @return TbUsuario
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string 
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set senha
     *
     * @param string $senha
     * @return TbUsuario
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get senha
     *
     * @return string 
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set stUsuario
     *
     * @param boolean $stUsuario
     * @return TbUsuario
     */
    public function setStUsuario($stUsuario)
    {
        $this->stUsuario = $stUsuario;

        return $this;
    }

    /**
     * Get stUsuario
     *
     * @return boolean 
     */
    public function getStUsuario()
    {
        return $this->stUsuario;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set idPerfil
     *
     * @param \AppBundle\Entity\TbPerfil $idPerfil
     * @return TbUsuario
     */
    public function setIdPerfil(\AppBundle\Entity\TbPerfil $idPerfil = null)
    {
        $this->idPerfil = $idPerfil;

        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return \AppBundle\Entity\TbPerfil 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set idTelefone
     *
     * @param \AppBundle\Entity\TbTelefone $idTelefone
     * @return TbUsuario
     */
    public function setIdTelefone(\AppBundle\Entity\TbTelefone $idTelefone = null)
    {
        $this->idTelefone = $idTelefone;

        return $this;
    }

    /**
     * Get idTelefone
     *
     * @return \AppBundle\Entity\TbTelefone 
     */
    public function getIdTelefone()
    {
        return $this->idTelefone;
    }

    /**
     * Set idEndereco
     *
     * @param \AppBundle\Entity\TbEndereco $idEndereco
     * @return TbUsuario
     */
    public function setIdEndereco(\AppBundle\Entity\TbEndereco $idEndereco = null)
    {
        $this->idEndereco = $idEndereco;

        return $this;
    }

    /**
     * Get idEndereco
     *
     * @return \AppBundle\Entity\TbEndereco 
     */
    public function getIdEndereco()
    {
        return $this->idEndereco;
    }

    /**
     * Set idSexo
     *
     * @param \AppBundle\Entity\TbSexo $idSexo
     * @return TbUsuario
     */
    public function setIdSexo(\AppBundle\Entity\TbSexo $idSexo = null)
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    /**
     * Get idSexo
     *
     * @return \AppBundle\Entity\TbSexo 
     */
    public function getIdSexo()
    {
        return $this->idSexo;
    }
}
