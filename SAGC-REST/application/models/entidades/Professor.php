<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\entidades;
/**
 * Description of Professor
 *
 * @author Carlos
 */

/**
 * @Entity @Table(name="professor")
 */
class Professor extends Usuario{
    //put your code here
    
    /**
     * @OneToMany(targetEntity="Turma",mappedBy="professor")
     */
    protected $turmas;
    /**
     * @OneToMany(targetEntity="PlanoAula",mappedBy="professor")
     */
    protected $planosAula;
    
    function __construct() {
        $this->planoAula = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
