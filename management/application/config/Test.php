<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Test extends CI_Controller {

    public function __construct()
	{
  	parent::__construct();
  	$this->load->database();
  	$this->load->helper('url');
  	$this->load->model('Test_Model');
    $this->load->model('Batch_Model');
    $this->load->model('Spaces_Model');
    $this->load->model('Student_Model');
  	$this->load->library('session'); 
    $this->isadminLoggedIn = $this->session->userdata('isadminLoggedIn'); 
  }

	public function index()
	{
		if (!$this->isadminLoggedIn) {
            		redirect('admin/login'); 
        	}
        	else{ 
        		$result=array();
        		$result=$this->Test_Model->getmcqtests();
    			$this->load->view('admin/header');         
			$this->load->view('admin/mcqtests',$result);
            		$this->load->view('admin/footer');
		}
	}
  public function filterbatchstudent()
  {
    $id=$this->input->post('id');
    $result=$this->Student_Model->filterbatchstudent($id);
    $output='';
    $i=0;
    if(count($result['students'])>0){
    foreach ($result['students'] as $stud) {
      $output.='<div class="row">
      <div class="col-md-1"><input type="checkbox" name="student" value="'.$stud->Id.'"></div>
      <div class="col-md-9" style="">
      <h4>'.$stud->FirstName.' '.$stud->LastName.'</h4>
      <p><span><i class="fas fa-envelope"></i>&nbsp; '.$stud->Email.'</span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; '.$stud->Phone.'</span></p>';
      $output.='</div></div><hr>';
              $i++;
    }
    
}
    echo $output;
  }
  function sort_order_tests(){
    $sids=$this->input->post('sids');
    $this->Test_Model->sort_order_tests($sids);
  }
  function accesstest(){
    $id=$this->input->post('id');
    $isaccessible=$this->input->post('isaccessible');
    $this->Test_Model->accesstest($id,$isaccessible);
  }
	public function fetchcmcqtests()
	{
		$orgid=$this->session->userdata("orgid");
        $branchid=$this->session->userdata("branchid");
        $cid=$this->input->post('cid');
        $result=$this->Test_Model->fetchcmcqtests($orgid,$branchid,$cid);
        $output='';
        if(count($result['mcqtests'])>0){
        	  $output.='<br>';
          $i=0;
          foreach ($result['mcqtests'] as $row) {
           $output.='<div class="row">
              <div class="col-md-9">
                <h4><a href="'.base_url().'/mcqtest/testdetails/'.$row->Id.'">'.$row->Title.'</a>
                ';
                	if($row->Tags!=""){
                		$output.='<span class="badge badge-info" style="font-size: 10px;">'.$row->Tags.'</span>';
                	}
                	$output.='</h4>
                <p>Courses:';
                 foreach ($result['courses'][$i] as $course) {
                $output.='<span>'.$course->Name.',</span>';
                }
                $output.='&nbsp;&nbsp; 
                <span><i class="fas fa-clock"></i> '.$row->CreatedAt.'</span></p>
              </div>
              <div class="col-md-3">
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModel_'.$row->Id.'" style="border-radius: 0px;">Edit</button>
                   <button type="button" class="btn btn-default" data-toggle="modal" data-target="#deleteModel_'.$row->Id.'" style="border-radius: 0px;">Delete</button>
              </div>
            </div><hr>
                <div class="modal" id="editModel_'.$row->Id.'">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Test</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row container">
          <div class="col-md-12">
             <div class="form-group row">
              <label>Title:</label>
              <input type="text" class="form-control" rows="4" id="title_'.$row->Id.'" value="'.$row->Title.'"/>
            </div>
            <div class="form-group row">
              <label>Description:</label>
              <textarea class="form-control" rows="4" id="desc_'.$row->Id.'" value="'.$row->Description.'"></textarea>
            </div>
            <div class="form-group row">
              <label>Tag:</label>
              <input type="text" class="form-control" rows="4" id="tag_'.$row->Id.'" value="'.$row->Tags.'"/>
            </div>
          </div>
          <br>
          <div id="msg_'.$row->Id.'"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="update btn btn-success" value="'.$row->Id.'">Update</button>
      </div>
    </div>
  </div>  
</div>
 <div class="modal" id="deleteModel_'.$row->Id.'">
  <div class="modal-dialog">
    <div class="modal-content moda-sm">
      <div class="modal-body text-center">
        <h5>Are you sure you want to delete this test.?</h5><br>
        <button type="button" class="btn btn-default" class="close" data-dismiss="modal">No</button>
        <button type="button" class="delete btn btn-danger" value="'.$row->Id.'">Yes</button>
      </div>
    </div>
  </div>
</div>';
           $i++;
          }
        }
        echo $output;
	}
	public function viewresults()
	{
		if(!$this->isadminLoggedIn){ 
            redirect('admin/login'); 
        }
        else{ 
        	$studid=$this->uri->segment(5);
        	$examid=$this->uri->segment(4);
        	$result=array();
        	$result=$this->Test_Model->getstudresults($examid,$studid);
		       
        $this->load->view('admin/header');
			  $this->load->view('admin/viewresults',$result);
        $this->load->view('admin/footer');
		}
	}
	function publishexam()
	{
		$examid=$this->input->post('id');
		$this->Test_Model->publishexam($examid);
	}
	public function fetchmcqtests()
	{
		$orgid=$this->session->userdata("orgid");
    	$branchid=$this->session->userdata("branchid");
    	$aid=$this->session->userdata("academic_id");
    	$limit=$this->input->post('limit');
    	$result=array();
    	$result['tests']=$this->Test_Model->fetchmcqtests($orgid,$branchid,$aid,$limit);
    	$output='';
    	if(count($result['tests'])>0){
    		foreach ($result['tests'] as $row) {
    			$this->session->set_userdata('mcqtest',$row->Id);
    			$duration=explode(":", $row->Duration);
    			$output.='<div class="row">
    						 <div class="col-md-12">
	    						 <h4><a href="'.base_url().'mcqtests/mcqtestdetails/'.$row->Id.'"">'.$row->ExamName.'</a></h4>
	    						 <p><span><strong>Marks: </strong>'.$row->Marks.'</span>&nbsp;&nbsp;&nbsp;<span><strong>Total Questions: </strong>'.$row->TotalQuestions.'</span>&nbsp;&nbsp;&nbsp;<span><strong>Total Duration:  </strong>'.$duration[0].'hr : '.$duration[1].'min</span></p>
    						 </div>
    					  </div><hr>';
    		}
    	}
    	echo $output;
	}
	public function newtest()
	{
		if(!$this->isadminLoggedIn){ 
            redirect('admin/login'); 
        }
        else{ 
        	$id=$this->uri->segment(4);
        	$result=array();
			$result['id']=$id;
			$this->load->view('admin/header');
        	$this->load->view('admin/createmcqexam',$result);
        	$this->load->view('admin/footer');
		}
	}
	public function addtest()
	{
		$id=$this->input->post("id");
		$duration=$this->input->post("duration");
		$title=$this->input->post("title");
		$pmarks=$this->input->post("pmarks");
    $instructions=$this->input->post("instructions");
    $isnegative=$this->input->post("isnegative");
		$code="";
		$msg="";
		$eid=0;
		if(empty($title)){
			$code="404";
			$msg="Please enter title of exam.";
		}
		else if(empty($duration)){
			$code="404";
			$msg="Please enter duration of exam.";
		}
		else if(empty($pmarks)){
			$code="404";
			$msg="Please enter passing percentage of exam.";
		}
    else if(empty($instructions)){
      $code="404";
      $msg="Please enter instructions of exam.";
    }
		else{
			
			$eid=$this->Test_Model->addtest($id,$title,$duration,$pmarks,$instructions,$isnegative);
			$code="200";
			$msg="Exam Created successfully.";
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		$data['id']=$eid;
		echo json_encode($data);
	}
	public function addtestseries()
	{
		$title=$this->input->post("title");
		$description=$this->input->post("desc");
		$ttype=$this->input->post("ttype");
		$price=$this->input->post("price");
		$code="";
		$msg="";
		$id=0;
		if(empty($title)){
			$code="404";
			$msg="Please enter title.";
		}
		else if(empty($_FILES["file"]["name"])){
			$msg="Please select thumbnail image.";
			$code="404";
 		}
 		else{
		 $image="";
		  $video="";
if(!empty( $_FILES["file"]["name"])){
    
$newname=str_replace(' ', '', $_FILES["file"]["name"]);
$fname=explode(".", $newname);
        $randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
  //print_r($fname);      
    $_FILES['file']['name']     = $randname;
        $_FILES['file']['type']     = $_FILES['file']['type'];
        $_FILES['file']['tmp_name'] = $_FILES['file']['tmp_name'];
        $_FILES['file']['error']    = $_FILES['file']['error'];
        $_FILES['file']['size']     = $_FILES['file']['size'];
        $dir = dirname($_FILES["file"]["tmp_name"]);
                $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
                rename($_FILES["file"]["tmp_name"], $destination);
            $key='kokateclasses/test-series/thumbnails/'.$_FILES["file"]["name"];
            $this->Spaces_Model->upload_file($key,$destination);
            $image = 'https://cbspace.sgp1.cdn.digitaloceanspaces.com/'.$key;  
              }
			$id=$this->Test_Model->addmcqtest($title,$description,$image,$ttype,$price);
			$code="200";
			$msg="Exam Created successfully.";
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		$data['id']=$id;
		echo json_encode($data);
	}
	public function testseriesdetails(){
		if(!$this->isadminLoggedIn){ 
      redirect('admin/login'); 
    }
    else{ 
    	$id=$this->uri->segment(4);
    	$result=array();
			$result=$this->Test_Model->fetchmcqtestdetails($id);
      $result['students']=$this->Test_Model->fetchtestseriesstudents($id);
			$this->load->view('admin/header');        
			$this->load->view('admin/testseriesdetails',$result);
      $this->load->view('admin/footer');
		}
	}
  public function addstudents()
  {
    $seriesid=$this->uri->segment(4);
    $this->session->set_userdata('startid',0);
    $result=array();
    $result['batches']=$this->Batch_Model->fetchbatches();
    $result['seriesid']=$seriesid;
    $this->load->view('admin/header');
    $this->load->view('admin/addtestseriesstudents',$result);
    $this->load->view('admin/footer');
  }
  public function fetchstudents()
  {
    $startid=$this->session->userdata('startid');
    $limit=$this->input->post('limit');
    $seriesid=$this->input->post('seriesid');
    $result=$this->Test_Model->fetchntestseriesstudents($seriesid,$startid,$limit);
    $output='';
    $i=0;
    if(count($result['students'])>0){
    foreach ($result['students'] as $stud) {
      $this->session->set_userdata('startid',$stud->Id);
      $output.='<div class="row">
      <div class="col-md-1"><input type="checkbox" name="student" value="'.$stud->Id.'"></div>
      <div class="col-md-9" style="">
      <h4>'.$stud->FirstName.' '.$stud->LastName.'</h4>
      <p><span><i class="fas fa-envelope"></i>&nbsp; '.$stud->Email.'</span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; '.$stud->Phone.'</span></p>';
      $output.='</div></div><hr>';
              $i++;
    }
    }

    echo $output;
  }
  public function addtestseriesstudents()
  {
    $students=$this->input->post('students');
    $seriesid=$this->input->post('seriesid');
    $result=$this->Test_Model->addtestseriesstudents($seriesid,$students);
  }
	public function testdetails(){
		if(!$this->isadminLoggedIn){ 
            redirect('admin/login'); 
        }
        else{ 
        	$this->session->set_userdata('qstart',0);
			$this->session->set_userdata('quesno',0);
        	$id=$this->uri->segment(4);
        	$result=array();
			$result=$this->Test_Model->fetchtestdetails($id);
			$this->load->view('admin/header');
			$this->load->view('admin/testdetails',$result);
            $this->load->view('admin/footer');
		}

	}
	public function viewanswersheet()
	{
		
		if(!$this->isUserLoggedIn){ 
            redirect('login'); 
        }
        else{ 
        	$orgid=$this->session->userdata("orgid");
        	$branchid=$this->session->userdata("branchid");
        	$aid=$this->session->userdata("academic_id");
        	$examid=$this->uri->segment(3);
			$result=$this->Test_Model->fetchexam($orgid,$examid);
			$sessiondata=array();
		  	$sessiondata['menu']="exam";
        	$sessiondata['submenu']="onexam";
			$sessiondata['setup']=$this->Setting_Model->setup($orgid);
	        $sessiondata['class_name']=$this->session->userdata('class_name');
			$sessiondata['logo']=$this->session->userdata('logo');
			$sessiondata['notifications']=$this->Notification_Model->fetchnotifications($orgid,$branchid);
		 	$this->session->set_userdata('qstart',0);
		 		$this->session->set_userdata('quesno',0);
	        if($this->session->userdata('usertype')=="teacher"){
			      $this->load->view('theader',$sessiondata);
			    }
			    else{
			    $this->load->view('header',$sessiondata);
			  }         
			  $this->load->view('mcqtest/viewanswersheet',$result);
            $this->load->view('footer');
		}
	}
	function fetchanswersheet()
	{
		$examid=$this->input->post('examid');
		$start=$this->session->userdata("start");
		$limit=$this->session->userdata("limit");
		$result=$this->Test_Model->fetchanswersheet($examid,$limit);
		$qno=$this->session->userdata('quesno');
		$output='';
		if(count($result['questions'])>0){
		$output.='
<script type="text/javascript">
  $(document).ready(function() {
  tinymce.init({
    selector: ".content",
    theme: "modern",
    paste_data_images: true,
    plugins: [
      "advlist autolink lists image charmap preview hr anchor pagebreak",,
      "insertdatetime nonbreaking save table contextmenu directionality",
      "template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "preview image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    image_advtab: true,
    file_picker_callback: function(cb, value, meta) {
    var input = document.createElement("input");
    input.setAttribute("type", "file");
    input.setAttribute("accept", "image/*");

    input.onchange = function() {
      var file = this.files[0];
      var reader = new FileReader();
      
      reader.onload = function () {
        var id = "blobid" + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(",")[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // call the callback and populate the Title field with the file name
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    
    input.click();
  },
    templates: [{
      title: "Test template 1",
      content: "Test 1"
    }, {
      title: "Test template 2",
      content: "Test 2"
    }]
  });
});
</script>';
		$i=0;
		foreach ($result['questions'] as $que) {
			$this->session->set_userdata('qstart',$que->Id);
			$qno=($qno+1);
			$this->session->set_userdata('quesno',$qno);
			$output.=' <div class="row">
    <div class="col-md-12"><div class="row">
    <div class="col-md-10">
      <p>Q. '.($qno).') '.$que->Questions.'. <span>(Marks '.$que->Marks.')</span></p>
      </div>
      <div class="col-md-2 text-right">
      <button class="btn btn-primary" data-toggle="modal" data-target="#quesModal_'.$que->Id.'">Edit</button>
      <button class="btn btn-danger" data-toggle="modal" data-target="#deletequesModal_'.$que->Id.'">Delete</button>
      </div>
      </div>
      <br>
      <ol type="A">';
      $ans=explode(",", $que->AnswerId);
      foreach ($result['options'][$i] as $option) {
        $output.='<li> '.$option->Options.'</li>';
      }
  	$output.='</ol>
  	<p><strong>Correct answer:</strong> </p>';
  	foreach ($result['options'][$i] as $option) {
  	 	if(in_array($option->Id, $ans)){
        $output.='<p>'.$option->Options.'</p>';
    	}
    	
      }
  	$output.='
  	<p><strong>Answer explaination:</strong></p>
  	<p>'.$que->AnsExplaination.'</p>
    </div>
  </div><hr>

<div class="modal" id="deletequesModal_'.$que->Id.'">
  <div class="modal-dialog">
    <div class="modal-content">


      <!-- Modal body -->
      <div class="modal-body text-center">
    <h5>Are you sure you want to delete this question?</h5><br>   
    <button type="button" class="btn btn-default" class="close" data-dismiss="modal">No</button>
    <button type="button" class="deleteque btn btn-success" value="'.$que->Id.'">Yes</button>
      </div>

      

    </div>
  </div>
</div>
  <div class="modal" id="quesModal_'.$que->Id.'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Question</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="row form-group">
       <div class="col-md-12">
  			<label>Question: </label>
					<textarea class="content form-control" id="question_'.$que->Id.'" rows="2">
				'.$que->Questions.'</textarea>
			</div>
  		</div>
  		<div class="row form-group">
  			<label class="col-md-3">Correct answer: </label>
				<label class="col-md-9">Options</label>
  		</div>';
  	 foreach ($result['options'][$i] as $option) {

  		$output.='<div class="row form-group">
  			<div class="col-md-3">';
  			if(in_array($option->Id, $ans)){
  				$output.='<input type="checkbox" name="canswer_'.$que->Id.'" value="'.$option->Id.'" checked>';
  			}
  			else{
  				$output.='<input type="checkbox" name="canswer_'.$que->Id.'" value="'.$option->Id.'">';
  			}
  			$output.='</div>
  			<div class="col-md-6">
  				<input type="text" name="options_'.$que->Id.'" class="form-control" value="'.$option->Options.'">
  			</div>
  		</div>';
  	}
  		$output.='<div class="row form-group">
  		<div class="col-md-12">
  			<label>Correct answer explaination: </label>
					<textarea class="content form-control" id="aexplain_'.$que->Id.'" rows="2" placeholder="Question">
				'.$que->AnsExplaination.'</textarea>
			</div>
  		</div>
  		<div class="row form-group">
  		<div class="col-md-12">
  			<label>Marks</label>
  				<input type="number" class="form-control" value="'.$que->Marks.'" id="qmarks_'.$que->Id.'">
  			</div>
  		</div>
     <div class="ui search focus mt-30 lbel25">
      <label>Negative Marks</label>
      <div class="ui left icon input swdh19">
        <input class="prompt srch_explore" type="number" placeholder="Negative Marks" value="'.$que->NegativeMarks.'" id="nmarks_'.$que->Id.'">                  
      </div>
    </div>
  		<div id="aqmsg_'.$que->Id.'"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="updateque btn btn-success" value="'.$que->Id.'">Update</button>
      </div>

    </div>
  </div>
</div>
';
$i++;
		}
	}
		echo $output;
	}
	public function updatequestion()
	{
		$id=$this->input->post('id');
		$question=$this->input->post('question');
		$qmarks=$this->input->post('qmarks');
		$options=$this->input->post('options');
		$canswers=$this->input->post('cans');
		$aexplain=$this->input->post('aexplain');
    $nmarks=$this->input->post('nmarks');
		$this->Test_Model->updatequestion($id,$question,$options,$canswers,$qmarks,$aexplain,$nmarks);
		$code="200";
		$msg="Exam Created successfully.";
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function addquestion(){
		$id=$this->input->post('id');
		$question=$this->input->post('question');
		$qmarks=$this->input->post('qmarks');
		$options=$this->input->post('options');
		$canswers=$this->input->post('canswers');
		$aexplain=$this->input->post('aexplain');
    $nmarks=$this->input->post('nmarks');
		$this->Test_Model->addquestion($id,$question,$options,$canswers,$qmarks,$aexplain,$nmarks);
		$code="200";
		$msg="Exam Created successfully.";
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function updatetest()
	{
		$id=$this->input->post('id');
		$title=$this->input->post('title');
		$duration=$this->input->post('duration');
		$percent=$this->input->post('pmarks');
    $instructions=$this->input->post('instructions');
		$code='';
		$msg='';
		if(empty($title)){
			$code='404';
			$msg='Please enter title of test.';
		}
		else if(empty($percent)){
			$code='404';
			$msg='Please enter passing percentage of test.';
		}
    else if(empty($instructions)){
      $code='404';
      $msg='Please enter instructions of test.';
    }
		else{
			$this->Test_Model->updateexam($id,$title,$duration,$percent,$instructions);
			$code='200';
			$msg='Exam update successfully.';
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function deletetest()
	{
		$id=$this->input->post('id');
		$this->Test_Model->deleteexam($id);
	}

  public function deletequestion()
  {
    $id=$this->input->post('id');
    $this->Test_Model->deletequestion($id);
  }
	public function updatetestseries()
	{
		$id=$this->input->post('id');
		$title=$this->input->post("title");
		$description=$this->input->post("desc");
		$ttype=$this->input->post("ttype");
		$price=$this->input->post("price");
		$code="";
		$msg="";
		if(empty($title)){
			$code="404";
			$msg="Please enter title.";
		}
 		else{
		 $image="";
		  $video="";
if(!empty( $_FILES["file"]["name"])){
    
$newname=str_replace(' ', '', $_FILES["file"]["name"]);
$fname=explode(".", $newname);
        $randname=$fname[0].md5(rand()) . '.' . $fname[count($fname)-1];
  //print_r($fname);      
    $_FILES['file']['name']     = $randname;
        $_FILES['file']['type']     = $_FILES['file']['type'];
        $_FILES['file']['tmp_name'] = $_FILES['file']['tmp_name'];
        $_FILES['file']['error']    = $_FILES['file']['error'];
        $_FILES['file']['size']     = $_FILES['file']['size'];
        $dir = dirname($_FILES["file"]["tmp_name"]);
                $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
                rename($_FILES["file"]["tmp_name"], $destination);
$key='kokateclasses/test-series/thumbnails/'.$_FILES["file"]["name"];
            $this->Spaces_Model->upload_file($key,$destination);
            $image = 'https://cbspace.sgp1.cdn.digitaloceanspaces.com/'.$key;
              }
			$this->Test_Model->updatetestseries($id,$title,$description,$image,$ttype,$price);
			$code="200";
			$msg="Exam Created successfully.";
		}
		$data=array();
		$data['code']=$code;
		$data['msg']=$msg;
		echo json_encode($data);
	}
	public function deletetestseries()
	{
		$id=$this->input->post('id');
		$this->Test_Model->deletemcqtest($id);
	}
	public function uploadquestions()
	{
		$id=$this->input->post('id');
		$code="200";
		$msg='';
        $tquestions=0;
        $tmarks=0;
		$path = './assets/images/test-series/questions/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                  
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                 
                try {
                    $arr_file   = explode('.', $inputFileName);
                    $extension  = end($arr_file);
                    if('csv' == $extension) {
                      $objReader   = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    } else {
                      $objReader   = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    }
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    //print_r($allDataInSheet);
                    $fitdb = $this->load->database('fitbrigadedb', TRUE);
                    $flag = true;
                    $inserdata=array();
                    $i=0;
                        $date=date("Y-m-d h:i:sa");
                        $cdate=date("Y-m-d");
                    foreach ($allDataInSheet as $value) {
                      if($flag){
                        $flag =false;
                        continue;
                      }
                      //print_r($value);
                        $question = $value['A'];
                        $options=array();
                        if(!empty($value['B'])){
                       		$options[]=$value['B'];
                   	    }
                   	    if(!empty($value['C'])){
                       		$options[]=$value['C'];
                   	    }
                   	    if(!empty($value['D'])){
                       		$options[]=$value['D'];
                   	    }
                   	    if(!empty($value['E'])){
                       		$options[]=$value['E'];
                   	    }
                        $cans=$value['F'];
                        $marks=$value['H'];
                        $nmarks=$value['I'];
                        $aexplain=$value['G'];
                        if(!empty($question) && count($options)<2){
	                       	$code="404";
	                       	$msg="Please enter at least two options for every questions.";
                        }
                        else if(empty($cans)){
	                       	$code="404";
	                       	$msg="Please enter answer for every questions.";
                        }
                        else if(empty($marks)){
	                       	$code="404";
	                       	$msg="Please enter marks for all the questions.";
                        }
                        else{
                        	$tquestions=$tquestions+1;
                        	$tmarks=$tmarks+$marks;
	                       $inserdata[$i]['cans'] = $cans;
	                       $inserdata[$i]['aexplain'] = $aexplain;
	                       $inserdata[$i]['question']=$question;
	                       $inserdata[$i]['options']=$options;
	                       $inserdata[$i]['marks']=$marks;
                         $inserdata[$i]['nmarks']=$nmarks;
                   		}
                        $i++;
                    }
                    if($code=="200"){               
                    $this->Test_Model->uploadquestions($id,$inserdata);   
                    $code="200";
                    $msg="Questions uploaded successfully."  ;         
      				    }
              } 

              catch (Exception $e) {
                   $code="400";
                   $msg=die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
                }
              }
              else{
              	$code="404";
                     $msg=$error['error'];
                }
                $data=array();
                $data['code']=$code;
                $data['msg']=$msg;
                $data['tquestions']=$tquestions;
                $data['tmarks']=$tmarks;
                echo json_encode($data);
	}
}
?>