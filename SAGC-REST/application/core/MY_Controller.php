<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author Carlos
 */
class MY_Controller extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();        
        $this->load->library('doctrine');
    }
    
}
