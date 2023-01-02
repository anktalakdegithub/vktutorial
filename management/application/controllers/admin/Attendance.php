
<?php
require 'vendor/autoload.php';
require APPPATH.'/third_party/getid3/getid3.php';
use Aws\S3\S3Client;
class Attendance extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Course_Model'); 
		$this->load->model('Category_Model');
		$this->load->model('Lecture_Model'); 
		$this->load->model('Batch_Model'); 
		$this->load->model('Test_Model');
		$this->load->model('Spaces_Model');
		$this->load->model('User_Model');
		$this->load->model('Attendance_Model');
		$this->load->library('session'); 
		$this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn');
		$this->load->library('pagination');
	}
	public function index()
	{
		// echo 'hbhjcbhjd';
		date_default_timezone_set('Asia/Kolkata');
		if ($this->isadminLoggedIn) {
				$from_date = $this->input->get('from_date');
				$to_date = $this->input->get('to_date');
				$batch_id = $this->input->get('batch_id');
				$student_id = $this->input->get('student_id');
				$filter_date='';
				if($from_date!='' && $to_date!=''){
					if($batch_id==''){

					$filter_date= "where student_attendance.attendance_date>='$from_date' and student_attendance.attendance_date<='$to_date'";
					}
					else{

					$filter_date= "and student_attendance.attendance_date>='$from_date' and student_attendance.attendance_date<='$to_date'";
					}
				}
				else{
					$date=date('Y-m-d');
					if($batch_id==''){

					$filter_date= "where student_attendance.attendance_date='$date'";
					}
					else{

					$filter_date= "and student_attendance.attendance_date='$date'";
					}
				}
				$batch='';
				if($batch_id!=''){
					$batch  = "where student_batch_mst_t.BatchId='$batch_id'";
				}
				$student='';
				if($student_id!=''){
					$student  = "and student_attendance.student_id='$student_id'";
				}
				//echo "SELECT * FROM student_batch_mst_t join batch_mst_t on batch_mst_t.Id=student_batch_mst_t.BatchId join student_mst_t on student_mst_t.Id=student_batch_mst_t.StudentId left JOIN student_attendance on student_attendance.student_id=student_batch_mst_t.StudentId $student  $batch  $filter_date";
				$query2=$this->db->query("SELECT * FROM student_batch_mst_t join batch_mst_t on batch_mst_t.Id=student_batch_mst_t.BatchId join student_mst_t on student_mst_t.Id=student_batch_mst_t.StudentId left JOIN student_attendance on student_attendance.student_id=student_batch_mst_t.StudentId $student  $batch  $filter_date and student_mst_t.IsBlock='0'");
				
				$data['students']= $query2->result();
                //print_r(count($data['students']));
				foreach ($data['students'] as $stud) {
					$query2=$this->db->query("SELECT * FROM parents_mst_t where StudentId='$stud->Id'");
					$data['parents'][]= $query2->result();
				}
				$query2=$this->db->query("SELECT  * FROM batch_mst_t");
				$data['batches']= $query2->result();

				// if($this->input->get('batch_id') || $this->input->get('type')){
				// 	if($this->input->get('type') == 1){

				// 	}
				// 	$batch_id =$this->input->get('batch_id');
				// 	// echo "SELECT student_mst_t.FirstName, student_mst_t.LastName,student_mst_t.MiddleName, student_attendance.attendance_date, student_attendance.in_time, student_attendance.out_time FROM `student_mst_t` left join student_attendance on student_attendance.student_id=student_mst_t.Id left join student_batch_mst_t on student_batch_mst_t.StudentId=student_mst_t.Id and (student_attendance.attendance_date='$date' or student_batch_mst_t.BatchId='$batch_id')";
				// 	$query1=$this->db->query("SELECT student_mst_t.FirstName, student_mst_t.LastName,student_mst_t.MiddleName, student_attendance.attendance_date, student_attendance.in_time, student_attendance.out_time FROM `student_mst_t` left join student_attendance on student_attendance.student_id=student_mst_t.Id left join student_batch_mst_t on student_batch_mst_t.StudentId=student_mst_t.Id and (student_attendance.attendance_date='$date' or student_batch_mst_t.BatchId='$batch_id')");
			
				// 	$data['students']= $query1->result();

				// 	// echo '<pre>';
				// 	// print_r($data);
				// 	// die;


				// }else{
					
				// 	$query1=$this->db->query("SELECT student_mst_t.FirstName, student_mst_t.LastName,student_mst_t.MiddleName, student_attendance.attendance_date, student_attendance.in_time, student_attendance.out_time FROM `student_mst_t` left join student_attendance on student_attendance.student_id=student_mst_t.Id and student_attendance.attendance_date='$date'");
			
				// 	$data['students']= $query1->result();

				// }

				

				// $data['students']=$this->db->select('s.*')
				// 	->from('student_mst_t s')
				// 	->join('student_attendance sa', 'sa.student_id = s.Id ', 'left')
				// 	->where('sa.attendance_date', $date)
				// 	->get();

				// echo '<pre>';
				// print_r($data);
				// die;

				// $config = $this->pagination->pagination('attendance',$data['total'],$per_pg);  
				// $this->pagination->initialize($config);
				// $data['pagination'] = $this->pagination->create_links();

				
				
				// echo '<pre>';
				// print_r($students);
				// die;
				$this->load->view('admin/header');
				$this->load->view('admin/attendance',$data);
				$this->load->view('admin/footer');
			// }
			
		}
		else{
			redirect('admin/login');
		}
	}
	public function attendance_api(){
		if(!$this->isadminLoggedIn){ 
      		redirect('admin/login'); 
		}
		else{
			$query2=$this->db->query("SELECT  * FROM batch_mst_t");
			$data['batches']= $query2->result();
			$this->load->view('admin/header');
			$this->load->view('admin/attendance_api',$data);
			$this->load->view('admin/footer');
		}
	}

		public function attendanceapi()
	{
		date_default_timezone_set('Asia/Kolkata');
		if ($this->isadminLoggedIn) {
			$from_date = $this->input->post('from_date');
			$fdate = date("d/m/Y", strtotime($from_date));
			$batch_id = $this->input->post('batch_id');
			$query1=$this->db->query("SELECT * FROM student_batch_mst_t WHERE BatchId =$batch_id ORDER BY StudentId");
			$result['batch_master'] = $query1->result();	
			$curl_handle = curl_init();
			$url = 'https://api.etimeoffice.com/api/DownloadInOutPunchData?Empcode=ALL&FromDate='.$fdate.'&ToDate='.$fdate;
			curl_setopt($curl_handle, CURLOPT_URL, $url);
			curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
			));
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_handle, CURLOPT_USERPWD, 'VKTUTORIALS:Ravindra Kokate:vktutorials@123:true');
			//curl_setopt($curl_handle, CURLOPT_USERPWD, 'support:support:support:true');
			$curl_data = curl_exec($curl_handle);
			curl_close($curl_handle);
			$response_data = json_decode($curl_data, true);
			$html='';
			// echo "<pre>";
			// print_r($response_data);
			$i=0;
			foreach($result['batch_master'] as $bmrow) { 
				$stid=$bmrow->StudentId;
				$query2=$this->db->query("SELECT * FROM student_mst_t WHERE Id =$stid");
				$strow = $query2->row(); 
				$st_code=$strow->Student_Code;
				$st_name=$strow->FirstName.' '.$strow->LastName;
				foreach ($response_data['InOutPunchData'] as $key => $data) {
					$Empcode=$data['Empcode'];
					$INTime=$data['INTime'];
					$OUTTime=$data['OUTTime'];
					$Status=$data['Status'];
					$DateString=$data['DateString'];
					$Remark=$data['Remark'];
					if($stid == $Empcode) {
						$html.='<tr class="students" data-id="'.$Empcode.'"><td>'.$Empcode.'</td><td>'.$st_name.'</td><td><input type="time" name="in_time" class="in_time form-control" value="'.$INTime.'"/></td><td><input type="time" name="out_time" value="'.$OUTTime.'" class="out_time form-control"/></td><td><input type="checkbox" name="is_late" class="is_late"/></td><td>';
						if($Status == 'A') {
							$html.='<input type="checkbox" name="is_absent" class="is_absent" checked/>';
						} else {
							$html.='<input type="checkbox" name="is_absent" class="is_absent"/>';
						}
						$html.='</td><td><textarea class="form-control remark">'.$Remark.'</textarea></td></tr>';
						
					}
					else {
						// $html.='<tr class="students" data-id="'.$stid.'"><td>'.$stid.'</td><td>'.$st_name.'</td><td><input type="time" name="in_time" class="in_time form-control" value=""/></td><td><input type="time" name="out_time" value="" class="out_time form-control"/></td><td><input type="checkbox" name="is_late" class="is_late"/></td><td>';
						
						// 	$html.='<input type="checkbox" name="is_absent" class="is_absent"/>';
						
						// $html.='</td><td><textarea class="form-control remark"></textarea></td></tr>';
					}
				$i++;
				}
				
				
			}
			echo $html;		
		}
		else{
			redirect('admin/login');
		}
	}

	public function addattendanceapi(){
		$batch_id = $this->input->post('batch_id');
		$in_time = $this->input->post('in_time');
		$out_time = $this->input->post('out_time');
		$sids = $this->input->post('sids');
		$is_late = $this->input->post('is_late');
		$attendance_date = $this->input->post('attendance_date');
		$is_absent = $this->input->post('is_absent');
		$remark = $this->input->post('remark');
		$this->Attendance_Model->addattendanceapi($batch_id,$sids,$attendance_date,$in_time,$out_time,$is_late,$is_absent,$remark);

		$data=array();
		$data['code']="200";
		$data['msg']="Attendance added successfully.";
		echo json_encode($data);
	}
	public function attendance(){
		if ($this->isadminLoggedIn) {
			// $query2=$this->db->query("SELECT  * FROM course_mst_t");
			// $data['course']= $query2->result();
			// $query1=$this->db->query("SELECT  * FROM student_mst_t ORDER BY ID DESC limit 20");
			// $data['students']= $query1->result();
			$result=$this->Course_Model->fetchcourses();
			
	// print_r($result);
	// 		die;
			$this->load->view('admin/header');
			$this->load->view('admin/attendance_form',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
		
		// $result['categories']=$this->Category_Model->fetchcategories();
		// $result['faculties']=$this->User_Model->fetchfaculties();
		
	
	}
	public function addattendance(){
		$in_time = $this->input->post('in_time');
		$out_time = $this->input->post('out_time');
		$sids = $this->input->post('sids');
		$is_late = $this->input->post('is_late');
		$attendance_date = $this->input->post('attendance_date');
		$is_absent = $this->input->post('is_absent');
		$remark = $this->input->post('remark');
		$this->Attendance_Model->addattendance($sids,$attendance_date,$in_time,$out_time,$is_late,$is_absent,$remark);

		$data=array();
		$data['code']="200";
		$data['msg']="Attendance added successfully.";
		echo json_encode($data);
	}

	public function deleteattendance(){
		$id=$this->input->post('attendance_id');
		$this->Attendance_Model->deleteattendance($id);

	}
	public function update_attendance(){
		$in_time = $this->input->post('in_time');
		$out_time = $this->input->post('out_time');
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$is_late = $this->input->post('is_late');
		$attendance_date = $this->input->post('attendance_date');
		$is_absent = $this->input->post('is_absent');
		$remark = $this->input->post('remark');
		$this->Attendance_Model->update_attendance($id,$type,$attendance_date,$in_time,$out_time,$is_late,$is_absent,$remark);

		$data=array();
		$data['code']="200";
		$data['msg']="Attendance added successfully.";
		echo json_encode($data);
	}
	public function lacture_attendance(){
		// print_r($this->input->get());
		$id = $this->input->get('lecture_id');
		$query2=$this->db->query("SELECT  * FROM lectures_mst_t where lecture_id='$id'");
		$lacture = $query2->result();
		echo '<pre>';
		print_r($lacture[0]->lecture_id);
		die;
		$query1=$this->db->query("SELECT student_mst_t.FirstName, student_mst_t.LastName,student_mst_t.MiddleName, student_attendance.attendance_date, student_attendance.in_time, student_attendance.out_time FROM `student_mst_t` left join student_attendance on student_attendance.student_id=student_mst_t.Id where student_mst_t.IsBlock='0'");
			
		$data['students']= $query1->result();
		// $query1=$this->db->query("SELECT  * FROM student_mst_t");
				
		// $data['students']= $query1->result();
		// $query=$this->db->query("SELECT  * FROM student_attendance");
		
		// $data['attendance']= $query->result();

		$query2=$this->db->query("SELECT  * FROM batch_mst_t");
		
		$data['batches']= $query2->result();
		// echo '<pre>';
		// print_r($students);
		// die;
		$this->load->view('admin/header');
		$this->load->view('admin/lacture_attendance',$data);
		$this->load->view('admin/footer');
	}
}
