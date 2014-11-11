<?php

namespace models\negocio;

use models\entidades\PerfilAcesso;
use Doctrine\ORM\EntityManager;

class PerfilAcessoBLL extends BaseBLL {
    
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\PerfilAcesso';
        parent::__construct();
    }
}