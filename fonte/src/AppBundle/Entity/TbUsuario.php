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
    private $cpf;

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
     * @var string
     */
    private $tpSexo;

    /**
     * @var string
     */
    private $cep;

    /**
     * @var string
     */
    private $uf;

    /**
     * @var string
     */
    private $endereco;

    /**
     * @var string
     */
    private $cidade;

    /**
     * @var string
     */
    private $bairro;

    /**
     * @var string
     */
    private $complemento;

    /**
     * @var boolean
     */
    private $stUsuario;

    /**
     * @var integer
     */
    private $idUsuario;

    /**
     * @var \AppBundle\Entity\TbPerfil
     */
    private $idPerfil;


    /**
     * Set cpf
     *
     * @param string $cpf
     * @return TbUsuario
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
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
     * Set tpSexo
     *
     * @param string $tpSexo
     * @return TbUsuario
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
     * Set cep
     *
     * @param string $cep
     * @return TbUsuario
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
     * Set uf
     *
     * @param string $uf
     * @return TbUsuario
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf
     *
     * @return string 
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     * @return TbUsuario
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
     * Set cidade
     *
     * @param string $cidade
     * @return TbUsuario
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return string 
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     * @return TbUsuario
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
     * @return TbUsuario
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
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
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
}
