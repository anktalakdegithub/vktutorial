
<?php
class Api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Attendance_Model');
		$this->load->model('Lecture_Model');
        $this->load->model('Student_Model');
        $this->load->model('Setting_Model');
	}
   public function login()
    {
        $code='';
        $msg='';
        $studid="0";
        $sname='';
        $scode=$this->input->post('scode');
        $pass=$this->input->post('pass');
        $token=$this->input->post('token');

        $data=array();
        if(empty($scode)){
            $code="404";
            $msg="Please enter your student code.";
        }
        else if(empty($pass)){
            $code="404";
            $msg="Please enter your password.";
        }
        else{
            $result=$this->Student_Model->checklogin($scode);
            if (count($result)>0) {
               if($pass!=$result[0]->Password){
                    $code="404";
                    $msg="Please enter correct password.";
                }
                else{
                    $studid=$result[0]->Id;
                    $this->Student_Model->updatestudenttoken($studid,$token);
                    $data['studentdata']=$result[0];
        			$sname=$result[0]->FirstName.' '.$result[0]->LastName;
                    $code="200";
                    $msg="login successful.";
                }
            }
            else{
                $code="404";
                $msg="no account found.";
            }
        }
        $data['studid']=$studid;
        $data['sname']=$sname;
        $data['code']=$code;
        $data['msg']=$msg;
        echo json_encode($data);
    }
    public function countstudnotifications(){
        $student_id=$this->input->post('student_id');
         $result=$this->Attendance_Model->countstudnotifications($student_id);
         echo json_encode($result);
    }
    public function fetchnotifications(){
        $student_id=$this->input->post('student_id');
         $result=$this->Attendance_Model->fetchstudnotifications($student_id);
         echo json_encode($result);
    }
    public function sliders(){
         $result=$this->Setting_Model->fetchhomesldier();
         echo json_encode($result);
    }
    public function fees()
    {
        $student_id=$this->input->post('student_id');
        $result=$this->Attendance_Model->fetch_studfees($student_id);
        echo json_encode($result);
    }
	public function attendance()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$student_id=$this->input->post('student_id');
       	$result=$this->Attendance_Model->fetch_studattendance($from_date,$to_date,$student_id);
       	echo json_encode($result);
    }
	public function lectures()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$student_id=$this->input->post('student_id');
       	$result=$this->Attendance_Model->fetch_studlectures($from_date,$to_date,$student_id);
       	echo json_encode($result);
    }
    public function worksheets()
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $student_id=$this->input->post('student_id');
        $result=$this->Attendance_Model->fetch_studworksheet($from_date,$to_date,$student_id);
        echo json_encode($result);
    }
    public function assignments()
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $student_id=$this->input->post('student_id');
        $result=$this->Attendance_Model->fetch_studassignments($from_date,$to_date,$student_id);
        echo json_encode($result);
    }
    public function qwritings()
    {
         $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $student_id=$this->input->post('student_id');
        $result=$this->Attendance_Model->fetch_studqwritings($from_date,$to_date,$student_id);
        echo json_encode($result);
    }
    public function exams()
    {
        
        //print_r($this->input->post('student_id'));
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $student_id=$this->input->post('student_id');
        $result=$this->Attendance_Model->fetch_studexams($from_date,$to_date,$student_id);
        echo json_encode($result);
    }
    public function counsellings()
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $student_id=$this->input->post('student_id');
        $result=$this->Attendance_Model->fetch_studcounsellings($from_date,$to_date,$student_id);
        echo json_encode($result);
    }
}
?>
