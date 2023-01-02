<?php
class Attendance_Model extends CI_Model 
{
	function fetch_studattendance($st_date,$ed_date,$student_id){

		// $data = array();
		// $data['attendance']=array();
		// $data['attendance_dates']=array();
		// $st_dateTS = strtotime($st_date);
		// $ed_dateTS = strtotime($ed_date);

		// for ($currentDateTS = $st_dateTS; $currentDateTS <= $ed_dateTS; $currentDateTS += (60 * 60 * 24)) {
		// 	// use date() and $currentDateTS to format the dates in between
		// 	$currentDateStr = date("Y-m-d",$currentDateTS);
		// 	$data['attendance_dates'][] = $currentDateStr;
		// 	$query1=$this->db->query("SELECT  * FROM student_attendance where student_id='$student_id' and attendance_date='$currentDateStr'");
		// 			$data['attendance'][]= $query1->result();
		// 	//print $currentDateStr.”<br />”;
		// }	
		// return $data;
		$data = array();
		$data['attendance']=array();
		$data['attendance_dates']=array();
		$st_dateTS = strtotime($st_date);
		$ed_dateTS = strtotime($ed_date);
		$query1=$this->db->query("SELECT  * FROM student_attendance where student_id='$student_id' and attendance_date>='$st_date' and attendance_date<='$ed_date'");
		$attendance= $query1->result();
		foreach ($attendance as $attend) {
			$data['attendance_dates'][] = $attend->attendance_date;
			if($attend->is_absent==1){
				$data['attendance'][]=array();
			}
			else{
				$data['attendance'][]=array($attend);
			}
		}
		return $data;
	}
	function fetch_studlectures($from_date,$to_date,$student_id)
	{
		$lectures=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$student_id'");
		$batches= $query1->result();
		$batch_ids=array_column($batches, 'BatchId');
		$batch_id = implode(",",$batch_ids);
		if(count($batch_ids)>1){
			$query1=$this->db->query("SELECT  lectures_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, student_attendance.*, faculty_mst_t.FirstName, faculty_mst_t.LastName  FROM lectures_mst_t join course_section_mst_t on course_section_mst_t.Id=lectures_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=lectures_mst_t.topic_id join faculty_mst_t on faculty_mst_t.Id=lectures_mst_t.teacher_id left join student_attendance on student_attendance.attendance_date=lectures_mst_t.lecture_date and student_attendance.student_id='$student_id' where lectures_mst_t.batch_id IN ($batch_id) and lectures_mst_t.is_publish='1'");
			$lectures= $query1->result();
		}
		else{
			$query1=$this->db->query("SELECT  lectures_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, student_attendance.*, faculty_mst_t.FirstName, faculty_mst_t.LastName FROM lectures_mst_t join course_section_mst_t on course_section_mst_t.Id=lectures_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=lectures_mst_t.topic_id join faculty_mst_t on faculty_mst_t.Id=lectures_mst_t.teacher_id left join student_attendance on student_attendance.attendance_date=lectures_mst_t.lecture_date and student_attendance.student_id='$student_id' where lectures_mst_t.batch_id = '$batch_id' and lectures_mst_t.is_publish='1'");
			$lectures= $query1->result();
		}
		return $lectures;
	}

