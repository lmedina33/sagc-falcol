<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\entidades;
/**
 * Description of Turma
 *
 * @author Carlos
 */

/**
 * @Entity @Table(name="turma")
 */
class Turma extends Entidade{
        
    /**
     * @Column(type="integer")
     */
    protected $ano;
    /**
     * @Column(type="integer")
     */
    protected $semestre;
    /**
     * @ManyToMany(targetEntity="Professor")
     */
    protected $professor;
    /**
     * @ManyToMany(targetEntity="Disciplina")
     */
    protected $disciplina;
    /**
     * @ManyToMany(targetEntity="PlanoAula")
     */
    protected $planoAula;
}
