<?php
class Lecture_Model extends CI_Model 
{

	function todayslecture(){
	
		$result['tolecture']=array();
		$result['topics']=array();
		$date=date('Y-m-d');
		$query=$this->db->query("SELECT lectures_mst_t.*, course_mst_t.Title, batch_mst_t.Name FROM lectures_mst_t join course_mst_t on course_mst_t.Id=lectures_mst_t.course_id join batch_mst_t on batch_mst_t.Id=lectures_mst_t.batch_id where lecture_date='$date'");
		// $query=$this->db->query("SELECT * FROM assignments_mst_t where submission_date>='$date'");
		$result['tolecture']=$query->result();
		foreach ($result['tolecture'] as $lecture) {
			// $topics = explode(",", $exam->topics_id);
			$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$lecture->topic_id'");
			$result['topics'][]= $query1->result();
		}
		
		return $result;
		
	}
	function addlecture($title,$desc,$batches,$faculties,$lectid,$pass,$ldate,$stime,$etime,$surl,$thumbnail)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query="insert into lecture_mst_t(BatchIds,Title,Description,Lecture_date,Start_time,End_time,Faculty,Meeting_url,Meeting_id,Password,Thumbnail,CreatedAt,UpdatedAt) values('$batches','$title','$desc','$ldate','$stime','$etime','$faculties','$surl','$lectid','$pass','$thumbnail','$date','$date')";
			$this->db->query($query);
			$id = $this->db->insert_id();
		return $id;
	}
	function addattendance($lid,$studid)
	{
		$query1=$this->db->query("SELECT  * FROM student_attendance_mst_t where StudentId='$studid' and LectureId='$lid'");
		$attendance= $query1->num_rows();
		if($attendance==0){
			date_default_timezone_set('Asia/Kolkata');
			$date=date("Y-m-d h:i:sa");	
			$query="insert into student_attendance_mst_t(StudentId,LectureId,CreatedAt,UpdatedAt) values('$studid','$lid','$date','$date')";
			$this->db->query($query);
		}
	}
	function islecturestarted($lid,$studid)
	{
		date_default_timezone_set('Asia/Kolkata');
			$date=date("Y-m-d h:i:sa");	
		$query1=$this->db->query("select * from lecture_mst_t where Id='$lid'");
		$lecture= $query1->result();
		if($lecture[0]->IsLectureStarted==1){
			if($lecture[0]->TopicId>0){
				$query="insert into student_attendance_mst_t(StudentId,LectureId,CreatedAt,UpdatedAt) values('$studid','$lid','$date','$date')";
				$this->db->query($query);
			}
			else{
				$this->db->query("delete  from student_attendance_mst_t where LectureId='".$lid."' and StudentId='$studid'");
			}
		}
		return $lecture;
	}
	function lecturedetails($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$result=array();
		$query=$this->db->query("select * from lecture_mst_t where Id='$id'");
		$timetable=$query->result();
		$teachers=array();
		$batches=explode(",",$timetable[0]->BatchIds);
		$faculties=explode(",",$timetable[0]->Faculty);
		$result['lecture']=$timetable[0];
		$result['batches']=array();
		$result['faculties']=array();
		$result['absents']=array();
		$result['students']=array();
		foreach ($faculties as $fid) {
			$query=$this->db->query("select * from faculty_mst_t where Id='$fid'");
			$faculty=$query->result();
			if(count($faculty)>0){
				$result['faculties'][]=$faculty[0];
			}
		}
		foreach ($batches as $bid) {
			$query=$this->db->query("select * from batch_mst_t where Id='$bid'");
			$batch=$query->result();
			if(count($batch)>0){
				$result['batches'][]=$batch[0];
			}
		$query=$this->db->query("select * from student_batch_mst_t where BatchId='$bid'");
		$allstudents=$query->result();
		foreach ($allstudents as $astudent) {
			$studid=$astudent->StudentId;
			$query=$this->db->query("select * from student_mst_t where Id='$studid'");
			$student= $query->result();
			if(count($student)>0){
				$result['students'][]=$student[0];
			}
		}
	}
		$query=$this->db->query("select * from student_attendance_mst_t where LectureId='$id'");
		$absents=$query->result();
		if (count($absents)>0) {
			foreach ($absents as $absent) {
				$studid=$absent->StudentId;
				
				$result['absents'][]=$studid;
			}
		}
			return $result;

}
	function count_past_lectures()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");	
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Lecture_date<'$date'");
		$lectures= $query1->num_rows();
		return $lectures;
	}
	function startlecture($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Id='$id'");
		$lecture= $query1->result();
		$batches=array();
		if(count($lecture)>0){
			if($lecture[0]->IsLectureStarted==0){
				if($lecture[0]->BatchIds!=""){
					$batches=explode(",", $lecture[0]->BatchIds);
					foreach ($batches as $bid) {
						$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where BatchId='$bid'");
						$students= $query1->result();
						foreach ($students as $stud) {
							$sid=$stud->StudentId;
							$query="insert into student_attendance_mst_t(StudentId,LectureId,CreatedAt,UpdatedAt) values('$sid','$id','$date','$date')";
							$this->db->query($query);
						}
					}
				}
			}
		}
		$query=$this->db->query("update lecture_mst_t SET IsAttendance='1',IsLectureStarted='1' where Id='".$id."'");
		return $lecture;
	}
	function fetch_past_lectures($startid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$month=date("m");
		$year=date("Y");	
		$start="";
		if($startid>0)
		{
			$start= " Id<'$startid'";
		}
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where TopicId='0' and MONTH(Lecture_date)='$month' and YEAR(Lecture_date)='$year' $start Order by Id DESC LIMIT 10");
		$lectures= $query1->result();
		$result['lectures']=array();
		$result['batches']=array();
		$result['faculties']=array();
		foreach ($lectures as $lect) {
			$bids=explode(",", $lect->BatchIds);
			$result['lectures'][]=$lect;
			$batches=array();
			$faculties=array();
			foreach ($bids as $bid) {
				$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
				$batches[]= $query1->result();
			}
			$fids=explode(",", $lect->Faculty);
			foreach ($fids as $fid) {
				$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
				$faculties[]= $query1->result();
			}
			$result['faculties'][]=$faculties;
			$result['batches'][]=$batches;
		}
		return $result;
	}
	function filter_past_lectures($bid,$month,$year)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where TopicId='0' and  MONTH(Lecture_date)='$month' and YEAR(Lecture_date)='$year'");
		$lectures= $query1->result();
		$result['lectures']=array();
		$result['batches']=array();
		$result['faculties']=array();
		foreach ($lectures as $lect) {
			$bids=explode(",", $lect->BatchIds);
			if ($bid!="") {
				if(in_array($bid, $bids))
				{
					$result['lectures'][]=$lect;
					$batches=array();
					$faculties=array();
					foreach ($bids as $bid) {
						$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
						$batches[]= $query1->result();
					}
					$fids=explode(",", $lect->Faculty);
					foreach ($fids as $fid) {
						$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
						$faculties[]= $query1->result();
					}
					$result['faculties'][]=$faculties;
					$result['batches'][]=$batches;
				}
			}
			else{
				$result['lectures'][]=$lect;
				$batches=array();
				$faculties=array();
				foreach ($bids as $bid) {
					$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
					$batches[]= $query1->result();
				}
				$fids=explode(",", $lect->Faculty);
				foreach ($fids as $fid) {
					$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
					$faculties[]= $query1->result();
				}
				$result['faculties'][]=$faculties;
				$result['batches'][]=$batches;
			}
		}
		return $result;
	}
	function fetchbatchlectures($bid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where TopicId='0' and BatchIds LIKE '%$bid%' order by Id desc");
		$lectures= $query1->result();
		$result['lectures']=array();
		$result['batches']=array();
		$result['faculties']=array();
		foreach ($lectures as $lect) {
			$bids=explode(",", $lect->BatchIds);
			if ($bid!="") {
				if(in_array($bid, $bids))
				{
					$result['lectures'][]=$lect;
					$batches=array();
					$faculties=array();
					foreach ($bids as $bid) {
						$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
						$batches[]= $query1->result();
					}
					$fids=explode(",", $lect->Faculty);
					foreach ($fids as $fid) {
						$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
						$faculties[]= $query1->result();
					}
					$result['faculties'][]=$faculties;
					$result['batches'][]=$batches;
				}
			}
			else{
				$result['lectures'][]=$lect;
				$batches=array();
				$faculties=array();
				foreach ($bids as $bid) {
					$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
					$batches[]= $query1->result();
				}
				$fids=explode(",", $lect->Faculty);
				foreach ($fids as $fid) {
					$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
					$faculties[]= $query1->result();
				}
				$result['faculties'][]=$faculties;
				$result['batches'][]=$batches;
			}
		}
		return $result;
	}
	function todaysstudlectures($studid){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$studid'");
		$batches= $query1->result();
		$sbids=array();
		foreach ($batches as $batch) {
			$sbids[]=$batch->BatchId;
		}
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$result=array();
		$query1=$this->db->query("SELECT  *, DATE_FORMAT(Lecture_date,'%d/%M/%Y') AS Lecturedate,DATE_FORMAT(Start_time, '%H:%i') as starttime,DATE_FORMAT(End_time, '%H:%i') as endtime  FROM lecture_mst_t where Lecture_date>='$date' and  SectionId='0' Order by Lecture_date Limit 5");
		$lectures= $query1->result();
		$result['faculties']=array();
		$result['lectures']=array();
		foreach ($lectures as $lect) {
			$bids=explode(",", $lect->BatchIds);
			$sbatch=array_intersect($sbids, $bids);
			if(count($sbatch)>0){
			$faculties=array();
			$fids=explode(",", $lect->Faculty);
			foreach ($fids as $fid) {
				$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
				$faculty= $query1->result();
				if(count($faculty)>0){
					$faculties[]=$faculty[0];
				}
			}
			$result['lectures'][]=$lect;
			$result['faculties'][]=$faculties;
			}
			
		}
		
		return $result;
	}
	function todaysabsents()
	{
		$result=array();
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Lecture_date='$date' and  SectionId='0'");
		$lectures= $query1->result();
		$result['lectures']=$lectures;
		$result['students']=array();
		foreach ($lectures as $lect) {
			$query1=$this->db->query("SELECT  * FROM student_attendance_mst_t where LectureId='$lect->Id'");
			$attendance= $query1->result();
			$astudents=array();
			foreach ($attendance as $attend) {
				$query1=$this->db->query("SELECT  * FROM student_mst_t where Id='$attend->StudentId'");
				$student= $query1->result();
				if(count($student)>0)
				{
					$astudents[]=$student;
				}
			}
			$result['students'][]=$astudents;
		}
		return $result;
	}
	function fetchlecture($lid){
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Id='$lid'");
		$lecture= $query1->result();
		return $lecture;
	}
	function todayslectures(){
		$result=array();
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Lecture_date='$date' and  SectionId='0'");
		$lectures= $query1->result();
		$result['lectures']=$lectures;
		$result['batches']=array();
		$result['faculties']=array();
		foreach ($lectures as $lect) {
			$bids=explode(",", $lect->BatchIds);
			$batches=array();
			$faculties=array();
			foreach ($bids as $bid) {
				$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
				$batches[]= $query1->result();
			}
			$fids=explode(",", $lect->Faculty);
			foreach ($fids as $fid) {
				$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
				$faculties[]= $query1->result();
			}
			$result['faculties'][]=$faculties;
			$result['batches'][]=$batches;
		}
		return $result;
	}
	function getlecture($lid)
	{
		$lecture=array();
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Id='$lid'");
		$lecture= $query1->result();
		return $lecture;
	}
	function fetchstudlectures($studid){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$studid'");
		$batches= $query1->result();
		$sbids=array();
		foreach ($batches as $batch) {
			$sbids[]=$batch->BatchId;
		}
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$result=array();
		$query1=$this->db->query("SELECT  *, DATE_FORMAT(Lecture_date,'%d/%M/%Y') AS Lecturedate,DATE_FORMAT(Start_time, '%H:%i') as starttime,DATE_FORMAT(End_time, '%H:%i') as endtime FROM lecture_mst_t where Lecture_date>='$date' and  SectionId='0'");
		$lectures= $query1->result();
		$result['faculties']=array();
		$result['lectures']=array();
		foreach ($lectures as $lect) {
			$bids=explode(",", $lect->BatchIds);
			$sbatch=array_intersect($sbids, $bids);
			if(count($sbatch)>0){
				$faculties=array();
				$fids=explode(",", $lect->Faculty);
				foreach ($fids as $fid) {
					$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
					$faculties[]= $query1->result();
				}
				$result['lectures'][]=$lect;
				$result['faculties'][]=$faculties;
			}
			else{
				if (in_array("0", $bids)) {
					$faculties=array();
				$fids=explode(",", $lect->Faculty);
				foreach ($fids as $fid) {
					$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
					$faculties[]= $query1->result();
				}
				$result['lectures'][]=$lect;
				$result['faculties'][]=$faculties;
				}
			}
			
		}
		return $result;
	}
	function fetchstudentattendance($sid){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$sid'");
		$batches= $query1->result();
		$sbids=array();
		foreach ($batches as $batch) {
			$sbids[]=$batch->BatchId;
		}
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate=date('Y-m-d',strtotime('-1 year'));
		$result=array();
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Lecture_date>'$ldate' and IsAttendance='1'");
		$lectures= $query1->result();
		$result['batches']=array();
		$result['lectures']=array();
		$result['attendance']=array();
		foreach ($lectures as $lect) {
			$batch=$lect->BatchIds;
			$bids=explode(",", $lect->BatchIds);
			$sbatch=array_intersect($sbids, $bids);
			if(count($sbatch)>0){
			$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id IN ($batch)");
			$result['batches'][]= $query1->result();
			$query1=$this->db->query("SELECT  * FROM student_attendance_mst_t where StudentId='$sid' and LectureId='$lect->Id'");
			$attendance= $query1->result();
			if(count($attendance)>0){
				$result['attendance'][]=$lect->Id;
			}
			$result['lectures'][]=$lect;
			}
		}
		return $result;
	}
	function upcominglectures()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate = date("Y-m-d", strtotime($date. ' + 2 days'));
		$query1=$this->db->query("SELECT  lectures_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, faculty_mst_t.FirstName, faculty_mst_t.LastName  FROM lectures_mst_t join course_section_mst_t on course_section_mst_t.Id=lectures_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=lectures_mst_t.topic_id join faculty_mst_t on faculty_mst_t.Id=lectures_mst_t.teacher_id where lectures_mst_t.is_publish='1'");
		//lectures_mst_t.lecture_date>='$date' and lectures_mst_t.lecture_date<='$ldate' and 
		$lectures= $query1->result();
		return $lectures;
	}
	function upcomingteacherlectures($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$result=array();
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Lecture_date>='$date' and  SectionId='0'");
		$lectures= $query1->result();
		$result['batches']=array();
		$result['faculties']=array();
		$result['lectures']=array();
		foreach ($lectures as $lect) {
			$fids=explode(",", $lect->Faculty);
			if(in_array($id, $fids)){
			$result['lectures'][]=$lect;
			$bids=explode(",", $lect->BatchIds);
			$batches=array();
			$faculties=array();
			foreach ($bids as $bid) {
				$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
				$batches[]= $query1->result();
			}
			foreach ($fids as $fid) {
				$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
				$faculties[]= $query1->result();
			}
			$result['faculties'][]=$faculties;
			$result['batches'][]=$batches;
		}	
		}
		return $result;
	}
	function fetchfacultylectures($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate=date("Y-m-d", strtotime("-1 year"));
		$result=array();
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Lecture_date<'$date' and Lecture_date>'$ldate' and  SectionId='0'");
		$lectures= $query1->result();
		$result['batches']=array();
		$result['lectures']=array();
		foreach ($lectures as $lect) {
			$fids=explode(",", $lect->Faculty);
			if(in_array($id, $fids)){
			$result['lectures'][]=$lect;
			$bids=explode(",", $lect->BatchIds);
			$batches=array();
			$faculties=array();
			foreach ($bids as $bid) {
				$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
				$batches[]= $query1->result();
			}
			$result['batches'][]=$batches;
		}	
		}
		return $result;
	}
	function faculty_month_lectures($id,$month,$year){
		$result=array();
		$query1=$this->db->query("SELECT  * FROM lecture_mst_t where YEAR(Lecture_date)='$year' and MONTH(Lecture_date)='$month' and SectionId='0'");
		$lectures= $query1->result();
		$result['batches']=array();
		$result['lectures']=array();
		foreach ($lectures as $lect) {
			$fids=explode(",", $lect->Faculty);
			if(in_array($id, $fids)){
			$result['lectures'][]=$lect;
			$bids=explode(",", $lect->BatchIds);
			$batches=array();
			$faculties=array();
			foreach ($bids as $bid) {
				$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
				$batches[]= $query1->result();
			}
			$result['batches'][]=$batches;
		}	
		}
		return $result;
	}
	public function updatelecture($id,$title,$desc,$batches,$faculties,$lectid,$pass,$ldate,$stime,$etime,$surl,$thumbnail)
	{
		$image='';
		if($thumbnail!="")
		{
			$image=", Thumbnail='$thumbnail'";
		}
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update lecture_mst_t SET Title='$title',Description='$desc',BatchIds='$batches',Faculty='$faculties',Meeting_url='$surl',Meeting_id='$lectid',Password='$pass',Lecture_date='$ldate',Start_time='$stime',End_time='$etime',UpdatedAt='$date' $image where Id='".$id."'");
	}
	function deletelecture($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$this->db->query("delete  from lecture_mst_t where Id='".$id."'");
	}
}
?>