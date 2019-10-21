<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class CoordinadorPorForm extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getCoordinadorPorForm_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_coordinator_by_form', ['id_coordinator_by_form' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_coordinator_by_form')->result();
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertCoordinadorPorForm_post()
        {
            $data = $this->input->post();

            if($this->db->insert('tb_coordinator_by_form', $data))
                $this->response($this->db->insert_id(), REST_Controller::HTTP_OK); 
        }

        public function updateCoordinadorPorForm_post()
        {
            $id = $this->post('id_coordinator_by_form');
            $data = $this->post();

            if($this->db->update('tb_coordinator_by_form', $data, array('id_coordinator_by_form'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteCoordinadorPorForm_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_coordinator_by_form', array('id_coordinator_by_form'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }


        
}