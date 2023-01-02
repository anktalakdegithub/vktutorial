<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
class Counselling extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Student_Model'); 
		$this->load->model('Batch_Model'); 
		$this->load->model('Setting_Model'); 
		//$this->load->model('Assignment_Model'); 
		$this->load->model('Lecture_Model'); 
	  	$this->load->model('Spaces_Model');
		$this->load->model('Course_Model'); 
		$this->load->model('Faculty_Model'); 
	  	$this->load->model('Counselling_Model');
		$this->load->library('email');
		$this->load->library('session'); 
		$this->load->library('form_validation'); 
		$this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn'); 
	}
	public function index()
	{
		if ($this->isadminLoggedIn) {
			$this->session->set_userdata('start_id', '0');
			$result=array();
			$result=$this->Course_Model->fetchcourses();

			$this->session->set_userdata('startid',0);
			$this->load->view('admin/header');
			$this->load->view('admin/counselling',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	public function addfacultyexam()
	{
		$course_id=$this->input->post('course_id');
		$batch_id=$this->input->post('batch_id');
		 $subjects=$this->input->post('subjects');
		 $topics=$this->input->post('topics');
		 $student=$this->input->post('student');
		$edate=$this->input->post('edate');
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$tmarks=$this->input->post('tmarks');
		$pmark=$this->input->post('pmark');
		$code='';
		$msg='';
		$result=array();
		if(empty($course_id))
		{
			$code="404";
			$msg="Please select course.";
		}
		else if(empty($_FILES["pdf"]["name"]))
		{
			$code="404";
			$msg="Please Upload File.";
		}
		else if(empty($edate))
		{
			$code="404";
			$msg="Please Enter Submission Date.";
		}
		else{
			$pdf='';
			if(!empty( $_FILES["pdf"]["name"])){
				$newname=str_replace(' ', '', $_FILES["pdf"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['pdf']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['pdf']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['pdf']['error'];
				$_FILES['file']['size']     = $_FILES['pdf']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='vktutorials/courses/counsellings/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$result=$this->Faculty_Model->addfacultyexam($course_id,$batch_id,$subjects,$topics,$student,$edate,$pdf,$stime,$etime,$tmarks,$pmark);
			$code="200";
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function add_counselling()
	{
		$title=$this->input->post('title');
		$date=$this->input->post('date');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$exam_id=$this->input->post('exam_id');
		$bid=$this->input->post('bid');
		$stud_id=$this->input->post('stud_id');
		$bid=$this->input->post('bid');
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($date))
		{
			$code="404";
			$msg="Please select date.";
		}
		else{

			$result=$this->Counselling_Model->add_counselling($cid,$sid,$exam_id,$bid,$stud_id,$title,$date,$stime,$etime);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}

	public function updatecounselling()
	{
		$counselling_id=$this->input->post('counselling_id');
		$title=$this->input->post('title');
		$date=$this->input->post('date');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$exam_id=$this->input->post('exam_id');
		$bid=$this->input->post('bid');
		$stud_id=$this->input->post('stud_id');
		$bid=$this->input->post('bid');
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($date))
		{
			$code="404";
			$msg="Please select date.";
		}
		else{

			$result=$this->Counselling_Model->update_counselling($counselling_id,$cid,$sid,$exam_id,$bid,$stud_id,$title,$date,$stime,$etime);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function fetch_counsellings()
	{
		$course_id = $this->input->post('course_id');
		$subject_id = $this->input->post('subject_id');
		$batch_id = $this->input->post('batch_id');
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$start_id=$this->input->post('page');
		$result=$this->Counselling_Model->fetch_counsellings($start_id,$course_id,$subject_id,$batch_id,$fromDate,$toDate);
		$courses=$this->Course_Model->fetchcourses();

		// print_r($result);
		// die;
		$page=0;
		$output='';
		$i=0;
		foreach ($result as $exam) {
			$output.='<div class="row"><div class="col-md-9" style="">
			<a href="#"><h4>'.$exam->counselling_title.'</h4></a>
			<p><strong>Batch: </strong>'.$exam->batch_name.'</p>
			<p><strong>Course:</strong> '.$exam->course_name.' &nbsp;&nbsp;<strong>Subject:</strong> '.$exam->subject.'&nbsp;&nbsp; </p><p><strong>Topics:</strong> '.$exam->topic.' &nbsp;&nbsp;';
			if($exam->student_worksheet!=''){
				$output.='<a href="'.$exam->student_worksheet.'">View Worksheet</a>';
			}
			$output.='</p>
			<p><i class="fa fa-calendar"></i> '.$exam->counselling_date.' '.$exam->start_time.'-'.$exam->end_time.'</p>
			<button class="btn btn-success edit_counselling" value="'.$exam->counselling_id.'" id="'.$exam->counselling_id.'" data-toggle="modal" data-target="#uploadworksheet_'.$exam->counselling_id.'">worksheet & Comment</button>
			</div><div class="col-md-3 text-right">
			<div class="col-md-3 text-right">
			<p><button class="btn btn-default edit_counselling" value="'.$exam->counselling_id.'" id="'.$exam->counselling_id.'" data-toggle="modal" data-target="#editexamModal"><i class="fas fa-edit"></i></button><button class="btn btn-default" data-toggle="modal" data-target="#deletexamModal_'.$exam->counselling_id.'"><i class="fas fa-trash"></i></button></p><p>  ';

				if($exam->is_publish == 0){

				$output.='<button class="btn btn-info" data-toggle="modal" data-target="#publisexamModal_'.$exam->counselling_id.'"> Publish</button></p>';


				}else{

				$output.='<button class="btn btn-danger" data-toggle="modal" data-target="#unpublisexamModal_'.$exam->counselling_id.'">Unpublish</button></p>';

				}

			$output.='</div></div><hr>
			<div class="modal" id="uploadworksheet_'.$exam->counselling_id.'">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-body">
					<h5 class="modal-title">Upload Worksheet</h5><br><br>
					<div class="form-group">
						<label>Counselling Comments</label>
						<textarea class="form-control" id="comment_'.$exam->counselling_id.'">'.$exam->comment.'</textarea>
					</div>
					<div class="form-group">
						<label>Upload Worksheet</label>
						<input type="hidden" value="'.$exam->student_worksheet.'" id="eworksheet_'.$exam->counselling_id.'"/>
						<input type="file" class="form-control" id="worksheet_'.$exam->counselling_id.'"/>
					</div>
					<div class="form-group">';
					if($exam->is_submitted==1){
						$output.='<input type="checkbox" id="issubmitted_'.$exam->counselling_id.'" checked/> <strong>Is Submitted?</strong>';
					}
					else{
						$output.='<input type="checkbox" id="issubmitted_'.$exam->counselling_id.'"/> <strong>Is Submitted?</strong>';
					}
					$output.='</div>
					<button class="addworksheet btn steps_btn" id="" value="'.$exam->counselling_id.'">Save</button>
					<button class="btn btn-default" data-dismiss="modal">No</button>
				  </div>
				</div>
			  </div>
			</div>
			<div class="modal" id="publisexamModal_'.$exam->counselling_id.'">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-body">
					<h5 class="modal-title">Are you sure you want to publis this?</h5><br>
					<button class="publishexamm btn steps_btn" id="" value="'.$exam->counselling_id.'">Yes</button>
					<button class="btn btn-default" data-dismiss="modal">No</button>
				  </div>
				</div>
			  </div>
			</div>
			<div class="modal" id="unpublisexamModal_'.$exam->counselling_id.'">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-body">
					<h5 class="modal-title">Are you sure you want to publis this?</h5><br>
					<button class="unpublishexamm btn steps_btn" id="" value="'.$exam->counselling_id.'">Yes</button>
					<button class="btn btn-default" data-dismiss="modal">No</button>
				  </div>
				</div>
			  </div>
			</div>
			 <div class="modal" id="deletexamModal_'.$exam->counselling_id.'">
			   <div class="modal-dialog" role="document">
				 <div class="modal-content">
				   <div class="modal-body">
					 <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
					 <button class="deleteexam btn steps_btn" id="" value="'.$exam->counselling_id.'">Yes</button>
					 <button class="btn btn-default" data-dismiss="modal">No</button>
				   </div>
				 </div>
			   </div>
			 </div>
			 </div></div><hr>';
			$page=$exam->counselling_id;
			$i++;
		}
		$data=array('page'=>$page, 'output'=>$output);
		echo json_encode($data);
	}
	public function get_counselling()
	{
		// $course_id=$this->input->post('course_id');
		// $batch_id=$this->input->post('batch_id');
		$counselling_id = $this->input->get('id');

		$result=$this->Counselling_Model->get_counselling($counselling_id);
		// $result=$this->Counselling_Model->fetch_counsellings($start_id);
		
		$courses=$this->Course_Model->fetchcourses();
		$output = '';
		foreach ($result as $exam) {
			$data=$this->Course_Model->fetchcoursebatchsubjects($exam->course_id);
			$exams=$this->Course_Model->coursesectionexams($exam->subject_id,$exam->batch_id);
			$students=$this->Batch_Model->fetchbatchstudents($exam->batch_id);
			$batches=$data['batches'];
			$subjects=$data['subjects'];
			// print_r(json_encode($exam));
			$output.='<div class="row justify-content-md-center">
			<div class="col-12">
				
				<div class="ui search focus mt-30 lbel25">
					<label>Title</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" id="etitle" value="'.$exam->counselling_title.'">	
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Select course</label>
					<div class="ui left icon input swdh19">
						<select class="form-control"  id="ecourse_id">';
							foreach ($courses['courses'] as $course) {
								if($exam->course_id==$course->Id){

									$output.='<option value="'.$course->Id.'" selected>'.$course->Title.'</option>';
								}
								else{

									$output.='<option value="'.$course->Id.'">'.$course->Title.'</option>';
								}
							}
							
							
					$output.='	</select>		
						</select>							
					</div>
				</div>	
				<div class="ui search focus mt-30 lbel25">
					<label>Select subject</label>
					<div class="ui left icon input swdh19">
						<select class="form-control" id="esubjects">';
							foreach ($subjects as $subject) {
								if($exam->subject_id==$subject->Id){

									$output.='<option value="'.$subject->Id.'" selected>'.$subject->Title.'</option>';
								}
								else{

									$output.='<option value="'.$subject->Id.'">'.$subject->Title.'</option>';
								}
							}	
						$output.='</select>									
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Select Batch</label>
					<div class="ui left icon input swdh19">
						<select class="form-control w_branch"  id="ebatch_id">';
							foreach ($batches as $batch) {
								if($exam->batch_id==$batch->Id){

									$output.='<option value="'.$batch->Id.'" selected>'.$batch->Name.'</option>';
								}
								else{

									$output.='<option value="'.$batch->Id.'">'.$batch->Name.'</option>';
								}
							}	
						$output.='</select>								
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Select Topic</label>
					<div class="ui left icon input swdh19">
						<select class="form-control" id="eexam_id">';
						//$etopics=explode(",", $exam->topics_id);
							foreach ($exams as $ex) {
								if($exam->exam_id=$ex->exam_id){

									$output.='<option value="'.$ex->exam_id.'" selected>'.$ex->Title.'</option>';
								}
								else{

									$output.='<option value="'.$ex->exam_id.'">'.$ex->Title.'</option>';
								}
							}	
						$output.='</select>									
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Select Student</label>
					<div class="ui left icon input swdh19">
						<select class="form-control" id="estudent">';
						//$etopics=explode(",", $exam->topics_id);
							foreach ($students as $stud) {
								if($exam->student_id==$stud->Id){

									$output.='<option value="'.$stud->Id.'" selected>'.$stud->FirstName.' '.$stud->LastName.'</option>';
								}
								else{

									$output.='<option value="'.$stud->Id.'">'.$stud->FirstName.' '.$stud->LastName.'</option>';
								}
							}	
						$output.='</select>							
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Counselling Date</label>
					<div class="ui left icon input swdh19">
						<input type="date" class="form-control" id="edate" name="" value="'.$exam->counselling_date.'">								
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Start Time</label>
					<div class="ui left icon input swdh19">
						<input type="time" class="form-control" id="stime" name="" value="'.$exam->start_time.'">
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>End Time</label>
					<div class="ui left icon input swdh19">
						<input type="time" class="form-control" id="etime" name="" value="'.$exam->end_time.'">
					</div>
				</div>
					<br>
					<div id="msg"></div>
				<button data-direction="next" type="button" class="steps_btn" id="update" value="'.$exam->counselling_id.'">Update</button>
			</div>		
		</div>';
		}
		 echo $output;
		// echo $result;
		//return $result;
		// echo json_decode(json_encode($result),true);
		// print_r($result);
	}

	public function add_counselling_worksheet()
	{
		$counselling_id=$this->input->post('counselling_id');
		$comment=$this->input->post('comment');
		$worksheet=$this->input->post('eworksheet');
		$issubmitted=$this->input->post('issubmitted');
		if(!empty( $_FILES["worksheet"]["name"])){
			$newname=str_replace(' ', '', $_FILES["worksheet"]["name"]);
			$fname=explode(".", $newname);
			$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			$_FILES['file']['name']     = $randname;
			$_FILES['file']['type']     = $_FILES['worksheet']['type'];
			$_FILES['file']['tmp_name'] = $_FILES['worksheet']['tmp_name'];
			$_FILES['file']['error']    = $_FILES['worksheet']['error'];
			$_FILES['file']['size']     = $_FILES['worksheet']['size'];
			$dir = dirname($_FILES["file"]["tmp_name"]);
			$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
			rename($_FILES["file"]["tmp_name"], $destination);
			$key='kokateclasses/counselling/worksheets/'.$_FILES["file"]["name"];
			$this->Spaces_Model->upload_file($key,$destination);
			$worksheet = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
		}
		$this->Counselling_Model->add_counselling_worksheet($counselling_id,$comment,$worksheet,$issubmitted);

		$data['code']="200";
		$data['msg']="Data updated successfully.";
		echo json_encode($data);
	}
	public function deletecounselling()
	{
		$counselling_id=$this->input->post('counselling_id');
		$this->Counselling_Model->deletecounselling($counselling_id);
	}
	public function publishcounselling()
	{
		$counselling_id=$this->input->post("counselling_id");
		$this->Counselling_Model->publishcounselling($counselling_id);
	}
	public function unpublishcounselling()
	{
		$counselling_id=$this->input->post("counselling_id");
		$this->Counselling_Model->unpublishcounselling($counselling_id);
	}
}
?>
