<?php

namespace models\entidades;

/**
 * @Entity @Table(name="Log")
 * */
class Log extends Entidade {

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $entidadeId;

    /**
     * @Column(type="string", length=250, nullable=false)
     */
    protected $entidade;

    /**
     * @Column(type="integer", nullable=true)
     */
    protected $usuarioId;

    /**
     * @Column(type="string", length=250, nullable=false)
     */
    protected $ip;

    /**
     * @Column(type="text", nullable=false)
     */
    protected $log;

    public function getEntidadeId() {
        return $this->entidadeId;
    }

    public function setEntidadeId($entidadeId) {
        $this->entidadeId = $entidadeId;
    }

    public function getEntidade() {
        return $this->entidade;
    }

    public function setEntidade($entidade) {
        $this->entidade = $entidade;
    }
    
    public function getUsuarioId() {
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId) {
        $this->usuarioId = $usuarioId;
    }

    public function getIp() {
        return $this->ip;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function getLog() {
        return $this->log;
    }

    public function setLog($log) {
        $this->log = $log;
    }
}
