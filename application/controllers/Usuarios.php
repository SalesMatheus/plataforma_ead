<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if(!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }
    }

    public function index(){

        $data = array(
            'titulo' => 'Usuários Cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css'
                
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'

            ),
            'usuarios' => $this->ion_auth->users()->result(),

            'perfil_usuario' => $this->ion_auth->get_users_groups($user_id = NULL)->row()
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');

    }

    public function add(){

        

        $this->form_validation->set_rules('first_name'      , 'Nome'             , 'trim|required');
        $this->form_validation->set_rules('last_name'       , 'Sobrenome'        , 'trim|required');
        $this->form_validation->set_rules('email'           , 'E-mail'           , 'trim|required');
        $this->form_validation->set_rules('username'        , 'Usuário'          , 'trim|required');
        $this->form_validation->set_rules('password'        , 'Senha'            , 'trim|required');
        $this->form_validation->set_rules('password_confirm', 'Confirmar Senha'  , 'trim|required');

        if($this->form_validation->run()){
            
            $password = $this->security->xss_clean($this->input->post('password'));
            $email    = $this->security->xss_clean($this->input->post('email'));

            $additional_data = array(
                'first_name'  => $this->input->post('first_name'),
                'username'    => $this->input->post('username'),
                'last_name'   => $this->input->post('last_name'),
                'active'      => $this->input->post('active'),
            );
            
            $group = array($this->input->post('perfil_usuario'));

            $additional_data = $this->security->xss_clean($additional_data);
            $group           = $this->security->xss_clean($group);

            if($this->ion_auth->register($username, $password, $email, $additional_data, $group)){

                $this->session->set_flashdata('sucesso','Usuário Cadastrado com sucesso');

            }else{

                $this->session->set_flashdata('error', 'Erro ao salvar dados!'); 
            }

            redirect('usuarios');

        }else{

            $data = array(
                'titulo' => 'Cadastrar usuário'
            );

            $this->load->view('layout/header', $data);
            $this->load->view('usuarios/add');
            $this->load->view('layout/footer');
        }

        
    }

    public function edit($user_id = NULL){

        if(!$user_id || !$this->ion_auth->user($user_id)->row()){

            $this->session->set_flashdata('error', 'Usuário não encontrado');

            redirect('usuarios');

        }else{
            
            $this->form_validation->set_rules('first_name'      , 'Nome'             , 'trim|required');
            $this->form_validation->set_rules('last_name'       , 'Sobrenome'        , 'trim|required');
            $this->form_validation->set_rules('email'           , 'E-mail'           , 'trim|required');
            $this->form_validation->set_rules('username'        , 'Usuário'          , 'trim|required');
            $this->form_validation->set_rules('password'        , 'Senha'            , 'trim|required');
            $this->form_validation->set_rules('password_confirm', 'Confirmar Senha'  , 'trim|required');

            if($this->form_validation->run()){
                

                $data = elements(
                            array(
                                'first_name',
                                'last_name',
                                'email',
                                'username',
                                'active',
                                'password'
                            ), $this->input->post()
                        );
                
                //Proteção contra códigos mal-intencionados
                $data = $this->security->xss_clean($data);
                
                //Verificação de mudança de perfil
                if($this->ion_auth->update($user_id, $data)){

                    $perfil_usuario_db = $this->ion_auth->get_users_groups($user_id)->row();

                    $perfil_usuario_post = $this->input->post('perfil_usuario');

                    if($perfil_usuario_db->id != $perfil_usuario_post){

                        //remove usuario do grupo
                        $this->ion_auth->remove_from_group($perfil_usuario_db->id, $user_id);

                        //adicionado usuario ao novo grupo
                        $this->ion_auth->add_to_group($perfil_usuario_post, $user_id);

                    }

                   $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso!'); 

                }else{

                    $this->session->set_flashdata('error', 'Erro ao salvar dados!'); 
                }   

                redirect('usuarios');
            }else{

                $data = array(
                    'titulo' => 'Editar usuário',
                    'usuario' => $this->ion_auth->user($user_id)->row(),
                    'perfil_usuario' => $this->ion_auth->get_users_groups($user_id)->row()
                );
    
                $this->load->view('layout/header', $data);
                $this->load->view('usuarios/edit');
                $this->load->view('layout/footer');
            }
        }
        
    }

    public function del($user_id = NULL){

        if(!$user_id || !$this->ion_auth->user($user_id)->row()){

            $this->session->set_flashdata('error', 'Usuário não encontrado');

            redirect('usuarios');

        }else{
           
            if($this->ion_auth->delete_user($user_id)){
                
                $this->session->set_flashdata('sucesso', 'Usuário deletado com sucesso!'); 

            }else{

                $this->session->set_flashdata('error', 'Erro ao deletar Usuário!'); 
            }   

                redirect('usuarios');

        }
        
    }

    public function vincular_materia_usuario($user_id = NULL) {

        $this->form_validation->set_rules('first_name'      , 'Nome'             , 'trim|required');
        
        if ($this->form_validation->run()) {
            
            $user_id = $_POST['user_id'];
            $materia_id = $_POST['materia_id'];

            $data = array(
                        'user_id'    => $user_id,
                        'materia_id' => $materia_id,
                    );
                    
            //Proteção contra códigos mal-intencionados
            $data = $this->security->xss_clean($data);

            $this->core_model->insert('materias_usuario', $data);

            redirect('usuarios/vincular_materia_usuario/'.$user_id);

        } else {

            $data = array(
                'titulo' => 'Vincular Matérias',
                'materias' => $this->core_model->get_all('materias', array('materias')),
                'materias_usuario' => $this->core_model->get_all('materias', array('user_id' => $user_id), 'materias_usuario', 'materias.materia_id', 'materias_usuario.materia_id'),
                'usuario' => $this->core_model->get_by_id('users', array('id' => $user_id)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('usuarios/vincular_materia_usuario');
            $this->load->view('layout/footer');
        }
    }

    public function del_materias_usuario($id = NULL, $user_id = NULL) {

        if (!$id || !$this->core_model->get_by_id('materias_usuario', array('id' => $id))) {
            $this->session->set_flashdata('error', 'Matéria não encontrada');
            redirect('usuarios/vincular_materia_usuario/'.$user_id);
        } else {
            $this->core_model->delete('materias_usuario', array('id' => $id));
            redirect('usuarios/vincular_materia_usuario/'.$user_id);
        }
    }


}
