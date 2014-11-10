<?php

namespace models\negocio;

use models\entidades\Usuario;
use Doctrine\ORM\EntityManager;
use Doctrine;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UsuarioBLL extends BaseBLL {
    
    public function __construct(){
        $this->nomeEntidade = 'models\entidades\Usuario';
        parent::__construct();
    }
    
    public function buscarPorPrefeitura($prefeituraId) {
        return $this->em->getRepository($this->nomeEntidade)->findBy(array("prefeitura" => $prefeituraId));
    }
    
    public function pesquisar($offset,$quantidade,$filtro){
        
        $condicao='';
        
        if(isset($filtro['nome'])){
            $condicao .= " AND e.nome like '%".$filtro['nome']."%'";           
        }
        if(isset($filtro['prefeituraId'])){
            $condicao .= " AND p.id =".$filtro['prefeituraId'];
        }
        
        $dql = "SELECT e FROM " . $this->nomeEntidade . " e join e.prefeitura p where 1=1 $condicao ORDER BY e.nome";    
        
        $query = $this->em->createQuery($dql)
                ->setFirstResult($offset)
                ->setMaxResults($quantidade);
        
        return new Paginator($query);
    }
    
}

?>
