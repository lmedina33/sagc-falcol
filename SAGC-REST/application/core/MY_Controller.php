<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class MY_Controller extends CI_Controller {
    public $data = array();
    public $usuarioLogado = null;    

    /**
     * Constructor
     */
    public function __construct(){
        parent::__construct();

        $this->checarAutenticacao();
        
        $this->data["menuAtivo"] = array();
        
        if($this->tank_auth->is_logged_in()){
            $usuarioBLL = new \models\negocio\UsuarioBLL();            
            $this->usuarioLogado = $usuarioBLL->buscarPorId($this->tank_auth->get_user_id());
            $this->data["usuarioLogado"] = $this->usuarioLogado;            
            
        }
    }

    protected function checarAutenticacao(){
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
            exit;
        }
    }
    
    protected function view($view, $vars = NULL, $return = FALSE){
        if(is_null($vars)){
            $vars = $this->data;
        }        
        if(isset($_GET['navAsAjax'])){
            $result = $this->load->view($view, $vars, true);
        }else{
            $vars['pageContent'] = $this->load->view($view, $vars, true);
            $result = $this->load->view('layout/framework', $vars, true);
        }
        
        if($return){
            return $result;
        }else{
            print $result;
        }
    }
}