<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends CI_Controller {
    function __construct() {
       parent::__construct();
       $this->load->model('user','',TRUE);
       $this->load->helper('url');
       $this->load->library('session');
    }
     
    function index() {
       //This method will have the credentials validation
       $this->load->library('form_validation');
     
       $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
       $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
     
       if($this->form_validation->run() == FALSE)
       {
         //Field validation failed.  User redirected to login page
         $this->load->view('login_view');
       }
       else
       {
         //Go to private area
         redirect('home', 'refresh');
       }
     
    }
     
    function check_database($password) {
       //Field validation succeeded.  Validate against database
       $username = $this->input->post('username');
     
       //query the database
       $result = $this->user->login($username, $password);
     
       if($result)
       {
         $sess_array = array();
         foreach($result as $row)
         {
           $sess_array = array(
             'username' => $row->username
           );
           //the user is validated!
           //create a session for the user annd store it somewhere
           $this->session->set_userdata('logged_in', $sess_array);
           //now create a json response 
           $json_response = array('username' => $row->username,
                                  'firstname' => $row->fname,
                                  'middlename' => $row->middlename, 
                                  'lastname' => $row->lastname,
                                  'user_type' => $row->user_type,
                                  'returnMessage'=>'User validated',
                                  'returnValue'=>'SUCCESS',
                                  'authenticated'=>'TRUE');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);
         }
         return TRUE;
       }
       else
       {
        //user is not validated!
        //show an error to the form
         $this->form_validation->set_message('check_database', 'Invalid username or password: '. $username. ' pword: '.md5($password));
         //return json response :D
         
         return false;
       }
    }


    function signin() {
       //Field validation succeeded.  Validate against database
       //$username = $this->input->post('username');
       //$password = $this->input->post('password');
      $username = $_POST['username'];
       $password = $_POST['password'];
       //query the database
       $result = $this->user->login($username, $password);
      
       if($result)
       {
         $sess_array = array();
         foreach($result as $row)
         {
           $sess_array = array(
             'username' => $row->username
           );
           //the user is validated!
           //create a session for the user annd store it somewhere
           $this->session->set_userdata('logged_in', $sess_array);
           //now create a json response 
           $json_response = array('username' => $row->username,
                                  'firstname' => $row->fname,
                                  'middlename' => $row->middlename, 
                                  'lastname' => $row->lastname,
                                  'user_type' => $row->user_type,
                                  'returnMessage'=>'User validated',
                                  'returnValue'=>'SUCCESS',
                                  'authenticated'=>'TRUE');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);
         }
         return TRUE;
       }
       else
       {
        //user is not validated!
        //show an error to the form
        // $this->form_validation->set_message('check_database', 'Invalid username or password');
         //return json response :D
          $json_response = array('returnMessage'=>'Invalid username or password',
                                  'returnValue'=>'FAILED',
                                  'authenticated'=>'FALSE',
                                  'username'=>$username,
                                  'password'=>$password);    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

         return false;
       }
    }

    //function to create user account
    public function create_user_account() {
        $this->load->helper('url');
        //$autoload['helper'] = array('security');
        //$this->load->library('database');
        $this->load->database();

        //check for duplicates
        $isDuplicated = $this->user->checkDuplicates($this->input->post('username'));
        if ($isDuplicated) {
          //username is already in used; show an error
          $json_response = array(
                                'returnMessage'=>'Username is already in used',
                                'returnValue'=>'FAILURE');    

             header('Content-Type: application/json');
             echo json_encode( $json_response);
        }
        else {
          //get the user input via POST method
          $password = $this->input->post('password');

          $data = array(
              'username' => $this->input->post('username'),
              'password' => md5($password),
              'fname' => $this->input->post('firstname'),
              'middlename' => $this->input->post('middlename'),
              'lastname' => $this->input->post('lastname')
          );

          $result = $this->db->insert('users', $data);

          //for response puposes
          //if successfully added
          if ($result) {
            $json_response = array(
                    'username' => $this->input->post('username'),
                                'returnMessage'=>'User successfully created',
                                'returnValue'=>'SUCCESS');    

             header('Content-Type: application/json');
             echo json_encode( $json_response);
          }
          else {
            $json_response = array(
                                'returnMessage'=>'unable to add user',
                                'returnValue'=>'SUCCESS');    

             header('Content-Type: application/json');
             echo json_encode( $json_response);
          }
      }
    }

    function change_password() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $this->user->updateUserPassword($username, $password);
        if ($result) {
            $json_response = array('username' => $username,
                                  'returnMessage'=>'The password was successfully changed',
                                  ' returnValue'=>'SUCCESS');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return true;
        }
        else {
            $json_response = array('username' => $username,
                                  'returnMessage'=>'Unsuccessful:'.$password,
                                  'returnValue'=>'FAILED');    

           header('Content-Type: application/json');
           echo json_encode( $json_response);

            return false;
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
}
?>