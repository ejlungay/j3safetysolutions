<?php
  Class Delegate_model extends CI_Model
  {
        //function for adding training course
       public function add_delegate($training_id, $fname, $mname, $lname, $email, $company, $phone, $address, $image) {
          $data = array(
              'training_id' => $training_id,
              'fname' => $fname,
              'mname' => $mname,
              'lname' => $lname,
              'email' => $email,
              'company'=> $company,
              'phone' => $phone,
              'address' => $address,
              'image' => $image
          );

          return $this->db->insert('delegates', $data);
       }
      
       //function to get a specific speaker detail
       public function get_delegate_by_delegate_id($delegate_id) {
         $this -> db -> select('*');
         $this -> db -> from('delegates');
         $this -> db -> where('delegate_id', $delegate_id);
         //$this -> db -> limit(1);

         $query = $this -> db -> get();
          
         if($query -> num_rows() >= 1) {
           return $query->result();
         }
         else {
           return false;
         }
       }

       //function to update delegate detail 
       function updateDelegateDetail($delegate_id, $fname, $mname, $lname, $email, $company, $phone, $address) {
          $data = array(
               'fname' => $fname,
               'mname' => $mname,
               'lname' => $lname,
               'email' => $email,
               'company' => $company,
               'phone' => $phone,
               'address' => $address
            );

          $this->db->where('delegate_id', $delegate_id);
          $this->db->update('delegates', $data);
          return true;
       }
  }
?>