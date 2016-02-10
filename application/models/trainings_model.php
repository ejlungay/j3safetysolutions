<?php
  Class Trainings_model extends CI_Model
  {
        //function for adding training course
       public function add_training($course_id,  $location, $training_fee) {
          $data = array(
              'course_id' => $course_id,
              'location' => $location,
              'fee' => $training_fee
          );

          return $this->db->insert('trainings', $data);
       }

       //function to get the training id by course id
       public function get_training_id_by_course_id($course_id) {
         $this ->db->select('training_id');
         $this ->db->from('trainings');
         $this ->db->where('course_id', $course_id);
         $this ->db->limit(1);

         $query = $this->db->get();
          
         if($query->num_rows() >= 1) {
           return $query->result();
         }
         else {
           return false;
         }
       }

       //function to get a specific course
       public function get_training_by_training_id($training_id) {
         $this->db->select('*');
         $this->db->from('trainings');
         $this->db->where('training_id', $training_id);
         $this->db->limit(1);

         $query = $this -> db -> get();
          
         if($query->num_rows() >= 1) {
           return $query->result();
         }
         else {
           return false;
         }
       }

       // a model for querying all trainings
       public function get_trainings_list($count) {
          $this->db->select('a.course_id, a.course_name, a.date_added,  b.training_id, b.fee, b.date');
          $this->db->from('COURSE as a, TRAININGS as b');
          $this->db->limit($count);
          //$query = $this->db->select('SELECT  FROM COURSE as a, TRAININGS as b');

          $query = $this ->db -> get();

          if ($query->num_rows() >= 1){
            return $query->result();
          }
          else {
            return false;
          }
       }

       // a model for querying training delegates
       public function get_training_delegates($training_id) {
          $this->db->select('c.course_name, b.*');
          $this->db->from('course as c, trainings as a,  delegates as b');
          $this->db-> where("a.training_id = $training_id  and a.training_id = b.training_id and c.course_id = a.course_id");
          $this->db->limit(0);
          $query = $this->db->get();

          if ($query->num_rows() >= 1){
            return $query->result();
          }
          else {
            return false;
          }
       }
  }
?>