<?php

use models\entidades\Usuario;
use models\entidades\Endereco;

class Doctrine_tools extends CI_Controller {
    
    protected function checarAutenticacao(){}
    
    //Doctrine EntityManager
    public $em;

    function __construct() {
        parent::__construct();

        //Instantiate a Doctrine Entity Manager 
        $this->em = $this->doctrine->em;
    }

    function index() {
        echo 'Doctrine: Atualizar estrutura do banco de dados.<br /><br />
		<form action="" method="POST">
		Inserir Dados<input type="checkbox" name="dados" value="1"><br /><br />
		<input type="submit" name="action" value="Atualizar Banco"><br /><br />
                </form>';
        
        if ($this->input->post('action')) {
            try {
                $tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
                
                $classes = array(
                    $this->em->getClassMetadata('models\entidades\Endereco'),
                    $this->em->getClassMetadata('models\entidades\Cidade'),
                    $this->em->getClassMetadata('models\entidades\Estado'),                    
                    $this->em->getClassMetadata('models\entidades\PerfilAcesso'),
                    $this->em->getClassMetadata('models\entidades\Pessoa'),
                    $this->em->getClassMetadata('models\entidades\Usuario'),
                    $this->em->getClassMetadata('models\entidades\Turma'),
                    $this->em->getClassMetadata('models\entidades\Aluno'),
                    $this->em->getClassMetadata('models\entidades\Aula'),
                    $this->em->getClassMetadata('models\entidades\Presenca'),
                    $this->em->getClassMetadata('models\entidades\Log')
                );
                
                $tool->updateSchema($classes);
                
                $this->runTankAuthSchema();
               
                if(isset($_POST['dados'])){
                    $this->InserirDadosIniciais();
                }

                echo "Pronto!";
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }

    function InserirDadosIniciais()
    {
        $admin = new Usuario();
        $admin->setNome("Administrador");
        $admin->setDataNascimento(dataStrToObject("01/01/2014"));
        $admin->setTelefone("(81)8619-6629");
        $admin->setCelular("(81)8619-6629");
        $admin->setCpf("000.000.000-00");
        $admin->setEmail("lti@lti.net.br");
        $admin->setLogin("admin");
        $admin->setSenha("123456");
        
        $this->em->Persist($admin);

        $this->em->Flush();         
    }
    
    function runTankAuthSchema(){
        $this->db->query("
            CREATE TABLE IF NOT EXISTS ci_sessions (
              session_id varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
              ip_address varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
              user_agent varchar(150) COLLATE utf8_bin NOT NULL,
              last_activity int(10) unsigned NOT NULL DEFAULT '0',
              user_data text COLLATE utf8_bin NOT NULL,
              PRIMARY KEY (session_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
        ");
        $this->db->query("
            CREATE TABLE IF NOT EXISTS auth_login_attempts (
              id int(11) NOT NULL AUTO_INCREMENT,
              ip_address varchar(40) COLLATE utf8_bin NOT NULL,
              login varchar(50) COLLATE utf8_bin NOT NULL,
              time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (id)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
        ");
        $this->db->query("
            CREATE TABLE IF NOT EXISTS auth_user_autologin (
              key_id char(32) COLLATE utf8_bin NOT NULL,
              user_id int(11) NOT NULL DEFAULT '0',
              user_agent varchar(150) COLLATE utf8_bin NOT NULL,
              last_ip varchar(40) COLLATE utf8_bin NOT NULL,
              last_login timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (key_id,user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
        ");
        $this->db->query("
            CREATE TABLE IF NOT EXISTS auth_user_profiles (
              id int(11) NOT NULL AUTO_INCREMENT,
              user_id int(11) NOT NULL,
              country varchar(20) COLLATE utf8_bin DEFAULT NULL,
              website varchar(255) COLLATE utf8_bin DEFAULT NULL,
              PRIMARY KEY (id)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
        ");
        
        $this->db->query("
            ALTER TABLE auth_users
            ADD  activated TINYINT( 1 ) NOT NULL DEFAULT  '1',
            ADD  banned TINYINT( 1 ) NOT NULL DEFAULT  '0',
            ADD  ban_reason VARCHAR( 255 ) NULL ,
            ADD  new_password_key VARCHAR( 50 ) NULL DEFAULT NULL ,
            ADD  new_password_requested DATETIME NULL DEFAULT NULL ,
            ADD  new_email VARCHAR( 100 ) NULL DEFAULT NULL ,
            ADD  new_email_key VARCHAR( 50 ) NULL DEFAULT NULL ,
            ADD  last_ip VARCHAR( 40 ) NOT NULL ,
            ADD  last_login DATETIME NOT NULL DEFAULT  '0000-00-00 00:00:00',
            ADD  created DATETIME NOT NULL DEFAULT  '0000-00-00 00:00:00',
            ADD  modified TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00';
        ");
    }    
    
}