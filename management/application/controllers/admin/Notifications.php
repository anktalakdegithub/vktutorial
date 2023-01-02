<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
class Notifications extends CI_Controller {

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
            $this->load->view('admin/send_notification',$result);
            $this->load->view('admin/footer');
        }
    }
     public function sendnotification()
    {
        $astudents=explode(",",$this->input->post('students'));
        $msg=$this->input->post('message');
        $result=$this->Student_Model->studentdevicetokens($astudents);
  $this->Notification_Model->addstudnotifications($astudents,$msg);
        $tokens = array_column($result, "token");
            $url = 'https://fcm.googleapis.com/fcm/send';
			$priority="high";
			$notification= array('title' => $msg, 
				'body' => '',
			  'sound' => 'default',
			  "icon" => "https://arkdes.in/assets/website/img/logo.png"
			);
			$fields = array(
			 'registration_ids' => $tokens,
			 'notification' => $notification
			);


			$headers = array(
			  'Authorization:key=AAAA70R-RoQ:APA91bFDQSWOuYq7KcbHnA7OV36e3eploF7sLrkP7dcRnrtTwztRfzZJMRx5OrTpqb-5-uPCRX0v9UVRTZ_v_kDGQM0WD1c8SUv0rpoGV9VAnccVo0Bxf-jUDpJomp8xudG5JO1nmlXs',
			  'Content-Type: application/json'
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch); 
			print_r($result);
			if ($result === FALSE) {
			 die('Curl failed: ' . curl_error($ch));
			}
			curl_close($ch);
    }
}
?>