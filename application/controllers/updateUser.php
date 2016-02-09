<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
  class UpdateUser extends CI_Controller {
   
     function __construct() {
       parent::__construct();
       $this->load->model('user','',TRUE);
       $this->load->helper('url');
       $this->load->library('session');
     }
     
     function index() {
     
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