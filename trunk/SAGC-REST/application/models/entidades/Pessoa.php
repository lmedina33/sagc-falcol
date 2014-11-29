<?php

namespace models\entidades;

/**
 * @Entity @Table(name="Pessoa")
 * @InheritanceType("JOINED")
 */
class Pessoa extends Entidade{
    
    /**
     * @Column(type="string", nullable=true)
     */
    protected $foto;
    
    /**
     * @Column(name="nome", type="string", length=50, nullable=false)
     */
    protected $nome;
    
    /**
     * @Column(type="smallint", nullable=true)
     */
    protected $sexo;
    
    /**
     * @Column(type="date", nullable=false)
     */
    protected $dataNascimento;
    
    /**
     * @Column(type="string",length=15,nullable=false)
     */
    protected $cpf;
    
    /**
     * @Column(type="string", length=50, nullable=true)
     */
    protected $rg;
    /**
     * @Column(type="string", length=50, nullable=true)
     */
    protected $rgOrgaoEmissor;
    
    /**
     * @Column(type="string", nullable=true)
     */
    protected $email;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $telefone;
    
    /**
     * @Column(type="string", nullable=true)
     */
    protected $celular;
    
    /**
     * @OneToOne(targetEntity="Endereco")
     */
    protected $endereco;
    
    /**
     * @Column(type="text",nullable=true); 
     */
    protected $digitais;
            
    function getFoto() {
        return $this->foto;
    }

    function getNome() {
        return $this->nome;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getRg() {
        return $this->rg;
    }

    function getRgOrgaoEmissor() {
        return $this->rgOrgaoEmissor;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCelular() {
        return $this->celular;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setRgOrgaoEmissor($rgOrgaoEmissor) {
        $this->rgOrgaoEmissor = $rgOrgaoEmissor;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
    
    function getDigitais() {
        return $this->digitais;
    }

    function setDigitais($digitais) {
        $this->digitais = $digitais;
    }
    
}


