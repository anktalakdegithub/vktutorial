<?php
//header('Access-Control-Allow-Origin: *');

require 'vendor/autoload.php';
use Aws\S3\S3Client;
class Sms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Student_Model');
        $this->load->model('Notification_Model');
        $this->load->model('Spaces_Model');
        $this->load->model('Batch_Model');
        $this->load->model('Sms_Model');
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
            $this->load->view('admin/send_sms',$result);
            $this->load->view('admin/footer');
        }
    }

    public function send()
    {
        $phone="7506464369";
        $msg="Hello";
        $url = "http://164.52.212.19:6005/api/v2/SendSMS";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'ApiKey=NH+W/OCqlPh8H/ydSpwJPsZd0JY15p8iRIX3Bv9/rEo=&ClientId=097be2ac-703f-4211-9857-ac5a7a297113&SenderId=SMSADS&Message=Hello&MobileNumbers=918369782692');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        echo $result;
    }
    public function send_sms()
    {
        $smstemplate=$this->input->post('smstemplate');
        $astudents=implode(",", $this->input->post('students'));
        $msg=$this->input->post('message');
        $result=$this->Student_Model->studentids($astudents);
        $data['numbers']=implode(",",array_column($result['students'], 'Phone'));
        echo json_encode($data);
        // $nos=array();
        // if(!empty($smstemplate)){
        //     $scodes=array();
        //     $sids=array();
        //     $msgs=array();
        //     $mobs=array();
        //     foreach ($result['students'] as $student) {
        //         $smsg=nl2br("Dear ".$student->FirstName.",".$msg);
        //         $msgs[]=$smsg;
        //         $phone=$student->Phone;
        //         if ($phone!="") {
        //             $sids[]=$student->Id;
        //             $mobs[]=$phone;
        //         }
        //     }
        //     $asms="Dear <name>, ".$msg;
        //     $msgid=$this->Sms_Model->addgroupsms($sids,$asms);
        //   //  $this->send_backgroundsms($msgid,$mobs,$msgs);
        //     $result=array();
        //     $result['msgid']=$msgid;
        //     $result['mobs']=$mobs;
        //     $result['msgs']=$msgs;
        //     $data=json_encode($result);
        //   $this->send_backgroundsms($data);
            //$url = base_url()."admin/sms/send_backgroundsm";
          //  $command = "php ".FCPATH."index.php admin/sms send_backgroundsms $data > /dev/null &";
       // print_r(exec($command));
//API URL
/*$url=base_url()."admin/sms/send_backgroundsms";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);
//print_r($output);
//Print error if any
if(curl_errno($ch))
{
  //  echo 'error:' . curl_error($ch);
}

curl_close($ch);
*/
        // }
        // else{
        //     echo "please select a template";
        // }   
               // $this->Sms_Model->send_sms($smstemplate,$cid,$msg);
    }
    function send_backgroundsms($data)
    {
        $i=0;
        $result=json_decode($data);
        $mobs=$result->mobs;
        $msgs=$result->msgs;
        $msgid=$result->msgid;
        $scodes=array();
        foreach ($mobs as $phone) {
            $response=json_decode($this->Sms_Model->send_sms($phone,$msgs[$i]));
            $scodes[]=$response[1]->msgid;
            $i++;
        }
        $this->Sms_Model->update_smscodes($msgid,$scodes);
        return $result;
    }
    function get_sms_delivery_status(){
        /*$url="http://sms.hspsms.com/getDLR?username=RELIABLEACADEMY&msgid=572870402&apikey=92b22b47-a854-4b0f-8212-bdbe3b0ec51e";
        //  Initiate curl
    $ch = curl_init();
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);

    print_r(json_decode($result));*/

    }
    function view_history(){
        if(!$this->isadminLoggedIn){ 
            redirect('admin/login'); 
        }
        else{ 
            $this->session->set_userdata('startid',0);
            $this->load->view('admin/header');
            $this->load->view('admin/sms_history');
            $this->load->view('admin/footer');
        }
    }
    function fetchsms(){
        $startid=$this->session->userdata('startid');
        $result=$this->Sms_Model->fetchallsms($startid);
        $output='';
        foreach ($result as $sms) {
            $sids=explode(",", $sms->StudentId);
            $this->session->set_userdata('startid',$sms->Id);
            $output.='
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fas fa-sms"></i>&nbsp;'.$sms->Message.'</p>
                    <p><i class="fas fa-calendar"></i> '.$sms->Sending_Time.' &nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'admin/sms/view_students/'.$sms->Id.'">students('.count($sids).')</a></p>
                </div>
            </div><hr>';
        }
        echo $output;
    }
    function fetch_monthly_sms()
    {
        $month=$this->input->post('month');
        $year=$this->input->post('year');
        $result=$this->Sms_Model->fetch_monthly_sms($month,$year);
        $output='';
        foreach ($result as $sms) {
            $sids=explode(",", $sms->StudentId);
            $this->session->set_userdata('startid',$sms->Id);
            $output.='
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fas fa-sms"></i>&nbsp;'.$sms->Message.'</p>
                    <p><i class="fas fa-calendar"></i> '.$sms->Sending_Time.' &nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'admin/sms/view_students/'.$sms->Id.'">students('.count($sids).')</a></p>
                </div>
            </div><hr>';
        }
        echo $output;
    }
    function view_students(){
        if(!$this->isadminLoggedIn){ 
            redirect('admin/login'); 
        }
        else{ 
            $result=array();
            $msgid=$this->uri->segment(4);
            $result=$this->Sms_Model->fetch_sms_students($msgid);
            if (count($result['sms'])>0) {
                $this->load->view('admin/header');
                $this->load->view('admin/view_sms_students',$result);
                $this->load->view('admin/footer');
            }
            else{
                show_404();
            }
        }
    }
}