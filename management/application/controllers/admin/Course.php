<?php
require 'vendor/autoload.php';
require APPPATH.'/third_party/getid3/getid3.php';
use Aws\S3\S3Client;
class Course extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Course_Model'); 
		$this->load->model('Category_Model');
		$this->load->model('Lecture_Model'); 
		$this->load->model('Notification_Model'); 
		$this->load->model('Batch_Model'); 
		$this->load->model('Test_Model');
		$this->load->model('Spaces_Model');
		$this->load->model('User_Model');
		$this->load->model('Student_Model');
		$this->load->library('session'); 
		$this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn');
	}
	public function index()
	{
		if ($this->isadminLoggedIn) {
			$result=$this->Course_Model->fetchcourses();
			
			$this->load->view('admin/header');
			$this->load->view('admin/courses',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}

	public function attendance()
	{
		
		// echo 'hbhjcbhjd';
		if ($this->isadminLoggedIn) {

			if(!empty($this->input->get())){
				// print_r($this->input->get());
				// die;

				$query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit 20");

				$data['students']= $query1->result();
				$query=$this->db->query("SELECT  * FROM student_attendance");

				$data['attendance']= $query->result();

				$query2=$this->db->query("SELECT  * FROM batch_mst_t");

				$data['batches']= $query2->result();
			// echo '<pre>';
			// print_r($students);
			// die;
				$this->load->view('admin/header');
				$this->load->view('admin/attendance',$data);
				$this->load->view('admin/footer');
			}else{
				// $result=$this->Course_Model->fetchcourses();
			// $result=$this->Student_Model->fetchstudents(1,20);
			// $this->db->order_by('id', 'DESC');  //actual field name of id
   			//  $query=$this->db->get('student_mst_t');

				$query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit 20");

				$data['students']= $query1->result();
				$query=$this->db->query("SELECT  * FROM student_attendance");

				$data['attendance']= $query->result();

				$query2=$this->db->query("SELECT  * FROM batch_mst_t");

				$data['batches']= $query2->result();
			// echo '<pre>';
			// print_r($students);
			// die;
				$this->load->view('admin/header');
				$this->load->view('admin/attendance',$data);
				$this->load->view('admin/footer');
			}
			
		}
		else{
			redirect('admin/login');
		}
	}
	public function newcourse()
	{
		$result['categories']=$this->Category_Model->fetchcategories();
		$result['faculties']=$this->User_Model->fetchfaculties();
		$this->load->view('admin/header');
		$this->load->view('admin/newcourse',$result);
		$this->load->view('admin/footer');
	}
	public function lecture_attendance()
	{
		$lecture_id=$this->input->get('lecture_id');
		$result=$this->Course_Model->fetch_lecture_attendance($lecture_id);
		//print_r($result);
		$this->load->view('admin/header');
		$this->load->view('admin/lecture_attendance',$result);
		$this->load->view('admin/footer');
	}
	public function worksheet_submit()
	{
		$id = $this->input->get('worksheet_id');
		// $query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit 20");
		$query1=$this->db->query("SELECT * FROM `worksheet_submitted` join student_mst_t on student_mst_t.Id=worksheet_submitted.student_id WHERE worksheet_submitted.worksheet_id='$id'");
		$batch_id=$this->input->get('batch_id');
		$worksheet_id=$this->input->get('worksheet_id');
		$result['batch_id']=$batch_id;
		$result['worksheet_id']=$worksheet_id;

		$result['students']= $query1->result();
		$this->load->view('admin/header');
		$this->load->view('admin/worksheet_submit',$result);
		$this->load->view('admin/footer');
	}
	public function question_write_submit()
	{
		$id = $this->input->get('question_id');
		// $query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit 20");
		$query1=$this->db->query("SELECT * FROM `qw_submitted` join student_mst_t on student_mst_t.Id=qw_submitted.student_id WHERE qw_submitted.qw_id='$id'");

		$result['students']= $query1->result();
		$batch_id=$this->input->get('batch_id');
		$qw_id=$this->input->get('question_id');
		$result['batch_id']=$batch_id;
		$result['qw_id']=$qw_id;
		$this->load->view('admin/header');
		$this->load->view('admin/question_write_submit',$result);
		$this->load->view('admin/footer');
	}
	public function assignment_submit()
	{
		$id = $this->input->get('assignment_id');
		// $query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit 20");
		$query1=$this->db->query("SELECT * FROM `assignment_submitted` join student_mst_t on student_mst_t.Id=assignment_submitted.student_id WHERE assignment_submitted.assignment_id='$id'");
		$batch_id=$this->input->get('batch_id');
		$assignment_id=$this->input->get('assignment_id');
		$result['batch_id']=$batch_id;
		$result['assignment_id']=$assignment_id;
		$result['students']= $query1->result();
		$this->load->view('admin/header');
		$this->load->view('admin/assignment_submit',$result);
		$this->load->view('admin/footer');
	}
	public function exam_result()
	{
		$id = $this->input->get('exam_id');
		// $query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit 20");
		$query1=$this->db->query("SELECT * FROM `exams_mst_t` WHERE exam_id='$id'");
		$result['exam']= $query1->result();
		$query1=$this->db->query("SELECT * FROM `exam_results` join student_mst_t on student_mst_t.Id=exam_results.student_id WHERE exam_results.exam_id='$id'");
		$batch_id=$this->input->get('batch_id');
		$result['batch_id']=$batch_id;
		$result['exam_id']=$id;
		$result['students']= $query1->result();
		$this->load->view('admin/header');
		$this->load->view('admin/exam_result',$result);
		$this->load->view('admin/footer');
	}
	public function information()
	{
		$cid=$this->uri->segment(4);
		$result=$this->Course_Model->fetchcourseinformation($cid);
		$result['categories']=$this->Category_Model->fetchcategories();
		$result['faculties']=$this->User_Model->fetchfaculties();
		$this->load->view('admin/course-info',$result);
	}
	public function viewtopics(){
		$sid=$this->uri->segment(4);
		$result['section']=$this->Course_Model->fetchsection($sid);
		$result['topics']=$this->Course_Model->fetchtopics($sid);
		$this->load->view('admin/sort_topics',$result);
	}
	public function curriculum()
	{
		$cid=$this->uri->segment(4);
		$result=$this->Course_Model->fetchcoursecurriculum($cid);
		$result['cid']=$cid;
		$this->load->view('admin/course-curriculum',$result);
	}
	public function newsection()
	{
		$cid=$this->uri->segment(4);
		$result['cid']=$cid;
		$this->load->view('admin/course-section',$result);
	}
	public function new_section_topic()
	{
		$sid=$this->uri->segment(4);
		$result['section']=$this->Course_Model->fetchsection($sid);
		$this->load->view('admin/course-section-topic',$result);
	}
	public function section()
	{
		$sid=$this->input->post('sid');
		$result=$this->Course_Model->fetchsection($sid);
		echo json_encode($result);
	}
	public function topic()
	{
		$tid=$this->input->post('tid');
		$result=$this->Course_Model->fetchtopic($tid);
		echo json_encode($result);
	}
	public function editsection()
	{
		$sid=$this->uri->segment(4);
		$result['section']=$this->Course_Model->fetchsection($sid);
		$this->load->view('admin/editsection',$result);
	}
	public function edittopic()
	{
		$tid=$this->uri->segment(4);
		$result['topic']=$this->Course_Model->fetchtopic($tid);
		$this->load->view('admin/edittopic',$result);
	}
	public function fetchtopic()
	{
		$tid=$this->input->post('tid');
		$result=$this->Course_Model->fetchtopic($tid);
		
		echo json_encode($result);
	}
	public function topic_lecture()
	{
		$tid=$this->uri->segment(4);
		$result=$this->Course_Model->fetchlecture($tid);
		$this->load->view('admin/course-lecture',$result);
	}
	public function newlecture()
	{
		$sid=$this->uri->segment(4);
		$lid=$this->Course_Model->addcourselecture($sid);
		$result=$this->Course_Model->fetchlecture($lid);
		$this->load->view('admin/course-lecture',$result);
	}
	public function test()
	{
		$sid=$this->uri->segment(4);
		$result['sid']=$sid;
		$this->load->view('admin/course-lecture',$result);
	}
	public function price()
	{
		$cid=$this->uri->segment(4);
		$result=$this->Course_Model->fetchcourseinformation($cid);
		$this->load->view('admin/course-price',$result);
	}
	public function publish()
	{
		$cid=$this->uri->segment(4);
		$result=$this->Course_Model->fetchcourseinformation($cid);
		$this->load->view('admin/course-publish',$result);
	}
	public function coursesectiontopics(){
		$subject_id=$this->input->post('subject_id');
		$result=$this->Course_Model->coursesectiontopics($subject_id);
		echo json_encode($result);
	}
	public function coursesectionexams(){
		$subject_id=$this->input->post('subject_id');
		$batch_id=$this->input->post('batch_id');
		$result=$this->Course_Model->coursesectionexams($subject_id,$batch_id);
		echo json_encode($result);
	}
	public function addstudents()
	{
		$courseid=$this->uri->segment(4);
		$this->session->set_userdata('startid',0);
		$result=array();
		$result['batches']=$this->Batch_Model->fetchbatches();
		$result['cid']=$courseid;
		$this->load->view('admin/header');
		$this->load->view('admin/addcoursestudents',$result);
		$this->load->view('admin/footer');
	}
	public function fetchstudents()
	{
		$startid=$this->session->userdata('startid');
		$limit=$this->input->post('limit');
		$cid=$this->input->post('cid');
		$result=$this->Course_Model->fetchncoursestudents($cid,$startid,$limit);
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
	public function filterbatchstudent()
	{
		$id=$this->input->post('id');
		$cid=$this->input->post('cid');
		$result=$this->Course_Model->filterncbatchstudent($cid,$id);
		$output='';
		$i=0;
		if(count($result['students'])>0){
			foreach ($result['students'] as $stud) {
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
	public function addcoursestudents()
	{
		$students=$this->input->post('students');
		$cid=$this->input->post('cid');
		$result=$this->Course_Model->addcoursestudents($cid,$students);
	}
	public function addsection(){
		$stitle=$this->input->post('stitle');
		$cid=$this->input->post('cid');
		// $videos_price=$this->input->post('videos_price');
		// $ppts_price=$this->input->post('ppts_price');
		// $tests_price=$this->input->post('tests_price');
		// $overall_price=$this->input->post('overall_price');
		$code='';
		$msg='';
		$id=0;
		$data=array();
		if(empty($stitle)){
			$msg='Please enter section title.';
			$code='404';
		}
		// else if(empty($_FILES["thumbnail"]["name"]))
		// {
		// 	$code="404";
		// 	$msg="Please upload a thumbnail image.";
		// }
		else{
			$thumbnail='';
			// if(!empty( $_FILES["thumbnail"]["name"])){
			// 	$newname=str_replace(' ', '', $_FILES["thumbnail"]["name"]);
			// 	$fname=explode(".", $newname);
			// 	$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			// 	//print_r($fname);			
			// 	$_FILES['file']['name']     = $randname;
			// 	$_FILES['file']['type']     = $_FILES['thumbnail']['type'];
			// 	$_FILES['file']['tmp_name'] = $_FILES['thumbnail']['tmp_name'];
			// 	$_FILES['file']['error']    = $_FILES['thumbnail']['error'];
			// 	$_FILES['file']['size']     = $_FILES['thumbnail']['size'];
			// 	$dir = dirname($_FILES["file"]["tmp_name"]);
			// 	$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
			// 	rename($_FILES["file"]["tmp_name"], $destination);
			// 	$key='kokateclasses/courses/section/'.$_FILES["file"]["name"];
			// 	$this->Spaces_Model->upload_file($key,$destination);
			// 	$thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			// }
			$id=$this->Course_Model->addsection($stitle,$thumbnail,$cid);
			$code='200';
		}
		$data['code']=$code;
		$data['msg']=$msg;
		$data['sid']=$id;
		echo json_encode($data);
	}
	public function add_section_topic(){
		$ttitle=$this->input->post('ttitle');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$overall_price=$this->input->post('overall_price');
		$videos_price=$this->input->post('videos_price');
		$ppts_price=$this->input->post('ppts_price');
		$tests_price=$this->input->post('tests_price');
		$code='';
		$msg='';
		$id=0;
		$data=array();
		if(empty($ttitle)){
			$msg='Please enter section title.';
			$code='404';
		}
		// else if(empty($_FILES["thumbnail"]["name"]))
		// {
		// 	$code="404";
		// 	$msg="Please upload a thumbnail image.";
		// }
		else{
			$thumbnail='';
			// if(!empty( $_FILES["thumbnail"]["name"])){
			// 	$newname=str_replace(' ', '', $_FILES["thumbnail"]["name"]);
			// 	$fname=explode(".", $newname);
			// 	$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			// 	//print_r($fname);			
			// 	$_FILES['file']['name']     = $randname;
			// 	$_FILES['file']['type']     = $_FILES['thumbnail']['type'];
			// 	$_FILES['file']['tmp_name'] = $_FILES['thumbnail']['tmp_name'];
			// 	$_FILES['file']['error']    = $_FILES['thumbnail']['error'];
			// 	$_FILES['file']['size']     = $_FILES['thumbnail']['size'];
			// 	$dir = dirname($_FILES["file"]["tmp_name"]);
			// 	$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
			// 	rename($_FILES["file"]["tmp_name"], $destination);
			// 	$key='kokateclasses/courses/section/topics/'.$_FILES["file"]["name"];
			// 	$this->Spaces_Model->upload_file($key,$destination);
			// 	$thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			// }
			$id=$this->Course_Model->add_section_topic($ttitle,$thumbnail,$cid,$sid,$overall_price,$videos_price,$ppts_price,$tests_price);
			$code='200';
		}
		$data['code']=$code;
		$data['msg']=$msg;
		$data['tid']=$id;
		echo json_encode($data);
	}
	function sort_order_courses(){
		$sids=$this->input->post('sids');
		$this->Course_Model->sort_order_courses($sids);
	}
	public function sort_order_sections()
	{
		$sids=$this->input->post('sids');
		$this->Course_Model->sort_order_sections($sids);
	}
	public function sort_order_topic()
	{
		$tids=$this->input->post('tids');
		$this->Course_Model->sort_order_topic($tids);
	}
	public function addviewcourse()
	{
		$code='';
		$msg='';
		if(empty($_FILES["image"]["name"])){
			$msg="Please select course thumbnail image.";
			$code="404";
		}
		else{
			$image="";
			$video="";
			if(!empty( $_FILES["image"]["name"])){

				$newname=str_replace(' ', '', $_FILES["image"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
	//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['image']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['image']['error'];
				$_FILES['file']['size']     = $_FILES['image']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/thumbnails/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$image = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key; 
			}
			if(!empty( $_FILES["video"]["name"])){

				$newname=str_replace(' ', '', $_FILES["video"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
	//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['video']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['video']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['video']['error'];
				$_FILES['file']['size']     = $_FILES['video']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/videos/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$video = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key; 
			}
			$cid=$this->input->post('cid');
			$yurl=$this->input->post('yurl');
			$this->Course_Model->addviewcourse($cid,$image,$video,$yurl);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	function fetchlecture(){
		$lid=$this->input->post('lid');
		$result=$this->Lecture_Model->fetchlecture($lid);
		echo json_encode($result);
	}
	public function addpayment()
	{
		$cid=$this->input->post('cid');
		$videos_price=$this->input->post('videos_price');
		$ppts_price=$this->input->post('ppts_price');
		$tests_price=$this->input->post('tests_price');
		$overall_price=$this->input->post('overall_price');
		$code='';
		$msg='';
		/*if(!$ctype!="free" && empty($price))
		{
			$code="404";
			$msg="Please enter price.";
		}
		else{
			$this->Course_Model->addpayment($cid,$videos_price,$ppts_price,$tests_price,$overall_price);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}*/
		$this->Course_Model->addpayment($cid,$videos_price,$ppts_price,$tests_price,$overall_price);
		$code="200";
		$data['id']=$cid;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);	
	}

	function newtest(){
		if(!$this->isadminLoggedIn){ 
			redirect('admin/login'); 
		}
		else{ 
			$id=$this->uri->segment(4);
			$result=array();
			$result['tid']=$id;
			$result['type']="course";
			$result['ttype']="stest";
			$this->load->view('admin/createlecttest',$result);
		}
	}
	public function addlecturetest()
	{
		$tid=$this->input->post("tid");
		$type=$this->input->post("type");
		$duration=$this->input->post("duration");
		$title=$this->input->post("title");
		$pmarks=$this->input->post("pmarks");
		$instructions=$this->input->post("instructions");
		$code="";
		$msg="";
		$eid=0;
		if(empty($title)){
			$code="404";
			$msg="Please enter title of exam.";
		}
		else if(empty($duration)){
			$code="404";
			$msg="Please enter duration of exam.";
		}
		else if(empty($pmarks)){
			$code="404";
			$msg="Please enter passing percentage of exam.";
		}
		else if(empty($instructions)){
			$code="404";
			$msg="Please enter instructions of exam.";
		}
		else{
			
			$eid=$this->Test_Model->addlecturetest($tid,$type,$title,$duration,$pmarks,$instructions);
			$code="200";
			$msg="Exam Created successfully.";
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		$data['id']=$eid;
		echo json_encode($data);
	}
	function newlqtest(){
		if(!$this->isadminLoggedIn){ 
			redirect('admin/login'); 
		}
		else{ 
			$id=$this->uri->segment(4);
			$result=array();
			$result['tid']=$id;
			$result['type']="course";
			$result['ttype']="sltest";
			$this->load->view('admin/createlecttest',$result);
		}
	}
	public function testdetails(){
		if(!$this->isadminLoggedIn){ 
			redirect('admin/login'); 
		}
		else{ 
			$this->session->set_userdata('qstart',0);
			$this->session->set_userdata('quesno',0);
			$id=$this->uri->segment(4);
			$result=array();
			$result=$this->Test_Model->fetchtestdetails($id);
			$this->load->view('admin/testdetails',$result);
		}

	}
	public function addcourse()
	{
		$cid=$this->input->post('cid');
		$title=$this->input->post('title');
		$price=$this->input->post('price');
		$category=$this->input->post('category');
		// $desc=$this->input->post('desc');
		// $faculty=$this->input->post('faculty');

		$code='';
		$msg='';
		$id=0;
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		// else if(empty($desc))
		// {
		// 	$code="404";
		// 	$msg="Please enter description of the course.";
		// }
		else{
			$background_image="";
			$video="";
			$video_thumbnail="";
			// if(!empty( $_FILES["video"]["name"])){
			// 	$newname=str_replace(' ', '', $_FILES["video"]["name"]);
			// 	$fname=explode(".", $newname);
			// 	$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			// 	$_FILES['file']['name']     = $randname;
			// 	$_FILES['file']['type']     = $_FILES['video']['type'];
			// 	$_FILES['file']['tmp_name'] = $_FILES['video']['tmp_name'];
			// 	$_FILES['file']['error']    = $_FILES['video']['error'];
			// 	$_FILES['file']['size']     = $_FILES['video']['size'];
			// 	$dir = dirname($_FILES["file"]["tmp_name"]);
			// 	$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
			// 	rename($_FILES["file"]["tmp_name"], $destination);
			// 	$key='kokateclasses/courses/thumbnails/'.$_FILES["file"]["name"];
			// 	$this->Spaces_Model->upload_file($key,$destination);
			// 	$video = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			// }
			// if(!empty( $_FILES["video_thumbnail"]["name"])){
			// 	$newname=str_replace(' ', '', $_FILES["video_thumbnail"]["name"]);
			// 	$fname=explode(".", $newname);
			// 	$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			// 	$_FILES['file']['name']     = $randname;
			// 	$_FILES['file']['type']     = $_FILES['video_thumbnail']['type'];
			// 	$_FILES['file']['tmp_name'] = $_FILES['video_thumbnail']['tmp_name'];
			// 	$_FILES['file']['error']    = $_FILES['video_thumbnail']['error'];
			// 	$_FILES['file']['size']     = $_FILES['video_thumbnail']['size'];
			// 	$dir = dirname($_FILES["file"]["tmp_name"]);
			// 	$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
			// 	rename($_FILES["file"]["tmp_name"], $destination);
			// 	$key='kokateclasses/courses/thumbnails/'.$_FILES["file"]["name"];
			// 	$this->Spaces_Model->upload_file($key,$destination);
			// 	$video_thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			// }
			if(!empty( $_FILES["background_image"]["name"])){
				$newname=str_replace(' ', '', $_FILES["background_image"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['background_image']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['background_image']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['background_image']['error'];
				$_FILES['file']['size']     = $_FILES['background_image']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/background_image/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$background_image = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			if($cid>0){
				$course = $this->Course_Model->fetchbcourse($cid);
				// if($course[0]->Cover_image!="" && $video_thumbnail!=""){
				// 	$url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$course[0]->Cover_image);
				// 	$this->Spaces_Model->delete_file($url);
				// }
				if($course[0]->Background_image!="" && $background_image!=""){
					$url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$course[0]->Background_image);
					$this->Spaces_Model->delete_file($url);
				}
				
				// if($course[0]->Promotional_video!="" && $video!=""){
				// 	$url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$course[0]->Promotional_video);
				// 	$this->Spaces_Model->delete_file($url);
				// }
			}
			$id=$this->Course_Model->addcourse($cid,$category,$title,$background_image,$price);
			$code="200";
		}
		$data['id']=$id;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);	
	}
	public function addlecture()
	{
		$course_id=$this->input->post('course_id');
		$subject_id=$this->input->post('subject_id');
		$teacher_id=$this->input->post('teacher_id');
		$title=$this->input->post('title');
		$batch_id=$this->input->post('batch_id');
		$topic_id=$this->input->post('topic_id');
		$lacture_date=$this->input->post('lacture_date');
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$note=$this->input->post('note');
		
		$code='';
		$msg='';
		$result=array();
		$result=array();
		


		$result=$this->Course_Model->addlecture($course_id,$subject_id,$teacher_id,$batch_id,$title,$topic_id,$lacture_date,$stime,$etime,$note);
		$type="lecture";
		$this->Notification_Model->send_notification($batch_id,$type);
		$code="200";

		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addvideo()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		
		$code='';
		$msg='';
		$result=array();
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($_FILES["thumbnail"]["name"]))
		{
			$code="404";
			$msg="Please upload a thumbnail image.";
		}
		else if(empty($_FILES["video"]["name"]))
		{
			$code="404";
			$msg="Please upload a video.";
		}
		else{
			$video="";
			$fname='';
			$thumbnail="";
			$type="video";
			$duration="";
			$videosize="";
			if(!empty( $_FILES["video"]["name"])){

				$newname=str_replace(' ', '', $_FILES["video"]["name"]);

				$fname=explode(".", $newname);
				$randname=date('ymdhis').'.'.$fname[count($fname)-1];

	//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['video']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['video']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['video']['error'];
				$_FILES['file']['size']     = $_FILES['video']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$getID3 = new getID3;
				$file = $getID3->analyze($destination);
				$duration=$file['playtime_string'];
				$videosize=$file['filesize'];
				$key='kokateclasses/courses/lectures/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$video = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			if(!empty( $_FILES["thumbnail"]["name"])){

				$newname=str_replace(' ', '', $_FILES["thumbnail"]["name"]);
				$fname=explode(".", $newname);
				$randname=date('ymdhis'). '.' . $fname[count($fname)-1];
	//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['thumbnail']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['thumbnail']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['thumbnail']['error'];
				$_FILES['file']['size']     = $_FILES['thumbnail']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/lectures/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$result=$this->Course_Model->addvideo($cid,$sid,$tid,$type,$title,$desc,$video,$thumbnail,$duration,$videosize);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function fetchvideoconcept(){
		$lid=$this->input->post('lid');
		$result=$this->Course_Model->fetchvideoconcept($lid);
		echo json_encode($result);
	}
	public function deletetest()
	{
		$sid=$this->input->post('sid');
		$this->Course_Model->deletetest($sid);
	}
	public function deletelecture()
	{
		$lid=$this->input->post('lid');
		$this->Course_Model->deletelecture($lid);
	}
	public function deleteassignmentsingle()
	{
		$aid=$this->input->post('aid');
		$this->Course_Model->deleteassignmentsingle($aid);
	}
	public function deleteworksingle()
	{
		$aid=$this->input->post('aid');
		$this->Course_Model->deleteworksingle($aid);
	}
	public function deleteexamsingle()
	{
		$aid=$this->input->post('aid');
		$this->Course_Model->deleteexamsingle($aid);
	}
	public function deleteqwsingle()
	{
		$aid=$this->input->post('aid');
		$this->Course_Model->deleteqwsingle($aid);
	}
	public function deletesectionlecture()
	{
		$lid=$this->input->post('lid');
		$this->Course_Model->deletesectionlecture($lid);
	}
	public function deleteworkshet()
	{
		$wid=$this->input->post('wid');
		$this->Course_Model->deleteworkshet($wid);
	}
	public function deletequew()
	{
		$qid=$this->input->post('qid');
		$this->Course_Model->deletequew($qid);
	}
	public function deleteexam()
	{
		$eid=$this->input->post('eid');
		$this->Course_Model->deleteexam($eid);
	}
	public function deleteassignment()
	{
		$aid=$this->input->post('aid');
		$this->Course_Model->deleteassignment($aid);
	}
	public function deletequestion()
	{
		$qid=$this->input->post('qid');
		$this->Course_Model->deleteqn($qid);
	}
	public function fetchtestseries(){
		$sid=$this->input->post('sid');
		$result=$this->Course_Model->fetchtestseries($sid);
		echo json_encode($result);
	}
	public function updatetest()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$sid=$this->input->post('sid');
		$thumbnail=$this->input->post('ethumbnail');
		$code='';
		$msg='';
		$result=array();
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else{
			if(!empty( $_FILES["thumbnail"]["name"])){
				$newname=str_replace(' ', '', $_FILES["thumbnail"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
				//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['thumbnail']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['thumbnail']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['thumbnail']['error'];
				$_FILES['file']['size']     = $_FILES['thumbnail']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/test-series/thumbnails/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$this->Course_Model->updatetest($sid,$title,$desc,$thumbnail);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updatevideo()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$vid=$this->input->post('vid');
		
		//$video=$this->input->post('evideo');
		//$thumbnail=$this->input->post('ethumbnail');
		$code='';
		$msg='';
		$result=array();
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else{
			$type="video";
			$duration="";
			$videosize="";
			$video="";
			$thumbnail="";
			/*if(!empty( $_FILES["video"]["name"])){
				$newname=str_replace(' ', '', $_FILES["video"]["name"]);
				$fname=explode(".", $newname);
				$randname=date('ymdhis') . '.' . $fname[count($fname)-1];
				//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['video']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['video']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['video']['error'];
				$_FILES['file']['size']     = $_FILES['video']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$getID3 = new getID3;
				$file = $getID3->analyze($destination);
				$duration=$file['playtime_string'];
				$videosize=$file['filesize'];
				$key='kokateclasses/courses/lectures/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$video = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			if(!empty( $_FILES["thumbnail"]["name"])){
				$newname=str_replace(' ', '', $_FILES["thumbnail"]["name"]);
				$fname=explode(".", $newname);
				$randname=date('ymdhis'). '.' . $fname[count($fname)-1];
				//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['thumbnail']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['thumbnail']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['thumbnail']['error'];
				$_FILES['file']['size']     = $_FILES['thumbnail']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/lectures/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key; 
			}*/
			$result=$this->Course_Model->updatevideo($vid,$title,$desc,$video,$thumbnail,$duration,$videosize);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['lecture']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updateexam()
	{
		$title=$this->input->post('title');
		$exbatch=$this->input->post('exbatch');
		$tmark=$this->input->post('tmark');
		$pmark=$this->input->post('pmark');
		$date=$this->input->post('date');
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		//$pdf=$this->input->post('epdf');
		$qid=$this->input->post('qid');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else{

			
			$this->Course_Model->updatexame($qid,$exbatch,$tmark,$pmark,$title,$date,$stime,$etime);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updatequestionw()
	{
		$qwabsent=$this->input->post('qwabsent');
		$qwsumitted=$this->input->post('qwsumitted');
		$qwremark=$this->input->post('qwremark');
		
		//$pdf=$this->input->post('epdf');
		$aid=$this->input->post('aid');
		$code='';
		$msg='';
		$result=array();
		if(empty($qwremark))
		{
			$code="404";
			$msg="Please enter Remark.";
		}
		else{

			
			$this->Course_Model->updatequestionw($aid,$qwabsent,$qwsumitted,$qwremark);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updateassignment()
	{
		$is_late=$this->input->post('is_late');
		$asumitted=$this->input->post('asumitted');
		$assignsubmitdate=$this->input->post('assignsubmitdate');
		$aremark=$this->input->post('aremark');
		
		//$pdf=$this->input->post('epdf');
		$aid=$this->input->post('aid');
		$code='';
		$msg='';
		$result=array();
		// if(empty($aremark))
		// {
		// 	$code="404";
		// 	$msg="Please enter Remark.";
		// }
		// else{

			
			$this->Course_Model->updateassignment($aid,$asumitted,$is_late,$aremark,$assignsubmitdate);
			$code="200";
			//	$msg="Student added sucessfully.";	
		//}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updateworksheets()
	{
		$is_late=$this->input->post('is_late');
		$wsumitted=$this->input->post('asumitted');
		$wremark=$this->input->post('aremark');
		
		//$pdf=$this->input->post('epdf');
		$wid=$this->input->post('aid');
		$code='';
		$msg='';
		$result=array();
		// if(empty($wremark))
		// {
		// 	$code="404";
		// 	$msg="Please enter Remark.";
		// }
		// else{

			
			$this->Course_Model->updateworksheets($wid,$wsumitted,$is_late,$wremark);
			$code="200";
			//	$msg="Student added sucessfully.";	
		//}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updateexams()
	{
		$aabsent=$this->input->post('aabsent');
		$qmark=$this->input->post('qmark');
		$qremark=$this->input->post('qremark');
		
		//$pdf=$this->input->post('epdf');
		$aid=$this->input->post('aid');
		$code='';
		$msg='';
		$result=array();
		if(empty($qremark))
		{
			$code="404";
			$msg="Please enter Remark.";
		}
		else{

			
			$this->Course_Model->updateexams($aid,$qmark,$aabsent,$qremark);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}

	public function updatequestionwrite()
	{
		$title=$this->input->post('title');
		$batch=$this->input->post('batch');
		$desc=$this->input->post('desc');
		//$pdf=$this->input->post('epdf');
		$qid=$this->input->post('qid');
		$qw_date=$this->input->post('qw_date');
		$qwstime=$this->input->post('qwstime');
		$qwetime=$this->input->post('qwetime');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		if(empty($batch))
		{
			$code="404";
			$msg="Please select batch.";
		}
		else if(empty($desc) && empty($pdf))
		{
			$code="404";
			$msg="Please enter concept description or select a document.";
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
				$key='vktutorials/courses/questionwrite/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$this->Course_Model->updatequestionwrite($qid,$batch,$title,$desc,$pdf,$qw_date,$qwstime,$qwetime);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updateconcept()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		//$pdf=$this->input->post('epdf');
		$cid=$this->input->post('cid');
		$type=$this->input->post('type');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($desc) && empty($pdf))
		{
			$code="404";
			$msg="Please enter concept description or select a document.";
		}
		else{
			if($type=='ppt'){
				if($desc!=""){
					$desc='<iframe src="'.$desc.'" frameborder="0" style="width: 100%;height: 100vh;" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';

				}
			}
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
				$key='kokateclasses/courses/concepts/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$this->Course_Model->updateconcept($cid,$title,$desc,$pdf);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updateworksheet()
	{
		$wid=$this->input->post('wid');
		$title=$this->input->post('title');
		$wbatchid=$this->input->post('wbatchid');
		$wlec_id=$this->input->post('wlec_id');
		$wsub_date=$this->input->post('wsub_date');
		// $pdf=$this->input->post('pdf');
		// $cid=$this->input->post('cid');
		$type=$this->input->post('type');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		// else if(empty($pdf))
		// {
		// 	$code="404";
		// 	$msg="Please enter concept description or select a document.";
		// }
		else{
			// if($type=='ppt'){
			// 	if($desc!=""){
			// 		$desc='<iframe src="'.$desc.'" frameborder="0" style="width: 100%;height: 100vh;" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';

			// 	}
			// }
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
				$key='vktutorials/courses/worksheet/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$this->Course_Model->updateworksheet($title,$wbatchid,$wsub_date,$pdf,$wlec_id,$wid);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updatassignmentdoc()
	{
		$aid=$this->input->post('aid');
		$bid=$this->input->post('bid');
		$title=$this->input->post('title');
		$assignsubmitdate=$this->input->post('assignsubmitdate');

		// $pdf=$this->input->post('pdf');
		// $cid=$this->input->post('cid');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
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
				$key='vktutorials/courses/assignment/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$this->Course_Model->updatassignmentdoc($title,$assignsubmitdate,$bid,$pdf,$aid);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function getbatchlectures(){
		$batch_id = $this->input->post('batch_id');
		$topic_id = $this->input->post('topic_id');
		$data = $this->Course_Model->getbatchlectures($batch_id,$topic_id);
		echo json_encode($data);
	}
	public function updateqaquestion()
	{
		$fquestion=$this->input->post('fquestion');
		$fanswer=$this->input->post('fanswer');
		$qid=$this->input->post('qid');
		$code='';
		$msg='';
		$result=array();
		if(empty($fquestion))
		{
			$code="404";
			$msg="Please enter question.";
		}
		else{
			$this->Course_Model->updateqaquestion($qid,$fquestion,$fanswer);
			$code="200";
			//	$msg="Student added sucessfully.";	
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addassignment()
	{
		$title=$this->input->post('title');
		$subdate=$this->input->post('subdate');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$bid=$this->input->post('bid');
		$lect_id=$this->input->post('lect_id');
		$tid=$this->input->post('tid');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($_FILES["pdf"]["name"]))
		{
			$code="404";
			$msg="Please Upload File.";
		}
		else if(empty($subdate))
		{
			$code="404";
			$msg="Please Enter Submission Date.";
		}
		else{

			// if($type=='ppt'){
			// 	$desc='<iframe src="'.$desc.'" frameborder="0" style="width: 100%;height: 100vh;" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
			// }
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
				$key='vktutorials/courses/worksheet/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$result=$this->Course_Model->addassignmentworksheet($cid,$sid,$bid,$tid,$lect_id,$title,$subdate,$pdf);
			$code="200";
		$type="worksheet";
		$this->Notification_Model->send_notification($bid,$type);
	//	$msg="Student added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addassignmentdoc()
	{
		$assin_title=$this->input->post('assin_title');
		$assinsubmission_date=$this->input->post('assinsubmission_date');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$bid=$this->input->post('bid');
		$code='';
		$msg='';
		$result=array();
		if(empty($assin_title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($_FILES["pdf"]["name"]))
		{
			$code="404";
			$msg="Please Upload File.";
		}
		else if(empty($assinsubmission_date))
		{
			$code="404";
			$msg="Please Enter Submission Date.";
		}
		else{

			// if($type=='ppt'){
			// 	$desc='<iframe src="'.$desc.'" frameborder="0" style="width: 100%;height: 100vh;" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
			// }
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
				$key='vktutorials/courses/assignment/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$result=$this->Course_Model->addassignmentdoc($cid,$sid,$tid,$assin_title,$assinsubmission_date,$bid,$pdf);
		$type="assignment";
		$this->Notification_Model->send_notification($bid,$type);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addconcept()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$type=$this->input->post('type');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($desc) && empty($_FILES["pdf"]["name"]))
		{
			$code="404";
			$msg="Please enter concept description or select a document.";
		}
		else{

			if($type=='ppt'){
				$desc='<iframe src="'.$desc.'" frameborder="0" style="width: 100%;height: 100vh;" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
			}
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
				$key='kokateclasses/courses/concepts/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$result=$this->Course_Model->addconcept($cid,$sid,$tid,$type,$title,$desc,$pdf);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addexam()
	{
		// print_r($this->input->post());
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

			$result=$this->Course_Model->addexam($cid,$sid,$tid,$bid,$total_marks,$passing_marks,$title,$date,$stime,$etime,$exam_type,$topic);
			$code="200";
		$type="exam";
		$this->Notification_Model->send_notification($bid,$type);


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
	public function addquestionwrite()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$bid=$this->input->post('bid');
		$qw_date=$this->input->post('qw_date');
		$qwstime=$this->input->post('qwstime');
		$qwetime=$this->input->post('qwetime');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($desc) && empty($_FILES["pdf"]["name"]))
		{
			$code="404";
			$msg="Please enter concept description or select a document.";
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
				$key='kokateclasses/courses/concepts/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$pdf = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$result=$this->Course_Model->addquestionwrite($cid,$sid,$tid,$bid,$title,$desc,$pdf,$qw_date,$qwstime,$qwetime);
			$code="200";
		$type="qw";
		$this->Notification_Model->send_notification($bid,$type);
	//	$msg="Student added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addlquestion()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter topic.";
		}
		else if(empty($desc))
		{
			$code="404";
			$msg="Please enter questions.";
		}
		else{
			$type="lquestions";
			$result=$this->Course_Model->addconcept($cid,$sid,$tid,$type,$title,$desc);
			$code="200";
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updatcourselecture()
	{
		$id=$this->input->post('lid');
		$title=$this->input->post('title');
		$bid=$this->input->post('bid');
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$ldate=$this->input->post('ldate');
		$tid=$this->input->post('tid');
		$note=$this->input->post('note');
		$code='';
		$msg='';
		if (empty($title)) {
			$code='404';
			$msg='Please enter title of the lecture.';
		}
		else if (empty($ldate)) {
			$code='404';
			$msg='Please select date of the lecture.';
		}
		else if (empty($stime) || empty($etime)) {
			$code='404';
			$msg='Please select both start time & end time .';
		}
		else if (empty($tid)) {
			$code='404';
			$msg='Please enter lecture id.';
		}
		else{

			$this->Course_Model->updatecurselec($id,$title,$bid,$tid,$note,$ldate,$stime,$etime);
			$code='200';
			$msg='Course lecture updated successfully.';
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updatelive()
	{
		$id=$this->input->post('lid');
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$lectid=str_replace(' ', "", $this->input->post('lectid'));
		$pass=$this->input->post('lpass');
		$stime=$this->input->post('lstime');
		$etime=$this->input->post('letime');
		$ldate=$this->input->post('ldate');
		$surl=$this->input->post('lstarturl');
		$image=$this->input->post('eimage');
		$code='';
		$msg='';
		if (empty($title)) {
			$code='404';
			$msg='Please enter title of the lecture.';
		}
		else if (empty($ldate)) {
			$code='404';
			$msg='Please select date of the lecture.';
		}
		else if (empty($stime) || empty($stime)) {
			$code='404';
			$msg='Please select both start time & end time .';
		}
		else if (empty($lectid)) {
			$code='404';
			$msg='Please enter lecture id.';
		}
		else if (empty($pass)) {
			$code='404';
			$msg='Please enter password.';
		}
		else{
			if(!empty( $_FILES["image"]["name"])){
				if($image!=""){
					$url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$image);
					$this->Spaces_Model->delete_file($url);
				}
				$newname=str_replace(' ', '', $_FILES["image"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
				//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['image']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['image']['error'];
				$_FILES['file']['size']     = $_FILES['image']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/section/topics/live/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$image = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key; 

			}
			$this->Course_Model->updatelive($id,$title,$desc,$lectid,$pass,$ldate,$stime,$etime,$surl,$image);
			$code='200';
			$msg='lecture updated successfully.';
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addqa()
	{
		$question=$this->input->post('question');
		$answer=$this->input->post('answer');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$code='';
		$msg='';
		$result=array();
		if(empty($question))
		{
			$code="404";
			$msg="Please enter your question.";
		}
		else if(empty($answer))
		{
			$code="404";
			$msg="Please enter your answer.";
		}
		else{
			$type="concept";
			$result=$this->Course_Model->addqa($cid,$sid,$tid,$question,$answer);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updatesection()
	{
		$sid=$this->input->post("sid");
		$title=$this->input->post("title");
	//$thumbnail=$this->input->post("ethumbnail");
		$code="";
		$msg="";
		if(empty($title))
		{
			$code="404";
			$msg="Please enter section title.";
		}
		else{

			$thumbnail="";
			if(!empty( $_FILES["thumbnail"]["name"])){
				$newname=str_replace(' ', '', $_FILES["thumbnail"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['thumbnail']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['thumbnail']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['thumbnail']['error'];
				$_FILES['file']['size']     = $_FILES['thumbnail']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/section/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key; 
			}
			$this->Course_Model->updatesection($sid,$title,$thumbnail);
			$code="200";
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}

	public function updatetopic()
	{
		$tid=$this->input->post("tid");
		$title=$this->input->post("title");
	//$thumbnail=$this->input->post("ethumbnail");
		$code="";
		$msg="";
		if(empty($title))
		{
			$code="404";
			$msg="Please enter section title.";
		}
		else{

			$thumbnail="";
			if(!empty( $_FILES["thumbnail"]["name"])){
				$newname=str_replace(' ', '', $_FILES["thumbnail"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['thumbnail']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['thumbnail']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['thumbnail']['error'];
				$_FILES['file']['size']     = $_FILES['thumbnail']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/section/topics/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key; 
			}
			$this->Course_Model->updatetopic($tid,$title,$thumbnail);
			$code="200";
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function publishsectionlecture()
	{
		$lid=$this->input->post("lid");
		$this->Course_Model->publishsectionlecture($lid);
	}
	public function publishcourse()
	{
		$cid=$this->input->post("cid");
		$this->Course_Model->publishcourse($cid);
	}
	public function publishsection()
	{
		$sid=$this->input->post("sid");
		$this->Course_Model->publishsection($sid);
	}
	public function publishtopic()
	{
		$tid=$this->input->post("tid");
		$this->Course_Model->publishtopic($tid);
	}
	public function publishlectures()
	{
		$lid=$this->input->post("lid");
		$this->Course_Model->publishlectures($lid);
	}
	public function publishworksheet()
	{
		$wid=$this->input->post("wid");
		$this->Course_Model->publishworksheet($wid);
	}
	public function unpublishworksheet()
	{
		$wid=$this->input->post("wid");
		$this->Course_Model->unpublishworksheet($wid);
	}
	public function publishassingment()
	{
		$aid=$this->input->post("aid");
		$this->Course_Model->publishassingment($aid);
	}
	public function unpublishassingment()
	{
		$aid=$this->input->post("aid");
		$this->Course_Model->unpublishassingment($aid);
	}
	public function publishexamm()
	{
		$aid=$this->input->post("aid");
		$this->Course_Model->publishexamm($aid);
	}
	public function unpublishexamm()
	{
		$aid=$this->input->post("aid");
		$this->Course_Model->unpublishexamm($aid);
	}
	public function publishqw()
	{
		$aid=$this->input->post("aid");
		$this->Course_Model->publishqw($aid);
	}
	public function unpublishqw()
	{
		$aid=$this->input->post("aid");
		$this->Course_Model->unpublishqw($aid);
	}
	public function unpublishlectures()
	{
		$lid=$this->input->post("lid");
		$this->Course_Model->unpublishlectures($lid);
	}
	public function allowpreview()
	{
		$tid=$this->input->post("tid");
		$result=$this->Course_Model->fetchtopic($tid);
		$ispreview=1;
		if($result[0]->IsAccessible==1){
			$ispreview=0;
		}
		$this->Course_Model->previewlecture($tid,$ispreview);
	}
	public function disablepreview()
	{
		$tid=$this->input->post("tid");
		$result=$this->Course_Model->fetchtopic($tid);
		$ispreview=1;
		if($result[0]->IsAccessible==1){
			$ispreview=0;
		}
		$this->Course_Model->previewlecture($tid,$ispreview);
	}
	public function publishtest()
	{
		$sid=$this->input->post("sid");
		$this->Course_Model->publishtest($sid);
	}
	public function publishlecture()
	{
		$lid=$this->input->post("lid");
		$this->Course_Model->publishlecture($lid);
	}
	public function publishquestion()
	{
		$qid=$this->input->post("qid");
		$this->Course_Model->publishquestion($qid);
	}
	public function addlecture1()
	{
		formData.append('course_id', cid);
		formData.append('subject_id', sid);
		formData.append('teacher_id', tid);
        // formData.append('video', video[0]);
        // formData.append('thumbnail', thumbnail[0]);
		formData.append('title', ltitle);
		formData.append('batch_id', bid);
		formData.append('topic_id', topicid);
		formData.append('lacture_date', bid);
		formData.append('stime', stime);
		formData.append('etime', etime);

		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$ldate=$this->input->post('ldate');
		$lectid=str_replace(' ', "", $this->input->post('lectid'));
		$pass=$this->input->post('pass');
		$lstarturl=$this->input->post('lstarturl');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($ldate))
		{
			$code="404";
			$msg="Please select lecture date.";
		}
		else if(empty($stime) && empty($etime))
		{
			$code="404";
			$msg="Please enter lecture start time & endtime.";
		}
		else if(empty($lectid))
		{
			$code="404";
			$msg="Please enter lecture id.";
		}
		else if(empty($pass))
		{
			$code="404";
			$msg="Please enter lecture password.";
		}
		else{
			$image="";
			if(!empty( $_FILES["image"]["name"])){
				$newname=str_replace(' ', '', $_FILES["image"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
			//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['image']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['image']['error'];
				$_FILES['file']['size']     = $_FILES['image']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/section/topics/live/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$image = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key; 
			}
			$result=$this->Course_Model->addlecture($cid,$sid,$tid,$title,$desc,$ldate,$stime,$etime,$lstarturl,$lectid,$pass,$image);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['result']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addtestseries()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$cid=$this->input->post('cid');
		$sid=$this->input->post('sid');
		$code='';
		$msg='';
		$result=array();
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($_FILES["thumbnail"]["name"]))
		{
			$code="404";
			$msg="Please upload a thumbnail image.";
		}
		else{
			$thumbnail="";
			if(!empty( $_FILES["thumbnail"]["name"])){

				$newname=str_replace(' ', '', $_FILES["thumbnail"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
	//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['thumbnail']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['thumbnail']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['thumbnail']['error'];
				$_FILES['file']['size']     = $_FILES['thumbnail']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/test-series/thumbnails/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$thumbnail = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			}
			$result=$this->Course_Model->addtestseries($cid,$sid,$title,$desc,$thumbnail);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['lecture']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);


	}
	public function updatelecture()
	{
		$title=$this->input->post('title');
		$desc=$this->input->post('desc');
		$lid=$this->input->post('lid');
		$code='';
		$msg='';
		$result=array();
		if(empty($title))
		{
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($desc) && empty($_FILES["file"]["name"]))
		{
			$code="404";
			$msg="Please enter description of the course or upload a file.";
		}
		else{
			$file="";
			$fname="";
			if(!empty( $_FILES["file"]["name"])){

				$newname=str_replace(' ', '', $_FILES["file"]["name"]);
				$fname=explode(".", $newname);
				$randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
	//print_r($fname);			
				$_FILES['file']['name']     = $randname;
				$_FILES['file']['type']     = $_FILES['file']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['file']['tmp_name'];
				$_FILES['file']['error']    = $_FILES['file']['error'];
				$_FILES['file']['size']     = $_FILES['file']['size'];
				$dir = dirname($_FILES["file"]["tmp_name"]);
				$destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
				rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/courses/lectures/'.$_FILES["file"]["name"];
				$this->Spaces_Model->upload_file($key,$destination);
				$file = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
				$fname=$_FILES['file']['name'];
			}
			$result=$this->Course_Model->updatelecture($lid,$title,$desc,$file,$fname);
			$code="200";
	//	$msg="Student added sucessfully.";	
		}
		$data['lid']=$result;
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);


	}
	public function deletecourse()
	{
		$id=$this->input->post('id');
		$this->Course_Model->deletecourse($id);
	}
	public function deletesection()
	{
		$sid=$this->input->post('sid');
		$this->Course_Model->deletesection($sid);
	}
	public function deletetopic()
	{
		$tid=$this->input->post('tid');
		$this->Course_Model->deletetopic($tid);
	}
	public function playvideo()
	{
		$vid=$this->uri->segment(4);
		$video=$this->Course_Model->fetchvideo($vid);
		$this->load->view('admin/header');
		$this->load->view('admin/playcoursevideo',$video[0]);
		$this->load->view('admin/footer');
	}
	public function fetchcourses()
	{
		$startid=$this->session->userdata('startid');
		$limit=$this->input->post('limit');
		$result=$this->Course_Model->fetchcourses($startid,$limit);
		$output='';
		$i=0;
		foreach ($result['courses'] as $row) {
			$this->session->set_userdata('startid',$row->Id);
			$output.='<div class="col-3" style="margin-bottom:20px;">
			
			<a href="'.base_url().'admin/course/coursedetails/'.$row->Id.'">
			<div class="card" style="border-radius:10px;">            
			<div class="card-body" style="padding:.5rem"> <img src="'.$row->Cover_image.'" style="width: 100%;height: 180px;border-radius:10px;">';

			if(strlen($row->Title)>20){
				$output.='<a href="'.base_url().'admin/course/coursedetails/'.$row->Id.'" style="font-size:15px;font-weight:bold;padding-bottom:.5rem;">'.substr($row->Title, 0, 20).'.....</a>';
			}
			else{
				$output.='<a href="'.base_url().'admin/course/coursedetails/'.$row->Id.'" style="font-size:15px;font-weight:bold;padding-bottom:.5rem;">'.$row->Title.'</a>';
			}
			if($row->Price!=0){
				$output.='<p style="color:black;">&#8377; '.$row->Price.'</p>';
			}
			else{
				$output.='<p style="color:black;">FREE</p>';
			}
			$output.='</div></div>';
			$output.='</a></div>';
			$i++;
		}
		echo $output;
	}

	public function course_students()
	{
		$id=$this->uri->segment(4);
		$result=$this->Course_Model->fetchcourse($id);
		$result['students']=$this->Course_Model->fetchcoursestudents($id);
		$this->load->view('admin/header');
		$this->load->view('admin/course_students',$result);
		$this->load->view('admin/footer');
	}
	public function editcourse()
	{
		$cid=$this->uri->segment(4);
		$result=$this->Course_Model->fetchcourseinformation($cid);
		$result['categories']=$this->Category_Model->fetchcategories();
		if(count($result)>0){
			$this->load->view('admin/header');
			$this->load->view('admin/editcourse',$result);
			$this->load->view('admin/footer');
		}
		else{
			show_404();
		}
	}
	public function coursedetail()
	{
		$cid=$this->uri->segment(4);
		$result=$this->Course_Model->fetchcourseinformation($cid);
		$result['categories']=$this->Category_Model->fetchcategories();
		if(count($result)>0){
			$this->load->view('admin/header');
			$this->load->view('admin/newcourse',$result);
			$this->load->view('admin/footer');
		}
		else{
			show_404();
		}
	}
	//add worksheet submitted students
	public function add_worksheet_submitted()
	{
		if ($this->isadminLoggedIn) {
			$batch_id=$this->input->get('batch_id');
			$worksheet_id=$this->input->get('worksheet_id');
			$result['students']=$this->Batch_Model->fetchbatchstudents($batch_id);
			$result['batch_id']=$batch_id;
			$result['worksheet_id']=$worksheet_id;
			$this->load->view('admin/header');
			$this->load->view('admin/add-worksheet-submitted',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	//add assignment submitted students
	public function add_assignment_submitted()
	{
		if ($this->isadminLoggedIn) {
			$batch_id=$this->input->get('batch_id');
			$assignment_id=$this->input->get('assignment_id');
			$result['students']=$this->Batch_Model->fetchbatchstudents($batch_id);
			$result['batch_id']=$batch_id;
			$result['assignment_id']=$assignment_id;
			$this->load->view('admin/header');
			$this->load->view('admin/add-assignment-submitted',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	//add question writing submitted students
	public function add_questionwrite_submitted()
	{
		if ($this->isadminLoggedIn) {
			$batch_id=$this->input->get('batch_id');
			$qw_id=$this->input->get('qw_id');
			$result['students']=$this->Batch_Model->fetchbatchstudents($batch_id);

			$result['batch_id']=$batch_id;
			$result['qw_id']=$qw_id;
			$this->load->view('admin/header');
			$this->load->view('admin/add-questionwrite-submitted',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
		//add exam submitted students
	public function add_exam_submitted()
	{
		if ($this->isadminLoggedIn) {
			$batch_id=$this->input->get('batch_id');
			$exam_id=$this->input->get('exam_id');
			$result['students']=$this->Batch_Model->fetchbatchstudents($batch_id);
			$result['batch_id']=$batch_id;
			$result['exam_id']=$exam_id;
			$this->load->view('admin/header');
			$this->load->view('admin/add-exam-submitted',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}

	public function save_worksheet_submitted()
	{
		if ($this->isadminLoggedIn) {
			$worksheet_id=$this->input->post('worksheet_id');
			$sids=$this->input->post('sids');
			$is_late=$this->input->post('is_late');
			$is_submitted=$this->input->post('is_submitted');
			$remark=$this->input->post('remark');
			$result['students']=$this->Course_Model->save_worksheet_submitted($worksheet_id,$sids,$is_late,$is_submitted,$remark);
			$code='200';
			$data['code']="200";
			$data['msg']='';
			echo json_encode($data);
		}
		else{
			redirect('admin/login');
		}
	}
	public function save_assignment_submitted()
	{
		if ($this->isadminLoggedIn) {
			$assignment_id=$this->input->post('assignment_id');
			$sids=$this->input->post('sids');
			$is_late=$this->input->post('is_late');
			$is_submitted=$this->input->post('is_submitted');
			$remark=$this->input->post('remark');
			$result['students']=$this->Course_Model->save_assignment_submitted($assignment_id,$sids,$is_late,$is_submitted,$remark);
			$code='200';
			$data['code']=$code;
			$data['msg']='';
			echo json_encode($data);
		}
		else{
			redirect('admin/login');
		}
	}
	public function save_exam_submitted()
	{
		if ($this->isadminLoggedIn) {
			$exam_id=$this->input->post('exam_id');
			$sids=$this->input->post('sids');
			$marks=$this->input->post('marks');
			$is_absent=$this->input->post('is_absent');
			$remark=$this->input->post('remark');
			$result['students']=$this->Course_Model->save_exam_submitted($exam_id,$sids,$marks,$is_absent,$remark);
			$code='200';
			$data['code']=$code;
			$data['msg']='';
			echo json_encode($data);
		}
		else{
			redirect('admin/login');
		}
	}
	public function save_questionw_submitted()
	{
		if ($this->isadminLoggedIn) {
			$qw_id=$this->input->post('qw_id');
			$sids=$this->input->post('sids');
			$is_late=$this->input->post('is_late');
			$is_submitted=$this->input->post('is_submitted');
			$remark=$this->input->post('remark');
			$result['studentsqw']=$this->Course_Model->save_questionw_submitted($qw_id,$sids,$is_late,$is_submitted,$remark);
			$code='200';
			$data['code']=$code;
			$data['msg']='';
			echo json_encode($data);
		}
		else{
			redirect('admin/login');
		}
	}
	

	public function worksheet_submitted()
	{
		if ($this->isadminLoggedIn) {
			$batch_id=$this->input->post('batch_id');
			$worksheet_id=$this->input->post('worksheet_id');
			$result['students']=$this->Course_Model->worksheet_submitted($worksheet_id,$batch_id);
			$this->load->view('admin/header');
			$this->load->view('admin/worksheet-submitted',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}

	}
	public function fetchcoursebatchsubjects(){
		$course_id = $this->input->post('course_id');
		$result=$this->Course_Model->fetchcoursebatchsubjects($course_id);
		echo json_encode($result);
	}
}
?>