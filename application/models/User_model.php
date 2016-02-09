<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User_model extends CI_Model {
    
    protected $table_name;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table_name = 'trainings';
    }
    
    /*public function getAll() {
        return $this->db->from($this->table_name)->get()->result_array();
    }*/
    
    public function getAll() {
        $this->db->select('a.training_id, b.course_name');
        $this->db->from('trainings as a, course as b');
        return $this->db->get()->result_array();
    }
}
//- See more at: https://arjunphp.com/angularjs-and-codeigniter-retrieve-data-from-the-database/#sthash.SC1b9Aev.dbplus_find(relation, constraints, tuple)