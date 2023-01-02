<?php
class Welcome extends CI_Controller
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
        $result=array();
        $result['courses']=$this->Course_Model->fetchhomecourses();
        $result['categories']=$this->Course_Model->fetchcoursecategories();
        $result['blogs']=$this->Blog_Model->fetchhomeposts();
        $header=array();
        $header['title']="Home";
        $result['cart_count']=$this->session->set_userdata('cart', '0');
        if($this->isstudentLoggedIn){
            $studid=$this->session->userdata('studid');
            $carts=$this->Course_Model->getcartdata($studid);
        $result['cart_count']=$this->session->set_userdata('cart', count($carts));
         }  
        $this->load->view('website/header',$header);
        $this->load->view('website/index',$result);
        $this->load->view('website/footer');
	}
    public function mycourses()
    {
        $result=array();
        $studid=$this->session->userdata('studid');
        $result['admissions']=$this->Course_Model->fetchstudcourses($studid);
        $header=array();
        $header['title']="Courses"; 
        $this->load->view('website/header',$header);
        $this->load->view('website/mycourses',$result);
        $this->load->view('website/footer');
    }
    public function institute(){
        $institute=$this->uri->segment(2);
            $query1=$this->db->query("SELECT  * FROM student_mst_t where FirstName='$institute' and Type='institute'");
            $student= $query1->result();
            $this->session->set_userdata('studdata', $student[0]);
            $data=array();
            $data['student']=$student;
            if($this->isstudentLoggedIn){ 
                redirect('institute/profile'); 
            }
            else{ 
                $result=array();
                $data['error_msg']='';
                $data['success_msg']='';
                if($this->input->post('loginSubmit')){ 
                    $email=$this->input->post('email');
                    $pass=$this->input->post('pass');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
                    $this->form_validation->set_rules('pass', 'Password', 'required'); 
                     
                    if($this->form_validation->run() == true){ 
                        $checkLogin = $this->Student_Model->checklogin($email); 
                        if(count($checkLogin)>0){ 
                            if($checkLogin[0]->Password!=md5($pass)){
                                  $data['error_msg'] = 'Please enter correct email address.'; 
                            }
                            else{
                                if($checkLogin[0]->Password!=md5($pass)){
                                      $data['error_msg'] = 'Please enter correct password.'; 
                                }
                                else{
                                  $this->session->set_userdata('isstudentLoggedIn', TRUE); 
                                  $this->session->set_userdata('studid', $checkLogin[0]->Id);
                                  $this->session->set_userdata('studdata', $checkLogin[0]);
                                  $this->session->set_userdata('type', 'institute');
                                  redirect('institute/courses'); 
                                }
                            }
                        }
                        else{ 
                            $data['error_msg'] = 'Wrong email or password, please try again.';  } 
                    }
                    else{ 
                        $data['error_msg'] = 'Please fill all the mandatory fields.'; 
                    } 
              
                }
                $this->load->view('institute/header',$data);
                $this->load->view('website/institute-login',$data);
                $this->load->view('institute/footer',$data);
          
            }
    }
}
