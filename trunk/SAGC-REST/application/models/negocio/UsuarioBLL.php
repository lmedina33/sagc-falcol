<?php

namespace models\negocio;

use models\entidades\Usuario;
use Doctrine\ORM\EntityManager;

class UsuarioBLL extends BaseBLL {
    
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\Usuario';
        parent::__construct();
    }
}

?>
