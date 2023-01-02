<?php
require 'vendor/autoload.php';
require APPPATH.'/third_party/getid3/getid3.php';
use Aws\S3\S3Client;
class Academic_year extends CI_Controller
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
		if ($this->isadminLoggedIn) {
		$result['ayears']=$this->Batch_Model->allacademicyears();
		$this->load->view('admin/academic_year',$result);
		}
		else{
			redirect('admin/login');
		}
	}
	public function selectacademic(){
		$aid=$this->input->post('ayear');
		$this->session->set_userdata('ayear', $aid);
		redirect('/admin/dashboard');
	}

}
?>