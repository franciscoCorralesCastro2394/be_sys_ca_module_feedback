<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class RespuestaPorPregunta extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getRespuestaPorPregunta_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_responce_by_question', ['  id_responce_by_question' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_responce_by_question')->result();
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertRespuestaPorPregunta_post()
        {
            $data = $this->input->post();

            if($this->db->insert('tb_responce_by_question', $data))
                $this->response('Item creado con éxito.', REST_Controller::HTTP_OK); 
        }

        public function updateRespuestaPorPregunta_post()
        {
            $id = $this->post(' id_responce_by_question');
            $data = $this->post();

            if($this->db->update('tb_responce_by_question', $data, array('  id_responce_by_question'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteRespuestaPorPregunta_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_responce_by_question', array(' id_responce_by_question'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }


        
}