<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class TipoPregunta extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getTipoPregunta_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_type_ques_feedback', ['id_type_cues' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_type_ques_feedback')->result();
            }

            if(!$data)

                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertTipoPregunta_post()
        {
            $data = $this->input->post();

            if($this->db->insert('tb_type_ques_feedback', $data))
                $this->response('Item creado con éxito.', REST_Controller::HTTP_OK); 
        }

        public function updateTipoPregunta_post()
        {
            $id = $this->post('id_type_cues');
            $data = $this->post();

            if($this->db->update('tb_type_ques_feedback', $data, array('id_type_cues'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteTipoPregunta_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_type_ques_feedback', array('id_type_cues'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }


     
}