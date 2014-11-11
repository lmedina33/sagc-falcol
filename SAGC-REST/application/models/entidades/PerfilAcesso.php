<?php

namespace models\entidades;

/**
 * @Entity @Table(name="PerfilAcesso")
 **/
class PerfilAcesso extends Entidade {
    
    /**
     * @Column(type="string", length=100, nullable=true)
     */
    protected $nome;
    
    /**
     * @Column(type="array", nullable=true)
     */
    protected $permissoesAcesso;
    
    /**
     * @Column(type="array", nullable=true)
     */
    protected $permissoesModificacao;
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getPermissoesAcesso() {
        return $this->permissoesAcesso;
    }

    public function setPermissoesAcesso($permissoesAcesso) {
        $this->permissoesAcesso = $permissoesAcesso;
    }
    
    public function getPermissoesModificacao() {
        return $this->permissoesModificacao;
    }

    public function setPermissoesModificacao($permissoesModificacao) {
        $this->permissoesModificacao = $permissoesModificacao;
    }
}

?>