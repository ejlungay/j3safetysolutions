<?php
	Class Delegate_model extends CI_Model {
        //function for adding training course
		public function add_delegate($training_id, $fname, $mname, $lname, $email, $company, $company_position, $phone,  $image) {
			$data = array( 'training_id' => $training_id,
						   'firstname' => $fname,
						   'middlename' => $mname,
						   'lastname' => $lname,
						   'email' => $email,
						   'company'=> $company,
						   'company_position' => $company_position,
						   'phone' => $phone,
						   'image' => $image);

			return $this->db->insert('delegates', $data);
		}
      
		//function to get a specific speaker detail
		public function get_delegate_by_delegate_id($delegate_id) {
			$this -> db -> select('a.delegate_id, a.training_id, a.firstname, a.middlename, a.lastname, a.email, a.phone, a.company, a.company_position');
			$this -> db -> from('delegates as a');
			$this -> db -> where('a.delegate_id', $delegate_id);
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
		public function updateDelegateDetail($delegate_id, $fname, $mname, $lname, $email, $company, $company_position, $phone) {
			$data = array('firstname' => $fname,
						  'middlename' => $mname,
						  'lastname' => $lname,
						  'email' => $email,
						  'company' => $company,
						  'company_position' => $company_position,
						  'phone' => $phone);

			$this->db->where('delegate_id', $delegate_id);
			$this->db->update('delegates', $data);
			return true;
		}
	   
	    public function change_delegate_picture($delegate_id, $img) {
			$data = array('image' => $img);
			$this->db->where("delegate_id = $delegate_id");
			return $this->db->update('delegates', $data);
		}
		
		public function search_delegate($key) {
			$this->db->select('a.delegate_id, a.training_id, a.firstname, a.middlename, a.lastname, a.email, a.phone, a.company, a.company_position');
			$this->db->from('delegates as a');
			$this->db->where("a.lastname LIKE '$key%' or a.firstname LIKE '$key%'");
			$this->db->limit(0);
			
			$query = $this->db->get();
			
			if ($query->num_rows() >= 1) {
				return $query->result();
			}
			else {
				return false;
			}
		}
  }
?>