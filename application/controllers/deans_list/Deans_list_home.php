<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deans_list_home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('Pdf');
		$this->pdf->fontpath = 'font/';
		$this->load->model("deans_list/Deans_list_model", "Deans_list_model");
		if((($this->session->userdata('role'))!=='Admin')) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
	}
	public function index()
	{
		$data['deans_list'] = $this->Deans_list_model->getDeansList();
		$this->load->view('deans_list/view_deans_list', $data);
	}

	public function deans_list_pdf(){
		$deans_list = $this->Deans_list_model->getSingleStudent();
		$_SESSION["report_name"]='________________________________________________________________________________';
		$date=date('d F Y').'       ';
		for($i=0;$i < count($deans_list);$i++){
			$ref='Ref.: DeansList/CSE/2017/'.$deans_list[$i]->id;
			$name = $deans_list[$i]->student_name;
			$student_id = 'Student No.: '.$deans_list[$i]->student_id;
			$dept = 'Department of CSE, BUET';
			$dear = 'Dear '.$deans_list[$i]->first_name.',';
			$text = 'I am enthusiastically pleased at the inclusion of your name in the prestigious Dean’s List of session  '.$deans_list[$i]->session.' (Level '.$deans_list[$i]->level.'). Congratulations!';
			$text2='CSE Department is proud of your commendable academic performance. I am sure you will continue to strengthen this performance and make all of us proud with excellence in curricular  activities as well that will enhance the image of CSE Department in the World CSE Community.';
			$sincerely='Yours sincerely,';
			$head='Dr. M. Sohel Rahman';
			$designation='Professor & Head';

			$this->pdf->SetFont('Arial', '', 11);
			$this->pdf->AliasNbPages();
			$this->pdf->AddPage();

			$this->pdf->SetXY(18,45);
			$this->pdf->cell(0,5,$date,0,0,'R');
			$this->pdf->SetXY(18,45);
			$this->pdf->cell(0,5,$ref,0,0);
			$this->pdf->SetXY(18,80);
			$this->pdf->cell(0,5,$name,0,0);
			$this->pdf->SetXY(18,85);
			$this->pdf->cell(0,5,$student_id,0,0);
			$this->pdf->SetXY(18,90);
			$this->pdf->cell(0,5,$dept,0,0);
			$this->pdf->SetXY(18,120);
			$this->pdf->cell(0,5,$dear,0,0);
			$this->pdf->SetXY(18,130);
			$this->pdf->MultiCell(0,5,$text,0,'L',0);
			$this->pdf->SetXY(18,142);
			$this->pdf->MultiCell(0,5,$text2,0,'L',0);
			$this->pdf->SetXY(18,180);
			$this->pdf->cell(0,5,$sincerely,0,0);
			$this->pdf->SetXY(18,200);
			$this->pdf->cell(0,5,$head,0,0);
			$this->pdf->SetXY(18,205);
			$this->pdf->cell(0,5,$designation,0,0);
		}

		$this->pdf->Output('deans_list.pdf', 'I');
	}

}
