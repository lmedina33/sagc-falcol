<?php

namespace models\negocio;

use Doctrine,
    Doctrine\ORM\Query,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Tools\Pagination\Paginator,
    models\entidades\Entidade;

class BaseBLL {
    protected $db;
    protected $em;
    protected $nomeEntidade;

    public function __construct(){
        get_instance()->load->database();
        $this->db =& get_instance()->db;
        $this->em = Doctrine::$ems;
    }

    public function incluir(Entidade $entidade){
        $this->em->persist($entidade);
    }

    public function remover(Entidade $entidade){
        //$entidade->setExcluido(true);
        $this->em->remove($entidade);
    }

    public function removerPorId($id){
        $entidade = $this->buscarPorId($id);
        $this->em->remove($entidade);
    }

    public function buscarTodos(){
        return $this->em->getRepository($this->nomeEntidade)->findAll();
    }

    public function buscarTodosPaginado($offset = 0, $quantidade = 0){
        $dql = "SELECT e FROM ".$this->nomeEntidade." e";
        $query = $this->em->createQuery($dql)
                       ->setFirstResult($offset)
                       ->setMaxResults($quantidade);

        return new Paginator($query);
    }

    public function consultarPaginado($offset = 0, $quantidade = 0, $condicao = null, $ordem = null, $join = null){

        if(!is_null($condicao))
        {
            $condicao = " WHERE ".$condicao;
        }
        if(!is_null($join))
        {
            $join = " ".$join." ";
        }
        if(!is_null($ordem))
        {
            $ordem = " ORDER BY ".$ordem;
        }

        $dql = "SELECT e FROM " . $this->nomeEntidade . " e $join $condicao $ordem";
        
        $query = $this->em->createQuery($dql)
                               ->setFirstResult($offset)
                               ->setMaxResults($quantidade);

        return new Paginator($query);
    }

    public function buscarPorId($id){
        return $this->em->find($this->nomeEntidade, $id);
    }

    public function buscarPorIds($id){
        return $this->em->getRepository($this->nomeEntidade)->findBy(array("id" => $id));
    }

    public function buscarPor($criterios, $ordem = null, $limit = null){
        return $this->em->getRepository($this->nomeEntidade)->findBy($criterios, $ordem, $limit);
    }

    public function buscarUmPor($criterios){
        return $this->em->getRepository($this->nomeEntidade)->findOneBy($criterios);
    }

    //protected function ConsultarTodos($nomeEntidade, $ordem = null)
    protected function ConsultarTodos($ordem = null)
    {
        return $this->Consultar(null, $ordem);
    }

    public function consultar($condicao = null, $ordem = null, $join = null)
    {
        if(!is_null($condicao))
        {
            $condicao = " WHERE ".$condicao;
        }
        if(!is_null($ordem))
        {
            $ordem = " ORDER BY ".$ordem;
        }
        if(!is_null($join))
        {
            $join = " ".$join." ";
        }

        $query = $this->em->createQuery("SELECT e FROM " . $this->nomeEntidade . " e $join $condicao $ordem");

        return $query->getResult(Query::HYDRATE_OBJECT);
    }

    public function query($query, $quantidade = null)
    {
        $query = $this->em->createQuery($query);

        if(!is_null($quantidade))
        {
            $query->setMaxResults($quantidade);
        }

        return $query->getResult(Query::HYDRATE_OBJECT);
    }
    
    public function querySql($sql){
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function queryPaginado($dql, $offset = 0, $quantidade = 0){
        $query = $this->em->createQuery($dql)
                               ->setFirstResult($offset)
                               ->setMaxResults($quantidade);

        return new Paginator($query);
    }

    protected function queryUnico($query)
    {
        $query = $this->em->createQuery($query);
        return $query->getSingleResult(Query::HYDRATE_OBJECT);
    }

    protected function QueryUnicoEscalar($query)
    {
        $query = $this->em->createQuery($query);
        return $query->getSingleScalarResult();
    }

    public function commit(){
        $this->em->flush();
    }
}