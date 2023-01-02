<?php
class Privacy extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('text');
	}
	public function index()
	{
		$header=array();
		$header['title']="Privacy Policy";	
		$this->load->view('website/header',$header);
		$this->load->view('website/privacy-policy');
		$this->load->view('website/footer');
	}

	
}
?>
