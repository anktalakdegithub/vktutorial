<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->model('Batch_Model');
	$this->load->library('session'); 
	$this->load->model('Fees_Model');
	$this->load->model('Student_Model'); 
	$this->load->model('Course_Model'); 
	$this->load->model('Lecture_Model'); 
	$this->load->model('Attendance_Model'); 
	$this->load->model('Test_Model'); 
	$this->load->model('Dashboard_Model'); 
    $this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn'); 
	}

	public function index()
	{
		if ($this->isadminLoggedIn) {
			$result=$this->Fees_Model->totalfees();
			
			  $result['course']=$this->Batch_Model->allcourses();
			  $result['batch']=$this->Batch_Model->totalbatch();
			$result['allexam']=$this->Batch_Model->upcomingexam();
			$result['allassignment']=$this->Attendance_Model->upcomingassignment();
			$result['lecture']=$this->Lecture_Model->todayslecture();
			
			$result['student']=$this->Student_Model->allstudentetails();
			$this->load->view('admin/header');
			$this->load->view('admin/dashboards',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	public function upcomingfees(){
		$fees = $this->Dashboard_Model->upcomingfees();
		$output='';
		foreach ($fees as $lect) {
			$output.='<div class="row">
                    <div class="col-md-12">
                       <a href="'.base_url().'admin/student/studentdetails/'.$lect->StudentId.'"> <h4 class="card-title"> '.$lect->Amount.' Rs.</h4></a>
                        <p><i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; '.$lect->FirstName.' '.$lect->LastName.' &nbsp;&nbsp;<i class="fas fa-calendar"></i> &nbsp;&nbsp;'.date("d-M-Y", strtotime($lect->PaymentDate)).'</p>
                    </div></div><hr>';
		}
		echo $output;
	}
	public function overduefees(){
		$fees = $this->Dashboard_Model->overduefees();
		$output='';
		foreach ($fees as $lect) {
			$output.='<div class="row">
                    <div class="col-md-12">
                       <a href="'.base_url().'admin/student/studentdetails/'.$lect->StudentId.'"> <h4 class="card-title"> '.$lect->Amount.' Rs.</h4></a>
                        <p><i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; '.$lect->FirstName.' '.$lect->LastName.' &nbsp;&nbsp;<i class="fas fa-calendar"></i> &nbsp;&nbsp;'.date("d-M-Y", strtotime($lect->PaymentDate)).'</p>
                    </div></div><hr>';
		}
		echo $output;
	}
	public function fetchlectures()
	{
		$lectures = $this->Dashboard_Model->upcominglectures();
		$output='';
		foreach ($lectures as $lect) {
			$output.='<div class="row">
                    <div class="col-md-12">
                       <a href="'.base_url().'admin/course/lecture_attendance?lecture_id='.$lect->lecture_id.'"> <h4 class="card-title"> '.$lect->lecture_title.'</h4></a>
                       <p><strong>Subject:</strong> '.$lect->subject.'&nbsp;&nbsp;<strong>Topic: </strong>'.$lect->topic.'</p>
                    </div>
                    <div class="col-md-12">
                        <p><i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; '.$lect->FirstName.' '.$lect->LastName.' &nbsp;&nbsp;<i class="fas fa-calendar"></i> &nbsp;&nbsp;'.date("d-M-Y", strtotime($lect->lecture_date)).' '.date('h:i A', strtotime($lect->start_time)).' - '.date('h:i A', strtotime($lect->end_time)).'</p>
                    </div></div><hr>';
		}
		echo $output;
	}
	public function fetchworksheets()
	{
		$worksheets = $this->Dashboard_Model->upcomingworksheets();
		$output='';
		foreach ($worksheets as $lect) {
			$output.='<div class="row">
                    <div class="col-md-12">
                       <a href="'.base_url().'admin/course/worksheet_submit?batch_id='.$lect->batch_id.'&worksheet_id='.$lect->worksheet_id.'"> <h4 class="card-title"> '.$lect->worksheet_title.'</h4></a>
                       <p><strong>Subject:</strong> '.$lect->subject.'&nbsp;&nbsp;<strong>Topic: </strong>'.$lect->topic.'</p>
                    </div>
                    <div class="col-md-12">
                        <p><i class="fas fa-calendar"></i> Submission Date: &nbsp;&nbsp;'.date("d-M-Y", strtotime($lect->submission_date)).'</p>
                    </div></div><hr>';
		}
		echo $output;
	}
	public function fetchqws()
	{
		$qws = $this->Dashboard_Model->upcomingqws();
		$output='';
		foreach ($qws as $lect) {
			$output.='<div class="row">
                    <div class="col-md-12">
                       <a href="'.base_url().'admin/course/question_write_submit?batch_id='.$lect->batch_id.'&question_id='.$lect->question_id.'"> <h4 class="card-title"> '.$lect->Title.'</h4></a>
                       <p><strong>Subject:</strong> '.$lect->subject.'&nbsp;&nbsp;<strong>Topic: </strong>'.$lect->topic.'</p>
                    </div>
                    <div class="col-md-12">
                        <p><i class="fas fa-calendar"></i> Submission Date: &nbsp;&nbsp;'.date("d-M-Y", strtotime($lect->qw_date)).'</p>
                    </div></div><hr>';
		}
		echo $output;
	}
	public function fetchassignments()
	{
		$assignments = $this->Dashboard_Model->upcomingassignments();
		$output='';
		foreach ($assignments as $lect) {
			$output.='<div class="row">
                    <div class="col-md-12">
                       <a href="'.base_url().'admin/course/assignment_submit?batch_id='.$lect->batch_id.'&assignment_id='.$lect->id.'"> <h4 class="card-title"> '.$lect->assignment_title.'</h4></a>
                       <p><strong>Subject:</strong> '.$lect->subject.'&nbsp;&nbsp;<strong>Topic: </strong>'.$lect->topic.'</p>
                    </div>
                    <div class="col-md-12">
                        <p><i class="fas fa-calendar"></i> Submission Date: &nbsp;&nbsp;'.date("d-M-Y", strtotime($lect->submission_date)).'</p>
                    </div></div><hr>';
		}
		echo $output;
	}
	public function fetchexams()
	{
		$exams = $this->Dashboard_Model->upcomingexams();
		$output='';
		foreach ($exams as $lect) {
			$topic_ids=explode(",", $lect->topics_id);
			$topics=array();
			if (count($topics)>1) {
				$query1=$this->db->query("SELECT  course_section_topic_mst_t where Id IN ($lect->topics_id)");
				$topics= $query1->result();
			}
			else{
				if(count($topics)==1){

				$query1=$this->db->query("SELECT  course_section_topic_mst_t where Id='$lect->topics_id'");
				$topics= $query1->result();
				}
			}
			$output.='<div class="row">
                    <div class="col-md-12">
                       <a href="'.base_url().'admin/course/exam_result?batch_id='.$lect->batch_id.'&exam_id='.$lect->exam_id.'"> <h4 class="card-title"> '.$lect->Title.'</h4></a>
                       <p><strong>Subject:</strong> '.$lect->subject.'</p><p><strong>Topic: </strong>';
                       foreach ($topics as $topic) {
                       	$output.=$topic->Topic.',';
                       }
                       $output.='</p>
                    </div>
                    <div class="col-md-12">
                        <p><i class="fas fa-calendar"></i> Exam Date: &nbsp;&nbsp;'.date("d-M-Y", strtotime($lect->exam_date)).'</p>
                    </div></div><hr>';
		}
		echo $output;
	}
}
?>