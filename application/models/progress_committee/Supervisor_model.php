<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getCommittee($username)
    {
        $this->db->select('id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor,faculty_name(co_supervisor) as co_supervisor');
        $this->db->from('committee');
        $this->db->where('supervisor', $username);
        $this->db->order_by('id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSingleCommittee($id)
    {
        $this->db->select('id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor,faculty_name(co_supervisor) as co_supervisor');
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

    public function getCoSupervisorCommittee($username)
    {
        $this->db->select('c.id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor, faculty_name(co_supervisor) as co_supervisor, faculty_name(m.member) as member');
        $this->db->from('committee c, committee_member m');
        $this->db->where('c.id=m.cid');
        $this->db->where('c.co_supervisor', $username);
        $this->db->order_by('id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getMemberCommittee($username)
    {
        $this->db->select('c.id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor, faculty_name(co_supervisor) as co_supervisor, faculty_name(m.member) as member');
        $this->db->from('committee c, committee_member m');
        $this->db->where('c.id=m.cid');
        $this->db->where('m.member', $username);
        $this->db->order_by('id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getMeetingType()
    {
        $arr = array();
        $this->db->select('id, title');
        $this->db->from('meeting_type');
        $this->db->order_by('title');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $arr[$row['id']] = $row['title'];
        }
        return $arr;
    }
    public function getExternal()
    {
        $arr = array();
        $this->db->select('username, full_name');
        $this->db->from('external');
        $this->db->order_by('full_name');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $arr[$row['username']] = $row['full_name'];
        }
        return $arr;
    }
    public function saveMeetingCall($data)
    {
        $this->db->insert('meeting', $data);
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }
    public function saveMeetingDocuments($data)
    {
        $this->db->insert('meeting_document', $data);
    }
    public function getMeetings($cid)
    {
        $this->db->select('*');
        $this->db->from('meeting');
        $this->db->where('cid',$cid);
        $this->db->order_by('meeting_date_time desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSingleMeetingCommittee($mid)
    {
        $this->db->select('c.id, student_name(for_student) as for_student, faculty_name(supervisor) as supervisor, faculty_full_name(supervisor) as supervisor_name, faculty_designation(supervisor) as designation, faculty_name(co_supervisor) as co_supervisor, m.type, m.id as mid, m.meeting_date_time');
        $this->db->from('committee c, meeting m');
        $this->db->where('c.`id`=m.`cid`');
        $this->db->where('m.id',$mid);
        $this->db->order_by('m.id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getMeetingDetail($mid)
    {
        $this->db->select('*');
        $this->db->from('meeting');
        $this->db->where('id',$mid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getDocumentList($mid)
    {
        $this->db->select('*');
        $this->db->from('meeting_document');
        $this->db->where('mid',$mid);
        $this->db->order_by('created_at desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSingleMeetingCommitteeMember($mid)
    {
        /*$this->db->select('c.id, faculty_name(member) as member, faculty_full_name(member) as full_name');
        $this->db->from('committee c, meeting m, committee_member mb, users u');
        $this->db->where('c.`id`=m.`cid`');
        $this->db->where('c.`id`=mb.`cid`');
        $this->db->where('m.id',$mid);
        $this->db->order_by('u.joining_date');
        $query = $this->db->get();
        return $result = $query->result();*/

        $query = $this->db->query('SELECT `c`.`id`, faculty_name(member) AS member, faculty_full_name(member) AS full_name FROM `committee` `c`, `meeting` `m`, `committee_member` `mb`, `users` `u` WHERE `c`.`id` = `m`.`cid` AND `c`.`id` = `mb`.`cid` AND `mb`.`member` = `u`.`username` COLLATE utf8_unicode_ci AND `m`.`id` = '.'"'.$mid.'"'.' ORDER BY `u`.`joining_date`');
        return $result = $query->result();
    }
    public function getUpcomingMeetings($uid)
    {
        $this->db->select('student_name(for_student) as for_student,faculty_name(supervisor) as supervisor,faculty_name(co_supervisor) as co_supervisor, m.*');
        $this->db->from('meeting m, committee c');
        $this->db->where('c.`id`=m.`cid`');
        $this->db->where("m.meeting_date_time >NOW()");
        $this->db->where('c.supervisor',$uid);
        $this->db->order_by('meeting_date_time desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getUpcomingCoSupervisorMeetings($uid)
    {
        $this->db->select('student_name(for_student) as for_student,faculty_name(supervisor) as supervisor,faculty_name(co_supervisor) as co_supervisor, m.*');
        $this->db->from('meeting m, committee c');
        $this->db->where('c.`id`=m.`cid`');
        $this->db->where("m.meeting_date_time >NOW()");
        $this->db->where('c.co_supervisor',$uid);
        $this->db->order_by('meeting_date_time desc');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getUpcomingMemberMeetings($username)
    {
        $this->db->select('c.id, student_name(for_student) as for_student,faculty_name(supervisor) as supervisor, faculty_name(co_supervisor) as co_supervisor, faculty_name(mb.member) as member, m.*');
        $this->db->from('committee c, committee_member mb, meeting m');
        $this->db->where('c.`id`=m.`cid`');
        $this->db->where('c.`id`=mb.`cid`');
        $this->db->where("m.meeting_date_time >NOW()");
        $this->db->where('mb.member', $username);
        $this->db->order_by('mb.id desc');
        $query = $this->db->get();
        return $result = $query->result();
    }

    function __destruct() {
        $this->db->close();
    }
}