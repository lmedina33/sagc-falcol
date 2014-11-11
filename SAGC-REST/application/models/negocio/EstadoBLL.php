<?php

namespace models\negocio;

use models\entidades\Estado;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

class EstadoBLL extends BaseBLL{
    //put your code here
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\Estado';
        parent::__construct();
    }
    
    public function buscarTodosComNucleo(){
        $query = $this->em->createQuery("SELECT e FROM " . $this->nomeEntidade . " e 
                                            JOIN e.cidades c
                                            JOIN c.enderecos en
                                            JOIN en.nucleo n ");

        return $query->getResult(Query::HYDRATE_OBJECT);
    }
}

?>
