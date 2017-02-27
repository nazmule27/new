<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_thesis_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getFaculty()
    {
        $ignore = array('cseoffice', 'roots');
        $arr=array();
        $this->db->select('fl.fac_login, fl.fac_name');
        $this->db->from('cseweb.fac_list fl');
        $this->db->where('fl.fac_on_leave=', 0);
        $this->db->where_not_in('fl.fac_login', $ignore);
        $this->db->order_by('fl.fac_joining_date');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['fac_login']]=$row['fac_name'];
        }
        return $arr;
    }
    public function validateThesis($data) {
        $this->db->like('thesis_students', $data);
        return $this->db->get('cseweb.thesis')->row();
    }
    public function saveThesis($data)
    {
        $this->db->insert('cseweb.thesis', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}