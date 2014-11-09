<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\entidades;
/**
 * Description of Media
 *
 * @author Carlos
 */

/**
 * @Entity @Table(name="arquivo")
 */
class Arquivos extends Entidade {
    /**
     * @Column(type="string")
     */
    protected $fileName;
    /**
     * @Column(type="string")
     */
    protected $hashName;
    /**
     * @Column(type="integer")
     */
    protected $tipo;    
    
}
