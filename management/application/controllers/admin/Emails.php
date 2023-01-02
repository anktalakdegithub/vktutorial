<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
class Emails extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Student_Model');
		$this->load->model('Course_Model');
		$this->load->model('Batch_Model');
		$this->load->model('Notification_Model');
		$this->load->library('session'); 
		   $this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn'); 
    }
    public function index()
    {
        if(!$this->isadminLoggedIn){ 
            redirect('admin/login'); 
        }
        else{ 
            $result=array();
            $result['students']=$this->Student_Model->fetchallstudents();
            $result['batches']=$this->Batch_Model->fetchbatches();
            $this->load->view('admin/header');
            $this->load->view('admin/send_email',$result);
            $this->load->view('admin/footer');
        }
    }
     public function sendemail()
    {
        $title=$this->input->post('title');
        $astudents=$this->input->post('students');
        $msg=$this->input->post('message');
        $result=$this->Student_Model->studentids($astudents);
        $emails = array_column($result, "Email");
       $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.zoho.com',
          'smtp_port' => 465,
          'smtp_user' => 'contact@classblue.in', // change it to yours
          'smtp_pass' => 'AccTech@101', // change it to yours
          'mailtype' => 'html',
          'charset' => 'utf-8', //iso-8859-1
          'wordwrap' => TRUE,
          'newline' => "\r\n"
    );

    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from('contact@classblue.in');
    $this->email->to($emails);
    $this->email->subject($title);
    $this->email->message($msg);
    //$this->email->attach($path.'/'.$file_name);

    if($this->email->send())
    {
    }
    else
    {
    }
    }
}
?>