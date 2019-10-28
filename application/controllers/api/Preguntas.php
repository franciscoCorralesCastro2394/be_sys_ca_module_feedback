<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Preguntas extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }



         public function getPreguntasPorForm_get()
        {
            $id = $this->uri->segment(4);
            $spQuestByForm = 'CALL spGetQuestbyForm(?)';

             $params = array('idForm' => $id);

            if(!empty($id)){
                $data = $this->db->query($spQuestByForm,$params);
            }
            
            $this->response($data->result(), REST_Controller::HTTP_OK);
        }


        public function getPreguntas_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_quest_feeback', ['id_quest_feedback' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_quest_feeback')->result();
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertPreguntas_post()
        {
            $data = $this->input->post();

            if($this->db->insert('tb_quest_feeback', $data))
                $this->response($this->db->insert_id(), REST_Controller::HTTP_OK); 
        }

        public function updatePreguntas_post()
        {
            $id = $this->post('id_quest_feedback');
            $data = $this->post();

            if($this->db->update('tb_quest_feeback', $data, array('id_quest_feedback'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deletePreguntas_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_quest_feeback', array('id_quest_feedback'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }


     
}