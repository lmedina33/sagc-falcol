<?php

namespace models\negocio;

class AulaBLL extends BaseBLL{
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\Aula';
        parent::__construct();
    }
}
