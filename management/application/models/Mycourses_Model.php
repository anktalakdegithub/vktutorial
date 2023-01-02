<?php
class Mycourses_Model extends CI_Model 
{
	function addviewcourse($cid,$image,$video,$yurl)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update course_mst_t SET Cover_image='$image',Promotional_video='$video',Youtube_url='$yurl',UpdatedAt='$date' where Id='".$cid."'");
	}
	function countcourseadmissions()
	{
		$query1=$this->db->query("SELECT  * FROM student_admission_mst_t");
		$count= $query1->num_rows();
		return $count;
	}
	public function fetchconcept($id)
	{
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$id'");
		$concept= $query1->result();
		return $concept;
	}

	public function fetchallearnings($start)
	{
		$query1=$this->db->query("SELECT  student_cart_mst_t.*,student_mst_t.FirstName,student_mst_t.LastName,course_mst_t.Title FROM student_cart_mst_t inner join course_mst_t on course_mst_t.Id=student_cart_mst_t.CourseId inner join student_mst_t on student_mst_t.Id=student_cart_mst_t.StudentId where student_cart_mst_t.CartId>'$start' and student_cart_mst_t.AdmissionId>0 ORDER BY student_cart_mst_t.CreatedAt DESC limit 10");
		$admissions= $query1->result();
		return $admissions;
	}
	function addpayment($cid,$videos_price,$ppts_price,$tests_price,$overall_price)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$columns='';
		/*if($type=="overall")
		{
			$columns=",IsPaid='$ctype',Price='$price'";
		}
		else if($type=="videos")
		{
			$columns=",IsVideoPaid='$ctype',VideosPrice='$price'";
		}
		else if($type=="ppts")
		{
			$columns=",IsPptPaid='$ctype',PptsPrice='$price'";
		}
		else if($type=="tests")
		{
			$columns=",IsTestPaid='$ctype',TestsPrice='$price'";
		}
		else if($type=="two")
		{
			$columns=",TwoPrice='$price'";
		}
		else if($type=="topic")
		{
			$columns=",TopicPrice='$price'";
		}
		else if($type=="section")
		{
			$columns=",SectionPrice='$price'";
		}
		//print_r($columns);*/
		$query=$this->db->query("update course_mst_t SET VideosPrice='$videos_price',TestsPrice='$tests_price',PptsPrice='$ppts_price',Price='$overall_price', UpdatedAt='$date' where Id='".$cid."'");
	}
	function fetchncoursestudents($cid,$startid,$limit)
	{
		$result=array();
		$result['students']=array();
		$result['batches']=array();
		if($startid>0){
			$query1=$this->db->query("SELECT  * FROM student_mst_t where Id<'$startid' ORDER BY ID DESC limit $limit");
		}
		else{
			$query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit $limit");
		}
		$students= $query1->result();
		foreach ($students as $row) {
			$studid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM student_admission_mst_t where Student_id='$studid' and Course_id='$cid'");
			$cstudent= $query1->result();
			if(count($cstudent)==0){
				$result['students'][]=$row;
			}
		}
		
		return $result;
	}
	public function fetch_offline_courses()
	{
		$query1=$this->db->query("SELECT  * FROM offline_course_mst_t");
		$courses= $query1->result();
		return $courses;
	}
	public function getcartdata($studid)
	{
		$query1=$this->db->query("SELECT  * FROM student_cart_mst_t where StudentId='$studid' and AdmissionId=0");
		$carts= $query1->result();
		return $carts;
	}

	public function totalcartamount($studid)
	{
		$query1=$this->db->query("SELECT  SUM(Price) as total FROM student_cart_mst_t where StudentId='$studid' and AdmissionId=0");
		$carts= $query1->result();
		return $carts;
	}
	public function update_offline_course($id,$title,$file,$batch)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$image="";
		if($file!=""){
			$image=", Image='$file'";
		}
		$query=$this->db->query("update offline_course_mst_t SET Name='$title',Batch_details='$batch',UpdatedAt='$date' $image where Id='".$id."'");
	}
	
	public function fetchlecture($tid)
	{
		$result=array();
		$result['videos']=array();
		$result['topic']=array();
		$result['concepts']=array();
		$result['tests']=array();
		$result['ltests']=array();
		$result['questions']=array();
		$result['fquestions']=array();
		$result['fanswers']=array();
		$result['live']=array();
		$result['fquestions']=array();
		$result['lquestions']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$tid'");
		$result['topic']= $query1->result();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='$tid' and Type='video'");
		$result['videos']= $query1->result();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='$tid' and Type='ppt'");
		$result['ppts']= $query1->result();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='$tid' and Type='study'");
		$result['studies']= $query1->result();
		$query1=$this->db->query("SELECT  * FROM mcq_exam_mst_t where TopicId='$tid' and Type='stest'");
		$tests= $query1->result();
		$result['tests']=$tests;
		$questions=array();
		foreach ($tests as $test) {
			$eid=$test->Id;
			$query1=$this->db->query("SELECT  * FROM mcq_questions_mst_t where ExamId='$eid'");
			$questions[]= $query1->num_rows();
		}
		$result['questions']=$questions;
		return $result;
	}
	public function fetchstudcoursesection($studid,$sid)
	{
		$result=array();
		$result['videos']=array();
		$result['section']=array();
		$result['concepts']=array();
		$result['tests']=array();
		$result['questions']=array();
		$result['studtests']=array();
		$result['ltests']=array();
		$result['lquestions']=array();
		$result['lstudtests']=array();
		$result['fquestions']=array();
		$result['fanswers']=array();
		$result['live']=array();
		$result['fquestions']=array();
		$result['admission']=array();
		$result['lquestions']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where Id='$sid'");
		$result['section']= $query1->result();
		if (count($result['section'])>0) {
			$cid=$result['section'][0]->CourseId;
			$result['sections']=$this->fetchcoursesection($cid);
			$result['admission']=$this->fetchcourseadmission($cid,$studid);
			$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$sid' order by Sort_order");
			$topics= $query1->result();
				$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
			$result['course']= $query1->result();
			$result['topics']=$topics;
			foreach ($topics as $topic) {
				$tid=$topic->Id;
				$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='$tid' and Type='video'");
				$result['videos'][]= $query1->result();
				$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='$tid' and Type='ppt'");
				$result['concepts'][]= $query1->result();
				$query=$this->db->query("select * from mcq_exam_mst_t where TopicId='".$tid."' and Type='stest'");
				$tests= $query->result();
				$studtests=array();
				$atests=array();
				$tmarks=array();
				$equestions=array();
				foreach ($tests as $test) {
					$eid=$test->Id;
					if($test->IsPublished==1){
						$query=$this->db->query("select * from mcq_questions_mst_t where ExamId='".$eid."'");
						$questions=$query->num_rows();
						if($questions>0){
							$equestions[]=$questions;
							$atests[]=$test;
							$query=$this->db->query("select * from mcq_result_mst_t where StudentId='".$studid."' and ExamId='$eid' order by Id DESC");
							$studtests[]= $query->result();
							$query=$this->db->query("select SUM(Marks) as total from mcq_questions_mst_t where ExamId='".$eid."'");
							$marks=$query->result();
							$tmarks[]=$marks[0]->total;
						}
					}
				}
				$result['tests'][]=$atests;
				$result['studtests'][]=$studtests;
				$result['marks'][]=$tmarks;
				$result['questions'][]=$equestions;
				$query=$this->db->query("select * from mcq_exam_mst_t where TopicId='".$tid."' and Type='sltest'");
				$tests= $query->result();
				$studtests=array();
				$atests=array();
				$tmarks=array();
				$equestions=array();
				foreach ($tests as $test) {
					$eid=$test->Id;
					if($test->IsPublished==1){
						$query=$this->db->query("select * from mcq_questions_mst_t where ExamId='".$eid."'");
						$questions=$query->num_rows();
						if($questions>0){
							$equestions[]=$questions;
							$atests[]=$test;
							$query=$this->db->query("select * from mcq_result_mst_t where StudentId='".$studid."' and ExamId='$eid' order by Id DESC");
							$studtests[]= $query->result();
							$query=$this->db->query("select SUM(Marks) as total from mcq_questions_mst_t where ExamId='".$eid."'");
							$marks=$query->result();
							$tmarks[]=$marks[0]->total;
						}
					}
				}
				$result['ltests'][]=$atests;
				$result['lstudtests'][]=$studtests;
				$result['lmarks'][]=$tmarks;
				$result['lquestions'][]=$equestions;
				$query1=$this->db->query("SELECT  * FROM lecture_mst_t where TopicId='$tid'");
				$result['live'][]= $query1->result();
				$query1=$this->db->query("SELECT  * FROM forum_questions_mst_t where LectureId='$tid'");
				$fquestions= $query1->result();
				$result['fquestions'][]=$fquestions;
				$fanswers=array();
				foreach ($fquestions as $que) {
					$qid=$que->Id;
					$query1=$this->db->query("SELECT  * FROM forum_answers_mst_t where QuestionId='$qid'");
					$fanswers[]= $query1->result();
				}
				$result['fanswers'][]=$fanswers;
			}
		}
		return $result;
	}
	function fetchcourseadmission($id,$studid)
	{
		$admission = array();
		if($studid>0){
			
		$query=$this->db->query("select * from student_admission_mst_t where Course_id='".$id."' and Student_id='$studid' and IsBlock=0");
		$admission= $query->result();
		if(count($admission)==0)
		{
			$query=$this->db->query("select * from batch_mst_t INNER JOIN student_batch_mst_t ON batch_mst_t.Id=student_batch_mst_t.BatchId where student_batch_mst_t.StudentId='$studid' and batch_mst_t.IsArchive=0");
			$batches= $query->result();
			$cids=array();
			foreach ($batches as $batch) {
				if($batch->CourseId!=""){
					$courses=explode(",", $batch->CourseId);
					foreach ($courses as $cid) {
						$cids[]=$cid;
					}
				}
			}
			if (in_array($id, $cids)) {
				$admission=$batches;
			}
		}
		}
		
		return $admission;
	}

	public function fetchstudcourses($studid){
		$query1=$this->db->query("SELECT  * FROM student_cart_mst_t where StudentId='$studid' and AdmissionId>'0' group by CourseId");
		$result= $query1->result();
		return $result;
	}
	public function fetchcoursevideos($cid, $studid)
	{
		$result=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
		$courses= $query1->result();
		$result['course']=$courses;
		$result['sections']=array();
		$result['videos']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$cid' order by Sort_order");
		$sections= $query1->result();
		foreach ($sections as $row) {
			$sid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where SectionId='$sid' and CourseId='$cid' and Type='video'");
			$lectures= $query1->result();
			$result['videos'][]=$lectures;
		}
		$result['sections']=$sections;
		return $result;
	}
	public function fetchcourseppts($cid, $studid)
	{
		$result=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
		$courses= $query1->result();
		$result['course']=$courses;
		$result['sections']=array();
		$result['ppts']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$cid' order by Sort_order");
		$sections= $query1->result();
		foreach ($sections as $row) {
			$sid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where SectionId='$sid' and CourseId='$cid' and Type='ppt'");
			$ppts= $query1->result();
			$result['ppts'][]=$ppts;
		}
		$result['sections']=$sections;
		return $result;
	}

	public function mycoursedetails($id)
	{
		$result=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM student_cart_mst_t inner join course_mst_t on student_cart_mst_t.CourseId where student_cart_mst_t.CartId='$id'");
		$course= $query1->result();
		$result['course']=$course;
		$course_id=$course[0]->CourseId;
		$result['sections']=array();
		//$query1=$this->db->query("SELECT  count(*) as topics, course_section_mst_t.Id as SectionId, course_section_mst_t.Title as Title, course_section_mst_t.Thumbnail FROM course_section_topic_mst_t inner join course_section_mst_t on course_section_mst_t.Id=course_section_topic_mst_t.SectionId where course_section_topic_mst_t.CourseId='$course_id'");
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t  where course_section_mst_t.CourseId='$course_id'");
		$sections = $query1->result();
		$i=0;
		foreach ($sections as $section) {
			$section_id=$section->Id;
			$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$section_id' and CourseId='$course_id' ");
			$section->topics=$query1->num_rows();
			$result['sections'][$i]=$section;
			$i++;
		}
		return $result;
	}
	public function mycoursesections($studid,$course_id)
	{
		$result=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM student_cart_mst_t inner join course_mst_t on student_cart_mst_t.CourseId where student_cart_mst_t.StudentId='$studid' and student_cart_mst_t.CourseId='$course_id'");
		$csections= array_unique(array_column($query1->result(), 'SectionId'));
		if (in_array('0', $csections)) {
			$query1=$this->db->query("SELECT  * FROM course_section_mst_t  where course_section_mst_t.CourseId='$course_id'");
			$sections = $query1->result();
			$i=0;
			foreach ($sections as $section) {
				$section_id=$section->Id;
				$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$section_id' and CourseId='$course_id' ");
				$section->topics=$query1->num_rows();
				$result['sections'][$i]=$section;
				$i++;
			}
		}
		else{
			if (count($csections)>1) {
				$section=implode(',', $csections);
				$query1=$this->db->query("SELECT  * FROM course_section_mst_t  where course_section_mst_t.Id IN ($section)");
				$sections = $query1->result();
				$i=0;
				foreach ($sections as $section) {
					$section_id=$section->Id;
					$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$section_id' and CourseId='$course_id' ");
					$section->topics=$query1->num_rows();
					$result['sections'][$i]=$section;
					$i++;
				}
			}
			else{
				if (count($csections)>0) {
					$section=implode(',', $csections);
					$query1=$this->db->query("SELECT  * FROM course_section_mst_t  where course_section_mst_t.Id='$section'");
					$sections = $query1->result();
					$i=0;
					foreach ($sections as $section) {
						$section_id=$section->Id;
						$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$section_id' and CourseId='$course_id' ");
						$section->topics=$query1->num_rows();
						$result['sections'][$i]=$section;
						$i++;
					}
				}
				else{
					$section=implode(',', $csections);
					$query1=$this->db->query("SELECT  * FROM course_section_mst_t  where course_section_mst_t.CourseId='$course_id'");
					$sections = $query1->result();
					$i=0;
					foreach ($sections as $section) {
						$section_id=$section->Id;
						$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$section_id' and CourseId='$course_id' ");
						$section->topics=$query1->num_rows();
						$result['sections'][$i]=$section;
						$i++;
					}
				}
			}
		}
		//die();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$course_id'");
		$course= $query1->result();
		$result['course']=$course;
		//$query1=$this->db->query("SELECT  count(*) as topics, course_section_mst_t.Id as SectionId, course_section_mst_t.Title as Title, course_section_mst_t.Thumbnail FROM course_section_topic_mst_t inner join course_section_mst_t on course_section_mst_t.Id=course_section_topic_mst_t.SectionId where course_section_topic_mst_t.CourseId='$course_id'");
		return $result;
	}
	public function mysectiondetails($studid,$course_id,$section_id)
	{
		$result=array();
		$result['section']=array();
		$result['topics']=array();
		$result['videos']=array();
		$result['ppts']=array();
		$result['tests']=array();
		$result['studies']=array();
		$result['studtests']=array();
		$query1=$this->db->query("SELECT  * FROM student_cart_mst_t where CourseId='$course_id' and StudentId='$studid'");
		$csections= array_unique(array_column($query1->result(), 'SectionId'));
		if (in_array('0', $csections)) {
			
		}
		$result['admission']=$admission;
		$types=json_decode($admission[0]->Type);
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t  where Id='$section_id'");
		$course= $query1->result();
		$result['section']=$course;
		$course_id=$course[0]->CourseId;
		$result['topics']=array();
		$query1=$this->db->query("SELECT  * from course_section_topic_mst_t where SectionId='$section_id'");
		$topics = $query1->result();
		$result['topics']=$topics;
		foreach ($topics as $topic) {
			$topic_id=$topic->Id;
			$tests=array();
			$ppts=array();
			$videos=array();
			if (in_array('All', $types)) {
				$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t  where TopicId='$topic_id' and Type='video'");
				$videos= $query1->result();
				$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t  where TopicId='$topic_id' and Type='ppt'");
				$ppts= $query1->result();
				$query1=$this->db->query("SELECT  count(*) as questions, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId where mcq_exam_mst_t.TopicId='$topic_id' GROUP BY mcq_questions_mst_t.ExamId");
				$tests= $query1->result();
			}
			else{
				if(in_array('Videos', $types)){
					$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t  where TopicId='$topic_id' and Type='video'");
					$videos= $query1->result();
				}
				if(in_array('PPTs', $types)){
					$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t  where TopicId='$topic_id' and Type='ppt'");
					$ppts= $query1->result();
				}
				if(in_array('Tests', $types)){
					$query1=$this->db->query("SELECT  count(*) as questions,SUM(mcq_questions_mst_t.Marks) as marks, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId where mcq_exam_mst_t.TopicId='$topic_id' GROUP BY mcq_questions_mst_t.ExamId");
					$tests= $query1->result();
					$studtests=array();
					foreach ($tests as $test) {
						$tid=$test->ExamId;
						$query1=$this->db->query("SELECT  * FROM mcq_result_mst_t where ExamId='$tid' and StudentId='$studid'");
						$studtests[]= $query1->result();
					}
					$result['studtests'][]=$studtests;
				}

			}
			$result['videos'][]=$videos;
			$result['ppts'][]=$ppts;
			$result['tests'][]=$tests;
				$query=$this->db->query("select * from course_lectures_mst_t where TopicId='".$topic_id."' and Type='study'");
				$result['studies'][]= $query->result();
		}
		return $result;
	}
	public function fetchcoursetests($cid, $studid)
	{
		$result=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
		$courses= $query1->result();
		$result['course']=$courses;
		$result['sections']=array();
		$result['tests']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$cid' order by Sort_order");
		$sections= $query1->result();
		foreach ($sections as $row) {
			$sid=$row->Id;
			$query1=$this->db->query("SELECT  count(*) as questions, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId where mcq_exam_mst_t.SectionId='$sid' and mcq_exam_mst_t.CourseId='$cid' GROUP BY mcq_questions_mst_t.ExamId");
			$tests= $query1->result();
			$result['tests'][]=$tests;

		}
		$result['sections']=$sections;
		return $result;
	}
	public function fetchstudentcoursetests($cid, $studid)
	{
		$result=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
		$courses= $query1->result();
		$result['course']=$courses;
		$result['sections']=array();
		$result['tests']=array();
		$result['studtests']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$cid' order by Sort_order");
		$sections= $query1->result();
		foreach ($sections as $row) {
			$sid=$row->Id;
			$query1=$this->db->query("SELECT  count(*) as questions, SUM(mcq_questions_mst_t.Marks) as marks, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId where mcq_exam_mst_t.SectionId='$sid' and mcq_exam_mst_t.CourseId='$cid' GROUP BY mcq_questions_mst_t.ExamId");
			$tests= $query1->result();
			$studtests=array();
			foreach ($tests as $test) {
				$tid=$test->ExamId;
				$query1=$this->db->query("SELECT  * FROM mcq_result_mst_t where ExamId='$tid'");
				$studtests[]= $query1->result();
			}
			$result['studtests'][]=$studtests;
			$result['tests'][]=$tests;
		}
		$result['sections']=$sections;
		return $result;
	}
	

	public function fetchcoursesections($vid,$studid)
	{
		$result=array();
		$result['video']=array();
		$result['videos']=array();
		$result['topic']=array();
		$result['concepts']=array();
		$result['tests']=array();
		$result['questions']=array();
		$result['studtests']=array();
		$result['ltests']=array();
		$result['lquestions']=array();
		$result['lstudtests']=array();
		$result['fquestions']=array();
		$result['fanswers']=array();
		$result['live']=array();
		$result['fquestions']=array();
		$result['admission']=array();
		$result['lquestions']=array();
		$result['course']=array();
		$result['count']=0;
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$vid'");
			$result['video']= $query1->result();
			$id=$result['video'][0]->TopicId;
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$id'");
		$result['topic']= $query1->result();
		if (count($result['topic'])>0) {
			$cid=$result['topic'][0]->CourseId;
			$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
		$result['course']= $query1->result();
			$sid=$result['topic'][0]->SectionId;
			$query=$this->db->query("select * from course_lectures_mst_t where SectionId='".$sid."' and Type='video'");
			$result['count']= $query->num_rows();
			$query=$this->db->query("select * from course_lectures_mst_t where CourseId='".$cid."' and Type='video'");
			$result['videos']= $query->result();
			$result['admission']=$this->fetchcourseadmission($cid,$studid);
			//print_r($result['admission']);
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='$id' and Type='ppt'");
			$result['concepts']= $query1->result();
			$query=$this->db->query("select * from mcq_exam_mst_t where TopicId='".$id."' and Type='stest'");
			$tests= $query->result();
			$studtests=array();
			$atests=array();
			$tmarks=array();
			$equestions=array();
			foreach ($tests as $test) {
				$tid=$test->Id;
				if($test->IsPublished==1){
					$query=$this->db->query("select * from mcq_questions_mst_t where ExamId='".$tid."'");
					$questions=$query->num_rows();
					if($questions>0){
						$equestions[]=$questions;
						$atests[]=$test;
						$query=$this->db->query("select * from mcq_result_mst_t where StudentId='".$studid."' and ExamId='$tid' order by Id DESC");
						$studtests[]= $query->result();
						$query=$this->db->query("select SUM(Marks) as total from mcq_questions_mst_t where ExamId='".$tid."'");
						$marks=$query->result();
						$tmarks[]=$marks[0]->total;
					}
				}
			}
			$result['tests']=$atests;
			$result['studtests']=$studtests;
			$result['marks']=$tmarks;
			$result['questions']=$equestions;
			$query=$this->db->query("select * from mcq_exam_mst_t where TopicId='".$id."' and Type='sltest'");
			$tests= $query->result();
			$studtests=array();
			$atests=array();
			$tmarks=array();
			$equestions=array();
			foreach ($tests as $test) {
				$tid=$test->Id;
				if($test->IsPublished==1){
					$query=$this->db->query("select * from mcq_questions_mst_t where ExamId='".$tid."'");
					$questions=$query->num_rows();
					if($questions>0){
						$equestions[]=$questions;
						$atests[]=$test;
						$query=$this->db->query("select * from mcq_result_mst_t where StudentId='".$studid."' and ExamId='$tid' order by Id DESC");
						$studtests[]= $query->result();
						$query=$this->db->query("select SUM(Marks) as total from mcq_questions_mst_t where ExamId='".$tid."'");
						$marks=$query->result();
						$tmarks[]=$marks[0]->total;
					}
				}
			}
			$result['ltests']=$atests;
			$result['lstudtests']=$studtests;
			$result['lmarks']=$tmarks;
			$result['lquestions']=$equestions;
			$query1=$this->db->query("SELECT  * FROM lecture_mst_t where TopicId='$id'");
			$result['live']= $query1->result();
			$query1=$this->db->query("SELECT  * FROM forum_questions_mst_t where LectureId='$id'");
			$fquestions= $query1->result();
			$result['fquestions']=$fquestions;
			foreach ($fquestions as $que) {
				$qid=$que->Id;
				$query1=$this->db->query("SELECT  * FROM forum_answers_mst_t where QuestionId='$qid'");
				$result['fanswers'][]= $query1->result();
			}
		}
		return $result;
	}
	public function fetchsectionlectures($sid)
	{
		$result=array();
		$result['section']=array();
		$result['videos']=array();
		$result['ppts']=array();
		$result['tests']=array();
		$result['studies']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where Id='$sid'");
		$result['section']= $query1->result();
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$sid'");
		$topics= $query1->result();
		$result['topics']=$topics;
		$cid=$result['section'][0]->CourseId;
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
		$result['course']= $query1->result();
		foreach ($topics as $topic) {
			$topic_id=$topic->Id;
			$query=$this->db->query("select * from course_lectures_mst_t where TopicId='".$topic_id."' and Type='video'");
			$result['videos'][]= $query->result();
			$query=$this->db->query("select * from course_lectures_mst_t where TopicId='".$topic_id."' and Type='study'");
			$result['studies'][]= $query->result();
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='".$topic_id."' and Type='ppt'");
			$result['ppts'][]= $query1->result();
			$query1=$this->db->query("SELECT  count(*) as questions, SUM(mcq_questions_mst_t.Marks) as marks, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId where mcq_exam_mst_t.TopicId='".$topic_id."' GROUP BY mcq_questions_mst_t.ExamId");
			$tests=$query1->result();
			$result['tests'][]=$tests;
		}

		return $result;
	}
	public function fetchtopiclectures($topic_id)
	{
		$result=array();
		$result['section']=array();
		$result['videos']=array();
		$result['ppts']=array();
		$result['tests']=array();
		$result['studies']=array();
		$query=$this->db->query("select * from course_lectures_mst_t where TopicId='".$topic_id."' and Type='video'");
		$result['videos']= $query->result();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='".$topic_id."' and Type='ppt'");
		$result['ppts']= $query1->result();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='".$topic_id."' and Type='study'");
		$result['studies']= $query1->result();
		$query1=$this->db->query("SELECT  count(*) as questions, SUM(mcq_questions_mst_t.Marks) as marks, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId where mcq_exam_mst_t.TopicId='".$topic_id."' GROUP BY mcq_questions_mst_t.ExamId");
		$tests=$query1->result();
		$result['tests']=$tests;

		return $result;
	}
	public function myorders($studid)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM student_admission_mst_t where Student_id='$studid'");
		$admissions= $query1->result();
		$result['admissions']=$admissions;
		$result['courses']=array();;
		foreach ($admissions as $admissions) {
			$query1=$this->db->query("SELECT  * FROM student_cart_mst_t where StudentId='$studid'");
			$result['courses'][]= $query1->result();
		}
		return $result;
	}
	public function publishcourse($cid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update course_mst_t SET IsPublished='1',UpdatedAt='$date' where Id='".$cid."'");
	}
	public function publishsection($sid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update course_section_mst_t SET IsPublished='1',UpdatedAt='$date' where Id='".$sid."'");
	}
	public function publishtopic($tid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update course_section_topic_mst_t SET IsPublished='1',UpdatedAt='$date' where Id='".$tid."'");
	}
	public function previewlecture($tid,$ispreview)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update course_section_topic_mst_t SET IsAccessible='$ispreview',UpdatedAt='$date' where Id='".$tid."'");
		$query=$this->db->query("update course_lectures_mst_t SET IsAccessible='$ispreview',UpdatedAt='$date' where TopicId='".$tid."'");
		$query=$this->db->query("update mcq_exam_mst_t SET IsAccessible='1',UpdatedAt='$date' where TopicId='".$tid."'");
		$query=$this->db->query("update forum_questions_mst_t SET IsAccessible='$ispreview',UpdatedAt='$date' where TopicId='".$tid."'");
		$query=$this->db->query("update lecture_mst_t SET IsAccessible='$ispreview',UpdatedAt='$date' where TopicId='".$tid."'");
	}
	public function publishsectionlecture($lid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update course_lectures_mst_t SET IsPublished='1',UpdatedAt='$date' where Id='".$lid."'");
	}
	public function publishtest($sid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update mcq_exam_mst_t SET IsPublished='1',UpdatedAt='$date' where Id='".$sid."'");
	}
	public function publishlecture($lid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update lecture_mst_t SET IsPublished='1',UpdatedAt='$date' where Id='".$lid."'");
	}
	public function publishquestion($qid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update forum_questions_mst_t SET IsPublished='1',UpdatedAt='$date' where Id='".$qid."'");
	}
	public function updatesection($sid,$title,$thumbnail,$videos_price,$tests_price,$ppts_price,$overall_price)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$image="";
		if($thumbnail!="")
		{
			$this->deletesectioncontent($sid);
			$image=", Thumbnail='$thumbnail'";
		}
		$query=$this->db->query("update course_section_mst_t SET Title='$title',VideosPrice='$videos_price',TestsPrice='$tests_price',PptsPrice='$ppts_price',Price='$overall_price',UpdatedAt='$date' $image where Id='".$sid."'");
	}
	public function updatetopic($tid,$title,$thumbnail,$videos_price,$tests_price,$ppts_price,$overall_price)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$image="";
		if($thumbnail!="")
		{
			$this->deletetopiccontent($tid);
			$image=", Thumbnail='$thumbnail'";
		}
		$query=$this->db->query("update course_section_topic_mst_t SET Topic='$title',VideosPrice='$videos_price',TestsPrice='$tests_price',PptsPrice='$ppts_price',Price='$overall_price',UpdatedAt='$date' $image where Id='".$tid."'");
	}
	public function filterncbatchstudent($cid,$id)
	{
		$result=array();
		$result['students']=array();
		$result['batches']=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where BatchId='$id' ORDER BY ID DESC");
		$students= $query1->result();
		foreach ($students as $row) {
			$studid=$row->StudentId;
			$query1=$this->db->query("SELECT  * FROM student_mst_t where Id='$studid'");
			$student= $query1->result();
			if(count($student)>0){
				$query1=$this->db->query("SELECT  * FROM student_admission_mst_t where Student_id='$studid' and Course_id='$cid'");
				$courses= $query1->result();
				if(count($courses)==0){
					$result['students'][]=$student[0];
				}
			}
		}
		return $result;
	}
	function addcoursestudents($cid,$students)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		foreach ($students as $sid) {
			$query="insert into student_admission_mst_t(Student_id,Course_id,CreatedAt,UpdatedAt) values('$sid','$cid','$date','$date')";
			$this->db->query($query);
		}
	}
	function addlectureviews($student_id,$lecture_id,$test_id,$topic_id,$section_id,$course_id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query1=$this->db->query("SELECT  * FROM course_topic_lecture_views where student_id='$student_id' and lecture_id='$lecture_id' and test_id='$test_id' and topic_id='$topic_id' and section_id='$section_id' and course_id='$course_id'");
		$view= $query1->result();
		if (count($view)>0) {
			$count=$view[0]->count+1;
			$query=$this->db->query("update course_topic_lecture_views SET student_id='$student_id',lecture_id='$lecture_id',test_id='$test_id',topic_id='$topic_id',section_id='$section_id',course_id='$course_id', count='$count',updated_at='$date' where student_id='$student_id' and lecture_id='$lecture_id' and test_id='$test_id' and topic_id='$topic_id' and section_id='$section_id' and course_id='$course_id'");
		}
		else{
			$query="insert into course_topic_lecture_views(student_id,course_id,section_id,topic_id,lecture_id,test_id,count,created_at,updated_at) values('$student_id','$course_id','$section_id','$topic_id','$lecture_id','$test_id','1','$date','$date')";
			$this->db->query($query);
		}
	}
	function addtocart($student_id,$course_id,$section_id,$topic_id,$title,$thumbnail,$types,$price)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$type=json_encode($types);
		$query="insert into student_cart_mst_t(StudentId,CourseId,SectionId,TopicId,CourseName,CourseThumbnail,Price,Type,CreatedAt,UpdatedAt) values('$student_id','$course_id','$section_id','$topic_id','$title','$thumbnail','$price','$type','$date','$date')";
		$this->db->query($query);
	}
	function mycourses($studid)
	{
		$result=array();
		$result['courses']=array();
		$query1=$this->db->query("SELECT  * FROM student_admission_mst_t where Student_id='$studid'");
		$courses= $query1->result();
		foreach ($courses as $course) {
			$cid=$course->Course_id;
			$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
			$course= $query1->result();
			if(count($course)>0){
				$result['courses'][]=$course[0];
			}
		}
		return $result;	
	}
	function updatelecture($lid,$title,$desc,$file,$fname)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update course_lectures_mst_t SET Title='$title',Description='$desc',ContentUrl='$file',ContentName='$fname',UpdatedAt='$date' where Id='".$lid."'");
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$lid'");
		$result= $query1->result();
		return $result;
	}
	function deletecourse($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$id'");
		$sections= $query1->result();
		foreach ($sections as $sect) {
			$sid=$sect->Id;
			$this->deletesection($sid);
		}
		$this->db->query("delete  from course_mst_t where Id='".$id."'");
	}
	function remove_cart_course($studid,$cart_id)
	{
		$this->db->query("delete  from student_cart_mst_t where StudentId='$studid' and CartId='".$cart_id."'");	
	}
	function deletesection($sid)
	{
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$sid'");
		$topics= $query1->result();
		foreach ($topics as $tid) {
			$this->deletetopic($tid->Id);
		}
		$this->deletesectioncontent($sid);
		$this->db->query("DELETE FROM course_section_mst_t where Id='$sid'");
	}
	function deletesectioncontent($sid)
	{
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where Id='$sid'");
		$section= $query1->result();
		if($section[0]->Thumbnail!=""){
            $image=$section[0]->Thumbnail;
            $url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$image);
            $this->Spaces_Model->delete_file($url);
        }
	}
	function deletetopiccontent($tid)
	{
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$tid'");
		$topic= $query1->result();
		if($topic[0]->Thumbnail!=""){
            $image=$topic[0]->Thumbnail;
            $url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$image);
            $this->Spaces_Model->delete_file($url);
        }
	}
	function deletetopic($tid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where TopicId='$tid'");
		$lectures= $query1->result();
		foreach ($lectures as $lect) {
			$lid=$lect->Id;
			$this->deletesectionlecture($lid);
		}
		$query1=$this->db->query("SELECT  * FROM mcq_exam_mst_t where TopicId='$tid'");
		$tests= $query1->result();
		foreach ($tests as $test) {
			$eid=$test->Id;
			$this->db->query("DELETE FROM mcq_options_mst_t where ExamId='$eid'");
			$this->db->query("DELETE FROM mcq_questions_mst_t where ExamId='$eid'");
		}
		$this->db->query("DELETE FROM mcq_exam_mst_t where TopicId='$tid'");
		$this->db->query("DELETE FROM course_lectures_mst_t where TopicId='$tid'");
		$query1=$this->db->query("SELECT  * FROM forum_questions_mst_t where LectureId='$tid'");
		$questions= $query1->result();
		foreach ($questions as $que) {
			$qid=$que->Id;
			$this->db->query("DELETE FROM forum_answers_mst_t where QuestionId='$tid'");
		}
		$this->db->query("DELETE FROM forum_questions_mst_t where TopicId='$tid'");
		$this->db->query("delete  from lecture_mst_t where TopicId='".$tid."'");
		$this->db->query("delete  from course_section_topic_mst_t where Id='".$tid."'");
	}
	function addcourse($cid,$category,$faculty,$title,$subtitle,$desc,$video_thumbnail,$video,$background_image)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$desc=str_replace("'","\'",$desc);
		$title=str_replace("'","\'",$title);
		if($cid==0){
			$query1=$this->db->query("SELECT  * FROM course_mst_t");
			$count= $query1->num_rows();
			$norder=$count+1;
			$query="insert into course_mst_t(Title,Subtitle,Description,Category_id,Faculty_id,Web_sort,Cover_image,Promotional_video,Background_image,CreatedAt,UpdatedAt) values('$title','$subtitle','$desc','$category','$faculty','$norder','$video_thumbnail','$video','$background_image','$date','$date')";
			$this->db->query($query);
			$cid = $this->db->insert_id();
			$stitle="First Section";
			$query="insert into course_section_mst_t(CourseId,Title,CreatedAt,UpdatedAt) values('$cid','$stitle','$date','$date')";
			$this->db->query($query);
			$sid = $this->db->insert_id();
			/*$ltitle="First Lecture";
			$query="insert into course_lectures_mst_t(CourseId,SectionId,Title,CreatedAt,UpdatedAt) values('$cid','$sid','$ltitle','$date','$date')";
			$this->db->query($query);
			$this->session->set_userdata('courseid',$cid);*/
		}
		else{
			$image="";
			if($video_thumbnail!=""){
				$image.=", Cover_image='$video_thumbnail'";
			}
			if($background_image!=""){
				$image.=", Background_image='$background_image'";
			}
			if($video!=""){
				$image.=", Promotional_video='$video'";
			}
			$query=$this->db->query("update course_mst_t SET Title='$title',Subtitle='$subtitle',Description='$desc',Category_id='$category',Faculty_id='$faculty',UpdatedAt='$date' $image where Id='".$cid."'");
		}
		return $cid;
	}
	function addsection($stitle,$thumbnail,$cid,$videos_price,$tests_price,$ppts_price,$overall_price)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$cid'");
		$count= $query1->num_rows();
		$norder=$count+1;
		$query="insert into course_section_mst_t(CourseId,Title,Thumbnail,VideosPrice,PptsPrice,TestsPrice,Price,Sort_order,CreatedAt,UpdatedAt) values('$cid','$stitle','$thumbnail','$videos_price','$ppts_price','$tests_price','$overall_price','$norder','$date','$date')";
		$this->db->query($query);
		$id = $this->db->insert_id();
		return $id;
	}
	function sort_order_courses($sids)
	{
		$i=1;
		foreach ($sids as $sid) {
			$query=$this->db->query("update course_mst_t SET Web_sort='$i' where Id='$sid'");
			$i++;
		}
	}
	function sort_order_sections($sids)
	{
		$i=1;
		foreach ($sids as $sid) {
			$query=$this->db->query("update course_section_mst_t SET Sort_order='$i' where Id='$sid'");
			$i++;
		}
	}
	function sort_order_topic($tids)
	{
		$i=1;
		foreach ($tids as $tid) {
			$query=$this->db->query("update course_section_topic_mst_t SET Sort_order='$i' where Id='$tid'");
			$i++;
		}
	}
	function add_section_topic($ttitle,$thumbnail,$cid,$sid,$overall_price,$videos_price,$ppts_price,$tests_price)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$sid'");
		$count= $query1->num_rows();
		$norder=$count+1;
		$query="insert into course_section_topic_mst_t(CourseId,SectionId,Topic,Thumbnail,VideosPrice,PptsPrice,TestsPrice,Price,Sort_order,CreatedAt,UpdatedAt) values('$cid','$sid','$ttitle','$thumbnail','$videos_price','$ppts_price','$tests_price','$overall_price','$norder','$date','$date')";
		$this->db->query($query);
		$id = $this->db->insert_id();
		return $id;
	}
	function addvideo($cid,$sid,$tid,$type,$title,$desc,$video,$thumbnail,$duration,$videosize)
	{
		$title=str_replace("'","\'",$title);
		$desc=str_replace("'","\'",$desc);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into course_lectures_mst_t(CourseId,TopicId,SectionId,Title,Description,VideoThumbnail,ContentUrl,VideoDuration,VideoSize,Type,CreatedAt,UpdatedAt) values('$cid','$tid','$sid','$title','$desc','$thumbnail','$video','$duration','$videosize','$type','$date','$date')";
		$this->db->query($query);
		$id = $this->db->insert_id();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$id'");
		$result= $query1->result();
		return $result;
	}
	function addlecture($cid,$sid,$tid,$title,$desc,$ldate,$stime,$etime,$lstarturl,$lectid,$pass,$image)
	{
		$title=str_replace("'","\'",$title);
		$desc=str_replace("'","\'",$desc);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into lecture_mst_t(CourseId,SectionId,TopicId,Title,Description,Lecture_date,Start_time,End_time,Meeting_url,Meeting_id,Password,Thumbnail,CreatedAt,UpdatedAt) values('$cid','$sid','$tid','$title','$desc','$ldate','$stime','$etime','$lstarturl','$lectid','$pass','$image','$date','$date')";
		$this->db->query($query);
		$id = $this->db->insert_id();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$id'");
		$result= $query1->result();
		return $result;
	}
	function addtestseries($cid,$tid,$title,$desc,$thumbnail)
	{
		$title=str_replace("'","\'",$title);
		$desc=str_replace("'","\'",$desc);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into mcq_category_mst_t(CourseId,TopicId,Title,Description,Thumbnail,CreatedAt,UpdatedAt) values('$cid's,'$tid','$title','$desc','$thumbnail','$date','$date')";
		$this->db->query($query);
		$id = $this->db->insert_id();
		$query1=$this->db->query("SELECT  * FROM mcq_category_mst_t where Id='$id'");
		$result= $query1->result();
		return $result;
	}
	function addconcept($cid,$sid,$tid,$type,$title,$desc,$pdf)
	{
		$title=str_replace("'","\'",$title);
		$desc=str_replace("'","\'",$desc);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into course_lectures_mst_t(CourseId,SectionId,TopicId,Title,Description,ContentUrl,Type,CreatedAt,UpdatedAt) values('$cid','$sid','$tid','$title','$desc','$pdf','$type','$date','$date')";
		$this->db->query($query);
		$id = $this->db->insert_id();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$id'");
		$result= $query1->result();
		return $result;
	}
	function addqa($cid,$sid,$tid,$question,$answer)
	{
		$question=str_replace("'","\'",$question);
		$answer=str_replace("'","\'",$answer);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into forum_questions_mst_t(CourseId,SectionId,LectureId,Questions,CreatedAt,UpdatedAt) values('$cid','$sid','$tid','$question','$date','$date')";
		$this->db->query($query);
		$qid = $this->db->insert_id();
		$query="insert into forum_answers_mst_t(QuestionId,Answers,CreatedAt,UpdatedAt) values('$qid','$answer','$date','$date')";
		$this->db->query($query);
		$result=array();
		$result['question']=array();
		$result['answer']=array();
		$query1=$this->db->query("SELECT  * FROM forum_questions_mst_t where Id='$qid'");
		$result['question']= $query1->result();
		$query1=$this->db->query("SELECT  * FROM forum_answers_mst_t where QuestionId='$qid'");
		$result['answer']= $query1->result();
		return $result;
	}
	function fetchvideoconcept($lid)
	{
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$lid'");
		$lecture= $query1->result();
		return $lecture;
	}
	function fetchtestseries($sid)
	{
		$query1=$this->db->query("SELECT  * FROM mcq_category_mst_t where Id='$sid'");
		$series= $query1->result();
		return $series;
	}
	function deletesectionlecture($lid)
	{
		$this->deletelecturecontent($lid);
		$this->db->query("DELETE FROM course_lectures_mst_t where Id='$lid'");
	}
	function deletetest($sid)
	{
		$query1=$this->db->query("SELECT  * FROM mcq_exam_mst_t where Id='$sid'");
		$tests= $query1->result();
		foreach ($tests as $test) {
			$tid=$test->Id;
			$this->db->query("DELETE FROM mcq_options_mst_t where ExamId='$tid'");
			$this->db->query("DELETE FROM mcq_questions_mst_t where ExamId='$tid'");
		}
		$this->db->query("DELETE FROM mcq_exam_mst_t where Id='$sid'");
	}
	function deletelecture($lid)
	{
		$this->db->query("DELETE FROM student_attendance_mst_t where LectureId='$lid'");
		$this->db->query("DELETE FROM lecture_mst_t where Id='$lid'");
	}
	function deletelecturecontent($lid)
	{
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$lid'");
		$lecture= $query1->result();
		if(count($lecture)>0){
			if($lecture[0]->ContentUrl!=""){
	            $content=$lecture[0]->ContentUrl;
	            $url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$content);
	            $this->Spaces_Model->delete_file($url);
	        }
			if($lecture[0]->VideoThumbnail!=""){
	            $thumbnail=$lecture[0]->VideoThumbnail;
	            $url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$thumbnail);
	            $this->Spaces_Model->delete_file($url);
	        }
		}
	}
	function deleteqn($qid)
	{
		$this->db->query("DELETE FROM forum_answers_mst_t where QuestionId='$qid'");
		$this->db->query("DELETE FROM forum_questions_mst_t where Id='$qid'");
	}
	function updatevideo($vid,$title,$desc,$video,$thumbnail,$duration,$videosize)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$size="";
		$dur="";
		if($videosize!=""){
			$size=", VideoSize='$videosize'";
		}
		if($duration!=""){
			$dur=", VideoDuration='$duration'";
		}
		$image="";
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$vid'");
		$lecture= $query1->result();
		if($thumbnail!="")
		{
			$image=", VideoThumbnail='$thumbnail'";
			if(count($lecture)>0){
				if($lecture[0]->VideoThumbnail!=""){
		            $content=$lecture[0]->VideoThumbnail;
		            $url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$content);
		            $this->Spaces_Model->delete_file($url);
		        }
			}
		}
		$lvideo="";
		if($video!="")
		{
			$lvideo=", ContentUrl='$video'";
			if(count($lecture)>0){
				if($lecture[0]->ContentUrl!=""){
		            $curl=$lecture[0]->ContentUrl;
		            $url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$curl);
		            $this->Spaces_Model->delete_file($url);
		        }
			}
		}
		$query=$this->db->query("update course_lectures_mst_t SET Title='$title',Description='$desc',UpdatedAt='$date' $image $lvideo $size $dur where Id='".$vid."'");
	}
	function updatetest($sid,$title,$desc,$thumbnail)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update mcq_category_mst_t SET Thumbnail='$thumbnail',Title='$title',Description='$desc',UpdatedAt='$date' where Id='".$sid."'");
	}
	function updateconcept($cid,$title,$desc,$pdf)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$cpdf="";
		if($pdf!="")
		{
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where Id='$cid'");
			$lecture= $query1->result();
			$cpdf=", ContentUrl='$pdf'";
			if(count($lecture)>0){
				if($lecture[0]->ContentUrl!=""){
		            $content=$lecture[0]->ContentUrl;
		            $url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$content);
		            $this->Spaces_Model->delete_file($url);
		        }
			}
		}
		$query=$this->db->query("update course_lectures_mst_t SET Title='$title',Description='$desc',UpdatedAt='$date' $cpdf where Id='".$cid."'");
	}
	function updateqaquestion($qid,$fquestion,$fanswer)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$fquestion=str_replace("'","\'",$fquestion);
		$fanswer=str_replace("'","\'",$fanswer);
		$query=$this->db->query("update forum_questions_mst_t SET Questions='$fquestion',UpdatedAt='$date' where Id='".$qid."'");
		$query=$this->db->query("update forum_answers_mst_t SET Answers='$fanswer',UpdatedAt='$date' where QuestionId='".$qid."'");
	}
	function updatelive($id,$title,$desc,$lectid,$pass,$ldate,$stime,$etime,$surl,$image)
	{
		if($image!="")
		{
			$image=", Thumbnail='$image'";
		}
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update lecture_mst_t SET Title='$title',Description='$desc',Meeting_url='$surl',Meeting_id='$lectid',Password='$pass',Lecture_date='$ldate',Start_time='$stime',End_time='$etime',UpdatedAt='$date' $image where Id='".$id."'");
	}
	function fetchcourses()
	{
		$result=array();
		$result['courses']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t ORDER BY Web_sort");
		$courses= $query1->result();
		$result['courses']=$courses;
		return $result;
	}

	function fetchallcourses()
	{
		$result=array();
		$result['sections']=array();
		$result['courses']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t ORDER BY Web_sort");
		$courses= $query1->result();
		foreach ($courses as $course) {
			$course_id=$course->Id;
			$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$course_id'");
			$course->sections= $query1->num_rows();
			$result['courses'][]=$course;
		}
		
		return $result;
	}
	function fetchcategorycourses($category_id)
	{
		$result=array();
		$result['courses']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where IsPublished='1' and Category_id='$category_id' ORDER BY Web_sort");
		$courses= $query1->result();
		foreach ($courses as $course) {
			$course_id=$course->Id;
			$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$course_id'");
			$course->sections= $query1->num_rows();
			$result['courses'][]=$course;
		}
		
		return $result;
	}
	function fetchcoursecategories()
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM course_category_mst_t");
		$result= $query1->result();
		return $result;
	}
	function getcourses($page)
	{
		$result=array();
		$result['courses']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where IsPublished='1' ORDER BY Web_sort Limit 10 offset $page");
		$courses= $query1->result();
		foreach ($courses as $course) {
			$course_id=$course->Id;
			$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$course_id'");
			$course->sections= $query1->num_rows();
			$result['courses'][]=$course;
		}
		
		return $result;
	}
	function getcategorycourses($category_id,$page)
	{
		$result=array();
		$result['courses']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where IsPublished='1' and Category_id='$category_id' ORDER BY Web_sort Limit 10 offset $page");
		$courses= $query1->result();
		foreach ($courses as $course) {
			$course_id=$course->Id;
			$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$course_id'");
			$course->sections= $query1->num_rows();
			$result['courses'][]=$course;
		}
		
		return $result;
	}
	function fetchpurchasedcourses($studid)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM student_admission_mst_t inner join course_mst_t on student_admission_mst_t.Course_id=course_mst_t.Id where student_admission_mst_t.Student_id='$studid' ORDER BY Web_sort");
		$courses= $query1->result();
		$result['courses']=$courses;
		$result['lectures']=array();
		foreach ($courses as $course) {
			$cid=$course->Course_id;
			if($course->Section_id>0){
				$sid=$course->Section_id;
				$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where SectionId='$sid' and IsPublished=1");
				$result['lectures']= $query1->result();	
			}
			else{
				$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where CourseId='$cid' and IsPublished=1");
				$result['lectures']= $query1->result();
			}
		}
		return $result;
	}
	/*function fetchallcourses()
	{
		$result=array();
		$result['categories']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where IsPublished='1' ORDER BY Web_sort");
		$courses= $query1->result();
		return $courses;
	}*/
	function fetchsection($sid)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where Id='$sid'");
		$result= $query1->result();
		return $result;
	}
	function section_lectures($sid)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where SectionId='$sid'");
		$result= $query1->result();
		return $result;
	}
	function fetchcoursesection($cid)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$cid'");
		$result= $query1->result();
		return $result;
	}
	function fetchtopic($tid)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$tid'");
		$result= $query1->result();
		return $result;
	}

	public function mytopicdetails($student_id,$cart_id,$topic_id)
	{
		$result=array();
		$result['topic']=array();
		$result['videos']=array();
		$result['ppts']=array();
		$result['studies']=array();
		$result['tests']=array();
		$result['studtests']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where Id='$topic_id'");
		$result['topic']= $query1->result();
		$query1=$this->db->query("SELECT  * FROM student_cart_mst_t where CartId='$cart_id'");
		$result['admission']= $query1->result();
		$query=$this->db->query("select course_lectures_mst_t.*,course_topic_lecture_views.id as view_id  from course_lectures_mst_t left join course_topic_lecture_views on course_topic_lecture_views.lecture_id=course_lectures_mst_t.Id and course_topic_lecture_views.student_id='$student_id' where course_lectures_mst_t.TopicId='".$topic_id."' and course_lectures_mst_t.Type='video'");
		$result['videos']= $query->result();
		$query=$this->db->query("select course_lectures_mst_t.*, course_topic_lecture_views.id as view_id from course_lectures_mst_t left join course_topic_lecture_views on course_topic_lecture_views.lecture_id=course_lectures_mst_t.Id and course_topic_lecture_views.student_id='$student_id' where course_lectures_mst_t.TopicId='".$topic_id."' and course_lectures_mst_t.Type='studies'");
		$result['studies']= $query->result();
		$query1=$this->db->query("SELECT  course_lectures_mst_t.*,course_topic_lecture_views.id as view_id FROM course_lectures_mst_t left join course_topic_lecture_views on course_topic_lecture_views.lecture_id=course_lectures_mst_t.Id and course_topic_lecture_views.student_id='$student_id' where course_lectures_mst_t.TopicId='".$topic_id."' and course_lectures_mst_t.Type='ppt'");
		$result['ppts']= $query1->result();
		$query1=$this->db->query("SELECT  count(*) as questions, SUM(mcq_questions_mst_t.Marks) as marks, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName,course_topic_lecture_views.test_id as view_id FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId left join course_topic_lecture_views on course_topic_lecture_views.test_id=mcq_questions_mst_t.ExamId and course_topic_lecture_views.student_id='$student_id' where mcq_exam_mst_t.TopicId='".$topic_id."' GROUP BY mcq_questions_mst_t.ExamId");
		$tests=$query1->result();
		$studtests=array();
		foreach ($tests as $test) {
			$tid=$test->ExamId;
			$query1=$this->db->query("SELECT  * FROM mcq_result_mst_t where ExamId='$tid' and StudentId='$student_id'");
			$result['studtests'][]= $query1->result();
		}
		$result['tests']=$tests;

		return $result;
	}
	function fetchtopics($sid)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$sid' order by Sort_order");
		$result= $query1->result();
		return $result;
	}
	public function fetchnstudcourses($cid,$startid,$limit)
	{
		$result=array();
		$result['students']=array();
		$result['batches']=array();
		if($startid>0){
			$query1=$this->db->query("SELECT  * FROM student_mst_t where Id<'$startid' ORDER BY ID DESC limit $limit");
		}
		else{
			$query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit $limit");
		}
		$students= $query1->result();
		foreach ($students as $row) {
			$studid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM student_admission_mst_t where Student_id='$studid' and Course_id='$cid'");
			$batches= $query1->result();
			if(count($batches)==0){
				$result['students'][]=$row;
			}
		}
		return $result;
	}
	function fetchcoursestudents($id)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM student_admission_mst_t where Course_id='$id'");
		$courses= $query1->result();
		foreach ($courses as $row) {
			$studid=$row->Student_id;
			$query1=$this->db->query("SELECT  * FROM student_mst_t where Id='$studid'");
			$student= $query1->result();
			if(count($student)>0){
				$result[]=$student[0];
			}
		}
		return $result;
	}
	function nstudcourses($studid)
	{
	$result=array();
		$result['courses']=array();
		$query=$this->db->query("select * from course_mst_t where IsPublished='1'");
		$courses= $query->result();
		foreach ($courses as $course) {
			$query=$this->db->query("select * from student_admission_mst_t where Student_id='$studid' and Course_id='$course->Id'");
			$count= $query->result();
			if(count($count)==0){
				$result['courses'][]=$course;
			}	
		}
		return $result;	
	}

	function fetchhomecourses()
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where IsPublished='1' order by Web_sort limit 4");
		$courses= $query1->result();
		foreach ($courses as $course) {
			$course_id=$course->Id;
			$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$course_id'");
			$course->sections= $query1->num_rows();
			$result[]=$course;
		}
		
		return $result;
	}

	function fetchsinglecourse($id)
	{
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$id'");
		$courses= $query1->result();
		return $courses;
	}
	function fetchcourse($id)
	{
		$result=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$id'");
		$courses= $query1->result();
		$result['course']=$courses;
		$result['sections']=array();
		$result['videos']=array();
		$result['ppts']=array();
		$result['tests']=array();
		$result['faculty']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$id' order by Sort_order");
		$sections= $query1->result();
		foreach ($sections as $row) {
			$sid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where SectionId='$sid' and CourseId='$id' and Type='video'");
			$lectures= $query1->result();
			$result['videos'][]=$lectures;
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where SectionId='$sid' and CourseId='$id' and Type='ppt'");
			$ppts= $query1->result();
			$result['ppts'][]=$ppts;
			$query1=$this->db->query("SELECT  count(*) as questions, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId where mcq_exam_mst_t.SectionId='$sid' and mcq_exam_mst_t.CourseId='$id' GROUP BY mcq_questions_mst_t.ExamId");
			$tests= $query1->result();
			$result['tests'][]=$tests;
		}
		$result['sections']=$sections;
		$tid=$courses[0]->Faculty_id;
		$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$tid'");
		$result['faculty']= $query1->result();
		return $result;
	}
	function fetchmycourse($id)
	{
		$result=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$id'");
		$courses= $query1->result();
		$result['course']=$courses;
		$result['sections']=array();
		$result['videos']=array();
		$result['ppts']=array();
		$result['tests']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$id' order by Sort_order");
		$sections= $query1->result();
		foreach ($sections as $row) {
			$sid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where SectionId='$sid' and CourseId='$id' and Type='video'");
			$lectures= $query1->result();
			$result['videos'][]=$lectures;
			$query1=$this->db->query("SELECT  * FROM course_lectures_mst_t where SectionId='$sid' and CourseId='$id' and Type='ppt'");
			$ppts= $query1->result();
			$result['ppts'][]=$ppts;
			$query1=$this->db->query("SELECT  count(*) as questions, mcq_exam_mst_t.Id as ExamId, mcq_exam_mst_t.Duration, mcq_exam_mst_t.IsAccessible, mcq_exam_mst_t.ExamName FROM mcq_questions_mst_t inner join mcq_exam_mst_t on mcq_exam_mst_t.Id=mcq_questions_mst_t.ExamId where mcq_exam_mst_t.SectionId='$sid' and mcq_exam_mst_t.CourseId='$id' GROUP BY mcq_questions_mst_t.ExamId");
			$tests= $query1->result();
			$result['tests'][]=$tests;
		}
		$result['sections']=$sections;
		return $result;
	}
	function fetchcourseinformation($cid){
		$result=array();
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
		$courses= $query1->result();
		$result['course']=$courses;
		return $result;
	}
	function fetchcoursecurriculum($cid){
		$result=array();
		$result['topics']=array();
		$result['sections']=array();
		$query1=$this->db->query("SELECT  * FROM course_section_mst_t where CourseId='$cid' order by Sort_order");
		$sections= $query1->result();
		foreach ($sections as $row) {
			$sid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM course_section_topic_mst_t where SectionId='$sid' and CourseId='$cid' order by Sort_order");
			$lectures= $query1->result();
			$result['topics'][]=$lectures;
		}
		$result['sections']=$sections;
		return $result;
	}
	function fetchbcourse($cid){
		$query=$this->db->query("select * from course_mst_t where Id='".$cid."'");
		$result= $query->result();
		return $result;
	}
	function fetchcartiddata($cart_id){
		$query=$this->db->query("select * from student_cart_mst_t where CartId='".$cart_id."'");
		$result= $query->result();
		return $result;
	}
	function getorderdata($cart_id){
		$query=$this->db->query("select * from student_admission_mst_t where Id='".$cart_id."'");
		$result= $query->result();
		return $result;
	}
	function addcourselecture($sid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("select * from course_section_mst_t where Id='".$sid."'");
		$section= $query->result();
		$cid=$section[0]->CourseId;
		$ltitle="New Lecture";
		$query="insert into course_lectures_mst_t(CourseId,SectionId,Title,CreatedAt,UpdatedAt) values('$cid','$sid','$ltitle','$date','$date')";
		$this->db->query($query);
		$lid = $this->db->insert_id();
		return $lid;
	}
	function addstudentcart($student_id,$course_id,$type,$coupon,$price,$discountprice)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into student_cart_mst_t(CourseId,StudentId,Price,Coupon,DiscountPrice,Type,CreatedAt,UpdatedAt) values('$course_id','$student_id','$price','$coupon','$discountprice','$type','$date','$date')";
		$this->db->query($query);
		$cart_id = $this->db->insert_id();
		return $cart_id;
	}
	function addorder($student_id,$couponcode,$price,$discountprice)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into student_admission_mst_t(Student_id,Price,Coupon,DiscountPrice,CreatedAt,UpdatedAt) values('$student_id','$price','$couponcode','$discountprice','$date','$date')";
		$this->db->query($query);
		$cart_id = $this->db->insert_id();
		return $cart_id;
	}
	function updateorder($cart_id,$student_id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update student_admission_mst_t SET UpdatedAt='$date', IsOrder='1' where Id='$cart_id'");
		$query=$this->db->query("update student_cart_mst_t SET UpdatedAt='$date', AdmissionId='$cart_id' where StudentId='$student_id' and AdmissionId='0'");
	}
	function addstudentcourse($cart)
	{
		$student_id= $cart[0]->StudentId;
		$course_id= $cart[0]->CourseId;
		$coupon= $cart[0]->Coupon;
		$price= $cart[0]->Price;
		$discountprice= $cart[0]->DiscountPrice;
		$enroll_type= json_decode($cart[0]->Type);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query1=$this->db->query("SELECT  * FROM student_admission_mst_t where Course_id='$course_id' and Student_id='$student_id'");
		$admission= $query1->result();
		$aid=0;
		if(count($admission)>0){
			$aid=$admission[0]->Id;

			$isvideo=$admission[0]->IsVideo;
			$isppt=$admission[0]->IsPpt;
			$istest=$admission[0]->IsTest;
			if($enroll_type!=""){

			foreach ($enroll_type as $type) {
				if($type=="Videos"){
					$isvideo=1;
				}
				else if($type=="PPTs"){
					$isppt=1;
				}
				else if($type=="Tests"){
					$istest=1;
				}
			}
			}
			else{

			$isvideo=1;
			$isppt=1;
			$istest=1;
			}
			$query=$this->db->query("update student_admission_mst_t SET UpdatedAt='$date', IsTest='$istest', IsVideo='$isvideo', IsPpt='$isppt' where Id='$aid'");
		}
		else{
			$isvideo=0;
			$isppt=0;
			$istest=0;
			if($enroll_type!=""){
			foreach ($enroll_type as $type) {
				if($type=="videos"){
					$isvideo=1;
				}
				else if($type=="ppts"){
					$isppt=1;
				}
				else if($type=="tests"){
					$istest=1;
				}
			}
			}
			else{

			$isvideo=1;
			$isppt=1;
			$istest=1;
			}
			$query="insert into student_admission_mst_t(Student_id,Course_id,Coupon,Price,DiscountPrice,IsPpt,IsVideo,IsTest,CreatedAt,UpdatedAt) values('$student_id','$course_id','$coupon','$price','$discountprice','$isppt','$isvideo','$istest','$date','$date')";
			$this->db->query($query);
			$aid=$this->db->insert_id();
		}
		return $aid;
	}
	function deleteaddmission($studid,$courseid)
	{
		$this->db->query("delete  from student_admission_mst_t where Student_id='".$studid."' and Course_id='$courseid'");
	}
	function fetchlectures()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");	
		$result=array();
		$result['lectures']=array();
		$result['faculties']=array();
		$result=array();
		$courses=array("11", "9");
		foreach ($courses as $cid) {
			$query1=$this->db->query("SELECT  * FROM batch_mst_t where Course_id='$cid'");
			$batches= $query1->result();
			$cbatches=array();
			foreach ($batches as $batch) {
				$cbatches[]=$batch->Id;
			}
			$query1=$this->db->query("SELECT  * FROM lecture_mst_t where Lecture_date>='$date' and  SectionId='0'");
			$lectures= $query1->result();
			$faculties=array();
			$clectures=array();
			foreach ($lectures as $lect) {
				$bids=explode(",", $lect->BatchIds);
				$cbatch=array_intersect($cbatches,$bids);
				$lfaculties=array();
				if (count($cbatch)>0) {
					$clectures[]=$lect;
					$fids=explode(",", $lect->Faculty);
					foreach ($fids as $fid) {
						$query1=$this->db->query("SELECT  * FROM faculty_mst_t where Id='$fid'");
						$lfaculties[]= $query1->result();
					}
					$faculties[]=$lfaculties;
				}
			}
			$result['lectures'][]=$clectures;
			$result['faculties'][]=$faculties;
		}
		return $result;
	}
}
?>