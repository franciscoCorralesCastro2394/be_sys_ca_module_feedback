<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Campamentos extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
        }


         public function getCampamentosPorCoord_get()
        {
            $id = $this->uri->segment(4);
            $spFormByCoord = 'CALL spGetCampsByCoord(?)';

             $params = array('userID' => $id);

            if(!empty($id)){
                $data = $this->db->query($spFormByCoord,$params);
            }else{
                $data = $this->db->get('tb_camp_gruop');
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data->result(), REST_Controller::HTTP_OK);
        }


        public function getCampamentos_get()
        {
            $id = $this->uri->segment(4);

            if(!empty($id)){
                $data = $this->db->get_where('tb_camp_gruop', ['id_camp_group' => $id])->row_array();
            }else{
                $data = $this->db->get('tb_camp_gruop')->result();
            }

            if(!$data)
                $data = 'No hay registros con este ID.';

            $this->response($data, REST_Controller::HTTP_OK);
        }

        public function insertCampamentos_post()
        {
            $data = $this->post();

            if($this->db->insert('tb_camp_gruop', $data))
                $this->response('Item creado con éxito.', REST_Controller::HTTP_OK); 
        }

        public function updateCampamentos_post()
        {
            $id = $this->post('id_camp_group');
            $data = $this->post();

            if($this->db->update('tb_camp_gruop', $data, array('id_camp_group'=>$id)))
                $this->response('Item actualizado con éxito.', REST_Controller::HTTP_OK);
        }

        public function deleteCampamentos_get()
        {
            $id = $this->uri->segment(4);

            if($this->db->delete('tb_camp_gruop', array('id_camp_group'=>$id)))
                $this->response('Item eliminado con éxito.', REST_Controller::HTTP_OK);
        }

}