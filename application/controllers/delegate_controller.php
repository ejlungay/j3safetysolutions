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
        $company_position = $this->input->post('company_position');
        $phone = $this->input->post('phone');
        $image = $this->input->post('image');

        if ($training_id != null) {   
            $result = $this->delegate_model->add_delegate($training_id, $fname, $mname, $lname, $email, $company, $company_position, $phone,  $image);
            if ($result) {
                $json_response = array('training id' => $training_id,
                                      'firstname' => $fname,
                                      'middlename' => $mname,
                                      'lastname' => $lname,
                                      'email' => $email,
                                      'company' => $company,
                                      'company_position' => $company_position,
                                      'phone' => $phone, 
                                      'returnMessage'=>'Delegate successfully added',
                                      'returnValue'=>'SUCCESS');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

                return true;
            }
            else {
                $json_response = array('returnMessage'=>'Unable to add training speaker',
                                      'returnValue'=>'FAILURE');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

                return false;
            }
        }
        else {
            $json_response = array('returnMessage' => 'Invalid request parameters',
                                   'returnValue' => 'FAILURE');    

            $this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
            return false;
        }
     }

    public function get_delegate_by_delegate_id() {
		$delegate_id = $this->input->get('delegate_id');
		
		if ($delegate_id != null) {
			$result = $this->delegate_model->get_delegate_by_delegate_id($delegate_id);
			if ($result) {
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
			}
			else {
				$json_response = array('returnMessage'=>'No available delegates from '.$delegate_id.' delegate id',
									  'returnValue'=>'SUCCESS');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
				return false;
			}
		}
		else {
			$json_response = array('returnMessage' => 'Invalid request parameters',
								   'returnValue' => 'FAILURE');
			$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
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
        $company_position = $this->input->post('company_position');
        $phone = $this->input->post('phone');

        if ($delegate_id != null) {
            $result = $this->delegate_model->updateDelegateDetail($delegate_id, $fname, $mname, $lname, $email, $company, $company_position, $phone);
            if ($result) {
                $json_response = array('delegate id' => $delegate_id,
                                      'firstname' => $fname,
                                      'middlename' => $mname,
                                      'lastname' => $lname,
                                      'email' => $email,
                                      'company' => $company,
                                      'company_position' => $company_position,
                                      'phone' => $phone,
                                      'returnMessage'=>'Delegate successfully updated',
                                      'returnValue'=>'SUCCESS');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

                return true;
            }
            else {
                $json_response = array('returnMessage' => 'Unable to update delegate detail',
                                      'returnValue' => 'FAILURE');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

                return false;
            }
        }
        else {
            $json_response = array('returnMessage' => 'Invalid request parameters',
                                      'returnValue' => 'FAILURE');    

            $this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

            return false;
        }
    }
	
	public function change_delegate_profile_picture() {
		$delegate_id = $this->input->post('delegate_id');
		$img = $this->input->post('image');
		
		if ($delegate_id != null) {
			$result = $this->delegate_model->change_delegate_picture($delegate_id, $img);
			
			if ($result) {
				$json_response = array('returnMessage' => 'Image successfully changed',
									   'returnValue' => 'SUCCESS');
				
				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
			}
			else {
				$json_response = array('returnMessage' => 'Unable to change profile picture',
									   'returnValue' => 'FAILURE');
				
				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
			}
		}
		else {
			$json_response = array('returnMessage' => 'Invalid request parameters',
								   'returnValue' => 'FAILURE');
				
				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
		}
	}
  }
?>