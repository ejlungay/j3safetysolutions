<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends CI_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->helper('url');
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
	 
	//function to retrieve user session
	function retrieve_user() {
		$this->load->helper('file');
		$ee11cbb19052e40b07aac0ca060c23ee = read_file('./21232f297a57a5a743894a0e4a801fc3/ee11cbb19052e40b07aac0ca060c23ee.txt');
		
		if ($ee11cbb19052e40b07aac0ca060c23ee != null) {
			$json_response = array('uid' => $ee11cbb19052e40b07aac0ca060c23ee);    

			$this->output->set_content_type('application/json')->set_output(json_encode($json_response));
		}
	}
	//function to destroy user session
	function destroy_session() {
		$this->load->helper('file');
			$data = "";
			if ( !write_file('./21232f297a57a5a743894a0e4a801fc3/ee11cbb19052e40b07aac0ca060c23ee.txt', $data)){
				 echo 'Unable to write the file';
				 die();
			}
	}
	
    function signin() {
		$username = $this->input->get('username');
		$password = $this->input->get('password');
		
		if ($username != null && $password != null) {
			
			$result = $this->user->login($username, $password);
			if($result) {
				//assign each item of the result as row
				foreach ($result as $row)
				//get the IP address of the client for authentication purposes
				$ip = '';
				if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
					$ip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
					$ip = $_SERVER['REMOTE_ADDR'];
				}
				/* Creating a custom authentication, save the data to a text file
				* Instead of cookies, I use text file
				*/
				$this->load->helper('file');
				date_default_timezone_set('Asia/Manila');
				$data = $row->uid.';'.$ip.';'.date('Y-m-d H:i:s', time());
				if ( !write_file('./21232f297a57a5a743894a0e4a801fc3/ee11cbb19052e40b07aac0ca060c23ee.txt', $data)){
					 echo 'Unable to write the file';
					 die();
				}
		
				$json_response = array('userid' => $row->uid,
									   'username' => $row->username,
									   'firstname' => $row->firstname,
									   'middlename' => $row->middlename,
									   'lastname' => $row->lastname,
									   'image' => $row->image,
									   'user_type' => $row->user_type,
									   'returnMessage'=>'User validated',
									   'returnValue'=>'SUCCESS');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response));
			}
		   else {
				$json_response = array('returnMessage'=>'Invalid username or password.',
									   'returnValue'=>'FAILED',
									   'username'=>$username,
									   'password'=>$password);    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response));

				return false;
			}
		}
		else {
			$json_response = array('returnMessage'=>'Invalid request parameters',
									   'returnValue'=>'FAILED');    

			$this->output->set_content_type('application/json')->set_output(json_encode($json_response));
		}
    }
	
	//function to check if user is logged in
	function isLoggedIn() {
		$this->load->helper('file');
		//set the timezone as asia/manila or utc+8
		date_default_timezone_set('Asia/Manila');
		//read the text file containing user info.
		$user_data = read_file('./21232f297a57a5a743894a0e4a801fc3/ee11cbb19052e40b07aac0ca060c23ee.txt');
		if ($user_data != null) {
			$temp = explode(";", $user_data);
			//get current date and time
			$now = date('Y-m-d H:i:s', time());
			//subtract date ******************************
			//load the external library
			$this->load->library('dateoperations');
			//define the limit time; 5 minutes is the allowed allowance
			$limit = $this->dateoperations->subtract($now,'minute', 5); // 5 minutes expiry
			if ($temp[2] < $limit) { 
				// the user session has expired for 5 minutes, return false
				$json_response = array('uid' => $temp[0],
									   'returnMessage'=>'You are not logged in anymore',
									   'returnValue'=>'FALSE');   
						
				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
			}
			else {
				//user is still logged in
				$json_response = array('uid' => $temp[0],
									   'returnMessage'=>'User still logged in',
									   'expiry' => $this->dateoperations->sum($temp[2],'minute',5),
									   'returnValue'=>'TRUE');   
						
				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
			}
		}
		else {
			// no logged in data
			$json_response = array('returnMessage'=>'Please login to continue',
								   'returnValue'=>'FALSE');   
					
			$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
		}
	}
	
    public function signup() {
		$this->load->helper('url');
        $this->load->database();

        $isDuplicated = $this->user->checkDuplicates($this->input->post('username'));
        if ($isDuplicated) {
			$json_response = array('returnMessage'=>'Username is already in used',
                                'returnValue'=>'FAILURE');    
			$this->output->set_content_type('application/json')->set_output(json_encode($json_response));							
        }
        else {
			$password = $this->input->post('password');
			
			$fileName = $_FILES['file']['name'];
			$tmpName  = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileType = $_FILES['file']['type'];

			$fp = fopen($tmpName, 'r');
			$content = fread($fp, filesize($tmpName));
			fclose($fp);
 
			$data = array('username' => $this->input->post('username'),
						  'password' => md5($password),
						  'firstname' => $this->input->post('firstname'),
						  'middlename' => $this->input->post('middlename'),
						  'lastname' => $this->input->post('lastname'),
						  'image' => $content);

			$result = $this->db->insert('users', $data);

			if ($result) {
				$json_response = array( 'username' => $this->input->post('username'),
							   'returnMessage'=>'User account successfully created',
							   'returnValue'=>'SUCCESS');   
					
				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
			}
			else {
				$json_response = array('returnMessage'=>'Unable to add user',
									   'returnValue'=>'FAILURE');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response));
			}
		}
    }

    function change_password() {
        $username = $_POST['username'];
        $password = $_POST['password'];
		
		if ($username != null && $password != null) {
			
			$result = $this->user->updateUserPassword($username, $password);
			if ($result) {
				$json_response = array('username' => $username,
									   'returnMessage'=>'The password was successfully changed',
									   ' returnValue'=>'SUCCESS');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response));
			}
			else {
				$json_response = array('returnMessage' => 'Unable to update user password.',
									   'returnValue' => 'FAILED');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

				return false;
			}
		}
		else {
			$json_response = array('returnMessage' => 'Invalid request parameters');
			
			$this->output->set_content_type('application/json')->set_output(json_encode($json_response));
		}
     }

    function change_user_detail() {
        $username = $_POST['username'];
        $fname = $_POST['firstname'];
        $mname = $_POST['middlename'];
        $lname = $_POST['lastname'];
		
		if ($username != null) {

			$result = $this->user->updateUserDetail($username, $fname, $mname, $lname);
			if ($result) {
				$json_response = array('username' => $username,
									  'returnMessage'=>'User detail successfully changed',
									  'returnValue'=>'SUCCESS');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

				return true;
			}
			else {
				$json_response = array('username' => $username,
									  'returnMessage'=>'User detail change unsuccessful',
									  'returnValue'=>'FAILED');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

				return false;
			}
		}
		else {
			$json_response = array('returnMessage' => 'Invalid request parameters',
								   'returnValue' => 'FAILURE');
			$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
		}
     }
	 
	function updateProfilePicture() {
		$username = $this->input->post('username');
        $img = $this->input->post('file');
		
		if ($username != null) {
			$result = $this->user->updateProfilePicture($username, $img);
			if ($result) {
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
			}
			else {
				$json_response = array('username' => $username,
									  'returnMessage'=>'Unable to change profile picture',
									  'returnValue'=>'FAILED');    

			   $this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

				return false;
			}
		}
		else {
			$json_response = array('returnMessage' => 'Invalid request parameters',
								   'returnValue' => 'FAILED');    

			$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
			return false;
		}
    }
	
	function getUserType() {
		$username = $this->input->get('username');
		
		if ($username != null) {
			$result = $this->user->getUserType($username);
			if ($result) {
				foreach ($result as $row)
				$json_response = array('user_type' => $row->user_type,
									  'returnValue' => 'SUCCESS'); 
				$this->output->set_content_type('application/json')->set_output(json_encode($json_response));
			}
			else {
				$json_response = array('username' => $username,
									  'returnMessage'=>'No available records from the given username',
									  'returnValue'=>'FAILED');    

			   $this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 

				return false;
			}
		}
		else {
			$json_response = array('returnMessage' => 'Invalid request parameters',
								   'returnValue' => 'FAILED');    

			$this->output->set_content_type('application/json')->set_output(json_encode($json_response)); 
			return false;
		}
     }
}
?>