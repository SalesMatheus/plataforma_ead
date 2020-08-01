<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Login extends CI_Controller {

    public function index(){
        
        $identify = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $remember = FALSE;

        if($this->ion_auth->login($identify, $password, $remember)){

            redirect('home');

        }else{

            $this->session->set_flashdata('error', 'Usuário ou senha inválidos');

            $this->load->view('layout/header');
            $this->load->view('login/index');
        }

    }
}