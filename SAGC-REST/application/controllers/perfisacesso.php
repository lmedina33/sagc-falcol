<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use models\negocio\PerfilAcessoBLL;
use models\entidades\PerfilAcesso;

class PerfisAcesso extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->data["menuAtivo"][] = "rh";
        $this->data["menuAtivo"][] = "perfisacesso";
    }

    public function index($page = 0) {
        if (!$this->usuarioLogado->temPermissao('perfisacesso')) {
            exit;
        }
        $perfilAcessoBLL = new PerfilAcessoBLL();

        $this->load->library('pagination');

        //$perfisAcesso = $perfilAcessoBLL->buscarTodosPaginado($page, $this->pagination->per_page);
        $perfisAcesso = $perfilAcessoBLL->consultarPaginado(0, 100000000000, NULL, 'e.nome');

        $config['base_url'] = site_url('perfisacesso/index');
        $config['total_rows'] = $perfisAcesso->count();

        $this->pagination->initialize($config);

        $this->data['perfisacesso'] = $perfisAcesso;

        $this->view('perfisacesso/index');
    }

    public function excluir() {
        if (!$this->usuarioLogado->temPermissao('perfisacesso', true)) {
            exit;
        }
        $result = array("erro" => true);
        $perfilAcessoBLL = new PerfilAcessoBLL();
        $id = $_POST["id"];

        try {
            $perfilAcessoBLL->removerPorId($id);
            $perfilAcessoBLL->commit();
            $result["mensagem"] = "Perfil excluído com sucesso.";
            $result["erro"] = false;
            die(json_encode($result));
        } catch (Exception $ex) {
            $perfil = $perfilAcessoBLL->buscarPorId($id);
            $result["mensagem"] = "O perfil " . $perfil->getNome() . " não pode ser excluído por possuir ligação com outras entidades do sistemas.";
            die(json_encode($result));
        }
    }

    public function novo() {
        if (!$this->usuarioLogado->temPermissao('perfisacesso', true)) {
            exit;
        }

        if (!empty($_POST)) {
            $cadastro = $this->novoAction();
            $this->data["erro"] = $cadastro["erro"];
            $this->data["mensagem"] = $cadastro["mensagem"];
            die(json_encode($cadastro));
        } else {
            $this->data["arvorePerfisAcesso"] = $this->arvorePerfisAcesso();
            $this->data["arvorePerfisModificacao"] = $this->arvorePerfisModificacao();
        }

        $this->view('perfisacesso/novo');
    }

    private function novoAction() {
        if (!$this->usuarioLogado->temPermissao('perfisacesso', true)) {
            exit;
        }
        $result = array("erro" => false);

        if (empty($_POST["nome"])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o campo nome.";
            return $result;
        }

        $perfilAcesso = new PerfilAcesso();
        $perfilAcesso->setNome($_POST["nome"]);
        $perfilAcesso->setPermissoesAcesso(explode(",", $_POST["permissoesAcesso"]));
        $perfilAcesso->setPermissoesModificacao(explode(",", $_POST["permissoesModificacao"]));

        $this->doctrine->em->persist($perfilAcesso);
        $this->doctrine->em->flush();

        $result["erro"] = false;
        $result["mensagem"] = "<strong>Sucesso!</strong> Cadastro realizado.";
        return $result;
    }

    public function editar($id) {
        if (!$this->usuarioLogado->temPermissao('perfisacesso', true)) {
            exit;
        }
        $perfilAcessoBLL = new PerfilAcessoBLL();

        $this->data["perfilacesso"] = $perfilAcessoBLL->buscarPorId($id);

        if (!empty($_POST)) {
            $cadastro = $this->editarAction($id);
            $this->data["erro"] = $cadastro["erro"];
            $this->data["mensagem"] = $cadastro["mensagem"];

            $this->data["arvorePerfisAcesso"] = $this->arvorePerfisAcesso(explode(",", $_POST["permissoesAcesso"]));
            $this->data["arvorePerfisModificacao"] = $this->arvorePerfisModificacao(explode(",", $_POST["permissoesModificacao"]));

            
            die(json_encode($cadastro));
        } else {
            $this->data["arvorePerfisAcesso"] = $this->arvorePerfisAcesso($this->data["perfilacesso"]->getPermissoesAcesso());
            $this->data["arvorePerfisModificacao"] = $this->arvorePerfisModificacao($this->data["perfilacesso"]->getPermissoesModificacao());
        }

        $this->view('perfisacesso/editar');
    }

    public function editarAction($id) {
        if (!$this->usuarioLogado->temPermissao('perfisacesso', true)) {
            exit;
        }
        $result = array("erro" => false);

        $perfilAcessoBLL = new PerfilAcessoBLL();

        if (empty($_POST["nome"])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o campo nome.";
            return $result;
        }

        $perfilAcesso = $perfilAcessoBLL->buscarPorId($id);

        $perfilAcesso->setNome($_POST["nome"]);
        $perfilAcesso->setPermissoesAcesso(explode(",", $_POST["permissoesAcesso"]));
        $perfilAcesso->setPermissoesModificacao(explode(",", $_POST["permissoesModificacao"]));

        $this->doctrine->em->flush();

        $result["erro"] = false;
        $result["mensagem"] = "<strong>Sucesso!</strong> Cadastro atualizado.";
        return $result;
    }

    private function arvorePerfisAcesso($permissoes = null) {

        $arrayPermissoes = array();

        if (!is_null($permissoes) && is_array($permissoes)) {
            $arrayPermissoes = $permissoes;
        }

        return '[
            {title: "Administração", isFolder: true, expand: false, children: [
                {title: "Usuários", key: "usuairos" ' . (in_array("usuarios", $arrayPermissoes) ? ", select: true" : "") . ' },
                {title: "Perfis de Acesso", key: "perfisdeacesso" ' . (in_array("perfisdeacesso", $arrayPermissoes) ? ", select: true" : "") . ' }                
            ]}            
        ]';
    }

    private function arvorePerfisModificacao($permissoes = null) {

        $arrayPermissoes = array();

        if (!is_null($permissoes) && is_array($permissoes)) {
            $arrayPermissoes = $permissoes;
        }

        return '[
            {title: "Administração", isFolder: true, expand: false, children: [
                {title: "Usuários", key: "usuairos" ' . (in_array("usuarios", $arrayPermissoes) ? ", select: true" : "") . ' },
                {title: "Perfis de Acesso", key: "perfisdeacesso" ' . (in_array("perfisdeacesso", $arrayPermissoes) ? ", select: true" : "") . ' }                
            ]}            
        ]';
    }

}

?>
