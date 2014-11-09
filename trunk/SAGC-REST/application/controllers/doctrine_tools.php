<?php


class Doctrine_tools extends CI_Controller {

    protected function checarAutenticacao() {
        
    }

    //Doctrine EntityManager
    public $em;

    function __construct() {
        parent::__construct();

        //Instantiate a Doctrine Entity Manager 
        $this->em = $this->doctrine->em;
        $this->load->database();
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
                    $this->em->getClassMetadata('models\entidades\Usuario'),
                );

                $tool->updateSchema($classes);

                //$this->runTankAuthSchema();

                if (isset($_POST['dados'])) {
                    $this->InserirDadosIniciais();
                }

                $this->runTankAuthSchema();

                echo "Pronto!";
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }

    function InserirDadosIniciais() {

        $estado = new Estado();
        $estado->setNome("Pernanbuco");
        $estado->setUf("PE");
        $this->em->Persist($estado);        
        $cidade = new Cidade();
        $cidade->setNome("Vitória de Santo Antão");
        $cidade->setEstado($estado);
        $this->em->Persist($cidade);
        
       
        $end = new Endereco();
        $end->setLogradouro("Rua Jardim Betânia");
        $end->setNumero("75");
        $end->setBairro("Livramento");
        $end->setCidade($cidade);
        $this->em->Persist($end);
        $root = new Usuario();
        $root->setNome("Carlos Eduardo de Souza Lima");
        $root->setMaster(true);
        $root->setFuncao("Gerente");
        $root->setEscolaridade("Sup imcompleto");
        $root->setEmail("dolalima@gmail.com");
        $root->setCpf("070.058.184-74");
        $root->setRg("7.153.203");
        $root->setCarteiraTrabalho("26542315654");
        $root->setDataNascimento(new DateTime());
        $root->setLogin("dolalima");
        $root->setSenha("lima1807");
        $root->setEndereco($end);
        $this->em->Persist($root);

        $this->em->Flush();

        $this->runTankAuthSchema();
    }

    function runTankAuthSchema() {
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
