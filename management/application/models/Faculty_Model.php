<?php
class Faculty_Model extends CI_Model 
{

	function addfacultyexam($course_id,$batch_id,$subjects,$topics,$student,$edate,$pdf,$stime,$etime,$tmarks,$pmark)
	{
		// $assin_title=str_replace("'","\'",$assin_title);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into exam_faculty_mst_t(course_id,batch_id,subjects,topics,student,edate,pdf,stime,etime,tmarks,pmark,created_at,updated_at) values('$course_id','$batch_id','$subjects','$topics','$student','$edate','$pdf','$stime','$etime','$tmarks','$pmark','$date','$date')";
		$this->db->query($query);

	}
	function addfaculty($fname,$mname,$lname,$phone,$email,$pass,$tphoto,$facebook,$twitter,$linkedin,$youtube)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		
		$pass= md5($pass);
		$query="insert into faculty_mst_t(FirstName,MiddleName,LastName,Phone,Email,Password,Photo,facebook,twitter,linkedin,youtube,CreatedAt,UpdatedAt) values('$fname','$mname','$lname','$phone','$email','$pass','$tphoto','$facebook','$twitter','$linkedin','$youtube','$date','$date')";
			$this->db->query($query);
			$id = $this->db->insert_id();
			$query="insert into users_mst_t(TeacherId,FirstName,LastName,Phone,Email,Password,Role,CreatedAt,UpdatedAt) values('$id','$fname','$lname','$phone','$email','$pass','Teacher','$date','$date')";
		$this->db->query($query);
		return $id;
	}
	function fetchfaculties(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM faculty_mst_t");
		$faculties= $query1->result();
		return $faculties;
	}

	function fetchcourses(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t");
		$courses= $query1->result();
		return $courses;
	}

	
	function fetchstudent(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM student_mst_t");
		$students= $query1->result();
		return $students;
	}
	function fetchtopic(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t");
		$topics= $query1->result();
		return $topics;
	}
	
	function checklogin($email){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Email='$email'");
		$faculty= $query1->result();
		return $faculty;
	}
	function countfaculty()
	{
		$query1=$this->db->query("SELECT  * FROM faculty_mst_t");
		$result= $query1->num_rows();
		return $result;
	}

	function updatefaculty($id,$fname,$mname,$lname,$phone,$email,$pass,$tphoto,$facebook,$twitter,$linkedin,$youtube)
	{
		$password="";
		if($pass!=""){
			$pass=md5($pass);
			$password= "and Password='$pass'";
		}

		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update users_mst_t SET FirstName='$fname',LastName='$lname',Email='$email',Phone='$phone',UpdatedAt='$date' $password where TeacherId='".$id."'");
		$query=$this->db->query("update faculty_mst_t SET FirstName='$fname',MiddleName='$mname',LastName='$lname',Email='$email',Phone='$phone',Photo='$tphoto',facebook='$facebook',twitter='$twitter',linkedin='$linkedin',youtube='$youtube',UpdatedAt='$date' $password where Id='".$id."'");
	}
	function deletefaculty($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$this->db->query("delete  from faculty_mst_t where Id='".$id."'");
		$this->db->query("delete  from salary_mst_t where TeacherId='".$id."'");
	}
	function fetchcourse(){
		$webdb = $this->load->database('reliablewebdb', TRUE);
		$query1=$webdb->query("SELECT  * FROM faculty_course_mst_t");
		$courses= $query1->result();
		return $courses;
	}
	function fetchcoursefaculties(){
		$result=array();
		$webdb = $this->load->database('reliablewebdb', TRUE);
		$result['courses']=array();
		$result['faculties']=array();
		$query1=$webdb->query("SELECT  * FROM faculty_course_mst_t");
		$courses= $query1->result();
		$result['courses']=$courses;
		foreach ($courses as $course) {
			$cid=$course->Id;
			$query1=$webdb->query("SELECT  * FROM faculty_mst_t where CourseId='$cid'order by Sort_order");
			$result['faculties'][]= $query1->result();
		}
		return $result;
	}
	function fetchhometeam(){
		$webdb = $this->load->database('reliablewebdb', TRUE);
		$query1=$webdb->query("SELECT  * FROM faculty_mst_t order by Sort_order LIMIT 5");
		$result= $query1->result();
		return $result;
	}
	function fetchfacultydetails($id)
	{
		$result=array();
		$query=$this->db->query("select * from faculty_mst_t where Id='$id'");
		$faculty=$query->result();
		$result['faculty']=$faculty;
		return $result;
	}
}
?>