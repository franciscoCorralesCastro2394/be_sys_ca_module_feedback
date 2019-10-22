<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Formularios extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getFormularios_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_fomr_feedback', ['id_form_feedback' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_fomr_feedback')->result();
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function getFormulariosPorCoord_get()
        {
            $id = $this->uri->segment(4);
            $spFormByCoord = 'CALL spGetFormbyCoord(?)';

             $params = array('userID' => $id);

            if(!empty($id)){
                $data = $this->db->query($spFormByCoord,$params);
            }else{
                $data = $this->db->get('tb_fomr_feedback');
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data->result(), REST_Controller::HTTP_OK);
        }

        public function insertFormularios_post()
        {
            $data = $this->input->post();

            if($this->db->insert('tb_fomr_feedback', $data))
                $this->response($this->db->insert_id(), REST_Controller::HTTP_OK);
        }

        public function updateFormularios_post()
        {
            $id = $this->post('id_form_feedback');
            $data = $this->post();

            if($this->db->update('tb_fomr_feedback', $data, array('id_form_feedback'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteFormularios_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_fomr_feedback', array('id_form_feedback'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }

}