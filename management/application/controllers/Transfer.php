<?php
class Transfer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('text');
	  	$this->load->library('pagination');
	  	$this->load->model('Student_Model');
	  	$this->load->model('Lecture_Model'); 
	  	$this->load->model('Course_Model'); 
	  	$this->load->model('Setting_Model'); 
	  	$this->load->model('Blog_Model'); 
	  	$this->load->model('Test_Model'); 
        $this->load->library('form_validation'); 
	  	$this->isstudentLoggedIn = $this->session->userdata('isstudentLoggedIn'); 
	}
	public function index()
	{

		$llmall = $this->load->database('llmallonline', TRUE);
		$zeak = $this->load->database('zeak', TRUE);
		$query1=$llmall->query("SELECT  * FROM ps_customer");
		$customers= $query1->result();
		$query = 'insert into users(id,user_prefix,first_name,last_name,email,phone,password,user_id,sponsor_id,created_at,updated_at)values';
			foreach ($customers as $customer) {
			$user_prefix = 'Mr.';
			if($customer->id_gender==2){
				$user_prefix = 'Mrs.';
			}
			else if($customer->id_gender==3){
				$user_prefix = 'Miss.';
			}
			$first_name=$customer->firstname;
			$last_name=$customer->lastname;
			$email=$customer->email;
			$phone = $customer->phone;
			$sponsor_id=$customer->sponsor_id;
			$password=$customer->passwd;
			$user_id=$customer->phone;
			$created_at=$customer->date_add;
			$updated_at=$customer->date_upd;
			$customer_id=$customer->id_customer;
			    $query .= "('$customer_id','$user_prefix','$first_name','$last_name','$email','$phone','$password','$user_id','$sponsor_id','$created_at','$updated_at'),";
			
		}
		$query = rtrim( $query, ',');
			$zeak->query($query);
	}
}
?>