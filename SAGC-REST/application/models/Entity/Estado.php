<?php

namespace models\Entity;

/**
 * @Entity @Table(name="Estado")
 **/
class Estado extends Entidade {
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $nome;
    /**
     * @Column(type="string", length=2, nullable=true)
     */
    protected $uf;
    /**
     * @OneToMany(targetEntity="Cidade", mappedBy="estado")
     */
    protected $cidades;
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getUf() {
        return $this->uf;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }
    
    public function getCidades() {
        return $this->cidades;
    }

    public function setCidades($cidades) {
        $this->cidades = $cidades;
    }
}

?>