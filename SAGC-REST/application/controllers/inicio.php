<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use models\negocio\TurmaBLL;

class Inicio extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->data["menuAtivo"][] = "inicio";
    }
    
    public function index() {        
        
        $turmaBLL = new TurmaBLL();
        
        $turmas = $turmaBLL->buscarPor(array("encerrada"=>0));
        
        $this->data["turmas"] = $turmas;
        $this->view('inicio/index');
    }
}