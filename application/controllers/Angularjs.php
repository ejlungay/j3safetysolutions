<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Angularjs extends CI_Controller {
    
    function __construct() {
       parent::__construct();
       $this->load->model('User_model','',TRUE);
       $this->load->helper('url');
       $this->load->library('session');
     }

    public function index()
    {
            //echo json_encode(array('t' => $this->User_model->getAll()));
            //$data = $this->User_model->getAll();
            //$this->output->set_content_type('application/json')->set_output(json_encode($data));
             $this->load->view('angular_view');
    }
		
	function test() {
		$this->load->view('test2');
	}	
	
    public function get_list() {
        $data = $this->User_model->getAll();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        //echo  json_encode(array('user' => $this->User_model->getAll()));
    }
}