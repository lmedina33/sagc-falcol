<?php

namespace models\Entity;

/**
 * @Entity @Table(name="Cidade")
 **/
class Cidade extends Entidade {
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $nome;
    /**
     * @ManyToOne(targetEntity="Estado")
     */
    protected $estado;
    /**
     * @OneToMany(targetEntity="Endereco", mappedBy="cidade")
     */
    protected $enderecos;
    /**
     * @OneToMany(targetEntity="Membro", mappedBy="cidadeNatal")
     */
    protected $nativos;
    
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
    public function getEnderecos() {
        return $this->enderecos;
    }

    public function setEnderecos($enderecos) {
        $this->enderecos = $enderecos;
    }    
    public function getNativos() {
        return $this->nativos;
    }

    public function setNativos($nativos) {
        $this->nativos = $nativos;
    }
}

?>