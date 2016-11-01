<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSingleCommittee($id)
    {
        $this->db->select('id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor,faculty_name(co_supervisor) as co_supervisor');
        $this->db->from('committee');
        $this->db->where('for_student',$id);
        $this->db->order_by('id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSingleCommitteeMembers($id)
    {
        $this->db->select('faculty_name(member) as member');
        $this->db->from('committee_member m, committee c');
        $this->db->where('c.`id`=m.`cid`');
        $this->db->where('for_student',$id);
        $this->db->order_by('member');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getMeetings($uid)
    {
        $this->db->select('m.*');
        $this->db->from('meeting m, committee c');
        $this->db->where('c.`id`=m.`cid`');
        $this->db->where('for_student',$uid);
        $this->db->order_by('meeting_date_time desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSingleMeetingCommittee($mid)
    {
        $this->db->select('c.id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor,faculty_name(co_supervisor) as co_supervisor, m.type');
        $this->db->from('committee c, meeting m');
        $this->db->where('c.`id`=m.`cid`');
        $this->db->where('m.id',$mid);
        $this->db->order_by('m.id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getDocumentList($mid)
    {
        $this->db->select('*');
        $this->db->from('meeting_document');
        $this->db->where('student_can_see',1);
        $this->db->where('mid',$mid);
        $this->db->order_by('created_at desc');
        $query = $this->db->get();
        return $result = $query->result();
    }

    function __destruct() {
        $this->db->close();
    }
}