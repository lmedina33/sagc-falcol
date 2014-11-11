<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Framework extends MY_Controller {
    public function index() {
        $this->view('layout/framework');
    }
}