<?php

namespace models\entidades;


/**
 * @Entity
 * @Table(name="Aula")
 */
class Aula extends Entidade{
    
    /**
     * @Column(type="date",nullable=false)
     */
    protected $data;
    
    /**
     * @Column(type="time",nullable=false)
     */
    protected $inicio;
    
    /**
     * @Column(type="time",nullable=false)
     */
    protected $termino;
    
    /**
     * @Column(type="integer",nullable=false)
     */
    protected $cargaHoraria;
    
    /**
     * @Column(type="string",nullable=false)
     */
    protected $conteudo;

    /**
     * @ManyToOne(targetEntity="Turma")
     */
    protected $turma;
    
    /**
     * @OneToMany(targetEntity="Presenca",mappedBy="aula")
     */
    protected $presencas;
    
    function __construct() {
        parent::__construct();
        $this->presencas = new \Doctrine\Common\Collections\ArrayCollection();        
    }
    
    function isPresente(Aluno $aluno){
        if(count($this->presencas)>0){
            foreach ($this->presencas as $presenca){
                if($presenca->getAluno()->getId() == $aluno->getId() ){
                    return true;
                }
            }
            return false;
        }else{
            return false;
        }
    }
    
    function getData() {
        return $this->data;
    }

    function getInicio() {
        return $this->inicio;
    }

    function getTermino() {
        return $this->termino;
    }

    function getCargaHoraria() {
        return $this->cargaHoraria;
    }

    function getConteudo() {
        return $this->conteudo;
    }

    function getTurma() {
        return $this->turma;
    }

    function getPresencas() {
        return $this->presencas;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setInicio($incio) {
        $this->inicio = $incio;
    }

    function setTermino($termino) {
        $this->termino = $termino;
    }

    function setCargaHoraria($cargaHoraria) {
        $this->cargaHoraria = $cargaHoraria;
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    function setTurma($turma) {
        $this->turma = $turma;
    }

    function setPresencas($presencas) {
        $this->presencas = $presencas;
    }
    
}


