<?php

namespace models\negocio;

class TurmaBLL extends BaseBLL{
    
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\Turma';
        parent::__construct();
    }
    
}

