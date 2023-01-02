<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
class Exams extends CI_Controller
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
	  	$this->load->model('Test_Model');
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
			$this->load->view('admin/exams',$result);
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
				$key='vktutorials/courses/exams/'.$_FILES["file"]["name"];
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
	public function fetch_exams()
	{
		$course_id = $this->input->post('course_id');
		$subject_id = $this->input->post('subject_id');
		$topic_id = $this->input->post('topic_id');
		$batch_id = $this->input->post('batch_id');
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$start_id=$this->input->post('page');
		$result=$this->Test_Model->fetch_exams($start_id,$course_id,$subject_id,$topic_id,$batch_id,$fromDate,$toDate);
		$output='';
		$page=0;
		$i=0;
		foreach ($result as $exam) {
			$page=$exam->exam_id;
			$etopics=array();
			$topics= explode(",", $exam->topics_id);
			if(count($topics)>1){
				$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id IN ($exam->topics_id)");
			$etopics= $query1->result();
			}
			else{
					$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$exam->topics_id'");
			$etopics= $query1->result();
			}
			$output.='<div class="row"><div class="col-md-9" style="">
			<a href="'.base_url().'admin/course/exam_result?exam_id='.$exam->exam_id.'&batch_id='.$exam->batch_id.'"><h4>'.$exam->Title.'('.$exam->exam_type.')</h4></a>
			<p><strong>Batch: </strong>'.$exam->batch_name.'</p>
			<p><strong>Course:</strong> '.$exam->course_name.' &nbsp;&nbsp;<strong>Subject:</strong> '.$exam->subject.'&nbsp;&nbsp;</p><p> <strong>Topic:</strong>';
			foreach ($etopics as $topic) {
				$output.=$topic->Topic.',';
			}
			$output.='</p>
			<p><i class="fa fa-calendar"></i> '.$exam->exam_date.' '.$exam->start_time.'-'.$exam->end_time.'</p>
			</div><div class="col-md-3 text-right">
			<button  class="btn btn-default edit_exam" id="'.$exam->exam_id.'" data-toggle="modal" data-target="#editexamModal"><i class="fas fa-edit"></i></button>	
		
				<p><button class="btn btn-default" data-toggle="modal" data-target="#deletexamModal_'.$exam->exam_id.'"><i class="fas fa-trash"></i></button></p>
				<p>  ';

				if($exam->is_publish == 0){

				  $output.='<button class="btn btn-info" data-toggle="modal" data-target="#publisexamModal_'.$exam->exam_id.'"> Publish</button></p>';


				}else{

				  $output.='<button class="btn btn-danger" data-toggle="modal" data-target="#unpublisexamModal_'.$exam->exam_id.'">UnPublish</button></p>';

				}
			$output.='</div></div><hr>
								<div class="modal" id="publisexamModal_'.$exam->exam_id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="publishexamm btn steps_btn" id="" value="'.$exam->exam_id.'">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="unpublisexamModal_'.$exam->exam_id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="unpublishexamm btn steps_btn" id="" value="'.$exam->exam_id.'">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                <div class="modal" id="deletexamModal_'.$exam->exam_id.'">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-body">
                         <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                         <button class="deleteexam btn steps_btn" id="" value="'.$exam->exam_id.'">Yes</button>
                         <button class="btn btn-default" data-dismiss="modal">No</button>
                       </div>
                     </div>
                   </div>
                </div>
			';
			$i++;
		}
		$data=array('page'=>$page, 'output'=>$output);
		echo json_encode($data);
	}
	public function get_exams()
	{
		// $course_id=$this->input->post('course_id');
		// $batch_id=$this->input->post('batch_id');
		$exam_id = $this->input->get('examId');

		$result=$this->Test_Model->get_exams($exam_id);
		$courses=$this->Course_Model->fetchcourses();
		$output = '';
		foreach ($result as $exam) {
			$data=$this->Course_Model->fetchcoursebatchsubjects($exam->course_id);
			$topics=$this->Course_Model->coursesectiontopics($exam->subject_id);
			$batches=$data['batches'];
			$subjects=$data['subjects'];
			// print_r(json_encode($exam));
			$output.='<div class="row justify-content-md-center">
			<div class="col-12">
				<div class="ui search focus mt-30 lbel25">
					<label>Exam Title</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" id="etitle" value="'.$exam->Title.'">	
						<input class="prompt srch_explore" type="hidden" id="exam_id" value="'.$exam->exam_id.'">	
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
					<label>Select Topic</label>
					<div class="ui left icon input swdh19">
						<select class="form-control" id="etopics" multiple>';
						$etopics=explode(",", $exam->topics_id);
							foreach ($topics as $topic) {
								if(in_array($topic->Id, $etopics)){

									$output.='<option value="'.$topic->Id.'" selected>'.$topic->Topic.'</option>';
								}
								else{

									$output.='<option value="'.$topic->Id.'">'.$topic->Topic.'</option>';
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
					<label>Exam Type</label>
					<div class="ui left icon input swdh19">
						<select class="form-control" id="eexam_type">';
							
								if($exam->exam_type=='oral'){

									$output.='<option value="oral" selected>oral</option>';
									$output.='<option value="written">written</option>';

								}
								else{

									$output.='<option value="written" selected>written</option>';
									$output.='<option value="oral" >oral</option>';

								}
						
							
					$output.='</select>
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Exam Date</label>
					<div class="ui left icon input swdh19">
						<input type="date" class="form-control" id="eedate" name="" value="'.$exam->exam_date.'">								
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Start Time</label>
					<div class="ui left icon input swdh19">
						<input type="time" class="form-control" id="estime" name="" value="'.$exam->start_time.'">
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>End Time</label>
					<div class="ui left icon input swdh19">
						<input type="time" class="form-control" id="eetime" name="" value="'.$exam->end_time.'">
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Total Marks</label>
					<div class="ui left icon input swdh19">
						<input type="text" class="form-control" id="etmarks" value="'.$exam->total_marks.'" placeholder="Total Marks" name="">
					</div>
				</div>
				<div class="ui search focus mt-30 lbel25">
					<label>Passing Marks</label>
					<div class="ui left icon input swdh19">
						<input type="text" class="form-control" id="epmark" value="'.$exam->passing_marks.'" placeholder="Passing Marks" name="">
					</div>
				</div>
					<br>
					<div id="msg"></div>
				<button data-direction="next" class="steps_btn" id="update">Update</button>
			</div>		
		</div>';
		}
		 echo $output;
		// echo $result;
		//return $result;
		// echo json_decode(json_encode($result),true);
		// print_r($result);
	}
	public function filter_exam(){
		// $exam_id = $this->input->get();
		// print_r($exam_id);
		$course_id = $this->input->get('course_id');
		$subject_id = $this->input->get('subject_id');
		$topic_id = $this->input->get('topic_id');
		$batch_id = $this->input->get('batch_id');
		$fromDate = $this->input->get('fromDate');
		$toDate = $this->input->get('toDate');

		$result=$this->Test_Model->filter_exams($course_id,$subject_id,$topic_id,$batch_id,$fromDate,$toDate);
		$output='';
		$i=0;
		foreach ($result as $exam) {
			$output.='<div class="row"><div class="col-md-9" style="">
			<a href="'.base_url().'admin/course/exam_result?exam_id='.$exam->exam_id.'&batch_id='.$exam->batch_id.'"><h4>'.$exam->Title.'('.$exam->exam_type.')</h4></a>
			<p><strong>Batch: </strong>'.$exam->batch_name.'</p>
			<p><strong>Course:</strong> '.$exam->course_name.' &nbsp;&nbsp;<strong>Subject:</strong> '.$exam->subject.'&nbsp;&nbsp; <strong>Topic:</strong> '.$exam->topic.'</p>
			<p><i class="fa fa-calendar"></i> '.$exam->exam_date.' '.$exam->start_time.'-'.$exam->end_time.'</p>
			</div><div class="col-md-3 text-right">
			<button  class="btn btn-default edit_exam" id="'.$exam->exam_id.'" data-toggle="modal" data-target="#editexamModal"><i class="fas fa-edit"></i></button>	
		
				<p><button class="btn btn-default" data-toggle="modal" data-target="#deletexamModal_'.$exam->exam_id.'"><i class="fas fa-trash"></i></button></p>
<p>  ';

if($exam->is_publish == 0){

  $output.='<button class="btn btn-info" data-toggle="modal" data-target="#publisexamModal_'.$exam->exam_id.'"> Publish</button></p>';


}else{

  $output.='<button class="btn btn-danger" data-toggle="modal" data-target="#unpublisexamModal_'.$exam->exam_id.'">UnPublish</button></p>';

}

			$output.='</div></div><hr>
								<div class="modal" id="publisexamModal_'.$exam->exam_id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="publishexamm btn steps_btn" id="" value="'.$exam->exam_id.'">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal" id="unpublisexamModal_'.$exam->exam_id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h5 class="modal-title">Are you sure you want to publis this?</h5><br>
                                        <button class="unpublishexamm btn steps_btn" id="" value="'.$exam->exam_id.'">Yes</button>
                                        <button class="btn btn-default" data-dismiss="modal">No</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                 <div class="modal" id="deletexamModal_'.$exam->exam_id.'">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-body">
                         <h5 class="modal-title">Are you sure you want to delete this?</h5><br>
                         <button class="deleteexam btn steps_btn" id="" value="'.$exam->exam_id.'">Yes</button>
                         <button class="btn btn-default" data-dismiss="modal">No</button>
                       </div>
                     </div>
                   </div>
                 </div>
			';
			$this->session->set_userdata('start_id', $exam->exam_id);
			$i++;
		}
		echo $output;

	}
	public function updateexam()
	{
		// print_r($this->input->post());
		$exam_id=$this->input->post('exam_id');
		$title=$this->input->post('title');
		$date=$this->input->post('date');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$bid=$this->input->post('bid');
		$passing_marks=$this->input->post('passing_marks');
		$total_marks=$this->input->post('total_marks');
		$bid=$this->input->post('bid');
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$exam_type=$this->input->post('exam_type');
		$topic=$this->input->post('topics');
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

			$result=$this->Course_Model->updateexam($exam_id,$cid,$sid,$tid,$bid,$total_marks,$passing_marks,$title,$date,$stime,$etime,$exam_type,$topic);
			$code="200";


			// $topic = explode(',', $topic);
			// for($i=0;$i<count($topic);$i++){
			// 	$query="insert into exam_topic_mst_t(exam_id,topic_id) values('$result->exam_id','$topic[$i]')";
			// 	$this->db->query($query);
			// }
		$msg="Exam added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
}

?>