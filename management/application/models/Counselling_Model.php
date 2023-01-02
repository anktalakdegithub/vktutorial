<?php
class Counselling_Model extends CI_Model 
{
	public function fetch_counsellings($start_id,$course_id,$subject_id,$batch_id,$fromDate,$toDate)
	{
		$data='';
		if($start_id>0){
			$data="and counselling_id<'$start_id'";
		}
		 $subject='';
		 $course='';
		 $batch='';
		 $fdate='';
		 if ($subject_id!="") {
		 	$subject="and counselling_mst_t.subject_id='$subject_id'";
		 }
		 if ($course_id!="") {
		 	$course="and counselling_mst_t.course_id='$course_id'";
		 }
		 if ($batch_id!="") {
		 	$batch="and counselling_mst_t.batch_id='$batch_id'";
		 }
		 if ($fromDate!="" && $toDate!="") {
		 	$fdate="and counselling_mst_t.counselling_date>='$fromDate' and counselling_mst_t.counselling_date<='$toDate'";
		 }
		$aid=$this->session->userdata('ayear');
		$query1=$this->db->query("SELECT counselling_mst_t.*,course_section_mst_t.Title as subject,course_section_mst_t.Id as SubjectId,exams_mst_t.Title as topic, course_mst_t.Title as course_name, course_mst_t.Id as CourseId, batch_mst_t.Id as batch_id, batch_mst_t.Name as batch_name, student_mst_t.FirstName, student_mst_t.LastName  FROM counselling_mst_t join course_section_mst_t on course_section_mst_t.Id=counselling_mst_t.subject_id join exams_mst_t on exams_mst_t.exam_id=counselling_mst_t.exam_id join course_mst_t on course_mst_t.Id=counselling_mst_t.course_id join batch_mst_t on batch_mst_t.Id=counselling_mst_t.batch_id join student_mst_t on student_mst_t.Id=counselling_mst_t.student_id where counselling_mst_t.academic_id='$aid' $data   $subject $course $batch $fdate order by counselling_id DESC limit 10");
		$tests= $query1->result();
		return $tests;
	}

	function add_counselling($cid,$sid,$exam_id,$bid,$stud_id,$title,$date,$stime,$etime){
		$title=str_replace("'","\'",$title);
		date_default_timezone_set('Asia/Kolkata');
		$cdate=date("Y-m-d h:i:sa");
		$aid=$this->session->userdata('ayear');
		$query="insert into counselling_mst_t(course_id,subject_id,exam_id,batch_id,student_id,academic_id,counselling_title,start_time,end_time,counselling_date,created_at,updated_at) values('$cid','$sid','$exam_id','$bid','$stud_id','$aid','$title','$stime','$etime','$date','$cdate','$cdate')";
		$this->db->query($query);
		$id = $this->db->insert_id();
	}
	function add_counselling_worksheet($counselling_id,$comment,$worksheet,$issubmitted){
		date_default_timezone_set('Asia/Kolkata');
		$cdate=date("Y-m-d h:i:sa");
		$query=$this->db->query("update counselling_mst_t SET comment='$comment',is_submitted='$issubmitted',student_worksheet='$worksheet' where counselling_id='".$counselling_id."'");
	}

	function update_counselling($counselling_id,$cid,$sid,$exam_id,$bid,$stud_id,$title,$date,$stime,$etime){
		$title=str_replace("'","\'",$title);
		date_default_timezone_set('Asia/Kolkata');
		$cdate=date("Y-m-d h:i:sa");
		
		$query=$this->db->query("update counselling_mst_t SET course_id='$cid',subject_id='$sid',exam_id='$exam_id',batch_id='$bid',student_id='$stud_id',counselling_title='$title',start_time='$stime',end_time='$etime',counselling_date='$date',updated_at='$cdate' where counselling_id='".$counselling_id."'");
		
	}
	public function get_counselling($counselling_id)
	{
		$query1=$this->db->query("SELECT counselling_mst_t.* from counselling_mst_t where counselling_id='$counselling_id'");
		$tests= $query1->result();
		return $tests;
		
		// $query1=$this->db->query("SELECT  * FROM course_category_mst_t");
		// $result= $query1->result();
		// return $result;
	}
	public function deletecounselling($counselling_id)
	{
		$this->db->query("DELETE FROM counselling_mst_t where counselling_id='$counselling_id'");
	}
	public function publishcounselling($counselling_id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update counselling_mst_t SET is_publish='1',updated_at='$date' where counselling_id ='".$counselling_id."'");
	}
	public function unpublishcounselling($counselling_id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update counselling_mst_t SET is_publish='0',updated_at='$date' where counselling_id ='".$counselling_id."'");
	}
}
?>