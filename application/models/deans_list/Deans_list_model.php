<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deans_list_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getDeansList()
    {
        $this->db->select('student_id, first_name, last_name, session, level, reference');
        $this->db->from('cseweb.deans_list');
        $this->db->order_by('student_id');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSingleStudent()
    {
        $this->db->select('id, student_id, first_name, last_name, session, level, reference');
        $this->db->from('cseweb.deans_list');
        //$this->db->where('cseweb.deans_list.student_id', $sid);
        $this->db->order_by('student_id');
        $query = $this->db->get();
        return $result = $query->result();
    }
    function __destruct() {
        $this->db->close();
    }
}