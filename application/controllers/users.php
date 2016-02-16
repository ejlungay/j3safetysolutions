<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends CI_Controller {
    function __construct() {
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->helper('url');
		$this->load->library('session');
    }
     
    function index() {
		
    }

    function signin() {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if ($username != null && $password != null) {
			
			$result = $this->user->login($username, $password);
			if($result) {
				$sess_array = array();
				$json_response = array('username' => $row->username,
									   'firstname' => $row->fname,
									   'middlename' => $row->middlename, 
									   'lastname' => $row->lastname,
									   'user_type' => $row->user_type,
									   'returnMessage'=>'User validated',
									   'returnValue'=>'SUCCESS',
									   'authenticated'=>'TRUE');    

				$this->output->set_content_type('application/json')->set_output(json_encode($json_response));
			}
		   else {
				$json_response = array('returnMessage'=>'Invalid username or password',
									   'returnValue'=>'FAILED',
									   'authenticated'=>'FALSE',
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

    //function to create user account
    public function signup() {
		$this->load->helper('url');
        $this->load->database();

        //check for duplicates
        $isDuplicated = $this->user->checkDuplicates($this->input->post('username'));
        if ($isDuplicated) {
			//username is already in used; show an error
			$json_response = array('returnMessage'=>'Username is already in used',
                                'returnValue'=>'FAILURE');    
			$this->output->set_content_type('application/json')->set_output(json_encode($json_response));							
        }
        else {
			//get the user input via POST method
			$password = $this->input->post('password');
			
			//for image purposes
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

				header('Content-Type: application/json');
				echo json_encode( $json_response);

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

          $result = $this->user->updateUserDetail($username, $fname, $mname, $lname);
        if ($result) {
            $json_response = array('username' => $username,
                                  'returnMessage'=>'User detail successfully changed',
                                  'returnValue'=>'SUCCESS');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('username' => $username,
                                  'returnMessage'=>'User detail change unsuccessful',
                                  'returnValue'=>'FAILED');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return false;
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

			   header('Content-Type: application/json');
			   echo json_encode( $json_response);

				return false;
			}
		}
		else {
			$json_response = array('username' => $username,
								   'returnMessage'=>'Invalid request parameters',
								   'returnValue'=>'FAILED');    

			header('Content-Type: application/json');
			echo json_encode( $json_response);

			return false;
		}
     }
}
?>