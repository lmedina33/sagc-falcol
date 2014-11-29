<?php

namespace models\negocio;

class AlunoBLL extends BaseBLL{
    
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\Aluno';
        parent::__construct();
    }
    
}

