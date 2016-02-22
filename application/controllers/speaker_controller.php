<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Speaker_controller extends CI_Controller {
		
		function __construct() {
			parent::__construct();
			$this->load->model('speaker_model','',TRUE);
			$this->load->helper('url');
			$this->load->library('session');
			//enabling CORS
			header('Access-Control-Allow-Origin: *');
			header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			$method = $_SERVER['REQUEST_METHOD'];
			if($method == "OPTIONS") {
				die();
			}
		}
		
		function index() {
		 
		}
		 
		public function add_training_speaker() {
			$training_id = $this->input->post('training_id');
			$fname =$this->input->post('firstname');
			$mname = $this->input->post('middlename');
			$lname = $this->input->post('lastname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$company = $this->input->post('company');
			$company_position = $this->input->post('company_position');
			$image = $this->input->post('image');

			if ($training_id != null) {
				$result = $this->speaker_model->add_speaker($training_id, $fname, $mname, $lname, $email, $phone, $company, $company_position, $image);
				
				if ($result) {
					$json_response = array('speaker' => $training_id,
										  'firstname' => $fname,
										  'middlename' => $mname,
										  'lastname' => $lname,
										  'email' => $email,
										  'phone' => $phone,
										  'company' => $company,
										  'company_position' => $company_position,
										  'returnMessage'=>'Speaker successfully added',
										  'returnValue'=>'SUCCESS');    

					$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
				}
				else {
					$json_response = array('returnMessage '= >'Unable to add training speaker',
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

		public function get_speakers_by_speaker_id() {
			$speaker_id = $this->input->get('speaker_id');

			if ($speaker_id != null) {
				$result = $this->speaker_model->get_speakers_by_speaker_id($speaker_id);
				if ($result) {
					 $this->output->set_content_type('application/json')->set_output(json_encode($result));
				}
				else {
					$json_response = array('returnMessage'=>'No available speakers from the given training id',
										  'returnValue'=>'SUCCESS');    

					$this->output->set_content_type('application/json')->set_output(json_encode($json_response));

					return false;
				}
			}
			else {
			   $json_response = array('returnMessage'=>'Invalid request parameters',
										  'returnValue'=>'FAILURE');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response));

				return false;
			}
		 }
		 
		public function update_speaker() {
			$speaker_id = $this->input->post('speaker_id');
			$fname =$this->input->post('firstname');
			$mname = $this->input->post('middlename');
			$lname = $this->input->post('lastname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$company = $this->input->post('company');
			$company_position = $this->input->post('company_position');
			$image = $this->input->post('image');
		}
  }
?>