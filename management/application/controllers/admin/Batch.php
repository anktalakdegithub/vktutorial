<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->model('Batch_Model');
	$this->load->library('session'); 
	$this->load->model('Student_Model'); 
	$this->load->model('Course_Model'); 
	$this->load->model('Lecture_Model'); 
	$this->load->model('Test_Model'); 
    $this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn'); 
	}

	public function index()
	{
		if ($this->isadminLoggedIn) {
			$result=$this->Batch_Model->fetchbatchsstudents();
			$result['courses']=$this->Course_Model->fetchcourses();
			$this->load->view('admin/header');
			$this->load->view('admin/batch',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	public function batch_details()
	{
		if ($this->isadminLoggedIn) {
		$id=$this->uri->segment(4);
		$student_id = $this->input->get('student_id');
		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$result=$this->Batch_Model->batchcoursesseries($id);
		$result['students']=$this->Batch_Model->fetchbatchstudents($id);
		$topic_id='';
		$subject_id = '';
		$result['lectures']=$this->Course_Model->filterbatchlectures($id,$from_date,$to_date,$topic_id,$subject_id,$student_id);
		$result['woorksheet']=$this->Course_Model->filterbatchworksheet($id,$from_date,$to_date,$topic_id,$subject_id,$student_id);
		$result['assignment']=$this->Course_Model->filterbatchassignment($id,$from_date,$to_date,$topic_id,$subject_id,$student_id);
		$result['question']=$this->Course_Model->filterbatchquestion($id,$from_date,$to_date,$topic_id,$subject_id,$student_id);
		$result['exam']=$this->Course_Model->filterbatchexam($id,$from_date,$to_date,$topic_id,$subject_id,$student_id);
		$result['courses']=$this->Course_Model->fetchcourses();
		$result['abatches']=$this->Batch_Model->fetchbatches();
		$result['ayears']=$this->Batch_Model->allacademicyears();
		//$result['series']=$this->Test_Model->getmcqtests();
		$this->load->view('admin/header');
		$this->load->view('admin/batch_details',$result);
		$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	function addcourse()
	{
		$bid=$this->input->post('bid');
		$cids=$this->input->post('cids');
		$result=$this->Batch_Model->addcourse($bid,$cids);
	}
	function addseries()
	{
		$bid=$this->input->post('bid');
		$sids=$this->input->post('sids');
		$result=$this->Batch_Model->addseries($bid,$sids);
	}
	function fetchbatch()
	{
		$id=$this->input->post('id');
		$result=$this->Batch_Model->fetchbatch($id);
		echo json_encode($result[0]);
	}
	public function addbatch(){
		$name=$this->input->post('name');
		$course=$this->input->post('course');
		$code='';
		$msg='';
		$data=array();
		if(empty($name)){
			$msg='Please enter batch name.';
			$code='404';
		}
		else if(empty($course)){
			$msg='Please select a course.';
			$code='404';
		}
		else{
			$this->Batch_Model->batch($name,$course);
			$code='200';
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addstudents()
	{
		$bid=$this->uri->segment(4);
		$this->session->set_userdata('startid',0);
		$this->load->view('admin/header');
		$result['bid']=$bid;
		$this->load->view('admin/addstudents',$result);
		$this->load->view('admin/footer');
	}
	public function fetchstudents()
	{
		$startid=$this->session->userdata('startid');
		$limit=$this->input->post('limit');
		$bid=$this->input->post('bid');
		$result=$this->Student_Model->fetchnbatchstudents($bid,$startid,$limit);
		$output='';
		$i=0;
		if(count($result['students'])>0){
		foreach ($result['students'] as $stud) {
			$this->session->set_userdata('startid',$stud->Id);
			$output.='<div class="row">
			<div class="col-md-1"><input type="checkbox" name="student" value="'.$stud->Id.'"></div>
			<div class="col-md-9" style="">
			<h4>'.$stud->FirstName.' '.$stud->LastName.'</h4>
			<p><span><i class="fas fa-envelope"></i>&nbsp; '.$stud->Email.'</span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; '.$stud->Phone.'</span></p>';
		
			$output.='</div></div><hr>';
			
							$i++;
		}
		}

		echo $output;
	}
	public function addbatchstudent()
	{
		$students=$this->input->post('students');
		$bid=$this->input->post('bid');
		$result=$this->Student_Model->assignbatchstudent($bid,$students);
	}
	public function getcoursebatches(){
		$course_id = $this->input->post('course_id');
		$data = $this->Batch_Model->getcoursebatches($course_id);
		echo json_encode($data);
	}
	public function getbatchstudents(){
		$batch_id = $this->input->post('batch_id');
		$data = $this->Batch_Model->fetchbatchstudents($batch_id);
		echo json_encode($data);
	}

	public function updatebatch(){
		$name=$this->input->post('name');
		$course=$this->input->post('course');
		$bid=$this->input->post('id');
		$code='';
		$msg='';
		$data=array();
		if(empty($name)){
			$msg='Please enter batch name.';
			$code='404';
		}
		else if(empty($course)){
			$msg='Please select a course.';
			$code='404';
		}
		else{
			$this->Batch_Model->updatebatch($bid,$name,$course);
			$code='200';
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	function deletebatch()
	{
		$id=$this->input->post('id');
		$this->Batch_Model->deletebatch($id);
	}
	function filter_lecture()
	{
		$batch_id=$this->input->post('batch_id');
		$subject_id=$this->input->post('subject_id');
		$topic_id=$this->input->post('topic_id');
		$student_id=$this->input->post('student_id');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');

		$result['lectures']=$this->Course_Model->filterbatchlectures($batch_id,$start_date,$end_date,$topic_id,$subject_id,$student_id);
		echo json_encode($result);

		// $this->Batch_Model->deletebatch($id);
	}
	function filter_worksheet()
	{
		$batch_id=$this->input->post('batch_id');
		$subject_id=$this->input->post('subject_id');
		$topic_id=$this->input->post('topic_id');
		$student_id=$this->input->post('student_id');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');

		$result['worksheet']=$this->Course_Model->filterbatchworksheet($batch_id,$start_date,$end_date,$topic_id,$subject_id,$student_id);
		echo json_encode($result);

		// $this->Batch_Model->deletebatch($id);
	}

	function filter_assignment()
	{
		$batch_id=$this->input->post('batch_id');
		$subject_id=$this->input->post('subject_id');
		$topic_id=$this->input->post('topic_id');
		$student_id=$this->input->post('student_id');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');

		$result['assignment']=$this->Course_Model->filterbatchassignment($batch_id,$start_date,$end_date,$topic_id,$subject_id,$student_id);
		echo json_encode($result);

		// $this->Batch_Model->deletebatch($id);
	}
	function filter_question()
	{
		$batch_id=$this->input->post('batch_id');
		$subject_id=$this->input->post('subject_id');
		$topic_id=$this->input->post('topic_id');
		$student_id=$this->input->post('student_id');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');

		$result['question']=$this->Course_Model->filterbatchquestion($batch_id,$start_date,$end_date,$topic_id,$subject_id,$student_id);
		echo json_encode($result);

		// $this->Batch_Model->deletebatch($id);
	}
	function filter_exam()
	{
		$batch_id=$this->input->post('batch_id');
		$subject_id=$this->input->post('subject_id');
		$topic_id=$this->input->post('topic_id');
		$student_id=$this->input->post('student_id');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');

		$result['exam']=$this->Course_Model->filterbatchexam($batch_id,$start_date,$end_date,$topic_id,$subject_id,$student_id);
		echo json_encode($result);

		// $this->Batch_Model->deletebatch($id);
	}
	function filter_student()
	{
		$batch_id=$this->input->post('batch_id');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');

		$result['student']=$this->Course_Model->filterbatchstudent($batch_id,$start_date,$end_date);
		echo json_encode($result);

		// $this->Batch_Model->deletebatch($id);
	}

        public function transferstudents()
        {
           $aid=$this->input->post('aid');
           $cid = $this->input->post('cid');
           $bid = $this->input->post('bid');
           $id = $this->input->post('id');
           $code='';
           $msg='';
            if(empty($aid)){
              $code="404";
              $msg="Please select a acamic year.";
            }
            else if(empty($cid)){
              $code="404";
              $msg="Please select a course name.";
            }
            else if(empty($bid)){
              $code="404";
              $msg="Please select a batch name.";
            }
            else{
             $this->Student_Model->transferstudents($aid,$cid,$bid,$id);
             $code="200";
             $msg='';
            }

            $data['code']=$code;
            $data['msg']=$msg;
            echo json_encode($data);
        }

		public function gettopic(){
			$subject_id = $this->input->post('subject_id');
			$data = $this->Batch_Model->fetchtopic($subject_id);
			echo json_encode($data);
		}
}
?>