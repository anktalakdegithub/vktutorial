<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
// require APPPATH . '/libraries/REST_Controller.php';

class Attendance extends CI_Controller {
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
		$this->load->library('session'); 
		$this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn');
		$this->load->library('pagination');
	}
    public function check_in() {
        // echo 'shbsjcbj';
        // echo $this->post('user_id');
        // echo $this->input->post('user_id');
         $user_id = $this->input->get('user_id');

        // $tid=$this->uri->segment(4);
		
        //returns all rows if the id parameter doesn't exist,
        //otherwise single row will be returned
        // $users = $this->user->getRows($id);
        
        // //check if the user data exists
        // if(!empty($users)){
        //     //set the response and exit
        //     $this->response($users, REST_Controller::HTTP_OK);
        // }else{
        //     //set the response and exit
        //     $this->response([
        //         'status' => FALSE,
        //         'message' => 'No user were found.'
        //     ], REST_Controller::HTTP_NOT_FOUND);
        // }
    }
    
    public function lecture_list() {
        // echo 'jnjfdnvkj';
        $result=$this->Course_Model->fetchlecture($user_id);
// print_r($result);
        echo json_encode($result) ;
        // $userData = array();
        // $userData['first_name'] = $this->post('first_name');
        // $userData['last_name'] = $this->post('last_name');
        // $userData['email'] = $this->post('email');
        // $userData['phone'] = $this->post('phone');
        // if(!empty($userData['first_name']) && !empty($userData['last_name']) && !empty($userData['email']) && !empty($userData['phone'])){
        //     //insert user data
        //     $insert = $this->user->insert($userData);
            
        //     //check if the user data inserted
        //     if($insert){
        //         //set the response and exit
        //         $this->response([
        //             'status' => TRUE,
        //             'message' => 'User has been added successfully.'
        //         ], REST_Controller::HTTP_OK);
        //     }else{
        //         //set the response and exit
        //         $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
        //     }
        // }else{
        //     //set the response and exit
        //     $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
        // }
    }
    
    public function user_put() {
        $userData = array();
        $id = $this->put('id');
        $userData['first_name'] = $this->put('first_name');
        $userData['last_name'] = $this->put('last_name');
        $userData['email'] = $this->put('email');
        $userData['phone'] = $this->put('phone');
        if(!empty($id) && !empty($userData['first_name']) && !empty($userData['last_name']) && !empty($userData['email']) && !empty($userData['phone'])){
            //update user data
            $update = $this->user->update($userData, $id);
            
            //check if the user data updated
            if($update){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete user information to update.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function user_delete($id){
        //check whether post id is not empty
        if($id){
            //delete post
            $delete = $this->user->delete($id);
            
            if($delete){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User has been removed successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }  
}

?>