<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_meeting_home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("general_meeting/General_meeting_model", "General_meeting_model");
		if((($this->session->userdata('role'))!=='Admin')&&(($this->session->userdata('role'))!=='BPGSSec')&&(($this->session->userdata('role'))!=='BUGSSec')&&(($this->session->userdata('role'))!=='BRTCSec')&&(($this->session->userdata('role'))!=='DeptSec')) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
	}
	public function index()
	{
		$data['meetings'] = $this->General_meeting_model->getMeetings();
		$data['tag'] = $this->General_meeting_model->getTag();
		$this->load->view('general_meeting/meeting_list', $data);
	}
	public function filter_meeting()
	{
		$tag_array=$this->input->post('tag');
		$tag = implode (",", $tag_array);
		$data['meetings'] = $this->General_meeting_model->getFilterMeetings($tag);
		$data['tag'] = $this->General_meeting_model->getTag();
		$this->load->view('general_meeting/meeting_list', $data);
	}
	public function meeting_detail($id)
	{
		$data['meeting'] = $this->General_meeting_model->getMeetingDetails($id);
		$this->load->view('general_meeting/meeting_detail', $data);
	}
	public function add_meeting_resolution()
	{
		$data['meeting_type'] = $this->General_meeting_model->getMeetingType();
		$data['tag'] = $this->General_meeting_model->getTag();
		$this->load->view('general_meeting/meeting_save', $data);
	}
	public function save_meeting() {
		$status = $this->General_meeting_model->validateMeetingNoResolution($this->input->post('meeting_no'), $this->input->post('resolution_no'));
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		if(empty($status)) {
			$data = array(
				'meeting_no' => $this->input->post('meeting_no'),
				'title' => $this->input->post('title'),
				'date' => $this->input->post('date'),
				'resolution_no' => $this->input->post('resolution_no'),
				'resolution' => $this->input->post('resolution'),
				'submitted_by' => $username,
			);
			$mid=$this->General_meeting_model->saveMeeting($data);
			$tag_data =array();
			for($i=0; $i < count($this->input->post('tag')); $i++) {
				$tag_data[$i] = array(
					'meeting_id' => $mid,
					'tag_id' => $this->input->post('tag')[$i],
				);
			}
			$this->General_meeting_model->saveMeetingTag($tag_data);
			$data['meeting_type'] = $this->General_meeting_model->getMeetingType();
			$data['tag'] = $this->General_meeting_model->getTag();
			$data['success_msg'] = '<div class="alert alert-success text-center">Your meeting resolution saved successfully! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('general_meeting/meeting_save', $data);
		}
		else {
			$data['meeting_type'] = $this->General_meeting_model->getMeetingType();
			$data['tag'] = $this->General_meeting_model->getTag();
			$data['success_msg'] = '<div class="alert alert-danger text-center">Sorry, Your meeting no and resolution no already exist. Please try again! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('general_meeting/meeting_save', $data);
		}

	}
	public function meeting_delete($id) {
		$this->General_meeting_model->deleteMeeting($id);
		$this->General_meeting_model->deleteMeetingTag($id);
		redirect('general_meeting/General_meeting_home');

	}
	public function add_meeting_type()
	{
		$this->load->view('general_meeting/add_meeting_type');
	}
	public function save_meeting_type()
	{
		$status = $this->General_meeting_model->validateMeetingType($this->input->post('meeting_type'));
		if(empty($status)) {
			$data = array(
				'title' => $this->input->post('meeting_type'),
			);
			$this->General_meeting_model->saveMeetingType($data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Meeting type successfully added! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('general_meeting/add_meeting_type', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-danger text-center">Sorry, this type already exist. Please try another one! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('general_meeting/add_meeting_type', $data);
		}
	}
	public function add_tag()
	{
		$this->load->view('general_meeting/add_tag');
	}
	public function save_tag()
	{
		$status = $this->General_meeting_model->validateTag($this->input->post('tag'));
		if(empty($status)) {
			$data = array(
				'title' => $this->input->post('tag'),
			);
			$this->General_meeting_model->saveTag($data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Tag successfully added! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('general_meeting/add_tag', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-danger text-center">Sorry, this tag already exist. Please try another one! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
			$this->load->view('general_meeting/add_tag', $data);
		}
	}

}
