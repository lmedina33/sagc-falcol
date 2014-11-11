<?php

namespace models\negocio;

use models\entidades\Endereco;
use Doctrine\ORM\EntityManager;

class EnderecoBLL extends BaseBLL{
    //put your code here
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\Endereco';
        parent::__construct();
    }
}

?>
