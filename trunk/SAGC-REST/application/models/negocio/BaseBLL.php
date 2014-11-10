<?php

namespace models\negocio;

use Doctrine,
    Doctrine\ORM\Tools\Pagination\Paginator,
    models\entidades\Entidade;

class BaseBLL {

    protected $db;
    protected $em;
    protected $nomeEntidade;

    public function __construct() {
        get_instance()->load->database();
        $this->db = & get_instance()->db;
        $this->em = Doctrine::$ems;
    }

    public function remover(Entidade $entidade) {
        $this->em->remove($entidade);
    }

    public function removerPorId($id) {
        $entidade = $this->buscarPorId($id);
        $this->em->remove($entidade);
    }

    public function buscarTodos() {
        return $this->em->getRepository($this->nomeEntidade)->findAll();
    }
    
    public function buscarTodosPaginado($offset = 0, $quantidade = 0, $ordem = null) {

        $dql = "SELECT e FROM " . $this->nomeEntidade . " e " . (is_null($ordem) ? '' : 'ORDER BY ' . $ordem);
        $query = $this->em->createQuery($dql)
                ->setFirstResult($offset)
                ->setMaxResults($quantidade);

        return new Paginator($query);
    }

    public function consultarPaginado($offset = 0, $quantidade = 0, $condicao = null, $ordem = null, $join = null) {

        if (!is_null($condicao)) {
            $condicao = " WHERE " . $condicao;
        }
        if (!is_null($join)) {
            $join = " " . $join . " ";
        }
        if (!is_null($ordem)) {
            $ordem = " ORDER BY " . $ordem;
        }

        $dql = "SELECT e FROM " . $this->nomeEntidade . " e $join $condicao $ordem";

        $query = $this->em->createQuery($dql)
                ->setFirstResult($offset)
                ->setMaxResults($quantidade);

        return new Paginator($query);
    }

    public function buscarPorId($id) {
        return $this->em->find($this->nomeEntidade, $id);
    }

    public function buscarPorIds($id) {
        return $this->em->getRepository($this->nomeEntidade)->findBy(array("id" => $id));
    }

    public function buscarPor($criterios, $ordem = null, $limit = null) {
        return $this->em->getRepository($this->nomeEntidade)->findBy($criterios, $ordem, $limit);
    }

    public function buscarUmPor($criterios) {
        return $this->em->getRepository($this->nomeEntidade)->findOneBy($criterios);
    }    
    
    
}
