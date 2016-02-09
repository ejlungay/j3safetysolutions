<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
  class Course_controller extends CI_Controller {
   
     function __construct() {
       parent::__construct();
       $this->load->model('course_model','',TRUE);
       $this->load->helper('url');
       $this->load->library('session');
     }
     
     function index() {
     
     }
     
     public function add_course() {
        $course_name = $this->input->post('course_name');
        $user = $this->input->post('user');

        $result = $this->course_model->add_course($course_name, $user);
        if ($result) {
            $json_response = array('course_name' => $course_name,
                                  'returnMessage'=>'Course successfully added',
                                  ' returnValue'=>'SUCCESS');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'Unable to add course',
                                  'returnValue'=>'FAILED');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return false;
        }
     }

     public function get_course_id_by_course_name() {
        $course_name = $this->input->post('course_name');

        $result = $this->course_model->get_course_id_by_course_name($course_name);
        if ($result) {
            $json_response = array('course_name' => $course_name,
                                  'course_detail'=>$result,
                                  ' returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'No available course id from the given course name',
                                  'returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return false;
        }
     }

     public function get_course_by_course_id() {
        $course_id = $this->input->post('course_id');

        $result = $this->course_model->get_course_by_course_id($course_id);
        if ($result) {
            $json_response = array('course_id' => $course_id,
                                  'course_detail'=>$result,
                                  ' returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'No available course from the given course id',
                                  'returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return false;
        }
     }
  }
?>