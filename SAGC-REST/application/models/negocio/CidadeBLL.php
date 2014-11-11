<?php

namespace models\negocio;

use models\entidades\Cidade;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

class CidadeBLL extends BaseBLL{
    
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\Cidade';
        parent::__construct();
    }
    
    public function buscarPorEstadoComNucleo($estado){
        $query = $this->em->createQuery("SELECT c FROM " . $this->nomeEntidade . " c 
                                            JOIN c.enderecos en
                                            JOIN en.nucleo n 
                                         WHERE c.estado = ".((int)$estado));

        return $query->getResult(Query::HYDRATE_OBJECT);
    }
    
}

?>
