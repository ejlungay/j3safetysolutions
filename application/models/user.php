<?php
  Class User extends CI_Model
  {
       function login($username, $password) {

         $this -> db -> select('*');
         $this -> db -> from('users');
         $this -> db -> where('username', $username);
         $this -> db -> where('password', md5($password));
         $this -> db -> limit(1);
       
         $query = $this -> db -> get();
       
         if($query -> num_rows() == 1)
         {
           return $query->result();
         }
         else
         {
           return false;
         }
       }

       function updateUserPassword($username, $password) {
          $data = array(
               'password' => md5($password)
            );

          $this->db->where('username', $username);
          $this->db->update('users', $data); 

          return true;
          // Produces:
          // UPDATE mytable 
          // SET title = '{$title}', name = '{$name}', date = '{$date}'
          // WHERE id = $id
       }

       function updateUserDetail($username, $fname, $mname, $lname) {
          $data = array(
               'fname' => $fname,
               'middlename' => $mname,
               'lastname' => $lname
            );

          $this->db->where('username', $username);
          $this->db->update('users', $data);
          return true;
       }

       function checkDuplicates($username) {
         $this -> db -> select('*');
         $this -> db -> from('users');
         $this -> db -> where('username', $username);
       
         $query = $this -> db -> get();
       
         if($query -> num_rows() >= 1)
         {
           return true;
         }
         else
         {
           return false;
         }
       }
  }
?>