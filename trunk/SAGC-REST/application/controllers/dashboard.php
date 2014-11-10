<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {
        
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

        $this->view('layout/dashboard');
    }

}
