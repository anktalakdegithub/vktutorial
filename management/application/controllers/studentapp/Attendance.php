
<?php
class Attendance extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}
	public function index()
	{
       echo "okay";
    //    return "okay";
        echo $this->post('user_id');
        echo $this->input->post('user_id');
    }
}
?>