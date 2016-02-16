<?php
	Class Speaker_model extends CI_Model {
		//function for adding training course
        public function add_speaker($training_id, $fname, $mname, $lname, $email, $phone, $company, $company_position, $image) {
			$data = array('training_id' => $training_id,
						  'firstname' => $fname,
						  'middlename' => $mname,
						  'lastname' => $lname,
						  'email' => $email,
						  'phone' => $phone,
						  'company' => $company,
						  'company_position' => $company_position,
						  'image' => $image
			);

			return $this->db->insert('speakers', $data);
		}

		//function to get the speaker id by training id
		public function get_speaker_id_by_training_id($training_id) {
			$this -> db -> select('speaker_id');
			$this -> db -> from('ntraining_speakers');
			$this -> db -> where('traiing_id', $training_id);
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
		public function get_speakers_by_speaker_id($speaker_id) {
			$this -> db -> select('*');
			$this -> db -> from('speakers');
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
		
		public function updateSpeaker_detail($speaker_id, $fname, $mname, $lname, $email, $phone, $company, $company_position, $image) {
			$data = array('firstname' => $fname,
						  'middlename' => $mname,
						  'lastname' => $lname,
						  'email' => $email,
						  'phone' => $phone,
						  'company' => $company,
						  'company_position' => $company_position,
						  'image' => $image);
			
			$this->db->where("speaker_id = $speaker_id");
			return $this->db->update('speakers', $data);
		}
	}
?>