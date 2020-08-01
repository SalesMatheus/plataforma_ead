<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Materias extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if(!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou');
            redirect('login');
        }

    }


    public function index(){
        
        $data = array(
            'titulo' => 'Matérias Cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css'
                
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'

            ),
            'materias' => $this->core_model->get_all('materias'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('materias/index');
        $this->load->view('layout/footer');


    }

    public function edit($materia_id = NULL) {

        if (!$materia_id || !$this->core_model->get_by_id('materias', array('materia_id' => $materia_id))) {
            $this->session->set_flashdata('error', 'materia não encontrada');
            redirect('materias');
        } else {


            $this->form_validation->set_rules('materia_nome'      , 'Nome da matéria'             , 'trim|required');


            if ($this->form_validation->run()) {


                $data = elements(
                        array(
                    'materia_nome',
                    'materia_ativa',
                        ), $this->input->post()
                );

                //Proteção contra códigos mal-intencionados
                $data = $this->security->xss_clean($data);

                $this->core_model->update('materias', $data, array('materia_id' => $materia_id));
                redirect('materias');
            } else {

                //Erro de validação

                $data = array(
                    'titulo' => 'Atualizar matéria',
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ),
                    'materia' => $this->core_model->get_by_id('materias', array('materia_id' => $materia_id))
                );

        //    echo '<pre>';
        //    print_r($data['materia']);
        //    exit();



                $this->load->view('layout/header', $data);
                $this->load->view('materias/edit');
                $this->load->view('layout/footer');
            }
        }
    }
}