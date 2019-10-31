<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class CampamentoPorVoluntario extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }

        public function getCampamentoPorVoluntario_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_camp_by_volontier', ['id_camp_by_volt' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_camp_by_volontier')->result();
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertCampamentoPorVoluntario_post()
        {
            $data = $this->post();

            if($this->db->insert('tb_camp_by_volontier', $data))
                $this->response('Item creado con éxito.', REST_Controller::HTTP_OK); 
        }


        public function getVoluntPorCamp_get()
        {
            $id = $this->uri->segment(4);
            $spVoluntByCamp = 'CALL spGetVoluntByCamp(?)';

             $params = array('campID' => $id);

            if(!empty($id)){
                $data = $this->db->query($spVoluntByCamp,$params);
            }

            if(!$data)
                $data = '';

            $this->response($data->result(), REST_Controller::HTTP_OK);
        }




        public function updateCampamentoPorVoluntario_post()
        {
            $id = $this->post('id_camp_by_volt');
            $data = $this->post();

            if($this->db->update('tb_camp_by_volontier', $data, array('id_camp_by_volt'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteCampamentoPorVoluntario_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_camp_by_volontier', array(' id_camp_by_volt'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }


        
}