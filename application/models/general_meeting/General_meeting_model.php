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
  `cseweb`.`meeting_type` mtp, (SELECT `m`.*,
    GROUP_CONCAT(t.title) AS tag_title
  FROM
    `cseweb`.meeting m
    LEFT JOIN `cseweb`.meeting_tag mt
    INNER JOIN `cseweb`.tag t
      ON mt.`tag_id` = t.`id`
      ON m.id = mt.meeting_id
  GROUP BY m.id) mm
WHERE mm.title = mtp.id
ORDER BY mm.`submitted_at` DESC');
        return $result = $query->result();
    }
    public function getMeetingDetails($id)
    {
        $query = $this->db->query('SELECT `mtp`.`title` AS title_type, `mm`.* FROM
  `cseweb`.`meeting_type` mtp, (SELECT `m`.*,
    GROUP_CONCAT(t.title) AS tag_title
  FROM
    `cseweb`.meeting m
    LEFT JOIN `cseweb`.meeting_tag mt
    INNER JOIN `cseweb`.tag t
      ON mt.`tag_id` = t.`id`
      ON m.id = mt.meeting_id and m.id='.$id.') mm
WHERE mm.title = mtp.id');
        /*$query = $this->db->query('SELECT m.id, m.meeting_no, m.title, m.`date`, m.`resolution_no`, m.`resolution`, m.`submitted_by`, GROUP_CONCAT(t.title)
AS tag_title FROM `cseweb`.meeting m LEFT JOIN `cseweb`.meeting_tag mt
INNER JOIN `cseweb`.tag t
    ON mt.`tag_id` = t.`id`
ON m.id=mt.meeting_id and m.id='.$id.'');*/
        return $result = $query->result();
    }
    public function getMeetingType()
    {
        $arr=array();
        $this->db->select('id, title');
        $this->db->from('cseweb.meeting_type');
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
        $this->db->from('cseweb.tag');
        $this->db->order_by('title');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['title'];
        }
        return $arr;
    }
    public function validateMeetingMeeting($data) {
        $this->db->where('meeting_no', $data);
        return $this->db->get('cseweb.meeting')->row();
    }
    /*public function validateMeetingResolution($data) {
        $this->db->where('resolution_no', $data);
        return $this->db->get('cseweb.meeting')->row();
    }*/
    public function saveMeeting($data)
    {
        $this->db->insert('cseweb.meeting', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function saveMeetingTag($tag_data)
    {
        $this->db->insert_batch('cseweb.meeting_tag', $tag_data);
    }
    public function validateMeetingType($data) {
        $this->db->where('title', $data);
        return $this->db->get('cseweb.meeting_type')->row();
    }
    public function saveMeetingType($data)
    {
        $this->db->insert('cseweb.meeting_type', $data);
    }

    public function validateTag($data) {
        $this->db->where('title', $data);
        return $this->db->get('cseweb.tag')->row();
    }
    public function saveTag($data)
    {
        $this->db->insert('cseweb.tag', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}