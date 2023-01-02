<?php
class Report extends CI_Controller 
{
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->model('Fees_Model');
	$this->load->model('Setting_Model');
    $this->load->model('Batch_Model');
    $this->load->model('Student_Model');  
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

	public function index(){
		if(!$this->isadminLoggedIn){ 
        redirect('admin/login'); 
        }
        else{
            $query2=$this->db->query("SELECT * FROM student_mst_t ");
                    
            $data['students']= $query2->result();
            $query2=$this->db->query("SELECT  * FROM batch_mst_t");
            $data['batches']= $query2->result();

            // $result=$this->Fees_Model->totalfees();
            $this->load->view('admin/header');
            $this->load->view('admin/report',$data);
            $this->load->view('admin/footer');
        }
	}
    public function send_sms(){
		if(!$this->isadminLoggedIn){ 
        redirect('admin/login'); 
        }
        else{
            // $query2=$this->db->query("SELECT * FROM student_mst_t ");
                    
            // $data['students']= $query2->result();

            // $result=$this->Fees_Model->totalfees();
            $this->load->view('admin/header');
            $this->load->view('admin/test_send_sms');
            $this->load->view('admin/footer');
        }
	}
    public function filter_report(){
		if(!$this->isadminLoggedIn){ 
        redirect('admin/login'); 
        }
        else{
            $student_id = $this->input->get('student_id');
		    $from_date = $this->input->get('from_date');
		    $to_date = $this->input->get('to_date');
            $batch_id = $this->input->get('batch_id');
            $output = '';
            $name='';
            $batch_name='';
$query=$this->db->query("SELECT * FROM batch_mst_t where Id = '$batch_id' ");
            $batch= $query->result();
            foreach($batch as $bt){ 
              $batch_name=$bt->Name;
            }
            $query2=$this->db->query("SELECT * FROM student_mst_t where Id = '$student_id' ");
            // $query2=$this->Course_Model->student_data($student_id);
            $students= $query2->result();
            // echo 
foreach($students as $stu){
                $name=$stu->FirstName.' '.$stu->MiddleName.' '.$stu->LastName;
    $start4 = $month4 = strtotime($from_date);
    $end4 = strtotime($to_date);
    $qq= 0;
    while($month4 < $end4)
    {
        
         $month4 = strtotime("+1 month", $month4);
       ++$qq ;
    }
    $qq =$qq*2;
    $start = $month = strtotime($from_date);
    $end = strtotime($to_date);
    $ii= 0;
    $attendance = array();
    $attendance['present']=array();
    $attendance['absent']=array();
    $worksheet['cworksheet']=array();
    $worksheet['uworksheet']=array();
    $assignment['cassignment']=array();
    $assignment['uassignment']=array();
    $qw['cqw']=array();
    $qw['uqw']=array();
    $exam['pass']=array();
    $exam['fail']=array();
    $months=array();
    while($month < $end)
    {
        $mnt1 = date('Y-m-d', $month);

        $query2=$this->db->query("SELECT count(student_id) as present FROM student_attendance WHERE MONTH(`attendance_date`) = MONTH('$mnt1') AND YEAR(`attendance_date`) = YEAR('$mnt1') AND `student_id`= '$student_id' and is_absent='0'");
        $students= $query2->result();
        $attendance['present'][] = $students[0]->present;
         $query2=$this->db->query("SELECT count(student_id) as absent FROM student_attendance WHERE MONTH(`attendance_date`) = MONTH('$mnt1') AND YEAR(`attendance_date`) = YEAR('$mnt1') AND `student_id`= '$student_id' and is_absent='1'");
        $students= $query2->result();
        $attendance['absent'][] = $students[0]->absent;
         $query2=$this->db->query("SELECT count(worksheet_submitted.student_id) as cworksheet FROM worksheets_mst_t join worksheet_submitted on worksheet_submitted.worksheet_id=worksheets_mst_t.worksheet_id WHERE MONTH(worksheets_mst_t.submission_date) = MONTH('$mnt1') AND YEAR(worksheets_mst_t.submission_date) = YEAR('$mnt1') AND worksheet_submitted.student_id= '$student_id' and worksheet_submitted.is_submitted='1'");
        $students= $query2->result();
        $worksheet['cworksheet'][] = $students[0]->cworksheet;
         $query2=$this->db->query("SELECT count(worksheet_submitted.student_id) as uworksheet FROM worksheets_mst_t join worksheet_submitted on worksheet_submitted.worksheet_id=worksheets_mst_t.worksheet_id WHERE MONTH(worksheets_mst_t.submission_date) = MONTH('$mnt1') AND YEAR(worksheets_mst_t.submission_date) = YEAR('$mnt1') AND worksheet_submitted.student_id= '$student_id' and worksheet_submitted.is_submitted='0'");
        $students= $query2->result();
        $worksheet['uworksheet'][] = $students[0]->uworksheet;
         $query2=$this->db->query("SELECT count(assignment_submitted.student_id) as cassignment FROM assignments_mst_t join assignment_submitted on assignment_submitted.assignment_id=assignments_mst_t.id WHERE MONTH(assignments_mst_t.submission_date) = MONTH('$mnt1') AND YEAR(assignments_mst_t.submission_date) = YEAR('$mnt1') AND assignment_submitted.student_id= '$student_id' and assignment_submitted.is_submitted='1'");
        $students= $query2->result();
        $assignment['cassignment'][] = $students[0]->cassignment;
         $query2=$this->db->query("SELECT count(assignment_submitted.student_id) as uassignment FROM assignments_mst_t join assignment_submitted on assignment_submitted.assignment_id=assignments_mst_t.id WHERE MONTH(assignments_mst_t.submission_date) = MONTH('$mnt1') AND YEAR(assignments_mst_t.submission_date) = YEAR('$mnt1') AND assignment_submitted.student_id= '$student_id' and assignment_submitted.is_submitted='0'");
        $students= $query2->result();
        $assignment['uassignment'][] = $students[0]->uassignment;
       $query2=$this->db->query("SELECT count(qw_submitted.student_id) as cqw FROM question_writing_mst_t join qw_submitted on qw_submitted.qw_id=question_writing_mst_t.question_id WHERE MONTH(question_writing_mst_t.qw_date) = MONTH('$mnt1') AND YEAR(question_writing_mst_t.qw_date) = YEAR('$mnt1') AND qw_submitted.student_id= '$student_id' and qw_submitted.is_submitted='1'");
        $students= $query2->result();
        $qw['cqw'][] = $students[0]->cqw;
         $query2=$this->db->query("SELECT count(qw_submitted.student_id) as uqw FROM question_writing_mst_t join qw_submitted on qw_submitted.qw_id=question_writing_mst_t.question_id WHERE MONTH(question_writing_mst_t.qw_date) = MONTH('$mnt1') AND YEAR(question_writing_mst_t.qw_date) = YEAR('$mnt1') AND qw_submitted.student_id= '$student_id' and qw_submitted.is_submitted='0'");
        $students= $query2->result();
        $qw['uqw'][] = $students[0]->uqw;
        $query2=$this->db->query("SELECT count(exam_results.student_id) as pass FROM exams_mst_t join exam_results on exam_results.exam_id=exams_mst_t.exam_id WHERE MONTH(exams_mst_t.exam_date) = MONTH('$mnt1') AND YEAR(exams_mst_t.exam_date) = YEAR('$mnt1') AND exam_results.student_id= '$student_id' and exam_results.marks>=exams_mst_t.passing_marks");
$students= $query2->result();
$exam['pass'][] = $students[0]->pass;
$query2=$this->db->query("SELECT count(exam_results.student_id) as fail FROM exams_mst_t join exam_results on exam_results.exam_id=exams_mst_t.exam_id WHERE MONTH(exams_mst_t.exam_date) = MONTH('$mnt1') AND YEAR(exams_mst_t.exam_date) = YEAR('$mnt1') AND exam_results.student_id= '$student_id' and exam_results.marks<exams_mst_t.passing_marks");
$students= $query2->result();
$exam['fail'][] = $students[0]->fail;
        // print_r("SELECT count(student_id) as present FROM student_attendance WHERE MONTH(`attendance_date`) = MONTH('$mnt1') AND YEAR(`attendance_date`) = YEAR('$mnt1') AND `student_id`= '$student_id'");
        $mnt = date('F', $month);
       $months[]=$mnt;
      
         $month = strtotime("+1 month", $month);
       ++$ii ;
    }
    //  <tr rowspan= "5">
    //    <th colspan = "'.$qq.'">Kokate Coaching Class</th>
      
    // </tr>
    //  <tr rowspan= "5">
    //    <td colspan = "'.$qq.'">
    //    Name:- '.$stu->FirstName.' '.$stu->LastName.'<br>
    //    Address:- '.$stu->Address.'<br>
    //    Std.:- '.$stu->Student_Code.'<br>
    //    Batch:- '.$stu->Type.'<br>
    //    Gender:- '.$stu->Gender.'<br>
       
       
    //    </td>
      
    // </tr>
    $output .= ' 
    <div class="row p-md-3 w-100">
    <div class="col-md-12"><h2 style="display: block;text-align: center;">Report</h2><br>
    </div>
    <div class="col-md-6">
        <p><strong>Student Name: </strong>'.$name.'</p>
        <p><strong>Batch Name: </strong>'.$batch_name.'</p>
        </div>
         <div class="col-md-6">
        <p><strong>Report Date: </strong>'.$from_date.'-'.$to_date.'</p>
        </div>
    </div><br>
    <table class="table table-bordered table-hover center" border = "5">
   <tbody>
   
    <tr rowspan= "5" style="background: #0056b9;">
       <th colspan = "'.$qq.'"  class="text-white"><strong>Attendence </strong></th>
      
    </tr>
    <tr>';
    foreach ($months as $month) {
      $output.='<th colspan="2"><strong>'.$month.'</strong></th>';
    }
    $output.='
    </tr> 
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th>A</th>';
        $output.='<th >P</th>';
    }  
      
       $output.='  
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$attendance['absent'][$i].'</a></th>';
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$attendance['present'][$i].'</a></th>';
    }  
      
       $output.='  
    </tr>
      <tr rowspan= "5" style="background: #1f9275;">
       <th colspan = "'.$qq.'"  class="text-white"><strong>Worksheets</strong></th>
      
    </tr>
    <tr>';
    foreach ($months as $month) {
      $output.='<th colspan="2"><strong>'.$month.'</strong></th>';
    }
    $output.='
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th>C</th>';
        $output.='<th >U</th>';
    }  
      
