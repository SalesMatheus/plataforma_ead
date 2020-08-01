<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Login extends CI_Controller {

    public function index(){
        
        $data = array(
            'titulo' => 'Login'
        );

        $this->load->view('layout/header', $data);
        $this->load->view('login/index');

    }

    public function validacao_login(){
        
        $identify = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $remember = FALSE;

        if($this->ion_auth->login($identify, $password, $remember)){

            redirect('home');

        }else{

            $this->session->set_flashdata('error', 'Usuário ou senha inválidos');
            redirect('login');
        }

    }

    public function logout(){

        $this->ion_auth->logout();
        redirect('login');
    }
}