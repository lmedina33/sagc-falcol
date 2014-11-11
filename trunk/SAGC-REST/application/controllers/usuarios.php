<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use models\negocio\UsuarioBLL;
use models\negocio\EstadoBLL;
use models\negocio\CidadeBLL;
use models\negocio\PerfilAcessoBLL;
use models\entidades\Usuario;
use models\entidades\Estado;
use models\entidades\Cidade;
use models\entidades\Endereco;

class Usuarios extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['menuAtivo'][] = 'administracao';
        $this->data['menuAtivo'][] = 'administracao/usuarios';
    }

    public function index() {
        if (!$this->usuarioLogado->temPermissao('administracao/usuarios')) {
            exit;
        }

        

        $usuarioBLL = new UsuarioBLL();
        $filtro = array();

        $page = 0;

        if (!empty($_GET['per_page']) && is_numeric($_GET['per_page'])) {
            $page = $_GET['per_page'];
        }

        if (isset($_GET['nome'])) {
            $filtro['nome'] = $_GET["nome"];
        }


        $usuarios = $usuarioBLL->buscarTodos();
        
        
        //$this->config->load("pagination");
        $this->load->library('pagination');
        
        $config['total_rows'] = count($usuarios);

        $get = $_GET;
        unset($get['per_page']);

        $config['full_tag_open'] = '<div class="btn-group">';
        $config['full_tag_close'] = '</div><!--pagination-->';

        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fa fa-arrow-circle-right"></i>';
        $config['next_tag_open'] = '<li class="btn btn-default">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-arrow-circle-left"></i>';
        $config['prev_tag_open'] = '<li class="btn btn-default">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="btn btn-default active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="btn btn-default">';
        $config['num_tag_close'] = '</li>';

        $config['base_url'] = site_url('usuarios/index?' . http_build_query($get));
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);
        $this->data['usuarios'] = $usuarios;
        $this->view('usuarios/listar');
    }

    public function excluir() {
        if (!$this->usuarioLogado->temPermissao('administracao/usuarios', true)) {
            exit;
        }

        $result = array('erro' => false);

        try {
            $usuarioBLL = new UsuarioBLL();
            $usuarioBLL->removerPorId($_POST['id']);
            $this->doctrine->em->flush();

            $result['mensagem'] = "Usuário removido!";

            die(json_encode($result));
        } catch (\Exception $ex) {
            $result['erro'] = true;
            $result['mensagem'] = "O usuário não pode ser excluído, pois, existe vínculos com outras entidades.";

            die(json_encode($result));
        }
    }

    public function novo() {
        if (!$this->usuarioLogado->temPermissao('administracao/usuarios', true)) {
            exit;
        }

        $estadoBLL = new EstadoBLL();
        $perfilBLL = new PerfilAcessoBLL();        

        if (!empty($_POST)) {
            $cadastro = $this->novoAction();
            $this->data["erro"] = $cadastro["erro"];
            $this->data["mensagem"] = $cadastro["mensagem"];
            if (!$this->data["erro"]) {
                unset($_POST);
                redirect('usuarios?sucesso=true&mensagem=' . urlencode($this->data["mensagem"]));
            }
        }
        $this->data["estados"] = $estadoBLL->buscarTodos();                


        if (!empty($_POST["estadoId"])) {
            $estado = $estadoBLL->buscarPorId($_POST["estadoId"]);
            $this->data['cidades'] = $estado->getCidades();
        }

        $this->view('usuarios/novo');
    }

    private function novoAction() {
        if (!$this->usuarioLogado->temPermissao('administracao/usuarios', true)) {
            exit;
        }
        $cidadeBLL = new CidadeBLL();
        $usuarioBLL = new UsuarioBLL();                


        $result = array("erro" => false);
        

        

        if (empty($_POST['nome'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o nome do usuário.";
            return $result;
        }
        if (empty($_POST['dataNascimento'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha data de nascimento.";
            return $result;
        }
        if (empty($_POST['cpf'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o CPF.";
            return $result;
        }
        
        if (!validaCPF($_POST["cpf"])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> CPF inválido.";
            return $result;
        }

        if (!empty($_POST["cpf"])) {
            $usuariosComCpfIgual = $usuarioBLL->buscarPor(array('cpf' => $_POST['cpf']));
            if (count($usuariosComCpfIgual) > 0) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> Já existe um usuário cadastrado com este CPF.";
                return $result;
            }
        }
        if (empty($_POST['email'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o email.";
            return $result;
        }
        if (!empty($_POST['email'])) {
            $usuariosComEmailIgual = $usuarioBLL->buscarPor(array('email' => $_POST['email']));
            if (count($usuariosComEmailIgual) > 0) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> Já existe um usuário cadastrado com este email.";
                return $result;
            }
        }
        if (empty($_POST['logradouro'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o logradouro do Usuário.";
            return $result;
        }
        if (empty($_POST['bairro'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o bairro do Usuário.";
            return $result;
        }
        if (empty($_POST['cidadeId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Selecione a cidade do Usuário.";
            return $result;
        }
        if (empty($_POST['login'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o login do Usuário.";
            return $result;
        } else {
            $lista = $usuarioBLL->buscarPor(array("login" => $_POST['login']));
            if (count($lista) > 0) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> Login utilizado por outro usuario";
                return $result;
            }
        }
        if (empty($_POST['senha'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a senha do Usuário.";
            return $result;
        }
        if (empty($_POST['senhaConfirmacao'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha novamente a senha do Usuário da Valicação .";
            return $result;
        }
        if (!empty($_POST['senhaConfirmacao']) & !empty($_POST['senha'])) {
            if ($_POST['senha'] != $_POST['senhaConfirmacao']) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> A senha fornecida não confere.";
                return $result;
            }
        }        
        

        try {

            $usuario = new Usuario();

            
            $usuario->setNome($_POST['nome']);
            $usuario->setEmail($_POST['email']);
            $usuario->setDataNascimento(dataStrObject($_POST['dataNascimento']));

            
            $usuario->setTelefone($_POST['telefone']);
            $usuario->setCelular($_POST['celular']);            
            $usuario->setCpf($_POST['cpf']);
            $usuario->setLogin($_POST['login']);
            $usuario->setSenha($_POST['senha']);

            $endereco = new Endereco();
            $endereco->setCep($_POST["cep"]);
            $endereco->setLogradouro($_POST["logradouro"]);
            $endereco->setNumero($_POST["numero"]);
            $endereco->setBairro($_POST["bairro"]);
            $endereco->setComplemento($_POST["complemento"]);

            $cidade = $cidadeBLL->buscarPorId($_POST["cidadeId"]);
            $endereco->setCidade($cidade);

            $usuario->setEndereco($endereco);


            $this->doctrine->em->flush();

            $result["erro"] = false;
            $result["mensagem"] = "Usuário cadastrado.";

            return $result;
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function editar($id) {
        if (!$this->usuarioLogado->temPermissao('administracao/usuarios')) {
            exit;
        }

        $usuariosBLL = new UsuarioBLL();
        $estadoBLL = new EstadoBLL();
        $perfilBLL = new PerfilAcessoBLL();        
        

        $usuario = $usuariosBLL->buscarPorId($id);

        if (!empty($_POST)) {
            $cadastro = $this->editarAction($usuario);
            $this->data["mensagem"] = $cadastro["mensagem"];
            $this->data["erro"] = $cadastro["erro"];
            if (!$this->data["erro"]) {
                unset($_POST);
            }
            die(json_encode($cadastro));
        }

        $this->data["usuario"] = $usuario;
        $this->data["estados"] = $estadoBLL->buscarTodos();
        $this->data["estadoId"] = $usuario->getEndereco()->getCidade()->getEstado()->getId();
        $this->data["cidades"] = $usuario->getEndereco()->getCidade()->getEstado()->getCidades();
        $this->data["cidadeId"] = $usuario->getEndereco()->getCidade()->getId();        

        $this->data["perfisAcesso"] = $perfilBLL->buscarTodos();

        $this->view('usuarios/editar');
    }

    private function editarAction($usuario) {
        if (!$this->usuarioLogado->temPermissao('administracao/usuarios')) {
            exit;
        }
        $cidadeBLL = new CidadeBLL();
        $usuarioBLL = new UsuarioBLL();
        $perfisAcessoBLL = new PerfilAcessoBLL();        

        $senhaValida = false;

        $result = array("erro" => false);

        
        if (empty($_POST['nome'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o nome do usuário.";
            return $result;
        }

        if (empty($_POST['dataNascimento'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha data de nascimento.";
            return $result;
        }

        if (empty($_POST['cpf'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o CPF.";
            return $result;
        }
        if (!validaCPF($_POST["cpf"])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> CPF inválido.";
            return $result;
        }
        if (!empty($_POST["cpf"])) {
            if ($_POST["cpf"] != $usuario->getCpf()) {
                $usuariosComCpfIgual = $usuarioBLL->buscarPor(array('cpf' => $_POST['cpf']));
                if (count($usuariosComCpfIgual) > 0) {
                    $result["erro"] = true;
                    $result["mensagem"] = "<strong>Erro!</strong> Já existe um usuário cadastrado com este CPF.";
                    return $result;
                }
            }
        }
        if (empty($_POST['email'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o email.";
            return $result;
        }
        if (!empty($_POST['email'])) {
            if ($usuario->getEmail() != $_POST['email']) {
                $usuariosComEmailIgual = $usuarioBLL->buscarPor(array('email' => $_POST['email']));
                if (count($usuariosComEmailIgual) > 0) {
                    $result["erro"] = true;
                    $result["mensagem"] = "<strong>Erro!</strong> Já existe um usuário cadastrado com este email.";
                    return $result;
                }
            }
        }
        if (empty($_POST['logradouro'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o logradouro do Usuário.";
            return $result;
        }
        if (empty($_POST['bairro'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o bairro do Usuário.";
            return $result;
        }
        if (empty($_POST['cidadeId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Selecione a cidade do Usuário.";
            return $result;
        }
        if (!empty($_POST['cidadeId']) & ($_POST['cidadeId']) == "") {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Selecione a cidade do Usuário.";
            return $result;
        }
        if (empty($_POST['login'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o login do Usuário.";
            return $result;
        } else {
            if ($usuario->getLogin() != $_POST["login"]) {
                $lista = $usuarioBLL->buscarPor(array("login" => $_POST['login']));
                if (count($lista > 0)) {
                    $result["erro"] = true;
                    $result["mensagem"] = "<strong>Erro!</strong> Login utilizado por outro usuario";
                    return $result;
                }
            }
        }
        if (!empty($_POST['senhaConfirmacao']) && !empty($_POST['senha'])) {
            if ($_POST['senha'] != $_POST['senhaConfirmacao']) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> A senha fornecida não confere.";
                return $result;
            } else {
                $senhaValida = true;
            }
        }        
       

        try {
            $usuario->setNome($_POST['nome']);
            $usuario->setEmail($_POST['email']);
            
            $usuario->setDataNascimento(dataStrObject($_POST['dataNascimento']));            
            $usuario->setCpf($_POST['cpf']);

            
            $usuario->setTelefone($_POST['telefone']);
            $usuario->setCelular($_POST['celular']);
            $usuario->setLogin($_POST['login']);

            if ($senhaValida) {
                $usuario->setSenha($_POST['senha']);
            }

            $usuario->getEndereco()->setCep($_POST["cep"]);
            $usuario->getEndereco()->setLogradouro($_POST["logradouro"]);
            $usuario->getEndereco()->setNumero($_POST["numero"]);
            $usuario->getEndereco()->setBairro($_POST["bairro"]);
            $usuario->getEndereco()->setComplemento($_POST["complemento"]);

            $cidade = $cidadeBLL->buscarPorId($_POST["cidadeId"]);
            $usuario->getEndereco()->setCidade($cidade);            

            $this->doctrine->em->flush();

            $result["erro"] = false;
            $result["mensagem"] = "<strong>Sucesso!</strong> Cadastro atualizado.";
            return $result;
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function recortarRedimensionarFotoJson() {
        try {
            require_once(APPPATH . 'libraries/WideImage/lib/WideImage.php');

            $arquivo = './././uploads/usuarios/' . $_POST['filename'];

            // Carrega a imagem
            $image = WideImage::load($arquivo);

            // Corta a imagem

            $height = $image->getHeight();
            $width = $image->getWidth();
            $image = $image->crop($_POST["left"], $_POST["top"], $width - $_POST["right"] - $_POST['left'], $height - $_POST['bottom'] - $_POST["top"]);

            // Redimensiona a imagem
            $image = $image->resize(150, 150, 'inside');

            // Salva a imagem substituindo a antiga
            $image->saveToFile($arquivo);

            // Limpa a imagem da memória
            $image->destroy();

            print json_encode(array('sucesso' => true));
        } catch (\Exception $ex) {
            print json_encode(array('mensagem' => $ex->getMessage(), 'sucesso' => false));
        }
    }

    public function trocarEntidadePublicaAtual($id) {
        $this->usuarioLogado->setEntidadePublicaAtualId($id);
        $this->doctrine->em->flush();

        redirect('inicio');
    }

}
