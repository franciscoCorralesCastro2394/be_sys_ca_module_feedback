<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Campamento extends REST_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
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
            $data = $this->input->post();

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