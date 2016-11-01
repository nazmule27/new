<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Committee_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getDoctors()
    {
        $arr=array();
        $ignore = array('roots', 'cseoffice');
        $this->db->select('fac_login, CONCAT(fac_name," (", fac_login,")") as fac_name');
        $this->db->from('cseweb.fac_list');
        $this->db->where_not_in('fac_login', $ignore);
        $this->db->order_by('fac_name');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['fac_login']]=$row['fac_name'];
        }
        return $arr;
    }
    /*public function getDoctors()
    {
        $arr=array();
        $ignore = array('roots', 'cseoffice');
        $this->db->select('fac_login, CONCAT(fac_name," (", fac_login,")") as fac_name');
        $this->db->from('cseweb.fac_list');
        $this->db->where_not_in('fac_login', $ignore);
        $this->db->order_by('fac_name');
        $query = $this->db->get()->result();

        $this->db->select('`username` AS fac_login, CONCAT(full_name, " (", `username`, ")") AS fac_name');
        $this->db->from('external');
        $this->db->order_by('fac_name');
        $query2 = $this->db->get()->result();

        $query = array_merge($query, $query2);
        foreach($query as $row){
            //$arr[$row['fac_login']]=$row['fac_name'];
            $arr[$row->fac_login]=$row->fac_name;
        }
        return $arr;
    }*/
    public function getStudents()
    {
        $arr=array();
        $this->db->select('STUDENTID, CONCAT(STUDENTNAME," (", STUDENTID,")") as STUDENTNAME');
        $this->db->from('cseweb.csestudents');
        $this->db->where('`STUDENTID` NOT IN (SELECT `for_student` FROM `committee`)', NULL, FALSE);
        $this->db->where('LENGTH(STUDENTID)>7', null, false);
        $this->db->order_by('STUDENTNAME');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['STUDENTID']]=$row['STUDENTNAME'];
        }
        return $arr;
    }
    public function getDoctorList()
    {
        $ignore = array('roots', 'cseoffice');
        $this->db->select('fac_login, CONCAT(fac_name," (", fac_login,")") as fac_name');
        $this->db->from('cseweb.fac_list');
        $this->db->where_not_in('fac_login', $ignore);
        $this->db->order_by('fac_name');
        $query = $this->db->get()->result();

        $this->db->select('`username` AS fac_login, CONCAT(full_name, " (", `username`, ")") AS fac_name');
        $this->db->from('external');
        $this->db->order_by('fac_name');
        $query2 = $this->db->get()->result();

        $query = array_merge($query, $query2);

        return $result = $query;
    }
    public function validateStudent($data) {
        $this->db->where('for_student', $data);
        return $this->db->get('committee')->row();
    }
    public function getFullName($sid)
    {
        $this->db->select('STUDENTNAME');
        $this->db->from('cseweb.csestudents');
        $this->db->where('STUDENTID', $sid);
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getEmail($sid)
    {
        $this->db->select('EMAIL');
        $this->db->from('cseweb.csestudents');
        $this->db->where('STUDENTID', $sid);
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveCommittee($data)
    {
        $this->db->insert('committee', $data);
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }
    public function saveCommitteeMember($data)
    {
        $this->db->insert_batch('committee_member', $data);
    }
    public function saveStudentUser($student_data)
    {
        $this->db->insert('users', $student_data);
    }
    public function getCommittee()
    {
        $this->db->select('id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor,faculty_name(co_supervisor) as co_supervisor');
        $this->db->from('committee');
        $this->db->order_by('id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSingleCommittee($id)
    {
        $this->db->select('id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor,faculty_name(co_supervisor) as co_supervisor, created_at ');
        $this->db->from('committee');
        $this->db->where('id',$id);
        $this->db->order_by('id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSingleCommitteeMembers($id)
    {
        /*$this->db->select('faculty_name(member) as member');
        $this->db->from('committee_membera m, `users` u');
        $this->db->where('cid',$id);
        $this->db->where('m.`member`=u.`username ` COLLATE utf8_unicode_ci');
        $this->db->order_by('u.`joining_date`');
        $query = $this->db->get();*/

        $query = $this->db->query('SELECT faculty_name(member) AS member FROM `committee_member` `m`, `users` `u` WHERE `cid` = '."'".$id."'".' AND `m`.`member` = `u`.`username` COLLATE utf8_unicode_ci ORDER BY `u`.`joining_date`');
        return $result = $query->result();
    }
    public function validateExternalUsername($data) {
        $this->db->where('username', $data);
        return $this->db->get('external')->row();
    }
    public function validateExternalEmail($data) {
        $this->db->where('email', $data);
        return $this->db->get('external')->row();
    }
    public function saveExternal($data, $data_user)
    {
        $this->db->insert('external', $data);
        $this->db->insert('users', $data_user);
    }
    public function getExternal()
    {
        $query = $this->db->get('external');
        return $result = $query->result();
    }
    function __destruct() {
        $this->db->close();
    }
}