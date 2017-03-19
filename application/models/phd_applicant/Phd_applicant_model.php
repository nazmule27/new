<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phd_applicant_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getFileType()
    {
        $arr=array();
        $this->db->select('type_id, type_name');
        $this->db->from('cseweb.phd_applicant_file_type');
        $this->db->order_by('type_name');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['type_id']]=$row['type_name'];
        }
        return $arr;
    }
    public function validateFileType($file_type, $username) {
        $this->db->where('file_type', $file_type);
        $this->db->where('created_by', $username);
        return $this->db->get('cseweb.phd_applicant_files')->row();
    }
    public function saveFile($data)
    {
        $this->db->insert('cseweb.phd_applicant_files', $data);
    }
    public function updateFile($file_type, $username, $data)
    {
        $this->db->where('file_type', $file_type);
        $this->db->where('created_by', $username);
        $this->db->update('cseweb.phd_applicant_files',$data);
    }
    public function getFiles()
    {
        $CI = &get_instance();
        $role = $CI->session->userdata('role');
        $username = $CI->session->userdata('username');
        $this->db->select('file_type, file_name, created_by, created_at');
        $this->db->from('cseweb.phd_applicant_files');
        if($role!=='Admin') {
            $this->db->where('created_by',$username);
        }
        $query = $this->db->get();
        return $result = $query->result();
    }

    function __destruct() {
        $this->db->close();
    }
}