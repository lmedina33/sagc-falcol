<?php

namespace models\entidades;

/**
 * @Entity @Table(name="Aluno")
 */
class Aluno extends Pessoa{
    
    /**
     * @Column(type="string",nullable=false)
     */
    protected $cnh;
    
    /**
     * @Column(type="integer",nullable=false)
     */
    protected $cnhCategoria;
    
    /**
     * @Column(type="boolean",nullable=true)
     */
    protected $cooperativa;
    
    /**
     * @Column(type="string",nullable=true);
     */
    protected $cooperativaNome;
    
       
    
    function getCnh() {
        return $this->cnh;
    }

    function getCnhCategoria() {
        return $this->cnhCategoria;
    }

    function getCooperativa() {
        return $this->cooperativa;
    }

    function getCooperativaNome() {
        return $this->cooperativaNome;
    }    

    function setCnh($cnh) {
        $this->cnh = $cnh;
    }

    function setCnhCategoria($cnhCategoria) {
        $this->cnhCategoria = $cnhCategoria;
    }

    function setCooperativa($cooperativa) {
        $this->cooperativa = $cooperativa;
    }

    function setCooperativaNome($cooperativaNome) {
        $this->cooperativaNome = $cooperativaNome;
    }

    


    
}

