<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class FormPorCamp extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getFormPorCamp_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_form_by_camp', ['id_camp_by_form' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_form_by_camp')->result();
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertFormPorCamp_post()
        {
            $data = $this->post();

            if($this->db->insert('tb_form_by_camp', $data))
                $this->response('OK', REST_Controller::HTTP_OK); 
        }

        public function updateFormPorCamp_post()
        {
            $id = $this->post('id_camp_by_form');
            $data = $this->post();

            if($this->db->update('tb_form_by_camp', $data, array('id_camp_by_form'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteFormPorCamp_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_form_by_camp', array('id_camp_by_form'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }


        
}