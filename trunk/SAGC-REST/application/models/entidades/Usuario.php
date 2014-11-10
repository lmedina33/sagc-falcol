<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\entidades;
/**
 * Description of Pessoa
 *
 * @author Carlos
 */

/**
 * @Entity @Table(name="auth_users")
 */
class Usuario extends Entidade{
    
    /**
     * @Column(type="string", length=250, nullable=false)
     */
    protected $nome;

    /**
     * @Column(type="string",length=250,nullable=true)
     */
    protected $foto;

    /**
     * @Column(type="date", nullable=false)
     */
    protected $dataNascimento;

    /**
     * @Column(type="string",length=250,nullable=true)
     */
    protected $escolaridade;

    /**
     * @Column(type="string",nullable=true)
     */
    protected $telefones;
    
    /**
     * @Column(name="username", type="string", length=50, nullable=false)
     */
    protected $login;

    /**
     * @Column(name="password", type="string", length=255, nullable=false)
     */
    protected $senha;

    /**
     * @Column(name="email", type="string", length=100, nullable=false)
     */
    protected $email;

    /**
     * @ManyToOne(targetEntity="Endereco")
     */
    protected $endereco;
        
    /**
     * @ManyToOne(targetEntity="PerfilAcesso")
     */
    protected $perfilAcesso;
    
    /**
     * @ManyToOne(targetEntity="InstituicaoEnsino", inversedBy="usuarios")      
     */
    protected $instituicaoEnsino;

    /**
     * @Column(type="array")
     */
    protected $configuracoes = array();
    
    function getNome() {
        return $this->nome;
    }

    function getFoto() {
        return $this->foto;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getEscolaridade() {
        return $this->escolaridade;
    }

    function getTelefones() {
        return $this->telefones;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getPerfilAcesso() {
        return $this->perfilAcesso;
    }

    function getInstituicaoEnsino() {
        return $this->instituicaoEnsino;
    }

    function getConfiguracoes() {
        return $this->configuracoes;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setEscolaridade($escolaridade) {
        $this->escolaridade = $escolaridade;
    }

    function setTelefones($telefones) {
        $this->telefones = $telefones;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setPerfilAcesso($perfilAcesso) {
        $this->perfilAcesso = $perfilAcesso;
    }

    function setInstituicaoEnsino($instituicaoEnsino) {
        $this->instituicaoEnsino = $instituicaoEnsino;
    }

    function setConfiguracoes($configuracoes) {
        $this->configuracoes = $configuracoes;
    }


    
}
