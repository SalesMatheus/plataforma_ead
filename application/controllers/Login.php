<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Login extends CI_Controller {

    public function index(){
        
        $data = array(
            'titulo' => 'Login',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css'
                
            ),
        );
        $this->load->view('layout/header');
        $this->load->view('login/index');

    }
}