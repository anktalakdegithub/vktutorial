<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
class Faculty extends CI_Controller
{
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->model('Faculty_Model'); 
	$this->load->model('Lecture_Model'); 
	$this->load->model('Salary_Model'); 
	$this->load->model('Spaces_Model'); 
	$this->load->library('session'); 
	$this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn');
	}
	public function index()
	{
		if ($this->isadminLoggedIn) {
		$result['faculties']=$this->Faculty_Model->fetchfaculties();
		$this->load->view('admin/header');
		$this->load->view('admin/faculty',$result);
		$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
	public function addfaculty()
	{
		$fname=$this->input->post('fname');
		$mname=$this->input->post('mname');
		$pass=$this->input->post('pass');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$facebook=$this->input->post('facebook');
		$twitter=$this->input->post('twitter');
		$linkedin=$this->input->post('linkedin');
		$youtube=$this->input->post('youtube');
		$code='';
		$msg='';
		if (empty($fname) || empty($lname)) {
			$code='404';
			$msg='first & last name of faculty is required.';
		}
		else if (empty($pass)) {
			$code='404';
			$msg='Please enter password.';
		}
		else if (empty($email)) {
			$code='404';
			$msg='Please enter email address.';
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
			$tphoto="";
			if(!empty( $_FILES["photo"]["name"])){
					
				$newname=str_replace(' ', '', $_FILES["photo"]["name"]);
				$iname=explode(".", $newname);
						$randname=date('Ymdhis'). '.' . $iname[count($iname)-1];
				
				$_FILES['file']['name']     = $randname;
		        $_FILES['file']['type']     = $_FILES['photo']['type'];
		        $_FILES['file']['tmp_name'] = $_FILES['photo']['tmp_name'];
		        $_FILES['file']['error']    = $_FILES['photo']['error'];
		        $_FILES['file']['size']     = $_FILES['photo']['size'];
		        $dir = dirname($_FILES["file"]["tmp_name"]);
	            $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
	            rename($_FILES["file"]["tmp_name"], $destination);
				  $key='kokateclasses/faculties/'.$_FILES["file"]["name"];
		          $this->Spaces_Model->upload_file($key,$destination);
		          $tphoto = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
			
				//	$msg="Student added sucessfully.";	
			}
			$result=$this->Faculty_Model->checklogin($email);
			if(count($result)>0){
				$code="404";
				$msg="Account already exists.";
			}
			else{
				 
                 $this->Faculty_Model->addfaculty($fname,$mname,$lname,$phone,$email,$pass,$tphoto,$facebook,$twitter,$linkedin,$youtube);
				$code='200';
				$msg='Student added successfully.';
			}
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
		public function updatefaculty()
	{
		$fname=$this->input->post('fname');
		$mname=$this->input->post('mname');
		$pass=$this->input->post('pass');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$pass=$this->input->post('pass');
		$id=$this->input->post('id');
		$facebook=$this->input->post('facebook');
		$twitter=$this->input->post('twitter');
		$linkedin=$this->input->post('linkedin');
		$youtube=$this->input->post('youtube');
		$ephoto=$this->input->post('ephoto');
		$code='';
		$msg='';
		if (empty($fname) || empty($lname)) {
			$code='404';
			$msg='first & last name of faculty is required.';
		}
		else if (empty($email)) {
			$code='404';
			$msg='Please enter email address.';
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
			$result=$this->Faculty_Model->checklogin($email);
			if(count($result)>1){
				$code="404";
				$msg="Account already exists.";
			}
			else{
			
				$tphoto="";
				if(!empty( $_FILES["photo"]["name"])){
					$newname=str_replace(' ', '', $_FILES["photo"]["name"]);
					$iname=explode(".", $newname);
							$randname=$fname[0].md5(rand()) . '.' . $fname[count($iname)-1];
				//print_r($fname);			
					$_FILES['file']['name']     = $randname;
			        $_FILES['file']['type']     = $_FILES['photo']['type'];
			        $_FILES['file']['tmp_name'] = $_FILES['photo']['tmp_name'];
			        $_FILES['file']['error']    = $_FILES['photo']['error'];
			        $_FILES['file']['size']     = $_FILES['photo']['size'];
			        $dir = dirname($_FILES["file"]["tmp_name"]);
		            $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
		            rename($_FILES["file"]["tmp_name"], $destination);
					  $key='kokateclasses/faculties/'.$_FILES["file"]["name"];
			          $this->Spaces_Model->upload_file($key,$destination);
			          $tphoto = 'https://arkdes.sgp1.cdn.digitaloceanspaces.com/'.$key;
					if ($ephoto!="") {
						$url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$ephoto);
            			$this->Spaces_Model->delete_file($url);
					}
					//	$msg="Student added sucessfully.";	
				}
				else{
					$tphoto=$ephoto;
				}	 
                 $this->Faculty_Model->updatefaculty($id,$fname,$mname,$lname,$phone,$email,$pass,$tphoto,$facebook,$twitter,$linkedin,$youtube);
				$code='200';
				$msg='Student added successfully.';
			}
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function deletefaculty()
{
	$id=$this->input->post('id');
	$this->Faculty_Model->deletefaculty($id);
}
public function facultydetails()
	{
		if ($this->isadminLoggedIn) {
			$id=$this->uri->segment(4);
			date_default_timezone_set('Asia/Kolkata');
			$year=date("Y");
			$month=date("m");
			$result=$this->Faculty_Model->fetchfacultydetails($id);
			$result['lectures']=$this->Lecture_Model->faculty_month_lectures($id,$month,$year);
			$result['salaries']=$this->Salary_Model->faculty_salaries($id);
			$this->load->view('admin/header');
			$this->load->view('admin/facultydetails',$result);
			$this->load->view('admin/footer');
		}
		else{
			redirect('admin/login');
		}
	}
}
?>