       $output.='  
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$worksheet['cworksheet'][$i].'</a></th>';
        $output.='<th ><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$worksheet['uworksheet'][$i].'</a></th>';
    }  
      
       $output.='  
    </tr>
      <tr rowspan= "5" style="background: #750f69;">
       <th colspan = "'.$qq.'"  class="text-white"><strong>Assignments</strong></th>
      
    </tr>
    <tr>';
    foreach ($months as $month) {
      $output.='<th colspan="2"><strong>'.$month.'</strong></th>';
    }
    $output.='
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th>C</th>';
        $output.='<th >U</th>';
    }  
      
       $output.='  
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$assignment['cassignment'][$i].'</a></th>';
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$assignment['uassignment'][$i].'</a></th>';
    }  
      
       $output.='  
    </tr>  
    <tr rowspan= "5" style="background: #877a00;">
       <th colspan = "'.$qq.'"  class="text-white"><strong>Oral & Writing</strong></th>
      
    </tr>
    <tr>';
    foreach ($months as $month) {
      $output.='<th colspan="2"><strong>'.$month.'</strong></th>';
    }
    $output.='
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th>C</th>';
        $output.='<th >U</th>';
    }  
      
       $output.='  
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$qw['cqw'][$i].'</a></th>';
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$qw['uqw'][$i].'</a></th>';
    }  
      
       $output.='  
    </tr>
      <tr rowspan= "5" style="background: #863131;">
       <th colspan = "'.$qq.'"  class="text-white"><strong>Exams</strong></th>
      
    </tr>
    <tr>';
    foreach ($months as $month) {
      $output.='<th colspan="2"><strong>'.$month.'</strong></th>';
    }
    $output.='
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th>P</th>';
        $output.='<th >F</th>';
    }  
      
       $output.='  
    </tr>
   
    <tr>';
    $ii= $ii*2;
    for($i=0;$i<count($months);$i++)
    {
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$exam['pass'][$i].'</a></th>';
        $output.='<th><a href="'.base_url().'admin/batch/batch_details/'.$batch_id.'?student_id='.$student_id.'&from_date='.$from_date.'&to_date='.$to_date.'">'.$exam['fail'][$i].'</a></th>';
    }  
      
       $output.='  
    </tr>
    </tbody>
   
 </table>';
}
           
echo $output;
// print_r($query2);
            // $result=$this->Fees_Model->totalfees();
            // $this->load->view('admin/header');
            // $this->load->view('admin/report',$data);
            // $this->load->view('admin/footer');
        }
	}
	
  
}
?>