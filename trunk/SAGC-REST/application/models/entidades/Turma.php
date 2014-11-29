<?php

namespace models\entidades;

/**
 * @Entity @Table(name="Turma")
 **/
class Turma extends Entidade{
    
    /**
     * @Column(type="string",nullable=false)
     */
    protected $nome;
    
    /**
     * @Column(type="string", nullable=false)
     */
    protected $codigo;
    
    /**
     * @Column(type="integer", nullable=false)
     */
    protected $ano;
    
    /**
     * @Column(type="date",nullable=false)
     */
    protected $dataInicio;
    
    /**
     * @Column(type="date",nullable=false)
     */
    protected $dataTermino;

    /**
     * @Column(type="integer", nullable=false)
     */
    protected $vagas;
    
    /**
     * @Column(type="string",nullable=false)
     */
    protected $descricao;

    /**
     * @ManyToMany(targetEntity="Aluno")
     */
    private $alunos;
    
    /**
     * @Column(type="boolean", nullable=false)
     */
    protected $encerrada = false;
    
    /**
     * @OneToMany(targetEntity="Aula",mappedBy="turma")
     * @OrderBy({"data" = "ASC"})
     */
    protected $aulas;
    
    function __construct() {
        parent::__construct();
        $this->aulas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->alunos = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
    
    function getNome() {
        return $this->nome;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getAno() {
        return $this->ano;
    }

    function getVagas() {
        return $this->vagas;
    }

    function getAlunos() {
        return $this->alunos;
    }

    function getEncerrada() {
        return $this->encerrada;
    }

    function getAulas() {
        return $this->aulas;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

    function setVagas($vagas) {
        $this->vagas = $vagas;
    }

    function setAlunos($alunos) {
        $this->alunos = $alunos;
    }

    function setEncerrada($encerrada) {
        $this->encerrada = $encerrada;
    }

    function setAulas($aulas) {
        $this->aulas = $aulas;
    }
    
    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataTermino() {
        return $this->dataTermino;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataTermino($dataTermino) {
        $this->dataTermino = $dataTermino;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }




    
}

