<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
  class Speaker_controller extends CI_Controller {
   
     function __construct() {
       parent::__construct();
       $this->load->model('speaker_model','',TRUE);
       $this->load->helper('url');
       $this->load->library('session');
     }
     
     function index() {
     
     }
     
     public function add_training_speaker() {
        $training_id = $this->input->post('training_id');
        $fname =$this->input->post('firstname');
        $mname = $this->input->post('middlename');
        $lname = $this->input->post('lastname');
        $image = $this->input->post('image');

        $result = $this->speaker_model->add_speaker($training_id, $fname, $mname, $lname, $image);
        if ($result) {
            $json_response = array('speaker' => $training_id,
                                  'firstname' => $fname,
                                  'middlename' => $mname,
                                  'lastname' => $lname,
                                  'returnMessage'=>'Speaker successfully added',
                                  'returnValue'=>'SUCCESS');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'Unable to add training speaker',
                                  'returnValue'=>'SUCCESS');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return false;
        }
     }

     public function get_speaker_id_by_training_id() {
        $training_id = $this->input->get('training_id');

        $result = $this->speaker_model->get_speaker_id_by_training_id($training_id);
        if ($result) {
            $json_response = array('training_id' => $training_id,
                                  'result'=>$result,
                                  ' returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'No available speaker id from the given training id',
                                  'returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return false;
        }
     }

     public function get_speaker_by_speaker_id() {
        $speaker_id = $this->input->get('speaker_id');

        $result = $this->speaker_model->get_speaker_by_speaker_id($speaker_id);
        if ($result) {
            $json_response = array('speaker_id' => $speaker_id,
                                  'result'=>$result,
                                  ' returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'No available speakers from the given training id',
                                  'returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return false;
        }
     }
  }
?>