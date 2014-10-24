<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\Entity;
/**
 * Description of Curso
 *
 * @author Carlos
 */
class Curso extends Entidade{
    //put your code here
    
    /**
     * @Column(type="string",nullable=false)
     */
    protected $nome;
    /**
     * @OneToMany(targetEntity="Disciplina")
     */
    protected $disciplina;
}
