<?php
class Dashboard_Model extends CI_Model 
{
	public function upcominglectures(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate = date("Y-m-d", strtotime($date. ' + 2 days'));
		$query1=$this->db->query("SELECT  lectures_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic, faculty_mst_t.FirstName, faculty_mst_t.LastName FROM lectures_mst_t join course_section_mst_t on course_section_mst_t.Id=lectures_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=lectures_mst_t.topic_id join faculty_mst_t on faculty_mst_t.Id=lectures_mst_t.teacher_id where lectures_mst_t.lecture_date>='$date' and lectures_mst_t.lecture_date<='$ldate' and  lectures_mst_t.is_publish='1'");
		$lectures= $query1->result();
		return $lectures;
	}
	public function upcomingworksheets(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate = date("Y-m-d", strtotime($date. ' + 2 days'));
		$query1=$this->db->query("SELECT  worksheets_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic FROM worksheets_mst_t join course_section_mst_t on course_section_mst_t.Id=worksheets_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=worksheets_mst_t.topic_id where worksheets_mst_t.submission_date>='$date' and worksheets_mst_t.submission_date<='$ldate' and  worksheets_mst_t.is_publish='1'");
		$worksheets= $query1->result();
		return $worksheets;
	}
	public function upcomingqws(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate = date("Y-m-d", strtotime($date. ' + 2 days'));
		$query1=$this->db->query("SELECT  question_writing_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic FROM question_writing_mst_t join course_section_mst_t on course_section_mst_t.Id=question_writing_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=question_writing_mst_t.topic_id where question_writing_mst_t.qw_date>='$date' and question_writing_mst_t.qw_date<='$ldate' and  question_writing_mst_t.is_publish='1'");
		$qws= $query1->result();
		return $qws;
	}
	public function upcomingassignments(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate = date("Y-m-d", strtotime($date. ' + 2 days'));
		$query1=$this->db->query("SELECT  assignments_mst_t.*,course_section_mst_t.Title as subject,course_section_topic_mst_t.Topic as topic FROM assignments_mst_t join course_section_mst_t on course_section_mst_t.Id=assignments_mst_t.subject_id join course_section_topic_mst_t on course_section_topic_mst_t.Id=assignments_mst_t.topic_id where assignments_mst_t.submission_date>='$date' and assignments_mst_t.submission_date<='$ldate' and  assignments_mst_t.is_publish='1'");
		$assignments= $query1->result();
		return $assignments;
	}
	public function upcomingexams(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate = date("Y-m-d", strtotime($date. ' + 2 days'));
		$query1=$this->db->query("SELECT  exams_mst_t.*,course_section_mst_t.Title as subject FROM exams_mst_t join course_section_mst_t on course_section_mst_t.Id=exams_mst_t.subject_id where exams_mst_t.exam_date>='$date' and exams_mst_t.exam_date<='$ldate' and  exams_mst_t.is_publish='1'");
		$exams= $query1->result();
		return $exams;
	}
	public function upcomingfees(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate = date("Y-m-d", strtotime($date. ' + 2 days'));
		$query1=$this->db->query("SELECT  stud_fee_mst_t.*, student_mst_t.FirstName, student_mst_t.LastName, student_mst_t.Phone FROM stud_fee_mst_t join student_mst_t on student_mst_t.Id=stud_fee_mst_t.StudentId where stud_fee_mst_t.PaymentDate>='$date' and stud_fee_mst_t.PaymentDate<='$ldate' and PaymentStatus='Unpaid'");
		$lectures= $query1->result();
		return $lectures;
	}
	public function overduefees(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$ldate = date("Y-m-d", strtotime($date. ' + 2 days'));
		$query1=$this->db->query("SELECT  stud_fee_mst_t.*, student_mst_t.FirstName, student_mst_t.LastName, student_mst_t.Phone FROM stud_fee_mst_t join student_mst_t on student_mst_t.Id=stud_fee_mst_t.StudentId where stud_fee_mst_t.PaymentDate<'$date' and PaymentStatus='Unpaid'");
		$lectures= $query1->result();
		return $lectures;
	}
}
?>