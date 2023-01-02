<?php
class Login extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Student_Model'); 
        $this->load->library('session'); 
        $this->load->library('form_validation'); 
        $this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn'); 
        $this->load->modeL('User_Model');
	}
    public function index(){ 
        if($this->isadminLoggedIn){ 
            // redirect('admin/batch'); 
            redirect('admin/academic_year'); 
        }
        else{ 
        	$data=array();
        	$data['error_msg']='';
        	$data['success_msg']='';
        if($this->input->post('loginSubmit')){ 
        	$email=$this->input->post('email');
        	$pass=$this->input->post('pass');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            $this->form_validation->set_rules('pass', 'Password', 'required'); 
             
            if($this->form_validation->run() == true){ 
                $checkLogin = $this->User_Model->checkuser($email); 
                if(count($checkLogin)>0){ 
                    if($checkLogin[0]->Password!=md5($pass)){
                          $data['error_msg'] = 'Please enter correct password.'; 
                    }
                    else{
                      $this->session->set_userdata('isadminLoggedIn', TRUE); 
                      $this->session->set_userdata('userid', $checkLogin[0]->Id);
                      $access=json_decode($checkLogin[0]->Access);
                      $this->session->set_userdata('access', $access);
                      $this->session->set_userdata('role', $checkLogin[0]->Role);
                      $this->session->set_userdata('teacherid', $checkLogin[0]->TeacherId);
                    //   redirect('admin/dashboard'); 
                      redirect('admin/academic_year'); 
                    }
                }
                else{ 
                    $data['error_msg'] = 'Wrong email or password, please try again.';	} 
            }
            else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
          
        }
              // Load view 
        $this->load->view('admin/login',$data);
      
        } 
         
     /*
        else
        {
            $title=array();
        $title['title']="";
        $title['keywords']="Classblue";
            $this->load->view('website/header',$title);
        $this->load->view('website/404page');
        $this->load->view('website/footer');
        }
       }
        else{
           redirect('subdomain');
        }
         }*/
    } 

    public function logout(){ 
        $this->session->unset_userdata('isadminLoggedIn'); 
        $this->session->unset_userdata('userId'); 
        $this->session->sess_destroy(); 
        redirect('admin/login'); 
    } 
     
}
?>