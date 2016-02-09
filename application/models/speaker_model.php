<?php
  Class Speaker_model extends CI_Model
  {
        //function for adding training course
       public function add_speaker($training_id, $fname, $mname, $lname, $image) {
          $data = array(
              'training_id' => $training_id,
              'fname' => $fname,
              'mname' => $mname,
              'lname' => $lname,
              'image' => $image
          );

          return $this->db->insert('training_speakers', $data);
       }

       //function to get the speaker id by training id
       public function get_speaker_id_by_training_id($training_id) {
         $this -> db -> select('speaker_id');
         $this -> db -> from('training_speakers');
         $this -> db -> where('training_id', $training_id);
         $this -> db -> limit(1);

         $query = $this -> db -> get();
          
         if($query -> num_rows() >= 1) {
           return $query->result();
         }
         else {
           return false;
         }
       }

       //function to get a specific speaker detail
       public function get_speaker_by_speaker_id($speaker_id) {
         $this -> db -> select('*');
         $this -> db -> from('training_speakers');
         $this -> db -> where('speaker_id', $speaker_id);
         $this -> db -> limit(1);

         $query = $this -> db -> get();
          
         if($query -> num_rows() >= 1) {
           return $query->result();
         }
         else {
           return false;
         }
       }
  }
?>