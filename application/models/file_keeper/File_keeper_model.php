<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_keeper_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getFileType()
    {
        $arr=array();
        $this->db->select('type_name');
        $this->db->from('cseweb.file_type');
        $this->db->order_by('type_name');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['type_name']]=$row['type_name'];
        }
        return $arr;
    }
    public function getDestination()
    {
        $arr=array();
        $this->db->select('destination_name');
        $this->db->from('cseweb.file_destination');
        $this->db->order_by('destination_name');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['destination_name']]=$row['destination_name'];
        }
        return $arr;
    }
    public function validateTrackNo($data) {
        $this->db->where('track_no', $data);
        return $this->db->get('cseweb.file_keeper')->row();
    }
    public function saveFile($data)
    {
        $this->db->insert('cseweb.file_keeper', $data);
    }
    public function getFiles()
    {
        $CI = &get_instance();
        $role = $CI->session->userdata('role');
        $username = $CI->session->userdata('username');
        $this->db->select('track_no, reference_no, destination, file_name, created_at');
        $this->db->from('cseweb.file_keeper');
        if($role!=='Admin') {
            $this->db->where('created_by',$username);
        }
        $this->db->order_by('created_at desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function validateType($data) {
        $this->db->where('type_name', $data);
        return $this->db->get('cseweb.file_type')->row();
    }
    public function saveType($data)
    {
        $this->db->insert('cseweb.file_type', $data);
    }
    public function validateDestination($data) {
        $this->db->where('destination_name', $data);
        return $this->db->get('cseweb.file_destination')->row();
    }
    public function saveDestination($data)
    {
        $this->db->insert('cseweb.file_destination', $data);
    }
    public function getSerial($type)
    {
        $this->db->select('track_no, CONVERT(SUBSTRING_INDEX(track_no, "/", -1),UNSIGNED INTEGER) last_number, SUBSTRING_INDEX(track_no, "/", -1)+1 AS next_number');
        $this->db->from('cseweb.file_keeper');
        $this->db->like('track_no', $type, 'after');
        $this->db->order_by('last_number DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result();
    }
    function __destruct() {
        $this->db->close();
    }
}