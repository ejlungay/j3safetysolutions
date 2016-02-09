<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
  class Delegate_controller extends CI_Controller {
   
     function __construct() {
       parent::__construct();
       $this->load->model('delegate_model','',TRUE);
       $this->load->helper('url');
       $this->load->library('session');
     }
     
     function index() {
     
     }
     
     public function add_delegate() {
        $training_id = $this->input->post('training_id');
        $fname = $this->input->post('firstname');
        $mname = $this->input->post('middlename');
        $lname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $company = $this->input->post('company');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $image = $this->input->post('image');

        $result = $this->delegate_model->add_delegate($training_id, $fname, $mname, $lname, $email, $company, $phone, $address, $image);
        if ($result) {
            $json_response = array('training id' => $training_id,
                                  'firstname' => $fname,
                                  'middlename' => $mname,
                                  'lastname' => $lname,
                                  'email' => $email,
                                  'company' => $company,
                                  'phone' => $phone,
                                  'address' => $address,  
                                  'returnMessage'=>'Delegate successfully added',
                                  'returnValue'=>'SUCCESS');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'Unable to add training speaker',
                                  'returnValue'=>'FAILURE');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return false;
        }
     }

     public function get_delegate_by_delegate_id() {
        $delegate_id = $this->input->get('delegate_id');

        $result = $this->delegate_model->get_delegate_by_delegate_id($delegate_id);
        if ($result) {
            $json_response = array('delegate_id' => $delegate_id,
                                  'detail'=>$result,
                                  ' returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'No available delegates from '.$delegate_id.' delegate id',
                                  'returnValue'=>'SUCCESS');    

            header('Content-Type: application/json');
            echo json_encode( $json_response);

            return false;
        }
     }

     public function update_delegate() {
        $delegate_id = $this->input->post('delegate_id');
        $fname = $this->input->post('firstname');
        $mname = $this->input->post('middlename');
        $lname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $company = $this->input->post('company');
        $phone = $this->input->post('phone');
        $address =$this->input->post('address');

        $result = $this->delegate_model->updateDelegateDetail($delegate_id, $fname, $mname, $lname, $email, $company, $phone, $address);
        if ($result) {
            $json_response = array('delegate id' => $delegate_id,
                                  'firstname' => $fname,
                                  'middlename' => $mname,
                                  'lastname' => $lname,
                                  'email' => $email,
                                  'company' => $company,
                                  'phone' => $phone,
                                  'address' => $address,  
                                  'returnMessage'=>'Delegate successfully updated',
                                  'returnValue'=>'SUCCESS');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('returnMessage'=>'Unable to update delegate detail',
                                  'returnValue'=>'FAILURE');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return false;
        }
     }
  }
?>