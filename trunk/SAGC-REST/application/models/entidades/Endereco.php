<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\entidades;
/**
 * Description of Endereco
 *
 * @author Carlos
 */

/**
 * @Entity @Table(name="endereco")
 */
class Endereco extends Entidade{
   
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $logradouro;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $numero;

    /**
     * @Column(type="string", length=100, nullable=true )
     */
    protected $complemento;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $bairro;

    /**
     * @Column(type="string", length=9, nullable=true)
     */
    protected $cep;

    /**
     * @ManyToOne(targetEntity="Cidade")
     */
    protected $cidade;

    /**
     * @Column(type="string", length=6, nullable=true)
     */
    protected $localizacaoDomicilio;

    /**
     * @Column(type="string", length=250, nullable=true)
     */
    protected $pontoReferencia;
    
    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCep() {
        return $this->cep;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getLocalizacaoDomicilio() {
        return $this->localizacaoDomicilio;
    }

    function getPontoReferencia() {
        return $this->pontoReferencia;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setLocalizacaoDomicilio($localizacaoDomicilio) {
        $this->localizacaoDomicilio = $localizacaoDomicilio;
    }

    function setPontoReferencia($pontoReferencia) {
        $this->pontoReferencia = $pontoReferencia;
    }


}
