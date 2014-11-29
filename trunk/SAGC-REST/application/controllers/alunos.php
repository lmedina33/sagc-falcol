<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use models\negocio\AlunoBLL;
use models\negocio\EstadoBLL;
use models\negocio\CidadeBLL;
use models\negocio\PerfilAcessoBLL;
use models\entidades\Aluno;
use models\entidades\Estado;
use models\entidades\Cidade;
use models\entidades\Endereco;

class Alunos extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['menuAtivo'][] = 'administracao';
        $this->data['menuAtivo'][] = 'administracao/alunos';
    }

    public function index() {
        if (!$this->usuarioLogado->temPermissao('administracao/alunos')) {
            exit;
        }

        

        $alunoBLL = new AlunoBLL();
        $filtro = array();

        $page = 0;

        if (!empty($_GET['per_page']) && is_numeric($_GET['per_page'])) {
            $page = $_GET['per_page'];
        }

        if (isset($_GET['nome'])) {
            $filtro['nome'] = $_GET["nome"];
        }


        $alunos = $alunoBLL->buscarTodos();
        
        
        //$this->config->load("pagination");
        $this->load->library('pagination');
        
        $config['total_rows'] = count($alunos);

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

        $config['base_url'] = site_url('alunos/index?' . http_build_query($get));
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);
        $this->data['alunos'] = $alunos;
        $this->view('alunos/listar');
    }

    public function excluir() {
        if (!$this->usuarioLogado->temPermissao('administracao/alunos', true)) {
            exit;
        }

        $result = array('erro' => false);

        try {
            $alunoBLL = new AlunoBLL();
            $alunoBLL->removerPorId($_POST['id']);
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
        if (!$this->usuarioLogado->temPermissao('administracao/alunos', true)) {
            exit;
        }

        $estadoBLL = new EstadoBLL();
        

        if (!empty($_POST)) {
            $cadastro = $this->novoAction();
            $this->data["erro"] = $cadastro["erro"];
            $this->data["mensagem"] = $cadastro["mensagem"];
            //if (!$this->data["erro"]) {
                //unset($_POST);
                //redirect('alunos?sucesso=true&mensagem=' . urlencode($this->data["mensagem"]));
                die(json_encode($cadastro));
            //}
        }
        $this->data["estados"] = $estadoBLL->buscarTodos();
        $this->data["cidades"] = array();


        if (!empty($_POST["estadoId"])) {
            $estado = $estadoBLL->buscarPorId($_POST["estadoId"]);
            $this->data['cidades'] = $estado->getCidades();
        }

        $this->view('alunos/novo');
    }

    private function novoAction() {
        if (!$this->usuarioLogado->temPermissao('administracao/alunos', true)) {
            exit;
        }
        $cidadeBLL = new CidadeBLL();
        $alunoBLL = new AlunoBLL();                


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
            $alunosComCnhIgual = $alunoBLL->buscarPor(array('cpf' => $_POST['cpf']));
            if (count($alunosComCnhIgual) > 0) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> Já existe um usuário cadastrado com este CPF.";
                return $result;
            }
        }
        if (empty($_POST['cnhNumero'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o CNH.";
            return $result;
        }      
               
        if (!empty($_POST["cnhNumero"])) {
            $alunosComCnhIgual = $alunoBLL->buscarPor(array('cnh' => $_POST['cnhNumero']));
            if (count($alunosComCnhIgual) > 0) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> Já existe um usuário cadastrado com este CNH.";
                return $result;
            }
        }        
        if (empty($_POST['email'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o email.";
            return $result;
        }
        if (!empty($_POST['email'])) {
            $alunosComEmailIgual = $alunoBLL->buscarPor(array('email' => $_POST['email']));
            if (count($alunosComEmailIgual) > 0) {
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
        

        try {

            $aluno = new Aluno();
            
            if(!empty($_POST['foto'])){
                $aluno->setFoto($_POST['foto']);                
            }
            $aluno->setNome($_POST['nome']);
            $aluno->setEmail($_POST['email']);
            $aluno->setDataNascimento(dataStrObject($_POST['dataNascimento']));
            
            $aluno->setTelefone($_POST['telefone']);
            $aluno->setCelular($_POST['celular']);            
            $aluno->setCpf($_POST['cpf']);
            $aluno->setRg($_POST['rgNumero']);
            $aluno->setRgOrgaoEmissor($_POST['rgOrgaoEmissor']);
            $aluno->setCnh($_POST['cnhNumero']);
            $aluno->setCnhCategoria($_POST['cnhCategoria']);
            
            if(!empty($_POST['cooperativa'])){
                $aluno->setCooperativa($_POST['cooperativa']);
            }else{
                $aluno->setCooperativa(false);
            }
            
            if(!empty($_POST['cooperativaNome'])){
                $aluno->setCooperativaNome($_POST['cooperativaNome']);
            }
            

            $endereco = new Endereco();
            $endereco->setCep($_POST["cep"]);
            $endereco->setLogradouro($_POST["logradouro"]);
            $endereco->setNumero($_POST["numero"]);
            $endereco->setBairro($_POST["bairro"]);
            $endereco->setComplemento($_POST["complemento"]);

            $cidade = $cidadeBLL->buscarPorId($_POST["cidadeId"]);
            $endereco->setCidade($cidade);

            $aluno->setEndereco($endereco);


            $this->doctrine->em->flush();

            $result["erro"] = false;
            $result["mensagem"] = "Usuário cadastrado.";

            return $result;
        } catch (\Exception $ex) {
            $result['mensagem'] = "Exception: ".$ex->getMessage();
            return $result;
        }
    }

    public function editar($id) {
        if (!$this->usuarioLogado->temPermissao('administracao/alunos')) {
            exit;
        }

        $alunosBLL = new AlunoBLL();
        $estadoBLL = new EstadoBLL();
        $perfilBLL = new PerfilAcessoBLL();        
        

        $aluno = $alunosBLL->buscarPorId($id);

        if (!empty($_POST)) {
            $cadastro = $this->editarAction($aluno);
            $this->data["mensagem"] = $cadastro["mensagem"];
            $this->data["erro"] = $cadastro["erro"];
            if (!$this->data["erro"]) {
                unset($_POST);
            }
            die(json_encode($cadastro));
        }

        $this->data["aluno"] = $aluno;
        $this->data["estados"] = $estadoBLL->buscarTodos();
        $this->data["estadoId"] = $aluno->getEndereco()->getCidade()->getEstado()->getId();
        $this->data["cidades"] = $aluno->getEndereco()->getCidade()->getEstado()->getCidades();
        $this->data["cidadeId"] = $aluno->getEndereco()->getCidade()->getId();        

        $this->data["perfisAcesso"] = $perfilBLL->buscarTodos();

        $this->view('alunos/editar');
    }

    private function editarAction(Aluno $aluno) {
        if (!$this->usuarioLogado->temPermissao('administracao/alunos')) {
            exit;
        }
        $cidadeBLL = new CidadeBLL();
        $alunoBLL = new AlunoBLL();
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
            if ($_POST["cpf"] != $aluno->getCpf()) {
                $alunosComCpfIgual = $alunoBLL->buscarPor(array('cpf' => $_POST['cpf']));
                if (count($alunosComCpfIgual) > 0) {
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
            if ($aluno->getEmail() != $_POST['email']) {
                $alunosComEmailIgual = $alunoBLL->buscarPor(array('email' => $_POST['email']));
                if (count($alunosComEmailIgual) > 0) {
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
       

        try {
            if(!empty($_POST['foto'])){
                $aluno->setFoto($_POST['foto']);                
            }            
            $aluno->setNome($_POST['nome']);
            $aluno->setEmail($_POST['email']);            
            $aluno->setDataNascimento(dataStrObject($_POST['dataNascimento']));            
            $aluno->setCpf($_POST['cpf']);            
            $aluno->setTelefone($_POST['telefone']);
            $aluno->setCelular($_POST['celular']);
            $aluno->setRg($_POST['rgNumero']);
            $aluno->setRgOrgaoEmissor($_POST['rgOrgaoEmissor']);
            $aluno->setCnh($_POST['cnhNumero']);
            $aluno->setCnhCategoria($_POST['cnhCategoria']);
            
            if(!empty($_POST['cooperativa'])){
                $aluno->setCooperativa($_POST['cooperativa']);
            }else{
                $aluno->setCooperativa(false);
            }
            
            if(!empty($_POST['cooperativaNome'])){
                $aluno->setCooperativaNome($_POST['cooperativaNome']);
            }

            $aluno->getEndereco()->setCep($_POST["cep"]);
            $aluno->getEndereco()->setLogradouro($_POST["logradouro"]);
            $aluno->getEndereco()->setNumero($_POST["numero"]);
            $aluno->getEndereco()->setBairro($_POST["bairro"]);
            if(!empty($_POST['complemento'])){
                $aluno->getEndereco()->setComplemento($_POST["complemento"]);
            }            

            $cidade = $cidadeBLL->buscarPorId($_POST["cidadeId"]);
            $aluno->getEndereco()->setCidade($cidade);            

            $this->doctrine->em->flush();

            $result["erro"] = false;
            $result["mensagem"] = "<strong>Sucesso!</strong> Cadastro atualizado.";
            return $result;
        } catch (\Exception $ex) {
            
            $result["mensagem"] = "Exception: ".$ex->getMessage(); 
            return $result;
        }
    }

    public function recortarRedimensionarFotoJson() {
        try {
            require_once(APPPATH . 'libraries/WideImage/lib/WideImage.php');

            $arquivo = './././uploads/alunos/' . $_POST['filename'];

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

}
