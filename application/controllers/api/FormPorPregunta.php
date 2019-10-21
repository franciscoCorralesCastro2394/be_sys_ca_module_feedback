<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class FormPorPregunta extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getFormPorPregunta_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_form_by_quest', ['id_form_by_quest' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_form_by_quest')->result();
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertFormPorPregunta_post()
        {
            $data = $this->input->post();

            if($this->db->insert('tb_form_by_quest', $data))
                $this->response('Item creado con éxito.', REST_Controller::HTTP_OK); 
        }

        public function updateFormPorPregunta_post()
        {
            $id = $this->post('id_form_by_quest');
            $data = $this->post();

            if($this->db->update('tb_form_by_quest', $data, array('id_form_by_quest'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteFormPorPregunta_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_form_by_quest', array('id_form_by_quest'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }


        
}