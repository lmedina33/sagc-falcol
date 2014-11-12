<?php

namespace models\entidades;

/**
 * @Entity @Table(name="auth_users")
 **/
class Usuario extends Entidade {
    
    /**
     * @Column(name="nome", type="string", length=50, nullable=false)
     */
    protected $nome;
    
    /**
     * @Column(type="date", nullable=false)
     */
    protected $dataNascimento;
    
    /**
     * @Column(type="string",length=15,nullable=true)
     */
    protected $cpf;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $telefone;
    
    /**
     * @Column(type="string", nullable=true)
     */
    protected $celular;    
       
    /**
     * @Column(name="username", type="string", length=50, nullable=false)
     */
    protected $login;
    
    /**
     * @Column(name="password", type="string", length=255, nullable=false)
     */
    protected $senha;
    
    /**
     * @Column(name="email", type="string", length=100, nullable=false)
     */    
    protected $email;
    /**
     * @ManyToOne(targetEntity="PerfilAcesso")
     */
    protected $perfilAcesso;
    
    /**
     * @OneToOne(targetEntity="Endereco")
     */
    protected $endereco;
    
    

    public function __construct() {
        parent::__construct();
        $this->estabelecimento = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    
    function getCpf() {
        return $this->cpf;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }
        
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }
    
    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCelular() {
        return $this->celular;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getEstabelecimentos() {
        return $this->estabelecimentos;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    
    
    public function setSenha($senha) {
        require_once(APPPATH.'libraries/phpass-0.1/PasswordHash.php');
        
        $this->ci =& get_instance();
        
        $hasher = new \PasswordHash(
            $this->ci->config->item('phpass_hash_strength', 'tank_auth'),
            $this->ci->config->item('phpass_hash_portable', 'tank_auth'));
        $this->senha = $hasher->HashPassword($senha);
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPerfilAcesso() {
        return $this->perfilAcesso;
    }

    public function setPerfilAcesso($perfilAcesso) {
        $this->perfilAcesso = $perfilAcesso;
    }
    
    public function temPermissao($funcao, $edicao = false){
        
        //return true; //TODO: remover 
        return true;
        if($edicao){ //Modificação
            $permissoesModificacao = $this->getPerfilAcesso()->getPermissoesModificacao();            
            return in_array($funcao, (is_null($permissoesModificacao)? array() : $permissoesModificacao));
        }
        else{ //Acesso
            $permissoesAcesso = $this->getPerfilAcesso()->getPermissoesAcesso();      
            return in_array($funcao, (is_null($permissoesAcesso)? array() : $permissoesAcesso));
        }
    }
}

?>