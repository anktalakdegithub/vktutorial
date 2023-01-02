<?php
class Test_Model extends CI_Model 
{
	public function fetch_exams($start_id,$course_id,$subject_id,$topic_id,$batch_id,$fromDate,$toDate)
	{
		$data='';
		if($start_id>0){
			$data="Where exam_id<'$start_id'";
		}
		else{
			$data="Where exam_id>'0'";
		}
		 $subject='';
		 $course='';
		 $batch='';
		 $fdate='';
		 if ($subject_id!="") {
		 	$subject="and exams_mst_t.subject_id='$subject_id'";
		 }
		 if ($course_id!="") {
		 	$course="and exams_mst_t.course_id='$course_id'";
		 }
		 if ($batch_id!="") {
		 	$batch="and exams_mst_t.batch_id='$batch_id'";
		 }
		 if ($fromDate!="" && $toDate!="") {
		 	$fdate="and exams_mst_t.exam_date>='$fromDate' and exams_mst_t.exam_date<='$toDate'";
		 }
		$aid=$this->session->userdata('ayear');
		 $sql="SELECT exams_mst_t.*,course_section_mst_t.Title as subject,course_section_mst_t.Id as SubjectId, course_mst_t.Title as course_name, course_mst_t.Id as CourseId, batch_mst_t.Id as batch_id, batch_mst_t.Name as batch_name  FROM exams_mst_t join course_section_mst_t on course_section_mst_t.Id=exams_mst_t.subject_id join course_mst_t on course_mst_t.Id=exams_mst_t.course_id join batch_mst_t on batch_mst_t.Id=exams_mst_t.batch_id $data  and exams_mst_t.academic_id='$aid' $subject $course $batch $fdate order by exam_id DESC limit 10";
		// print_r($sql);
		$query1=$this->db->query($sql);
		$tests= $query1->result();
		return $tests;
	}
	public function get_exams($exam_id)
	{
		// $data='';
		// if($start_id>0){
			$result=array();
			$data="Where exams_mst_t.exam_id='$exam_id'";
		// }
		$query1=$this->db->query("SELECT exams_mst_t.*,course_section_mst_t.Title as subject,course_section_mst_t.Id as SubjectId,course_section_topic_mst_t.Topic as topic,course_section_topic_mst_t.Id as TopicId, course_mst_t.Title as course_name, course_mst_t.Id as CourseId, batch_mst_t.Id as batch_id, batch_mst_t.Name as batch_name  FROM exams_mst_t join course_section_mst_t on course_section_mst_t.Id=exams_mst_t.subject_id left join course_section_topic_mst_t on course_section_topic_mst_t.Id=exams_mst_t.topics_id join course_mst_t on course_mst_t.Id=exams_mst_t.course_id join batch_mst_t on batch_mst_t.Id=exams_mst_t.batch_id $data ");
		$tests= $query1->result();
		return $tests;

		
		// $query1=$this->db->query("SELECT  * FROM course_category_mst_t");
		// $result= $query1->result();
		// return $result;
	}
	public function filter_exams($course_id,$subject_id,$topic_id,$batch_id,$fromDate,$toDate)
	{
		 $subject='';
		 $course='';
		 $batch='';
		 $fdate='';
		 if ($subject_id!="") {
		 	$subject="and exams_mst_t.subject_id='$subject_id'";
		 }
		 if ($course_id!="") {
		 	$course="and exams_mst_t.course_id='$course_id'";
		 }
		 if ($batch_id!="") {
		 	$batch="and exams_mst_t.batch_id='$batch_id'";
		 }
		 if ($fromDate!="" && $toDate!="") {
		 	$fdate="and exams_mst_t.exam_date>='$fromDate' and exams_mst_t.exam_date<='$toDate'";
		 }
		// if($start_id>0){
		
		$query1=$this->db->query("SELECT exams_mst_t.*,course_section_mst_t.Title as subject,course_section_mst_t.Id as SubjectId,course_section_topic_mst_t.Topic as topic,course_section_topic_mst_t.Id as TopicId, course_mst_t.Title as course_name, course_mst_t.Id as CourseId, batch_mst_t.Id as batch_id, batch_mst_t.Name as batch_name  FROM exams_mst_t join course_section_mst_t on course_section_mst_t.Id=exams_mst_t.subject_id left join course_section_topic_mst_t on course_section_topic_mst_t.Id=exams_mst_t.topic_id join course_mst_t on course_mst_t.Id=exams_mst_t.course_id join batch_mst_t on batch_mst_t.Id=exams_mst_t.batch_id join exam_topic_mst_t on exam_topic_mst_t.exam_id=exams_mst_t.exam_id where exams_mst_t.exam_id>0 $subject $course $batch $fdate");
		$tests= $query1->result();
		return $tests;

		
		// $query1=$this->db->query("SELECT  * FROM course_category_mst_t");
		// $result= $query1->result();
		// return $result;
	}
}
?>