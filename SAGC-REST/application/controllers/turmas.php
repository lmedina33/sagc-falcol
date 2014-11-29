<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use models\entidades\Turma;
use models\entidades\Aluno;
use models\entidades\Aula;
use models\negocio\EstadoBLL;
use models\negocio\TurmaBLL;
use models\negocio\AlunoBLL;
use models\negocio\AulaBLL;

class Turmas extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['menuAtivo'][] = 'administracao';
        $this->data['menuAtivo'][] = 'administracao/turmas';
    }

    public function index() {

        if (!$this->usuarioLogado->temPermissao('administracao/turmas')) {
            exit;
        }

        $turmasBLL = new TurmaBLL();
        $filtro = array();

        $page = 0;

        if (!empty($_GET['per_page']) && is_numeric($_GET['per_page'])) {
            $page = $_GET['per_page'];
        }

        if (isset($_GET['nome'])) {
            $filtro['nome'] = $_GET["nome"];
        }

        $turmas = $turmasBLL->consultarPaginado($page, 20, null);


        //$this->config->load("pagination");
        $this->load->library('pagination');

        $config['total_rows'] = count($turmas);

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

        $config['base_url'] = site_url('turmas/index?' . http_build_query($get));
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);
        $this->data['turmas'] = $turmas;
        $this->view('turmas/listar');
    }

    public function novo() {
        if (!$this->usuarioLogado->temPermissao('administracao/turmas', true)) {
            exit;
        }

        $estadoBLL = new EstadoBLL();

        if (!empty($_POST)) {
            $cadastro = $this->novoAction();
            $this->data["erro"] = $cadastro["erro"];
            $this->data["mensagem"] = $cadastro["mensagem"];
            die(json_encode($cadastro));
        }
        $this->data["estados"] = $estadoBLL->buscarTodos();


        if (!empty($_POST["estadoId"])) {
            $estado = $estadoBLL->buscarPorId($_POST["estadoId"]);
            $this->data['cidades'] = $estado->getCidades();
        }

        $this->view('turmas/novo');
    }

    public function novoAction() {

        if (!$this->usuarioLogado->temPermissao('administracao/turmas', true)) {
            exit;
        }

        $result["erro"] = true;
        $result["mensagem"] = "";

        if (empty($_POST['codigo'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o codigo.";
            return $result;
        }

        if (empty($_POST['nome'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o nome.";
            return $result;
        }

        if (empty($_POST['ano'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o ano.";
            return $result;
        }

        if (empty($_POST['dataInicio'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o datda de inicio.";
            return $result;
        }

        if (empty($_POST['dataTermino'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o data de termino.";
            return $result;
        }

        if (empty($_POST['vagas'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as quantidade de vagas.";
            return $result;
        }

        if (empty($_POST['descricao'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a descrição.";
            return $result;
        }


        try {
            $turma = new Turma();
            $turma->setCodigo($_POST['codigo']);
            $turma->setNome($_POST['nome']);
            $turma->setAno($_POST['ano']);
            $turma->setDataInicio(dataStrToObject($_POST['dataInicio']));
            $turma->setDataTermino(dataStrToObject($_POST['dataTermino']));
            $turma->setVagas($_POST['vagas']);
            $turma->setDescricao($_POST['descricao']);
            $turma->getEncerrada(false);

            $this->doctrine->em->flush();

            $result['erro'] = false;
            $result['mesnsagem'] = "Turma cadastrada com sucesso!";

            return $result;
        } catch (Exception $ex) {

            $result['erro'] = true;
            $result['mensagem'] = $ex->getMessage();

            return $result;
        }
    }

    public function editar($id) {

        if (!$this->usuarioLogado->temPermissao('administracao/usuarios')) {
            exit;
        }

        $turmaBLL = new TurmaBLL();
        $alunoBLL = new AlunoBLL();


        $turma = $turmaBLL->buscarPorId($id);
        $alunos = $alunoBLL->buscarTodos();

        if (!empty($_POST)) {
            $cadastro = $this->editarAction($turma);
            $this->data["mensagem"] = $cadastro["mensagem"];
            $this->data["erro"] = $cadastro["erro"];
            if (!$this->data["erro"]) {
                unset($_POST);
            }
            die(json_encode($cadastro));
        }

        $this->data["turma"] = $turma;
        $this->data["alunos"] = $alunos;

        $this->view('turmas/editar');
    }

    public function editarAction(Turma $turma) {

        if (!$this->usuarioLogado->temPermissao('administracao/turmas', true)) {
            exit;
        }

        $result["erro"] = true;
        $result["mensagem"] = "";

        if (empty($_POST['codigo'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o codigo.";
            return $result;
        }

        if (empty($_POST['nome'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o nome.";
            return $result;
        }

        if (empty($_POST['ano'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o ano.";
            return $result;
        }

        if (empty($_POST['dataInicio'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o datda de inicio.";
            return $result;
        }

        if (empty($_POST['dataTermino'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o data de termino.";
            return $result;
        }

        if (empty($_POST['vagas'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as quantidade de vagas.";
            return $result;
        }

        if (empty($_POST['descricao'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a descrição.";
            return $result;
        }


        try {

            $turma->setCodigo($_POST['codigo']);
            $turma->setNome($_POST['nome']);
            $turma->setAno($_POST['ano']);
            $turma->setDataInicio(dataStrToObject($_POST['dataInicio']));
            $turma->setDataTermino(dataStrToObject($_POST['dataTermino']));
            $turma->setVagas($_POST['vagas']);
            $turma->setDescricao($_POST['descricao']);
            $turma->setEncerrada(false);

            $this->doctrine->em->flush();

            $result['erro'] = false;
            $result['mesnsagem'] = "Turma cadastrada com sucesso!";

            return $result;
        } catch (Exception $ex) {

            $result['erro'] = true;
            $result['mensagem'] = $ex->getMessage();

            return $result;
        }
    }

    public function addAula() {
        if (!$this->usuarioLogado->temPermissao('administracao/turmas', true)) {
            exit;
        }

        $result["erro"] = true;
        $result["mensagem"] = "";

        $turmaBLL = new TurmaBLL();

        if (empty($_POST['turmaId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as turmaId";
            die(json_encode($result));
        }

        $turma = $turmaBLL->buscarPorId($_POST['turmaId']);

        if (empty($_POST['data'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as data.";
            die(json_encode($result));
        }

        if (empty($_POST['inicio'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a hora de inicio.";
            die(json_encode($result));
        }

        if (empty($_POST['termino'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a hora de termino.";
            die(json_encode($result));
        }

        if (empty($_POST['cargaHoraria'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a carga horária.";
            die(json_encode($result));
        }

        if (empty($_POST['conteudo'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o conteúdo da aula.";
            die(json_encode($result));
        }

        try {
            $aula = new Aula();
            $aula->setData(dataStrToObject($_POST['data']));
            $aula->setConteudo($_POST['conteudo']);
            $aula->setInicio(dataStrObject("00/00/0000 " . $_POST['inicio']));
            $aula->setTermino(dataStrObject("00/00/0000 " . $_POST['termino']));
            $aula->setCargaHoraria($_POST['cargaHoraria']);
            $aula->setTurma($turma);

            $this->doctrine->em->flush();

            $result['erro'] = false;
            $result['mensagem'] = "<strong>Cadastrado com exito</strong>";

            die(json_encode($result));
        } catch (Exception $ex) {
            $result['mensagem'] = $ex->getMessage();
            die(json_encode($result));
        }
    }

    public function editAula() {
        if (!$this->usuarioLogado->temPermissao('administracao/turmas', true)) {
            exit;
        }

        $result["erro"] = true;
        $result["mensagem"] = "";

        $turmaBLL = new TurmaBLL();
        $aulaBLL = new AulaBLL();

        if (empty($_POST['turmaId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as turmaId";
            die(json_encode($result));
        }

        $turma = $turmaBLL->buscarPorId($_POST['turmaId']);

        if (empty($_POST['aulaId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as aulaId";
            die(json_encode($result));
        }

        $aula = $aulaBLL->buscarPorId($_POST['aulaId']);

        if (empty($_POST['data'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as data.";
            die(json_encode($result));
        }

        if (empty($_POST['inicio'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a hora de inicio.";
            die(json_encode($result));
        }

        if (empty($_POST['termino'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a hora de termino.";
            die(json_encode($result));
        }

        if (empty($_POST['cargaHoraria'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha a carga horária.";
            die(json_encode($result));
        }

        if (empty($_POST['conteudo'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha o conteúdo da aula.";
            die(json_encode($result));
        }

        try {

            $aula->setData(dataStrToObject($_POST['data']));
            $aula->setConteudo($_POST['conteudo']);
            $aula->setInicio(dataStrObject("00/00/0000 " . $_POST['inicio']));
            $aula->setTermino(dataStrObject("00/00/0000 " . $_POST['termino']));
            $aula->setCargaHoraria($_POST['cargaHoraria']);
            $aula->setTurma($turma);

            $this->doctrine->em->flush();

            $result['erro'] = false;
            $result['mensagem'] = "<strong>Cadastrado com exito</strong>";

            die(json_encode($result));
        } catch (Exception $ex) {
            $result['mensagem'] = $ex->getMessage();
            die(json_encode($result));
        }
    }

    public function getAula() {

        $aulaBLL = new AulaBLL();
        $result = array();
        $result['erro'] = true;
        $result['mensagem'] = "";
        $result['dados'] = array();

        if (empty($_POST['aulaId'])) {
            $result['erro'] = true;
            $result['mensagem'] = "Erro falta de parâmetro";
            die(json_encode($result));
        }

        $aula = $aulaBLL->buscarPorId($_POST['aulaId']);

        $result['dados'] = array(
            "id" => $aula->getId(),
            "data" => dataObjectToStr($aula->getData(), false),
            "inicio" => $aula->getInicio()->format('H:i'),
            "termino" => $aula->getTermino()->format('H:i'),
            "conteudo" => $aula->getConteudo(),
            "cargaHoraria" => $aula->getCargaHoraria()
        );

        $result['erro'] = false;
        die(json_encode($result));
    }

    public function getAulas($turmaId) {

        $turmaBLL = new TurmaBLL();
        $result = array();
        $result['erro'] = true;
        $result['dados'] = array();

        $turma = $turmaBLL->buscarPorId($turmaId);
        $aulas = $turma->getAulas();

        foreach ($aulas as $aula) {
            $result['dados'][] = array(
                "id" => $aula->getId(),
                "data" => dataObjectToStr($aula->getData(), false),
                "inicio" => $aula->getInicio()->format('H:i'),
                "termino" => $aula->getTermino()->format('H:i'),
                "conteudo" => $aula->getConteudo(),
                "cargaHoraria" => $aula->getCargaHoraria()
            );
        }
        $result['erro'] = false;
        die(json_encode($result));
    }

    public function excluirAula() {

        $result = array();
        $result['erro'] = true;
        $result['mensagem'] = "";

        $turmaBLL = new TurmaBLL();
        $aulaBLL = new AulaBLL();

        if (empty($_POST['turmaId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as turmaId";
            die(json_encode($result));
        }

        $turma = $turmaBLL->buscarPorId($_POST['turmaId']);

        if (empty($_POST['aulaId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as turmaId.";
            die(json_encode($result));
        }

        $aula = $aulaBLL->buscarPorId($_POST['aulaId']);

        if (is_null($turma) || is_null($aula)) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Dados inválidos";
            die(json_encode($result));
        }

        try {

            $turma->getAulas()->removeElement($aula);
            $this->doctrine->em->remove($aula);
            $this->doctrine->em->flush();

            $result['erro'] = false;
            $result['mensagem'] = "<strong>Sucesso! Alterações realizadas.</strong>";
            die(json_encode($result));
        } catch (Exception $ex) {
            $result['erro'] = true;
            $result['mensagem'] = $ex->getMessage();
            die(json_encode($result));
        }
    }

    public function addAluno() {

        if (!$this->usuarioLogado->temPermissao('administracao/turmas', true)) {
            exit;
        }

        $result["erro"] = true;
        $result["mensagem"] = "";

        $turmaBLL = new TurmaBLL();
        $alunoBLL = new AlunoBLL();



        try {

            if (empty($_POST['turmaId'])) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> Preencha as turmaId";
                die(json_encode($result));
            }

            $turma = $turmaBLL->buscarPorId($_POST['turmaId']);

            if (empty($_POST['aluno'])) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> selecione aluno.";
                die(json_encode($result));
            }

            $aluno = $alunoBLL->buscarPorId($_POST['aluno']);

            if (is_null($aluno)) {
                $result["erro"] = true;
                $result["mensagem"] = "<strong>Erro!</strong> Aluno não existe.";
                die(json_encode($result));
            }

            $turma->getAlunos()->add($aluno);

            $this->doctrine->em->flush();

            $result['erro'] = false;
            $result['mensagem'] = "<strong>Cadastrado com exito</strong>";

            die(json_encode($result));
        } catch (Exception $ex) {
            $result['mensagem'] = $ex->getMessage();
            die(json_encode($result));
        }
    }

    public function getAlunos($turmaId) {

        $alunoBLL = new AlunoBLL();
        $turmaBLL = new TurmaBLL();
        $result = array();
        $result['erro'] = true;
        $result['dados'] = array();

        $turma = $turmaBLL->buscarPorId($turmaId);
        $alunos = $turma->getAlunos();

        foreach ($alunos as $aluno) {
            $result['dados'][] = array(
                "id" => $aluno->getId(),
                "nome" => $aluno->getNome(),
                "dataNasc" => dataObjectToStr($aluno->getDataNascimento(), false),
                "cpf" => $aluno->getCpf(),
                "cnh" => $aluno->getCnh(),
                "cnhCategoria" => cnhCategorias()[$aluno->getCnhCategoria()]
            );
        }
        $result['erro'] = false;
        die(json_encode($result));
    }

    public function excluirAluno() {

        $result = array();
        $result['erro'] = true;
        $result['mensagem'] = "";

        $turmaBLL = new TurmaBLL();
        $alunoBLL = new AlunoBLL();

        if (empty($_POST['turmaId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as turmaId";
            die(json_encode($result));
        }

        $turma = $turmaBLL->buscarPorId($_POST['turmaId']);

        if (empty($_POST['alunoId'])) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Preencha as alunoId.";
            die(json_encode($result));
        }

        $aluno = $alunoBLL->buscarPorId($_POST['alunoId']);

        if (is_null($turma) || is_null($aluno)) {
            $result["erro"] = true;
            $result["mensagem"] = "<strong>Erro!</strong> Dados inválidos";
            die(json_encode($result));
        }

        try {

            $turma->getAlunos()->removeElement($aluno);

            $this->doctrine->em->flush();

            $result['erro'] = false;
            $result['mensagem'] = "<strong>Sucesso! Alterações realizadas.</strong>";
            die(json_encode($result));
        } catch (Exception $ex) {
            $result['erro'] = true;
            $result['mensagem'] = $ex->getMessage();
            die(json_encode($result));
        }
    }

}
