<?php
class Batch_Model extends CI_Model 
{

	function batch($name,$course)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query="insert into batch_mst_t(Name,Course_id,CreatedAt,UpdatedAt) values('$name','$course','$date','$date')";
			$this->db->query($query);
			$id = $this->db->insert_id();
		return $id;
	}
	function allcourses(){
		$result=array();
		$result['totalcourse']=0;
		$query=$this->db->query("select COUNT(Title) as totalcourse from course_mst_t");
		$amount=$query->result();
		if($amount!=""){
			$result['totalcourse']=$amount[0]->totalcourse;
		}
		return $result;
	}
	
	function totalbatch(){
		$result=array();
		$result['totalbatch']=0;
		$query=$this->db->query("select COUNT(Name) as totalbatch from batch_mst_t");
		$amount=$query->result();
		if($amount!=""){
			$result['totalbatch']=$amount[0]->totalbatch;
		}
		return $result;
	}
	function upcomingexam(){
		
		// $result=array();
		// $result['allexam']=array();
		
		// $query1=$this->db->query("SELECT  * FROM exams_mst_t where ('(exam_date >= now())')");
		// $allexam= $query1->result();
		// $result['allexam']=$allexam;
		// return $result;
	
		$result['exams']=array();
		$result['topics']=array();
		$date=date('Y-m-d');
		$query=$this->db->query("SELECT  exams_mst_t.*, course_mst_t.Title, course_section_mst_t.Title, batch_mst_t.Name FROM exams_mst_t join course_mst_t on course_mst_t.Id=exams_mst_t.course_id  join course_section_mst_t on course_section_mst_t.Id=exams_mst_t.subject_id  join batch_mst_t on batch_mst_t.Id=exams_mst_t.batch_id where exam_date>='$date'");
		$result['exams']=$query->result();
		foreach ($result['exams'] as $exam) {
			$topics = explode(",", $exam->topics_id);
			if(count($topics)>1){
		
				$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id IN ($exam->topics_id)");
				$result['topics'][]= $query1->result();		
			}
			else{
				
			$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$exam->topics_id'");
			$result['topics'][]= $query1->result();
			}
		}
		
		return $result;
		
	}
	function fetchbatches(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM batch_mst_t");
		$batches= $query1->result();
		return $batches;
	}
	function allacademicyears(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM academic_years");
		$batches= $query1->result();
		return $batches;
	}
	function getcoursebatches($course_id){
		$query1=$this->db->query("SELECT  * FROM batch_mst_t where Course_id='$course_id'");
		$batches= $query1->result();
		return $batches;
	}
	function fetchbatch($id)
	{
		$query1=$this->db->query("SELECT  batch_mst_t.*,course_mst_t.Price FROM batch_mst_t join course_mst_t on course_mst_t.Id=batch_mst_t.Course_id where batch_mst_t.Id='$id'");
		$batch= $query1->result();
		return $batch;
	}
	function batchcoursesseries($id){
		$result=array();
		$result['batch']=array();
		$result['bcourses']=array();
		$result['bseries']=array();
		$result['bsubjects']=array();
		$batch=$this->fetchbatch($id);
		if (count($batch)>0) {
			$cids=$batch[0]->Course_id;
			if ($cids!="") {
				$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cids'");
				$result['bcourses']= $query1->result();
				$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$cids'");
				$result['bsubjects']= $query1->result();
			}
		}
		$result['batch']=$batch;
		return $result;
	}
	function fetchbatchsstudents()
	{
		$result=array();
		$result['batches']=array();
		$result['students']=array();
		$result['courses']=array();
		$aid=$this->session->userdata('ayear');
		$query1=$this->db->query("SELECT  batch_mst_t.*, course_mst_t.Title FROM batch_mst_t join course_mst_t on course_mst_t.Id=batch_mst_t.Course_id");
		$batches= $query1->result();
		$result['batches']=$batches;
		foreach ($batches as $batch) {
			$bid=$batch->Id;
			$cid=$batch->Course_id;
			$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where BatchId='$bid' and AcademicId='$aid'");
			$result['students'][]= $query1->num_rows();
			$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
			$result['courses'][]= $query1->num_rows();
		}
		return $result;
	}
	function fetchbatchstudents($id)
	{
		$result=array();
		$aid=$this->session->userdata('ayear');
		$query=$this->db->query("select student_batch_mst_t.StudentId,student_mst_t.*, SUM(stud_fee_mst_t.Amount) as total_fees, SUM(stud_fee_mst_t.AmountPaid) as paid_fees, SUM(stud_fee_mst_t.AmountUnclear) as unclear_fees from student_mst_t INNER JOIN student_batch_mst_t ON student_mst_t.Id=student_batch_mst_t.StudentId left join stud_fee_mst_t on stud_fee_mst_t.StudentId=student_batch_mst_t.StudentId where student_batch_mst_t.BatchId='$id' and student_batch_mst_t.AcademicId='$aid' and student_mst_t.IsBlock='0' group by student_mst_t.Id");
		$result= $query->result();
		return $result;
	}
	function updatebatch($bid,$name,$course)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update batch_mst_t SET Name='$name',Course_id='$course',UpdatedAt='$date' where Id='".$bid."'");
	}
	function deletebatch($id)
	{
		$this->db->query("delete  from student_batch_mst_t where BatchId='".$id."'");	
		$this->db->query("delete  from batch_mst_t where Id='".$id."'");
	}
	function addcourse($bid,$cids)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$courses=implode(",", $cids);
		$query=$this->db->query("update batch_mst_t SET CourseId='$courses',UpdatedAt='$date' where Id='".$bid."'");
	}
	function activatebatch($bid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update batch_mst_t SET IsArchive='0',UpdatedAt='$date' where Id='".$bid."'");
	}
	function archivebatch($bid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update batch_mst_t SET IsArchive='1',UpdatedAt='$date' where Id='".$bid."'");
	}
	function addseries($bid,$sids)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$series=implode(",", $sids);
		$query=$this->db->query("update batch_mst_t SET SeriesId='$series',UpdatedAt='$date' where Id='".$bid."'");
	}

	
	function fetchtopic($id)
	{
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t  where SectionId='$id'");
		$batch= $query1->result();
		return $batch;
	}
}
?>