<?php
  Class Course_model extends CI_Model
  {
        //function for adding training course
       public function add_course($course_name, $user_id, $course_code) {
          $data = array(
              'course_name' => $course_name,
              'uid' => $user_id,
			  'course_code' => $course_code
          );

          return $this->db->insert('course', $data);
       }

       //function to get the course id using a course name
       public function get_course_id_by_course_name($course_name) {
         /*$this -> db -> select('course_id');
         $this -> db -> from('course');
         $this -> db -> where('course_name', $course_name);*/

         $this -> db -> select('course_id');
         $this -> db -> from('course');
         $this -> db -> where('course_name', $course_name);
         $this -> db -> limit(1);
         

         $query = $this -> db -> get();
         if($query -> num_rows() >= 1) {
           return $query->result();
         }
         else {
           return false;
         }
       }

       //function to get a specific course
       public function get_course_by_course_id($course_id) {
         $this -> db -> select('*');
         $this -> db -> from('course');
         $this -> db -> where('course_id', $course_id);
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