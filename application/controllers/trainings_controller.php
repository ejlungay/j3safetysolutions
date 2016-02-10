<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
  class Trainings_controller extends CI_Controller {
   
     function __construct() {
       parent::__construct();
       $this->load->model('trainings_model','',TRUE);
       $this->load->helper('url');
       $this->load->library('session');
     }
     
     function index() {
     
     }
     
     /* A function for adding training
      * @Params: course id, training fee
      *  returns true/false
     */
     public function add_training() { 
        $course_id = $this->input->post('course_id');
        $location = $this->input->post('location');
        $training_fee = $this->input->post('training_fee');

        if ($course_id != null) {
            $result = $this->trainings_model->add_training($course_id,  $location, $training_fee);
            if ($result) {
                $json_response = array('course_id' => $course_id,
                                        'location' => $location,
                                        'training_fee' => $training_fee,
                                      'returnMessage'=>'Training successfully added',
                                      ' returnValue'=>'SUCCESS');    

               header('Content-Type: application/json');
               echo json_encode( $json_response);

                return true;
            } // end if
            else {
                $json_response = array('returnMessage'=>'Unable to add training',
                                      'returnValue'=>'FAILED');    

               header('Content-Type: application/json');
               echo json_encode( $json_response);

                return false;
            } //end else
        }
        else {
            $json_response = array('returnMessage'=>'Invalid request',
                                      'returnValue'=>'FAILED');    

               header('Content-Type: application/json');
               echo json_encode( $json_response);

              return false;
        }
     } // end function

     /* Function for getting training id using course id
      * request method: GET
      * @Params: course id
      * returns: a json object: course_id
     */
     public function get_training_id_by_course_id() {
        $course_id = $this->input->get('course_id');

        if ($course_id != null) {
            $result = $this->trainings_model->get_training_id_by_course_id($course_id);
            if ($result) {
                $json_response = array('course_id' => $course_id,
                                      'result'=>$result,
                                      ' returnValue'=>'SUCCESS');    

                header('Content-Type: application/json');
                echo json_encode( $json_response);

                return true;
            } // end if
            else {
                $json_response = array('returnMessage'=>'No available training id from the given course id',
                                      'returnValue'=>'SUCCESS');    

                header('Content-Type: application/json');
                echo json_encode( $json_response);

                return false;
            } // end else
        } 
        else {
            $json_response = array('returnMessage'=>'Invalid request',
                                      'returnValue'=>'FAILURE');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return false;
        }
     } ///end function

     /* Function for getting a specific training detail using a training id
      * @Params: training id
      * returns: json object: training detail
     */
     public function get_training_by_training_id() {
        $training_id = $this->input->get('training_id');

        $result = $this->trainings_model->get_training_by_training_id($training_id);
        if ($result) {
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
        else {
            $json_response = array('returnMessage'=>'No available trainings from the given training id',
                                  'returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return false;
        } // end else
     } // end function

     /* Function for loading trainings depending on the number of counts
      * @Params: count
      * returns json object: training lists
     */
     public function get_trainings_list() {
        $count = $this->input->get('count');
        $result = $this->trainings_model->get_trainings_list($count);
        if ($result) {
            $this->output->set_content_type('application/json')->set_output(json_encode($result)); 
        }
        else {
            $json_response = array('returnMessage'=>'No available trainings',
                                  'returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return false;
        } // end else
     }

     /* Function for getting the delegates of a specific training
      * @Params: training id
      * returns json object: list of delegates
     */
     public function get_training_delegates() {
        $training_id = $this->input->get('training_id');

        if ($training_id != null) {
            $result = $this->trainings_model->get_training_delegates($training_id);
            if ($result) {
                $this->output->set_content_type('application/json')->set_output(json_encode($result)); 
            }
            else {
                 $json_response = array('returnMessage'=>'No available delegate from '.$training_id.' training id',
                                      'returnValue'=>'SUCCESS');    

                header('Content-Type: application/json');
                echo json_encode( $json_response); 

                return false;
            }
        }
        else {
            $json_response = array('returnMessage'=>'Invalid request',
                                      'returnValue'=>'FAILURE');    

            header('Content-Type: application/json');
            echo json_encode( $json_response); 

            return false;
        }
     }

     //function for getting training speakers
  } // end class
?>