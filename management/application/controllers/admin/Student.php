<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
class Student extends CI_Controller
{
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->model('Student_Model'); 
	$this->load->model('Batch_Model'); 
	$this->load->model('Setting_Model'); 
	$this->load->model('Fees_Model'); 
	$this->load->model('Lecture_Model'); 
  	$this->load->model('Spaces_Model');
	$this->load->model('Course_Model'); 
  	$this->load->model('Test_Model');
	$this->load->library('email');
	$this->load->library('session'); 
	$this->load->library('form_validation'); 
	$this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn'); 
    
	}
	public function index()
	{
		if ($this->isadminLoggedIn) {
		$result=array();
		$result['courses']=$this->Course_Model->allcourses();
		$result['batches']=$this->Batch_Model->fetchbatches();
		$this->session->set_userdata('startid',0);
		$this->load->view('admin/header');
		$this->load->view('admin/students',$result);
		$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	public function studentdetails()
	{
		if ($this->isadminLoggedIn) {
			$result=array();
			$sid=$this->uri->segment(4);
			$result=$this->Student_Model->fetchstudentdetails($sid);
			$result['acourses']=$this->Course_Model->fetchcourses();
			//$result['aseries']=$this->Test_Model->getmcqtests();
			$result['pmethod']=$this->Setting_Model->fetchpaymentcategories();
			$result['obatches']=$this->Batch_Model->fetchbatches();
			//$result['obatches']=$this->Test_Model->fetchstudenttests($sid);
			
			$this->load->view('admin/header');
			$this->load->view('admin/studentdetails',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	public function student_attendance()
	{
		$result=array();
		$sid=$this->uri->segment(4);
		$result['lectures']=$this->Lecture_Model->fetchstudentattendance($sid);
		$this->load->view('admin/student_attendance',$result);
	}
	public function student_assignments()
	{
		$result=array();
		$sid=$this->uri->segment(4);
		$result['assignments']=$this->Assignment_Model->fetchstudentpassignments($sid);
		$this->load->view('admin/student_assignments',$result);
	}
	public function student_tests()
	{
		$result=array();
		$sid=$this->uri->segment(4);
		$result=$this->Assignment_Model->student_tests($sid);
		$this->load->view('admin/student_tests',$result);
	}
	function addcourse()
	{
		$sid=$this->input->post('sid');
		$cid=$this->input->post('cid');
		$access=$this->input->post('access');
		$result=$this->Student_Model->addcourse($sid,$cid,$access);
	}
	function addseries()
	{
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$result=$this->Student_Model->addseries($sid,$tid);
	}
	function removecourse()
	{
		$sid=$this->input->post('sid');
		$cid=$this->input->post('cid');
		$result=$this->Student_Model->removecourse($sid,$cid);
	}
	function removeseries()
	{
		$sid=$this->input->post('sid');
		$tid=$this->input->post('tid');
		$result=$this->Student_Model->removeseries($sid,$tid);
	}
	function blockstudent()
	{
		$sid=$this->input->post('sid');
		$this->Student_Model->blockstudent($sid);
	}
	function unblockstudent()
	{
		$sid=$this->input->post('sid');
		$this->Student_Model->unblockstudent($sid);
	}
	public function fetchstudents()
	{
		$page=$this->input->post('page');
		$limit=$this->input->post('limit');
		$batch_id=$this->input->post('batch_id');
		$course_id=$this->input->post('course_id');
		$result=$this->Student_Model->fetchstudents($page,$limit,$course_id,$batch_id);
		$result['obatches']=$this->Batch_Model->fetchbatches();
		$output='';
		$page=0;
		$i=0;
		if(count($result['students'])>0){
		foreach ($result['students'] as $stud) {
			$this->session->set_userdata('startid',$stud->Id);
			$page=$stud->Id;
			$query2=$this->db->query("SELECT * FROM parents_mst_t where StudentId='$stud->Id'");
			$parents= $query2->result();
			$output.='<div class="row"><div class="col-md-9" style="">
			<h4><a href="'.base_url().'admin/student/studentdetails/'.$stud->Id.'">'.$stud->FirstName.' '.$stud->LastName.'</a></h4>
			<p><span><i class="fas fa-envelope"></i>&nbsp; '.$stud->Email.'</span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; '.$stud->Phone.',';
			 $j=0;
                          foreach ($parents as $parent) {
                            if($i==(count($parents)-1))
                            {
                            $output.=$parent->Phone;
                            }
                            else{
                            $output.=$parent->Phone.',';
                            }
                           $j++;
                          }
			$output.='</span></p>';
			$batches=array();
			if(count($result['batches'][$i])>0){
				$output.='<p> Batches: ';
			foreach ($result['batches'][$i] as $batch) {
				$batches[]=$batch->Id;
				$output.=$batch->Name.',';

			}
			$output.='</p>';
		}
			$output.='</div><div class="col-md-3">';
			$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#changePassword_'.$stud->Id.'">change password</button>
			<br><br>' ;
			if(count($result['batches'][$i])==0){
				$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#assignModel_'.$stud->Id.'">assign batch</button>' ;
		
		}
		else{
			$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#changeModel_'.$stud->Id.'">change batch</button>' ;
		}
			$output.='</div></div><hr>';
			$output.=' <div class="modal" id="assignModel_'.$stud->Id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Assign Batch</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              		<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label>
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="batch_'.$stud->Id.'">';		
								foreach($result['obatches'] as $batch){
									if(in_array($batch->Id, $batches)){
									$output.='<option value="'.$batch->Id.'" selected>'.$batch->Name.'</option>';
								}
								else{

									$output.='<option value="'.$batch->Id.'">'.$batch->Name.'</option>';
								}						
								}
							$output.='</select>
						</div>
							
						<br>
						<div id="msg_"></div>
						<button data-direction="next" class="assign btn btn-default steps_btn" value="'.$stud->Id.'">assign</button>	
			
					</div>
				</div>
			</div>
		</div>
		<div class="modal" id="changeModel_'.$stud->Id.'">
            <div class="modal-dialog">
                <div class="modal-content">
					<div class="modal-header">
                        <h3>Change Batch</h3>
                    </div>
                      <!-- Modal body -->
                    <div class="modal-body">
                      	<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label>
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="cbatch_'.$stud->Id.'">';		
								foreach($result['obatches'] as $batch){
									if(in_array($batch->Id, $batches)){
										$output.='<option value="'.$batch->Id.'" selected>'.$batch->Name.'</option>';
									}
									else{

										$output.='<option value="'.$batch->Id.'">'.$batch->Name.'</option>';
									}						
								}					
							$output.='</select>
						</div>
						<br>
						<div id="msg_"></div>
						<button data-direction="next" class="change btn btn-default steps_btn" value="'.$stud->Id.'">assign</button>	
					</div>
				</div>
			</div>
		</div>
		<div class="modal" id="changePassword_'.$stud->Id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Change Password</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              <div class="row">
                              <div class="col-md-12">
                              		<div class="ui search focus mt-30 lbel25">
							<input class="prompt srch_explore" type="text" placeholder="Enter new password" id="npass_'.$stud->Id.'" data-purpose="edit-course-title">        
						</div>
							
						<br>
						<div id="cpmsg_'.$stud->Id.'"></div>
						<button data-direction="next" class="pchange btn btn-default steps_btn" value="'.$stud->Id.'">Change</button>	
			</div>
			</div>
					</div>
				</div>
			</div>
		</div>';
							$i++;
		}
}
		$data=array('page'=>$page, 'output'=>$output);
		echo json_encode($data);
	}
	public function filterbatchstudent()
	{
		$id=$this->input->post('id');
		$result=$this->Student_Model->filterbatchstudent($id);
		$result['obatches']=$this->Batch_Model->fetchbatches();
		$output='';
		$i=0;
		if(count($result['students'])>0){
		foreach ($result['students'] as $stud) {
			$this->session->set_userdata('startid',$stud->Id);
			$output.='<div class="row"><div class="col-md-9" style="">
			<a href="'.base_url().'admin/student/studentdetails/'.$stud->Id.'"><h4>'.$stud->FirstName.' '.$stud->LastName.'</h4></a>
			<p><span><i class="fas fa-envelope"></i>&nbsp; '.$stud->Email.'</span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; '.$stud->Phone.'</span></p>';
			$batches=array();
			if(count($result['batches'][$i])>0){
				$output.='<p> Batches: ';
			foreach ($result['batches'][$i] as $batch) {
				$batches[]=$batch->Id;
				$output.=$batch->Name.',';

			}
			$output.='</p>';
		}
			$output.='</div><div class="col-md-3">';
			$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#changePassword_'.$stud->Id.'">change password</button>
			<br><br>' ;
			if(count($result['batches'][$i])==0){
				$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#assignModel_'.$stud->Id.'">assign batch</button>' ;
		
		}
		else{
			$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#changeModel_'.$stud->Id.'">change batch</button>' ;
		}
			$output.='</div></div><hr>';
			$output.=' <div class="modal" id="assignModel_'.$stud->Id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Assign Batch</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              		<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label>
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="batch_'.$stud->Id.'">';		
								foreach($result['obatches'] as $batch){
									if(in_array($batch->Id, $batches)){
									$output.='<option value="'.$batch->Id.'" selected>'.$batch->Name.'</option>';
								}
								else{

									$output.='<option value="'.$batch->Id.'">'.$batch->Name.'</option>';
								}						
								}
							$output.='</select>
						</div>
							
						<br>
						<div id="msg_"></div>
						<button data-direction="next" class="assign btn btn-default steps_btn" value="'.$stud->Id.'">assign</button>	
			
					</div>
				</div>
			</div>
		</div><div class="modal" id="changeModel_'.$stud->Id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Change Batch</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              		<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label>
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="cbatch_'.$stud->Id.'">';		
								foreach($result['obatches'] as $batch){
									if(in_array($batch->Id, $batches)){
									$output.='<option value="'.$batch->Id.'" selected>'.$batch->Name.'</option>';
								}
								else{

									$output.='<option value="'.$batch->Id.'">'.$batch->Name.'</option>';
								}						
								}					
							$output.='</select>
						</div>
							
						<br>
						<div id="msg_"></div>
						<button data-direction="next" class="change btn btn-default steps_btn" value="'.$stud->Id.'">assign</button>	
			
					</div>
				</div>
			</div>
		</div>
		<div class="modal" id="changePassword_'.$stud->Id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Change Password</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              <div class="row">
                              <div class="col-md-12">
                              		<div class="ui search focus mt-30 lbel25">
							<input class="prompt srch_explore" type="text" placeholder="Enter new password" id="npass_'.$stud->Id.'" data-purpose="edit-course-title">        
						</div>
							
						<br>
						<div id="cpmsg_'.$stud->Id.'"></div>
						<button data-direction="next" class="pchange btn btn-default steps_btn" value="'.$stud->Id.'">Change</button>	
			</div>
			</div>
					</div>
				</div>
			</div>
		</div>';
							$i++;
		}
		$output.='<script>	 $(function () {
        $(".multiselectdrop").multiselect({
            //includeSelectAllOption: true
        });
    });
    </script>';
}
		echo $output;
	}
	public function addfeesdetail(){
		$batch=$this->input->post('batch');
		$fees=$this->input->post('fees');
		$tfees=$this->input->post('tfees');
		$discount=$this->input->post('discount');
		$apaid=$this->input->post('apaid');
		$payment=$this->input->post('payment');
		$aremaining=$this->input->post('aremaining');
		$iamount=$this->input->post('iamount');
		$itype=$this->input->post('itype');
		$noi=$this->input->post('noi');
		$idate=$this->input->post('idate');
		$id=$this->input->post("sid");
		$this->Student_Model->addfeesdetail($id,$batch,$fees,$tfees,$discount,$apaid,$payment,$aremaining,$iamount,$itype,$noi,$idate);
		$code="200";
		$msg="Student fees added sucessfully.";
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function searchsmsstudents()
	{
		$search=$this->input->post('search');
		$bid=$this->input->post('bid');
		$result['students']=$this->Student_Model->searchsmsstudents($search,$bid);
		echo json_encode($result);
	}
	public function fetchbatchtudents(){
		$bid=$this->input->post('bid');
		$result['students']=$this->Student_Model->fetchbatchtudents($bid);
		echo json_encode($result);
	}
	public function searchstudents()
	{
		$search=$this->input->post('search');
		$result=$this->Student_Model->searchstudents($search);
		$result['obatches']=$this->Batch_Model->fetchbatches();
		$output='';
		$i=0;
		if(count($result['students'])>0){
		foreach ($result['students'] as $stud) {
			$this->session->set_userdata('startid',$stud->Id);
			$output.='<div class="row"><div class="col-md-9" style="">
			<a href="'.base_url().'admin/student/studentdetails/'.$stud->Id.'"><h4>'.$stud->FirstName.' '.$stud->LastName.'</h4></a>
              <p><strong>Student Code:</strong>'.$stud->Student_Code.'&nbsp;&nbsp;<strong>Password:</strong>'.$stud->Password.'</p>
			<p><span><i class="fas fa-envelope"></i>&nbsp; '.$stud->Email.'</span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; '.$stud->Phone.'</span></p>';
			$batches=array();
			if(count($result['batches'][$i])>0){
				$output.='<p> Batches: ';
			foreach ($result['batches'][$i] as $batch) {
				$batches[]=$batch->Id;
				$output.=$batch->Name.',';

			}
			$output.='</p>';
		}
			$output.='</div><div class="col-md-3">';
			$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#changePassword_'.$stud->Id.'">change password</button>
			<br><br>' ;
			if(count($result['batches'][$i])==0){
				$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#assignModel_'.$stud->Id.'">assign batch</button>' ;
		
		}
		else{
			$output.='<button class="btn btn-outline-primary" data-toggle="modal" data-target="#changeModel_'.$stud->Id.'">change batch</button>' ;
		}
			$output.='</div></div><hr>';
			$output.=' <div class="modal" id="assignModel_'.$stud->Id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Assign Batch</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              		<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label>
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="batch_'.$stud->Id.'">';		
								foreach($result['obatches'] as $batch){
									if(in_array($batch->Id, $batches)){
									$output.='<option value="'.$batch->Id.'" selected>'.$batch->Name.'</option>';
								}
								else{

									$output.='<option value="'.$batch->Id.'">'.$batch->Name.'</option>';
								}						
								}
							$output.='</select>
						</div>
							
						<br>
						<div id="msg_"></div>
						<button data-direction="next" class="assign btn btn-default steps_btn" value="'.$stud->Id.'">assign</button>	
			
					</div>
				</div>
			</div>
		</div><div class="modal" id="changeModel_'.$stud->Id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Change Batch</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              		<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label>
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="cbatch_'.$stud->Id.'">';		
								foreach($result['obatches'] as $batch){
									if(in_array($batch->Id, $batches)){
									$output.='<option value="'.$batch->Id.'" selected>'.$batch->Name.'</option>';
								}
								else{

									$output.='<option value="'.$batch->Id.'">'.$batch->Name.'</option>';
								}						
								}					
							$output.='</select>
						</div>
							
						<br>
						<div id="msg_"></div>
						<button data-direction="next" class="change btn btn-default steps_btn" value="'.$stud->Id.'">assign</button>	
			
					</div>
				</div>
			</div>
		</div>
		<div class="modal" id="changePassword_'.$stud->Id.'">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Change Password</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              <div class="row">
                              <div class="col-md-12">
                              		<div class="ui search focus mt-30 lbel25">
							<input class="prompt srch_explore" type="text" placeholder="Enter new password" id="npass_'.$stud->Id.'" data-purpose="edit-course-title">        
						</div>
							
						<br>
						<div id="cpmsg_'.$stud->Id.'"></div>
						<button data-direction="next" class="pchange btn btn-default steps_btn" value="'.$stud->Id.'">Change</button>	
			</div>
			</div>
					</div>
				</div>
			</div>
		</div>';
							$i++;
		}
		$output.='<script>	 $(function () {
        $(".multiselectdrop").multiselect({
            //includeSelectAllOption: true
        });
    });
    </script>';
}
		echo $output;
	}
	public function newstudent()
	{
		$result=array();
		$result['batches']=$this->Batch_Model->fetchbatches();
		$result['isources']=$this->Setting_Model->fetchinquirysource();
		$result['pcategory']=$this->Setting_Model->fetchpaymentcategories();
		$this->load->view('admin/header');
		$this->load->view('admin/newstudent',$result);
		$this->load->view('admin/footer');
	}
	public function assignbatch()
	{
		$sid=$this->input->post('sid');
		$bid=$this->input->post('batch');
		$this->Student_Model->assignbatch($sid,$bid);
	}
	public function changepassword()
	{
		$sid=$this->input->post('sid');
		$pass=$this->input->post('pass');
		$this->Student_Model->changepassword($sid,$pass);
	}
	public function changebatch()
	{
		$sid=$this->input->post('sid');
		$bid=$this->input->post('batch');
		$this->Student_Model->changebatch($sid,$bid);
	}
	public function addadmission(){
		$batch=$this->input->post('batch');
		$id=$this->input->post("studid");
		$fees=$this->input->post("fees");
		$tfees=$this->input->post("tfees");
		$discount=$this->input->post("discount");
		$note=$this->input->post("note");
		$data=array();
		$code="200";
		$msg='';
		if(empty($batch)){
			$code="404";
			$msg="Please select a batch.";
		}
		else{
			$data=$this->Student_Model->addadmission($id,$batch,$fees,$tfees,$discount,$note);
			$code="200";
			$msg="Student added sucessfully.";
		}
			$data['code']=$code;
			$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addstudent()
	{
		$fname=$this->input->post('fname');
		$mname=$this->input->post('mname');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$gender=$this->input->post('gender');
		$dob=$this->input->post('dob');
		$address=$this->input->post('address');
		$city=$this->input->post('city');
		$state=$this->input->post('state');
		$pincode=$this->input->post('pincode');
		$photo=$this->input->post('file');
		$isource=$this->input->post('isource');
		$type=$this->input->post('type');
		$batches=$this->input->post('batches');
		$code='';
		$msg='';
		$id=0;
		if (empty($fname) || empty($lname)) {
			$code='404';
			$msg='First & last name of student is required.';
		}
		else if (empty($email)) {
			$code='404';
			$msg='Please enter email address.';
		}
		else if(empty($phone)){
			$code="404";
			$msg="Please enter mobile number.";
		}
		else if(!empty($phone) && !preg_match('/^\d{10}$/',$phone)){
			$code="404";
			$msg="Please enter correct mobile number format.";
		}
		else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
			$code="404";
			$msg="Invalid email format.";
		}
		else{
			$result=$this->Student_Model->checklogin($email);
			if(count($result)>0){
				$code="404";
				$msg="Account already exists.";
			}
			else{
				$image="";
				if(!empty( $_FILES["file"]["name"])){
					$newname=str_replace(' ', '', $_FILES["file"]["name"]);
					$iname=explode(".", $newname);
					$randname=$iname[0].md5(rand()) . '.' . $iname[count($iname)-1];
					//print_r($fname);			
					$_FILES['file']['name']     = $randname;
			        $_FILES['file']['type']     = $_FILES['file']['type'];
			        $_FILES['file']['tmp_name'] = $_FILES['file']['tmp_name'];
			        $_FILES['file']['error']    = $_FILES['file']['error'];
			        $_FILES['file']['size']     = $_FILES['file']['size'];
			        $dir = dirname($_FILES["file"]["tmp_name"]);
	                $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
	                rename($_FILES["file"]["tmp_name"], $destination);       
					$key='kokateclasses/students/'.$_FILES["file"]["name"];
	          	$this->Spaces_Model->upload_file($key,$destination);
	          	$image = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
              	}
                $id=$this->Student_Model->addstudentadmission($fname,$mname,$lname,$phone,$email,$address,$city,$state,$pincode,$image,$gender,$dob,$isource,$type,$batches);
				$code='200';
				$msg='Student added successfully.';
			}
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		$data['id']=$id;
		echo json_encode($data);
	}
	public function addparents()
	{
		$studid=$this->input->post('studid');
		$fname=$this->input->post('fname');
		$mname=$this->input->post('mname');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$addressing=$this->input->post('addressing');
		$relation=$this->input->post('relation');
		$occupation=$this->input->post('occupation');
		$id=0;
		$code='';
		$msg='';
		if (empty($fname) || empty($lname)) {
			$code='404';
			$msg='First & last name of student is required.';
		}
		// else if (empty($email)) {
		// 	$code='404';
		// 	$msg='Please enter email address.';
		// }
		else if(empty($phone)){
			$code="404";
			$msg="Please enter mobile number.";
		}
		else if(!empty($phone) && !preg_match('/^\d{10}$/',$phone)){
			$code="404";
			$msg="Please enter correct mobile number format.";
		}
		else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
			$code="404";
			$msg="Invalid email format.";
		}
		else{
			// $result=$this->Student_Model->checkparent($email);
			// if(count($result)>0){
			// 	$code="404";
			// 	$msg="Account already exists.";
			// }
			// else{
                $id=$this->Student_Model->addparents($studid,$fname,$mname,$lname,$phone,$email,$addressing,$relation,$occupation);
				$code='200';
				$msg='Parent added successfully.';
			//}
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		$data['id']=$id;
		echo json_encode($data);
	}

	public function updateparent()
	{
		$id=$this->input->post('id');
		$fname=$this->input->post('fname');
		$mname=$this->input->post('mname');
		$lname=$this->input->post('lname');
		$occupation=$this->input->post('occupation');
		$relation=$this->input->post('relation');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$addressing=$this->input->post('addressing');
		$code="";
		$msg="";
		if(empty($fname)){
			$code="404";
			$msg="First name required.";
		}
		else if(empty($lname)){
			$code="404";
			$msg="Last name required.";
		}
		else if(empty($phone)){
			$code="404";
			$msg="phone number required.";
		}
		else if(!preg_match('/^\d{10}$/',$phone)){
			$code="404";
			$msg="Please enter correct mobile number format.";
		}
		else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
			$code="404";
			$msg="Invalid email format.";
		}
		else{
			$this->Student_Model->updateparent($id,$addressing,$fname,$mname,$lname,$email,$phone,$relation,$occupation);
			$code="200";
			$msg="Details updated successfully.";
		}
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function deleteparent(){
		$id=$this->input->post('id');
		$this->Student_Model->deleteparent($id);

	}
	public function deletefees(){
		$fees_id=$this->input->post('fees_id');
		$this->Fees_Model->deletefees($fees_id);

	}
	public function updatestudent()
	{
		$sid=$this->input->post('sid');
		$fname=$this->input->post('fname');
		$mname=$this->input->post('mname');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$gender=$this->input->post('gender');
		$password=$this->input->post('password');
		$dob=$this->input->post('dob');
		$address=$this->input->post('address');
		$city=$this->input->post('city');
		$state=$this->input->post('state');
		$pincode=$this->input->post('pincode');
		$image=$this->input->post('ephoto');
		$code='';
		$msg='';
		$id=0;
		if (empty($fname) || empty($lname)) {
			$code='404';
			$msg='First & last name of student is required.';
		}
		else if (empty($email)) {
			$code='404';
			$msg='Please enter email address.';
		}
		else if(empty($phone)){
			$code="404";
			$msg="Please enter mobile number.";
		}
		/*else if(!empty($phone) && !preg_match('/^\d{10}$/',$phone)){
			$code="404";
			$msg="Please enter correct mobile number format.";
		}*/
		else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
			$code="404";
			$msg="Invalid email format.";
		}
		else{
			if(!empty( $_FILES["photo"]["name"])){
				$newname=str_replace(' ', '', $_FILES["photo"]["name"]);
				$iname=explode(".", $newname);
				$randname=$iname[0].md5(rand()) . '.' . $iname[count($iname)-1];
				//print_r($fname);			
				$_FILES['file']['name']     = $randname;
		        $_FILES['file']['type']     = $_FILES['photo']['type'];
		        $_FILES['file']['tmp_name'] = $_FILES['photo']['tmp_name'];
		        $_FILES['file']['error']    = $_FILES['photo']['error'];
		        $_FILES['file']['size']     = $_FILES['photo']['size'];
		        $dir = dirname($_FILES["file"]["tmp_name"]);
                $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
                rename($_FILES["file"]["tmp_name"], $destination);
				$key='kokateclasses/students/'.$_FILES["file"]["name"];
	          	$this->Spaces_Model->upload_file($key,$destination);
	          	$image = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
          	}
            $id=$this->Student_Model->updatestudent($sid,$fname,$mname,$lname,$phone,$email,$password,$address,$city,$state,$pincode,$image,$gender,$dob);
			$code='200';
			$msg='Student added successfully.';
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addpayment(){
		$batch=$this->input->post('batch');
		$tfees=$this->input->post('tfees');
		$apaid=$this->input->post('apaid');
		$payment=$this->input->post('pmethod');
		$pstatus=$this->input->post('pstatus');
		$aremaining=$this->input->post('aremaining');
		$iamount=$this->input->post('iamount');
		$itype=$this->input->post('itype');
		$noi=$this->input->post('noi');
		$idate=$this->input->post('idate');
		$id=$this->input->post("studid");
		$this->Student_Model->addpayments($id,$batch,$tfees,$apaid,$payment,$pstatus,$aremaining,$iamount,$itype,$noi,$idate);
		$code="200";
				$msg="Student added sucessfully.";
			$data['code']=$code;
			$data['msg']=$msg;
		echo json_encode($data);
	}	
	public function Importexcel(){
		$batch=$this->input->post('batch');
		 $path = './assets/images/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);    
                if(!empty( $_FILES["file"]["name"])){        
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                  
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                 
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    $code='200';
                    $msg='';
                    foreach ($allDataInSheet as $value) {
                    if($flag){
                        $flag =false;
                        continue;
                      }

                      $inserdata[$i]['FirstName'] = $value['A'];
                      $inserdata[$i]['MiddleName'] = $value['B'];
                      $inserdata[$i]['LastName'] = $value['C'];
                      $inserdata[$i]['Email'] = $value['D'];
                      $inserdata[$i]['Phone'] = $value['E'];
                      if(!preg_match('/^\d{10}$/',$inserdata[$i]['Phone'])){
			$code="404";
			$msg="Please enter correct mobile number format.";
		}
		 else if (empty($email) && !filter_var($inserdata[$i]['Email'], FILTER_VALIDATE_EMAIL)){
			$code="404";
			$msg="Invalid email format.";
		}
		         else if(!empty($inserdata[$i]['PPhone']) && !preg_match('/^\d{10}$/',$inserdata[$i]['PPhone'])){
			$code="404";
			$msg="Please enter correct mobile number format.";
		}
		 else if (!empty($email) && !filter_var($inserdata[$i]['PEmail'], FILTER_VALIDATE_EMAIL)){
			$code="404";
			$msg="Invalid email format.";
		}
	
                       $i++;
                    }  
                    if($code=="200"){             
                     $this->Student_Model->Importexcel($batch,$inserdata);   
                         $code="200";
                     $msg="Student imported successfully."; 
                     }          
      	
              } catch (Exception $e) {
                   $code="400";
                   $msg=die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
                }
              }
              else{
              	$code="404";
                     $msg=$error['error'];
                }
                $data=array();
                $data['code']=$code;
                $data['msg']=$msg;
                echo json_encode($data); 
                }
                else
                {
                	 $data=array();
                $data['code']="404";
                $data['msg']="Please select an excel file.";
                echo json_encode($data);     
                }

     } 
    public function updatefeestatus(){
		$pstatus=$this->input->post('pstatus');
		$id=$this->input->post('id');
    	$aid=$this->session->userdata('academic_id');
		$iamount=$this->input->post('iamount');
		$pamount=$this->input->post('pamount');
		$pmethod=$this->input->post('pmethod');
    	$pdate=$this->input->post('pdate');
		$studid=$this->input->post('studid');
	    $remaining=$this->input->post('remaining');
	    $code="";
	    $msg="";
	    if(empty($pamount)){
	      $code="404";
	      $msg="Please enter paid amount.";
	    }
	    else if($pamount>$remaining){
	      $code="404";
	      $msg="Please enter amount less then or equal to amount remaining.";
	    }
	    else{
	  		$this->Student_Model->updatefeestatus($aid,$id,$studid,$pstatus,$iamount,$pamount,$pmethod,$pdate,$remaining);
	      $code="200";
	      $msg="Status updated successfully.";
	  	}
	    $data=array();
	    $data['code']=$code;
	    $data['msg']=$msg;
	    echo json_encode($data);
  	}
    public function updatefees(){
		$pstatus=$this->input->post('pstatus');
		$id=$this->input->post('id');
		$iamount=$this->input->post('iamount');
    	$idate=$this->input->post('idate');
		$studid=$this->input->post('studid');
	  //  $remaining=$this->input->post('remaining');
	    $code="";
	    $msg="";
	  		$this->Fees_Model->updatefees($id,$iamount,$idate);
	      $code="200";
	      $msg="Status updated successfully.";
	  	
	    $data=array();
	    $data['code']=$code;
	    $data['msg']=$msg;
	    echo json_encode($data);
  	}
}
?>