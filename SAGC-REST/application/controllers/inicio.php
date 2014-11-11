<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Inicio extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->data["menuAtivo"][] = "inicio";
    }
    
    public function index() {        
        
        $this->view('inicio/index');
    }
}