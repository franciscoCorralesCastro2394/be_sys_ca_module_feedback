<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class FormularioPorVoluntario extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getFormularioPorVoluntario_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_camp_by_form_by_volunt', ['id_form' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_camp_by_form_by_volunt')->result();
            }

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertFormularioPorVoluntario_post()
        {
            $data = $this->post();

            if($this->db->insert('tb_camp_by_form_by_volunt', $data))
                $this->response('Item creado con éxito.', REST_Controller::HTTP_OK); 
        }

        public function updateFormularioPorVoluntario_post()
        {
            $id = $this->post(' id_responce_by_question');
            $data = $this->post();

            if($this->db->update('tb_responce_by_question', $data, array('  id_responce_by_question'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteFormularioPorVoluntario_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_responce_by_question', array(' id_responce_by_question'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }


        
}