	function fetch_studworksheet($from_date,$to_date,$student_id)
	{
		$lectures=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$student_id'");
		$batches= $query1->result();
		$batch_ids=array_column($batches, 'BatchId');
		$batch_id = implode(",",$batch_ids);
		if(count($batch_ids)>1){
			$query1=$this->db->query("SELECT worksheets_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, worksheet_submitted.* FROM `worksheets_mst_t` join course_section_mst_t on course_section_mst_t.Id=worksheets_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=worksheets_mst_t.topic_id left join worksheet_submitted on worksheet_submitted.worksheet_id=worksheets_mst_t.worksheet_id and worksheet_submitted.student_id='$student_id' where worksheets_mst_t.batch_id IN ($batch_id)");
			$lectures= $query1->result();
		}
		else{
			$query1=$this->db->query("SELECT worksheets_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, worksheet_submitted.* FROM `worksheets_mst_t` join course_section_mst_t on course_section_mst_t.Id=worksheets_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=worksheets_mst_t.topic_id left join worksheet_submitted on worksheet_submitted.worksheet_id=worksheets_mst_t.worksheet_id and worksheet_submitted.student_id='$student_id' where worksheets_mst_t.batch_id='$batch_id'");
			$lectures= $query1->result();
		}
		return $lectures;
	}
	function fetch_studassignments($from_date,$to_date,$student_id)
	{
		$lectures=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$student_id'");
		$batches= $query1->result();
		$batch_ids=array_column($batches, 'BatchId');
		$batch_id = implode(",",$batch_ids);
		if(count($batch_ids)>1){
			$query1=$this->db->query("SELECT assignments_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, assignment_submitted.* FROM assignments_mst_t join course_section_mst_t on course_section_mst_t.Id=assignments_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=assignments_mst_t.topic_id left join assignment_submitted on assignment_submitted.assignment_id=assignments_mst_t.id and assignment_submitted.student_id='$student_id' where assignments_mst_t.batch_id IN ($batch_id) and assignments_mst_t.is_publish='1'");
			$lectures= $query1->result();
		}
		else{
			$query1=$this->db->query("SELECT assignments_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, assignment_submitted.* FROM assignments_mst_t join course_section_mst_t on course_section_mst_t.Id=assignments_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=assignments_mst_t.topic_id left join assignment_submitted on assignment_submitted.assignment_id=assignments_mst_t.id and assignment_submitted.student_id='$student_id' where assignments_mst_t.batch_id='$batch_id' and assignments_mst_t.is_publish='1'");
			$lectures= $query1->result();
		}
		return $lectures;
	}
	function fetch_studqwritings($from_date,$to_date,$student_id)
	{
		$lectures=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$student_id'");
		$batches= $query1->result();
		$batch_ids=array_column($batches, 'BatchId');
		$batch_id = implode(",",$batch_ids);
		if(count($batch_ids)>1){
			$query1=$this->db->query("SELECT question_writing_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, qw_submitted.* FROM question_writing_mst_t join course_section_mst_t on course_section_mst_t.Id=question_writing_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=question_writing_mst_t.topic_id left join qw_submitted on qw_submitted.qw_id=question_writing_mst_t.question_id and qw_submitted.student_id='$student_id' where question_writing_mst_t.batch_id IN ($batch_id) and question_writing_mst_t.is_publish='1'");
			$lectures= $query1->result();
		}
		else{
			$query1=$this->db->query("SELECT question_writing_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, qw_submitted.* FROM question_writing_mst_t join course_section_mst_t on course_section_mst_t.Id=question_writing_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=question_writing_mst_t.topic_id left join qw_submitted on qw_submitted.qw_id=question_writing_mst_t.question_id and qw_submitted.student_id='$student_id' where question_writing_mst_t.batch_id='$batch_id' and question_writing_mst_t.is_publish='1'");
			$lectures= $query1->result();
		}
		return $lectures;
	}
	function fetch_studexams($from_date,$to_date,$student_id)
	{
		$lectures=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$student_id'");
		$batches= $query1->result();
		$batch_ids=array_column($batches, 'BatchId');
		$batch_id = implode(",",$batch_ids);
        
        //print_r($batch_id);
		if(count($batch_ids)>1){
			$query1=$this->db->query("SELECT exams_mst_t.*,CONCAT(exams_mst_t.Title, '(', exams_mst_t.exam_type, ')') as Title ,course_section_mst_t.Title as subject, exam_results.* FROM exams_mst_t join course_section_mst_t on course_section_mst_t.Id=exams_mst_t.subject_id left join exam_results on exam_results.exam_id=exams_mst_t.exam_id and exam_results.student_id='$student_id' where exams_mst_t.batch_id IN ($batch_id) and exams_mst_t.is_publish='1'");
			$lectures= $query1->result();
		}
		else{
			$query1=$this->db->query("SELECT exams_mst_t.*,CONCAT(exams_mst_t.Title, '(', exams_mst_t.exam_type, ')') as Title, course_section_mst_t.Title as subject, exam_results.* FROM exams_mst_t join course_section_mst_t on course_section_mst_t.Id=exams_mst_t.subject_id left join exam_results on exam_results.exam_id=exams_mst_t.exam_id and exam_results.student_id='$student_id' where exams_mst_t.batch_id='$batch_id' and exams_mst_t.is_publish='1'");
			$lectures= $query1->result();
		}
        $exams= array();
        $exams['exams']=$lectures;
        $exams['topics']=array();
        foreach ($lectures as $exam) {
                    $page=$exam->exam_id;
                    $etopics=array();
                    $topics= explode(",", $exam->topics_id);
                    if(count($topics)>1){
                        $query1=$this->db->query("SELECT Topic FROM course_section_topic_mst_t where Id IN ($exam->topics_id)");
                    $etopics= $query1->result();
                    }
                    else{
                            $query1=$this->db->query("SELECT Topic FROM course_section_topic_mst_t where Id='$exam->topics_id'");
                    $etopics= $query1->result();
                    }
            $exam->topics = $etopics;
            }
		return $exams;
	}
	function fetch_studcounsellings($from_date,$to_date,$student_id)
	{
		$lectures=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$student_id'");
		$batches= $query1->result();
		$batch_ids=array_column($batches, 'BatchId');
		$batch_id = implode(",",$batch_ids);
		$query1=$this->db->query("SELECT counselling_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, counselling_comments.* FROM counselling_mst_t left join course_section_mst_t on course_section_mst_t.Id=counselling_mst_t.subject_id left join course_section_topic_mst_t on course_section_topic_mst_t.Id=counselling_mst_t.topic_id left join counselling_comments on counselling_comments.counselling_id=counselling_mst_t.counselling_id and counselling_comments.student_id='$student_id' where counselling_mst_t.is_publish='1'");
		$lectures= $query1->result();
		return $lectures;
	}
	public function addattendance($sids,$attendance_date,$in_time,$out_time,$is_late,$is_absent,$remark)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$i=0;
		foreach ($sids as $sid) {
			$query="insert into student_attendance(student_id,in_time,out_time,is_late,is_absent,remark,attendance_date) values('$sid','$in_time[$i]','$out_time[$i]','$is_late[$i]','$is_absent[$i]','$remark[$i]','$attendance_date')";
			$this->db->query($query);
			$i++;
		}
	}
	public function update_attendance($id,$type,$attendance_date,$in_time,$out_time,$is_late,$is_absent,$remark)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$i=0;
		if($type=="add"){
			$query="insert into student_attendance(student_id,in_time,out_time,is_late,is_absent,remark,attendance_date) values('$id','$in_time','$out_time','$is_late','$is_absent','$remark','$attendance_date')";
			$this->db->query($query);
		}
		else{
			$query=$this->db->query("update student_attendance SET is_late='$is_late',in_time='$in_time',out_time='$out_time',is_absent='$is_absent',remark='$remark' where attendance_id='".$id."'");
		}
	}
	public function fetch_studfees($student_id)
	{
		$query1=$this->db->query("SELECT  * FROM stud_fee_mst_t where StudentId='$student_id' order by Id DESC");
		$result= $query1->result();
		return $result;
	}
	
	function upcomingassignment(){
	
		$result['allassign']=array();
		$result['topics']=array();
		$date=date('Y-m-d');
		$query=$this->db->query("SELECT assignments_mst_t.*, course_mst_t.Title, batch_mst_t.Name FROM assignments_mst_t join course_mst_t on course_mst_t.Id=assignments_mst_t.cource_id join batch_mst_t on batch_mst_t.Id=assignments_mst_t.batch_id where submission_date>='$date'");
		// $query=$this->db->query("SELECT * FROM assignments_mst_t where submission_date>='$date'");
		$result['allassign']=$query->result();
		foreach ($result['allassign'] as $assignment) {
			// $topics = explode(",", $exam->topics_id);
			$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$assignment->topic_id'");
			$result['topics'][]= $query1->result();
		}
		
		return $result;
		
	}
	function countstudnotifications($student_id)
	{
		$query1=$this->db->query("SELECT  * FROM studnotifications_mst_t where StudentId='$student_id' and IsView=0");
		$notifications= $query1->num_rows();
		return $notifications;
	}
	function fetchstudnotifications($student_id)
	{
		$query1=$this->db->query("SELECT  * FROM studnotifications_mst_t where StudentId='$student_id' and IsView=0");
		$notifications= $query1->result();
		//$query=$this->db->query("update studnotifications_mst_t SET IsView=1 where StudentId='".$student_id."'");
		return $notifications;
	}

	function deleteattendance($id)
	{
		$this->db->query("delete from student_attendance where attendance_id='$id'");
	}
	public function addattendanceapi($batch_id,$sids,$attendance_date,$in_time,$out_time,$is_late,$is_absent,$remark)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$i=0;
		foreach ($sids as $sid) {
			$query="insert into student_attendance(batch_id,student_id,in_time,out_time,is_late,is_absent,remark,attendance_date) values('$batch_id','$sid','$in_time[$i]','$out_time[$i]','$is_late[$i]','$is_absent[$i]','$remark[$i]','$attendance_date')";
			$this->db->query($query);
			$i++;
		}
	}
}
?>
