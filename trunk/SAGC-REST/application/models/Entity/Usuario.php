<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\Entity;
/**
 * Description of Pessoa
 *
 * @author Carlos
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
    
}
