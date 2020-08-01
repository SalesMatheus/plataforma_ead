<?php 

defined('BASEPATH') OR exit('Ação não permitida');

class Core_model extends CI_Model{

    public funtion get_all($tabela = NULL, $condincao == NULL){

        if($table && is_array($condicao)){

            $this->db->where($condicao);

            return $this->db->get($tabela)->result();

        }else{

            return FALSE;
        }
    }

    public function get_by_id($tabela = NULL, $condincao == NULL){

        if($table && is_array($condicao)){

            $this->db->where($condicao);
            $this->db->limit(1);

            return $this->db->get($tabela)->row();

        }else{

            return FALSE;
        }
    }

    public function insert($tabela = NULL, $data == NULL, $get_last_id == NULL){

        if($table && is_array($condicao)){

            $this->db->insert($tabela, $data);
            
            if($get_last_id){

                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            if(this->db->affected_rows() > 0){

                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');

            }else{

                $this->session->set_flashdata('error', 'Erro ao salvar dados');
            }
            
        }else{

            return FALSE;
        }
    }

    public function update($tabela = NULL, $data == NULL, $condincao == NULL){

        if($table && is_array($data) && is_array($condincao)){

            
            if($this->db->update($tabela, $data, $condincao)){

                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');

            }else{

                $this->session->set_flashdata('error', 'Erro ao atualizar dados');

            }
            
        }else{

            return FALSE;
        }
    }

    public function delete($tabela = NULL, $condincao == NULL){

        $this->db->db_debug = FALSE;

        if($table && is_array($condincao)){

            
            $status = $this->db->delete($tabela, $data, $condincao);

            $error = $this->db->error();

            if(!$status){

                foreach($error as $code){

                    if($code == 1451){

                        $this->session->set_flashdata('error', 'Impossível excluir. Esse registro está sendo utilizado em outra tabela.')
                    }
                }

            }else{

                $this->session->set_flashdata('sucesso', 'Registro excluído com sucesso');

            }

            $this->db->db_debug = TRUE;
            
        }else{

            return FALSE;
        }
    }
}