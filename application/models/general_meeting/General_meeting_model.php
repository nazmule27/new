<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_meeting_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getMeetings()
    {
        $query = $this->db->query('SELECT `mtp`.`title` AS title_type, `mm`.* FROM
  `general_meeting_type` mtp, (SELECT `m`.*, mt.`tag_id`,
    GROUP_CONCAT(t.title) AS tag_title
  FROM
    general_meeting m
    LEFT JOIN meeting_tag mt
    INNER JOIN tag t
      ON mt.`tag_id` = t.`id`
      ON m.id = mt.meeting_id
  GROUP BY m.id) mm
WHERE mm.title = mtp.id
ORDER BY mm.`submitted_at` DESC');
        return $result = $query->result();
    }
    public function getFilterMeetings($tag)
    {
        $query = $this->db->query('SELECT `mtp`.`title` AS title_type, `mm`.* FROM
  `general_meeting_type` mtp, (SELECT `m`.*, mt.`tag_id`,
    GROUP_CONCAT(t.title) AS tag_title
  FROM
    general_meeting m
    LEFT JOIN meeting_tag mt
    INNER JOIN tag t
      ON mt.`tag_id` = t.`id`
      ON m.id = mt.meeting_id AND mt.`tag_id` IN ('.$tag.')
  GROUP BY m.id) mm
WHERE mm.title = mtp.id
ORDER BY mm.`submitted_at` DESC');
        return $result = $query->result();
    }
    public function getMeetingDetails($id)
    {
        $query = $this->db->query('SELECT `mtp`.`title` AS title_type, `mm`.* FROM
  `general_meeting_type` mtp, (SELECT `m`.*, mt.`tag_id`,
    GROUP_CONCAT(t.title) AS tag_title
  FROM
    general_meeting m
    LEFT JOIN meeting_tag mt
    INNER JOIN tag t
      ON mt.`tag_id` = t.`id`
      ON m.id = mt.meeting_id
  GROUP BY m.id) mm
WHERE mm.title = mtp.id AND mm.id='.$id.'
ORDER BY mm.`submitted_at` DESC');
        /*$query = $this->db->query('SELECT m.id, m.meeting_no, m.title, m.`date`, m.`resolution_no`, m.`resolution`, m.`submitted_by`, GROUP_CONCAT(t.title)
AS tag_title FROM general_meeting m LEFT JOIN meeting_tag mt
INNER JOIN tag t
    ON mt.`tag_id` = t.`id`
ON m.id=mt.meeting_id and m.id='.$id.'');*/
        return $result = $query->result();
    }
    public function getMeetingType()
    {
        $arr=array();
        $this->db->select('id, title');
        $this->db->from('general_meeting_type');
        $this->db->order_by('title');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['title'];
        }
        return $arr;
    }
    public function getTag()
    {
        $arr=array();
        $this->db->select('id, title');
        $this->db->from('tag');
        $this->db->order_by('title');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['title'];
        }
        return $arr;
    }
    public function validateMeetingNoResolution($meeting_no, $resolution_no) {
        $this->db->where('meeting_no', $meeting_no);
        $this->db->where('resolution_no', $resolution_no);
        return $this->db->get('general_meeting')->row();
    }
    /*public function validateMeetingResolution($data) {
        $this->db->where('resolution_no', $data);
        return $this->db->get('general_meeting')->row();
    }*/
    public function saveMeeting($data)
    {
        $this->db->insert('general_meeting', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function deleteMeeting($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('general_meeting');
    }
    public function deleteMeetingTag($id)
    {
        $this->db->where('meeting_id', $id);
        $this->db->delete('meeting_tag');
    }
    public function saveMeetingTag($tag_data)
    {
        $this->db->insert_batch('meeting_tag', $tag_data);
    }
    public function validateMeetingType($data) {
        $this->db->where('title', $data);
        return $this->db->get('general_meeting_type')->row();
    }
    public function saveMeetingType($data)
    {
        $this->db->insert('general_meeting_type', $data);
    }

    public function validateTag($data) {
        $this->db->where('title', $data);
        return $this->db->get('tag')->row();
    }
    public function saveTag($data)
    {
        $this->db->insert('tag', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}