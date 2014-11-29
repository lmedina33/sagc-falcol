<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\entidades;
/**
 * @Entity
 * @Table(name="Presenca")
 */
class Presenca extends Entidade{
    
    /**
     * @ManyToOne(targetEntity="Aula")
     */
    protected $aula;
    
    /**
     * @ManyToOne(targetEntity="Aluno")
     */
    protected $aluno;
    
    function __construct() {
        parent::__construct();
    }

    
    function getAula() {
        return $this->aula;
    }

    function getAluno() {
        return $this->aluno;
    }

    function setAula($aula) {
        $this->aula = $aula;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }
    
}
