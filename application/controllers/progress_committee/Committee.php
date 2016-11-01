<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Committee extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("progress_committee/Committee_model", "Committee_model");
		$this->load->model("progress_committee/Supervisor_model", "Supervisor_model");
		if((($this->session->userdata('role'))!=='Admin')) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
	}
	public function index()
	{
		$data['doctors'] = $this->Committee_model->getDoctors();
		$data['students'] = $this->Committee_model->getStudents();
		$data['doctorList'] = $this->Committee_model->getDoctorList();
		$this->load->view('progress_committee/admin/committee_create', $data);
	}
	Public function save(){
		$status = $this->Committee_model->validateStudent($this->input->post('for_student'));
		if(empty($status)) {
			$CI = &get_instance();
			$username = $CI->session->userdata('username');
			$data = array(
				'for_student' => $this->input->post('for_student'),
				'supervisor' => $this->input->post('supervisor'),
				'co_supervisor' => $this->input->post('co_supervisor'),
				'ex_officio' => $this->input->post('ex_officio'),
				'created_by' => $username,
			);
			$cid=$this->Committee_model->saveCommittee($data);

			$full_name = $this->Committee_model->getFullName($this->input->post('for_student'));
			$full_name=$full_name[0]->STUDENTNAME;
			$email = $this->Committee_model->getEmail($this->input->post('for_student'));
			$email=$email[0]->EMAIL;
			$student_data = array(
				'username' => $this->input->post('for_student'),
				'full_name' => $full_name,
				'designation' => 'Student',
				'role' => 'Student',
				'email' => $email,
			);
			$this->Committee_model->saveStudentUser($student_data);
			$member_data =array();
			for($i=0; $i <150; $i++) {
				$member = $this->input->post('member'.$i);
				if (isset($member)) {
					$member_data[$i] = array(
						'cid' => $cid,
						'member' => $member,
					);
				}
			}
			$this->Committee_model->saveCommitteeMember($member_data);

			$data['success_msg'] = '<div class="alert alert-success text-center">Committee created successfully !<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#"> &times;</a> </strong></div>';
			$data['doctors'] = $this->Committee_model->getDoctors();
			$data['students'] = $this->Committee_model->getStudents();
			$data['doctorList'] = $this->Committee_model->getDoctorList();
			$this->load->view('progress_committee/admin/committee_create', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-warning text-center">For this student already committee created !<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#"> &times;</a> </strong></div>';
			$data['doctors'] = $this->Committee_model->getDoctors();
			$data['students'] = $this->Committee_model->getStudents();
			$data['doctorList'] = $this->Committee_model->getDoctorList();
			$this->load->view('progress_committee/admin/committee_create', $data);
		}
	}

	public function committee_list()
	{
		$data['all_committee'] = $this->Committee_model->getCommittee();
		$this->load->view('progress_committee/admin/committee_list', $data);
	}
	public function committee_detail($id)
	{
		$data['committee'] = $this->Committee_model->getSingleCommittee($id);
		$data['committees'] = $this->Committee_model->getSingleCommitteeMembers($id);
		$data['meetings'] = $this->Supervisor_model->getMeetings($id);
		$this->load->view('progress_committee/admin/committee_detail',$data);
	}
	public function committee_print($id)
	{
		$data['committee'] = $this->Committee_model->getSingleCommittee($id);
		$data['committees'] = $this->Committee_model->getSingleCommitteeMembers($id);
		$this->load->view('progress_committee/admin/committee_print',$data);
	}
	public function add()
	{
		$this->load->view('progress_committee/admin/add_external');
	}
	public function add_external()
	{
		$username = $this->Committee_model->validateExternalUsername($this->input->post('username'));
		$email = $this->Committee_model->validateExternalEmail($this->input->post('email'));
		if(empty($username)&&empty($email)) {
			$data = array(
				'username' => $this->input->post('username'),
				'full_name' => $this->input->post('full_name'),
				'designation' => $this->input->post('designation'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'type' => $this->input->post('type'),
			);
			$data_user = array(
				'username' => $this->input->post('username'),
				'full_name' => $this->input->post('full_name'),
				'designation' => $this->input->post('designation'),
				'role' => 'External',
				'email' => $this->input->post('email'),
			);
			$this->Committee_model->saveExternal($data, $data_user);
			$data['success_msg'] = '<div class="alert alert-success text-center">External  added successfully !<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#"> &times;</a> </strong></div>';
			$this->load->view('progress_committee/admin/add_external', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-warning text-center">This external already exist !<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#"> &times;</a> </strong></div>';
			$this->load->view('progress_committee/admin/add_external', $data);
		}
	}
	public function external_list()
	{
		$data['all_external'] = $this->Committee_model->getExternal();
		$this->load->view('progress_committee/admin/external_list', $data);
	}
}
