<?php

namespace models\entidades;

/**
 * @Entity @Table(name="Endereco")
 **/
class Endereco extends Entidade {
    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $logradouro;
    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $numero;
    /**
     * @Column(type="string", length=100, nullable=true )
     */
    protected $complemento;
    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $bairro;
    /**
     * @Column(type="string", length=9, nullable=true )
     */
    protected $cep;
    /**
     * @ManyToOne(targetEntity="Cidade")
     */
    protected $cidade;
    
    public function getLogradouro() {
        return $this->logradouro;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getEstado() {
        if(is_null($this->getCidade()))
            return null;
        return $this->getCidade()->getEstado();
    }
}

?>