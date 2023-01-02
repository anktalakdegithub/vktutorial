<?php
class Student_Model extends CI_Model 
{
	function addstudent($token,$fname,$mname,$lname,$email,$phone,$pass)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		
		$pass= md5($pass);
		$query="insert into student_mst_t(Token,FirstName,MiddleName,LastName,Phone,Email,Password,CreatedAt,UpdatedAt) values('$token','$fname','$mname','$lname','$phone','$email','$pass','$date','$date')";
			$this->db->query($query);
			$id = $this->db->insert_id();
		return $id;
	}
	public function studentdevicetokens($sids)
	{
		$result=array();
		$students=array();

		if(count($sids)>1){
			$studid=implode(",", $sids);
			$query=$this->db->query("select * from device_tokens where student_id IN ($studid)");
			$students=$query->result();
		}
		else{
			if(count($sids)==1){
				$studid=implode(",", $sids);
				$query=$this->db->query("select * from device_tokens where student_id = $studid");
				$students=$query->result();
			}
		}
		return $students;
	}
	function allstudentetails(){
		$result=array();
		$result['totalstud']=0;
		$query=$this->db->query("select COUNT(FirstName) as totalstud from student_mst_t");
		$stud=$query->result();
		if($stud!=""){
			$result['totalstud']=$stud[0]->totalstud;
		}
		return $result;
	}
	function addsignupstudent($token,$fname,$mname,$lname,$email,$phone,$pass,$gender,$dob,$address)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$pass= md5($pass);
		$query="insert into student_mst_t(Token,FirstName,MiddleName,LastName,Phone,Email,Password,Gender,Address,DateOfBirth,CreatedAt,UpdatedAt) values('$token','$fname','$mname','$lname','$phone','$email','$pass','$gender','$address','$dob','$date','$date')";
		$this->db->query($query);
		$id = $this->db->insert_id();
		return $id;
	}
	function checkemail($email)
	{
		$student=array();
		$query1=$this->db->query("SELECT  * FROM student_mst_t where md5(Email)='$email'");
		$student= $query1->result();
		return $student;
	}
	function add_google_user($fname,$lname,$email,$photo)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query="insert into student_mst_t(FirstName,LastName,Photo,Email,IsGoogleLogin,CreatedAt,UpdatedAt) values('$fname','$lname','$photo','$email','1','$date','$date')";
		$this->db->query($query);
	}
	function studentids($studid)
	{
		$result=array();
		$result['students']=array();
		$studids=explode(",", $studid);
		if(count($studids)>1){
			$query=$this->db->query("select student_mst_t.Id,CONCAT('91', student_mst_t.Phone) as Phone,student_mst_t.FirstName, student_mst_t.LastName,student_mst_t.Email from student_mst_t where Id IN ($studid)");
			$students=$query->result();
			$result['students']=$students;
		}
		else{
			$query=$this->db->query("select student_mst_t.Id,CONCAT('91', student_mst_t.Phone) as Phone,student_mst_t.FirstName, student_mst_t.LastName,student_mst_t.Email from student_mst_t where Id='$studid'");
			$students=$query->result();
			$result['students']=$students;
		}
		return $result;
	}
	function fetchstudentbatch($studid)
	{
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$studid'");
		$batches= $query1->result();
		$result=array();
		$sbatches=array();
		foreach ($batches as $batch) {
			$bid=$batch->BatchId;
			$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
			$sbatches[]= $query1->result();
		}
		return $sbatches;
	}
	function addstudentadmission($fname,$mname,$lname,$phone,$email,$address,$city,$state,$pincode,$image,$gender,$dob,$isource,$type,$batches)
	{

		$rndno=rand(1000, 9999);
		$studname=str_replace('.', '', $fname);
		$scode = substr($studname, 0, 3).$rndno;
		$count=1;
		$i=0;
		while ($count<1){
			$query=$this->db->query("select * from student_mst_t where Student_Code='".$scode."'");
			$count= $query->num_rows();
			$rndno=rand(1000, 9999);
			$scode = substr($studname, 0, 3).$rndno;
			$i++;
		}
		$pass= $rndno=rand((int)100000, (int)999999);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query="insert into student_mst_t(FirstName,MiddleName,LastName,Phone,Email,Student_Code,Password,Gender,Address,State,City,Pincode,Photo,DateOfBirth,InquirySource,Type,CreatedAt,UpdatedAt) values('$fname','$mname','$lname','$phone','$email','$scode','$pass','$gender','$address','$state','$city','$pincode','$image','$dob','$isource','$type','$date','$date')";
		$this->db->query($query);
		$id = $this->db->insert_id();
		$batchids=explode(",", $batches);
		$aid=$this->session->userdata('ayear');
			foreach ($batchids as $batch) {
				$query="insert into student_batch_mst_t(StudentId,BatchId,AcademicId,CreatedAt,UpdatedAt) values('$id','$batch','$aid','$date','$date')";
				$this->db->query($query);
			}
		return $id;
	}
	function addparents($studid,$fname,$mname,$lname,$phone,$email,$addressing,$relation,$occupation)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query="insert into parents_mst_t(StudentId,Addressing,FirstName,MiddleName,LastName,Phone,Email,Relation,Occupation,CreatedAt,UpdatedAt) values('$studid','$addressing','$fname','$mname','$lname','$phone','$email','$relation','$occupation','$date','$date')";
			$this->db->query($query);
			$id = $this->db->insert_id();
		return $id;
	}

	function updateparent($id,$addressing,$fname,$mname,$lname,$email,$phone,$relation,$occupation)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update parents_mst_t SET FirstName='$fname',MiddleName='$mname',LastName='$lname',Email='$email',Phone='$phone',Addressing='$addressing',Relation='$relation',Occupation='$occupation',UpdatedAt='$date' where Id='".$id."'");
	}
	function deleteparent($id)
	{
		$this->db->query("delete from parents_mst_t where Id='$id'");
	}
	function addadmission($id,$batch,$fees,$tfees,$discount,$note)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	

		$aid=$this->session->userdata('ayear');
		$query="insert into student_batch_mst_t(StudentId,BatchId,AcademicId,Fees,Discount,FinalFees,Note,CreatedAt,UpdatedAt) values('$id','$batch','$aid','$fees','$discount','$tfees','$note','$date','$date')";
			$this->db->query($query);
	}
	function addbatchstudent($fname,$mname,$lname,$phone,$email,$batches)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query="insert into student_mst_t(FirstName,MiddleName,LastName,Phone,Email,CreatedAt,UpdatedAt) values('$fname','$mname','$lname','$phone','$email','$date','$date')";
			$this->db->query($query);
			$id = $this->db->insert_id();

		$aid=$this->session->userdata('ayear');
			foreach ($batches as $batch) {
				$query="insert into student_batch_mst_t(StudentId,BatchId,AcademicId,CreatedAt,UpdatedAt) values('$id','$batch','$aid','$date','$date')";
				$this->db->query($query);
			}
			//$query="insert into student_batch_mst_t(StudentId,BatchId,CreatedAt,UpdatedAt) values('$id','$batches','$date','$date')";
			//	$this->db->query($query);
		return $id;
	}
	function checklogin($scode){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM student_mst_t where Student_Code='$scode'");
		$student= $query1->result();
		return $student;
	}
	function checkparent($email){
		$parent=array();
		$query1=$this->db->query("SELECT  * FROM parents_mst_t where Email='$email'");
		$parent= $query1->result();
		return $parent;
	}
	function fetchallstudents(){
		$parent=array();
		$query1=$this->db->query("SELECT  * FROM student_mst_t where IsBlock='0'");
		$students= $query1->result();
		return $students;
	}
	public function updatestudenttoken($studid,$token)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update student_mst_t SET Token='$token',UpdatedAt='$date' where Id='".$studid."'");
		$query1=$this->db->query("SELECT  * FROM device_tokens where student_id='$studid' and token='$token'");
		$tokens= $query1->result();
		if(count($tokens)==0){
			$query="insert into device_tokens(student_id,token) values ('$studid','$token')";
			$this->db->query($query);
		}
	}
	public function changepassword($sid,$pass)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$pass=md5($pass);
		$query=$this->db->query("update student_mst_t SET Password='$pass',UpdatedAt='$date' where Id='".$sid."'");
	}
	public function updatestudentinfo($studid,$fname,$lname,$phone,$city,$state)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update student_mst_t SET FirstName='$fname',LastName='$lname',Phone='$phone',State='$state',City='$city',UpdatedAt='$date' where Id='".$studid."'");
	}
	public function updatestudentpassword($studid,$oldpassword,$newpassword,$confirmPassword)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$pass=md5($newpassword);
		$query=$this->db->query("update student_mst_t SET Password='$pass',UpdatedAt='$date' where Id='".$studid."'");
	}
	public function updatestudent($sid,$fname,$mname,$lname,$phone,$email,$password,$address,$city,$state,$pincode,$image,$gender,$dob)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update student_mst_t SET FirstName='$fname',MiddleName='$mname',LastName='$lname',Phone='$phone',Email='$email',Password='$password',Address='$address',State='$state',City='$city',Pincode='$pincode',Photo='$image',Gender='$gender',DateOfBirth='$dob',UpdatedAt='$date' where Id='".$sid."'");
	}
	public function updateprofile($sid,$fname,$mname,$lname,$phone,$email,$address,$file,$gender,$dob)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		if($file!=""){
			$query=$this->db->query("update student_mst_t SET FirstName='$fname',MiddleName='$mname',LastName='$lname',Phone='$phone',Email='$email',Address='$address',Photo='$file',Gender='$gender',DateOfBirth='$dob',UpdatedAt='$date' where Id='".$sid."'");
		}
		else{	
			$query=$this->db->query("update student_mst_t SET FirstName='$fname',MiddleName='$mname',LastName='$lname',Phone='$phone',Email='$email',Address='$address',Gender='$gender',DateOfBirth='$dob',UpdatedAt='$date' where Id='".$sid."'");
		}
	}
	function findemail($email)
	{
		$student=array();
		$query1=$this->db->query("SELECT  * FROM student_mst_t where md5(Email)='$email'");
		$student= $query1->result();
		return $student;
	}
	function fetchstudentdetails($sid)
	{
		$result=array();
		$result['batches']=array();
		$result['courses']=array();
		$result['tseries']=array();
		$result['parents']=array();
		$query1=$this->db->query("SELECT  * FROM student_mst_t where Id='$sid'");
		$student= $query1->result();
		$result['student']=$student;
		$query1=$this->db->query("SELECT  * FROM parents_mst_t where StudentId='$sid'");
		$student= $query1->result();
		$result['parents']=$student;
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$sid'");
		$batches= $query1->result();
		foreach ($batches as $batch) {
			$bid=$batch->BatchId;
			$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
			$sbatch= $query1->result();
			if(count($sbatch)>0){
				$result['batches'][]=$sbatch[0];
			}
		}
		$query1=$this->db->query("SELECT  course_mst_t.Title,course_mst_t.Cover_image,batch_mst_t.Name,student_batch_mst_t.*,course_mst_t.Price FROM student_batch_mst_t join batch_mst_t on batch_mst_t.Id=student_batch_mst_t.BatchId join course_mst_t on course_mst_t.Id=batch_mst_t.Course_id where StudentId='$sid' order by Id DESC");
		$courses= $query1->result();
		$result['courses']=$courses;
		$query1=$this->db->query("SELECT  * FROM stud_test_series_mst_t where StudentId='$sid' order by Id DESC");
		$tests= $query1->result();
		foreach ($tests as $test) {
			$tid=$test->SeriesId;
			$query1=$this->db->query("SELECT  * FROM mcq_category_mst_t where Id='$tid'");
			$stest= $query1->result();
			if(count($stest)>0){
				$result['tseries'][]=$stest[0];
			}
		}
		$query1=$this->db->query("SELECT  * FROM stud_fee_mst_t where StudentId='$sid' order by Id DESC");
		$fees= $query1->result();
		$result['paid']=0;
		$result['unpaid']=0;
		$result['unclear']=0;
		$result['pmethod']=array();
		foreach ($fees as $fee) {
			$pmethod=$fee->PaymentMethod;
			$query1=$this->db->query("SELECT  * FROM payment_category_mst_t where Id='$pmethod' order by Id DESC");
			$PaymentMethod= $query1->result();
			$result['pmethod'][]=$PaymentMethod;
			if($fee->PaymentStatus=="Paid"){
				$result['paid']=$result['paid']+$fee->AmountPaid;
				$result['unpaid']=$result['unpaid']+($fee->Amount-$fee->AmountPaid);
			}
			else if($fee->PaymentStatus=="Unpaid"){
				$result['paid']=$result['paid']+$fee->AmountPaid;
				$result['unpaid']=$result['unpaid']+($fee->Amount-$fee->AmountPaid);
			}
			else if($fee->PaymentStatus=="Unclear"){
				$result['paid']=$result['paid']+$fee->AmountPaid;
				$result['unpaid']=$result['unpaid']+($fee->Amount-$fee->AmountPaid);
				$result['unclear']=$result['unclear']+($fee->AmountUnclear);
			}
		}
		$result['fees']=$fees;
		return $result;
	}
	function student_courses($sid)
	{
		$result=array();
		$query1=$this->db->query("SELECT  * FROM student_admission_mst_t where Student_id='$sid' order by Id DESC");
		$courses= $query1->result();
		foreach ($courses as $course) {
			$cid=$course->Course_id;
			$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
			$scourse= $query1->result();
			if(count($scourse)>0){
				$result[]=$scourse[0];
			}
		}
		return $result;
	}
	function addcourse($sid,$cid,$access)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
		$scourse= $query1->result();
		$total=0;
		foreach ($access as $value) {
			if($value=='PPTs'){
				$total=$total+$scourse[0]->PptsPrice;
			}
			if($value=='Videos'){
				$total=$total+$scourse[0]->VideosPrice;
			}
			if($value=='Tests'){
				$total=$total+$scourse[0]->TestsPrice;
			}
		}
		$query="insert into student_admission_mst_t(Student_id,Price,CreatedAt,UpdatedAt) values('$sid','$total','$date','$date')";
		$this->db->query($query);
		$type=json_encode($access);
		$thumbnail=$scourse[0]->Cover_image;
		$title=$scourse[0]->Title;
		$aid=$this->db->insert_id();
		$query="insert into student_cart_mst_t(StudentId,AdmissionId,CourseId,SectionId,TopicId,CourseName,CourseThumbnail,Price,Type,CreatedAt,UpdatedAt) values('$sid','$aid','$cid','0','0','$title','$thumbnail','$total','$type','$date','$date')";
		$this->db->query($query);
	}
	function addseries($sid,$tid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into stud_test_series_mst_t(StudentId,SeriesId,CreatedAt,UpdatedAt) values('$sid','$tid','$date','$date')";
		$this->db->query($query);
	}
	function removecourse($sid,$cid)
	{
		$query="delete from student_batch_mst_t where Id='$cid'";
		$this->db->query($query);
	}
	function removeseries($sid,$tid)
	{
		$query="delete from stud_test_series_mst_t where StudentId='$sid' and SeriesId='$tid'";
		$this->db->query($query);
	}
	function unblockstudent($sid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update student_mst_t SET IsBlock='0',UpdatedAt='$date' where Id='".$sid."'");
		$query=$this->db->query("update student_admission_mst_t SET IsBlock='0',UpdatedAt='$date' where Student_id='".$sid."'");
		$query=$this->db->query("update student_batch_mst_t SET IsBlock='0',UpdatedAt='$date' where StudentId='".$sid."'");
		$query=$this->db->query("update stud_test_series_mst_t SET IsBlock='0',UpdatedAt='$date' where StudentId='".$sid."'");
	}
	function blockstudent($sid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update student_mst_t SET IsBlock='1',UpdatedAt='$date' where Id='".$sid."'");
		$query=$this->db->query("update student_admission_mst_t SET IsBlock='1',UpdatedAt='$date' where Student_id='".$sid."'");
		$query=$this->db->query("update student_batch_mst_t SET IsBlock='1',UpdatedAt='$date' where StudentId='".$sid."'");
		$query=$this->db->query("update stud_test_series_mst_t SET IsBlock='1',UpdatedAt='$date' where StudentId='".$sid."'");
	}
	public function fetchstudents($startid,$limit,$course_id,$batch_id)
	{
		$result=array();
		$result['students']=array();
		$result['batches']=array();
		if($batch_id!='' || $course_id!=''){
			$batch='';
			$course='';
			if ($batch_id!='') {
				$batch="and student_batch_mst_t.BatchId='$batch_id'";
			}
			if ($course_id!='') {
				$course="and student_batch_mst_t.CourseId='$course_id'";
			}
			if($startid>0){
				$query1=$this->db->query("SELECT  * FROM student_mst_t join student_batch_mst_t on student_batch_mst_t.StudentId=student_mst_t.Id where student_mst_t.Id<'$startid' and student_mst_t.IsBlock='0' $batch $course ORDER BY student_mst_t.ID DESC limit $limit");
			}
			else{
				$query1=$this->db->query("SELECT  * FROM student_mst_t join student_batch_mst_t on student_batch_mst_t.StudentId=student_mst_t.Id where student_mst_t.Id>0 and student_mst_t.IsBlock='0' $batch $course ORDER BY student_mst_t.ID DESC limit $limit");
			}
		}
		else{
			if($startid>0){
				$query1=$this->db->query("SELECT  * FROM student_mst_t where student_mst_t.Id<'$startid' and student_mst_t.IsBlock='0' ORDER BY student_mst_t.ID DESC limit $limit");
			}
			else{
				$query1=$this->db->query("SELECT  * FROM student_mst_t where student_mst_t.Id>0 and student_mst_t.IsBlock='0' ORDER BY student_mst_t.ID DESC limit $limit");
			}
		}
		$students= $query1->result();
		foreach ($students as $row) {
			$studid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$studid'");
			$batches= $query1->result();
			$studbatches=array();
			foreach ($batches as $batch) {
				$bid=$batch->BatchId;
				$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
				$sbatch= $query1->result();
				$studbatches[]=$sbatch[0];
			}
			$result['batches'][]=$studbatches;
		}
		$result['students']=$students;
		return $result;
	}
		public function fetchnbatchstudents($bid,$startid,$limit)
	{
		$result=array();
		$result['students']=array();
		$result['batches']=array();
		if($startid>0){
			$query1=$this->db->query("SELECT  * FROM student_mst_t where Id<'$startid' and student_mst_t.IsBlock='0' ORDER BY ID DESC limit $limit");
		}
		else{
			$query1=$this->db->query("SELECT  * FROM student_mst_t where student_mst_t.IsBlock='0' ORDER BY ID DESC limit $limit");
		}
		$students= $query1->result();
		foreach ($students as $row) {
			$studid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$studid' and BatchId='$bid'");
			$batches= $query1->result();
			if(count($batches)==0){
				$result['students'][]=$row;
			}
		}
		
		return $result;
	}
	function addfeesdetail($id,$batch,$fees,$tfees,$discount,$apaid,$payment,$aremaining,$iamount,$itype,$noi,$idate){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update student_batch_mst_t SET Fees='$fees',Discount='$discount',FinalFees='$tfees',UpdatedAt='$date' where StudentId='".$id."' and BatchId='$batch'");
		if($apaid>0){
		$query2="insert into stud_fee_mst_t(StudentId,BatchId,Amount,AmountPaid,PaymentMethod,PaymentStatus,PaymentDate,CreatedAt,UpdatedAt) values('$id','$batch','$apaid','$apaid','$payment','Paid','$idate','$date','$date')";
			$this->db->query($query2);
		}
		$pamount=0;
		if($iamount>0){
		for($i=1;$i<=$noi;$i++){
			$insdate = strtotime($idate);
			if($itype=="Monthly"){
				$insdate = date("Y-m-d", strtotime("+1 month", $insdate));
			}
			else{
				$insdate = date("Y-m-d", strtotime("+1 week", $insdate));
			}
			$pamount=$pamount+$iamount;
			if($pamount>$aremaining){
				$extra=$pamount-$aremaining;
				$iamount=$iamount-$extra;
			}
			$status="Unpaid";
			$query2="insert into stud_fee_mst_t(StudentId,BatchId,Amount,PaymentStatus,PaymentDate,CreatedAt,UpdatedAt) values('$id','$batch','$iamount','$status','$insdate','$date','$date')";
		$this->db->query($query2);
		$idate=$insdate;
		}
	}
	}
	function addpayments($id,$batch,$tfees,$apaid,$payment,$pstatus,$aremaining,$iamount,$itype,$noi,$idate){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		if($apaid>0){
		$query2="insert into stud_fee_mst_t(StudentId,BatchId,Amount,AmountPaid,InstallmentDate,PaymentStatus,PaymentDate,CreatedAt,UpdatedAt) values('$id','$batch','$apaid','$apaid','$payment','Paid','$idate','$date','$date')";
			$this->db->query($query2);
		}
		$pamount=0;
		if($iamount>0){
		for($i=1;$i<=$noi;$i++){
			$insdate = strtotime($idate);
			if($itype=="Monthly"){
				$insdate = date("Y-m-d", strtotime("+1 month", $insdate));
			}
			else{
				$insdate = date("Y-m-d", strtotime("+1 week", $insdate));
			}
			$pamount=$pamount+$iamount;
			if($pamount>$aremaining){
				$extra=$pamount-$aremaining;
				$iamount=$iamount-$extra;
			}
			$status="Unpaid";
			$query2="insert into stud_fee_mst_t(StudentId,BatchId,Amount,PaymentStatus,InstallmentDate,CreatedAt,UpdatedAt) values('$id','$batch','$iamount','$status','$insdate','$date','$date')";
		$this->db->query($query2);
		$idate=$insdate;
		}
	}
	}
	public function filterbatchstudent($id)
	{
		$result=array();
		$result['students']=array();
		$result['batches']=array();
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where BatchId='$id' ORDER BY ID DESC");
		$students= $query1->result();
		foreach ($students as $row) {
			$studid=$row->StudentId;
			$query1=$this->db->query("SELECT  * FROM student_mst_t where Id='$studid'");
			$student= $query1->result();
			$result['students'][]=$student[0];
			$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$studid'");
			$batches= $query1->result();
			$studbatches=array();
			foreach ($batches as $batch) {
				$bid=$batch->BatchId;
				$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
				$sbatch= $query1->result();
				$studbatches[]=$sbatch[0];
			}
			$result['batches'][]=$studbatches;
		}
		
		return $result;
	}
	function assignbatchstudent($bid,$students)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	

		$aid=$this->session->userdata('ayear');
		foreach ($students as $sid) {
			$query="insert into student_batch_mst_t(StudentId,BatchId,AcademicId,CreatedAt,UpdatedAt) values('$sid','$bid','$aid','$date','$date')";
			$this->db->query($query);
		}
	}
	function searchstudents($search){
		
		$result=array();
		$result['students']=array();
		$result['batches']=array();
		$query1=$this->db->query("SELECT  * FROM student_mst_t WHERE IsBlock='0' and (FirstName LIKE '%$search%') OR (LastName LIKE '%$search%')");
		$students= $query1->result();
		foreach ($students as $row) {
			$studid=$row->Id;
			$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$studid'");
			$batches= $query1->result();
			$studbatches=array();
			foreach ($batches as $batch) {
				$bid=$batch->BatchId;
				$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$bid'");
				$sbatch= $query1->result();
				$studbatches[]=$sbatch[0];
			}
			$result['batches'][]=$studbatches;
		}
		$result['students']=$students;
		return $result;
	}
	function searchsmsstudents($search,$bid)
	{
		$result=array();
		$batch="";
		if($bid!=""){
			$batch="and ps.BatchId='$bid'";
		}
		$query1=$this->db->query("SELECT *
         FROM student_mst_t p
         JOIN student_batch_mst_t ps ON ps.StudentId = p.Id where (FirstName LIKE '%$search%') OR (LastName LIKE '%$search%') $batch");
		$result= $query1->result();
		return $result;
	}
	function fetchbatchtudents($bid)
	{
		$result=array();
		$batch="";
		if($bid!=""){
			$batch="and ps.BatchId='$bid'";
		}
		$query1=$this->db->query("SELECT *
         FROM student_mst_t p
         JOIN student_batch_mst_t ps ON ps.StudentId = p.Id where student_mst_t.IsBlock='0' $batch");
		$result= $query1->result();
		return $result;
	}
	function countstudents()
	{
		$query1=$this->db->query("SELECT  * FROM student_mst_t where IsBlock='0'");
		$result= $query1->num_rows();
		return $result;
	}

	public function assignbatch($sid,$bids)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	

		$aid=$this->session->userdata('ayear');
		foreach ($bids as $batch) {
			$query="insert into student_batch_mst_t(StudentId,BatchId,AcademicId,CreatedAt,UpdatedAt) values('$sid','$batch','$aid','$date','$date')";
			$this->db->query($query);
		}
	}
	public function changebatch($sid,$bids)
	{
		$this->db->query("delete  from student_batch_mst_t where StudentId='".$sid."'");
		date_default_timezone_set('Asia/Kolkata');

		$aid=$this->session->userdata('ayear');
		$date=date("Y-m-d h:i:sa");	
		foreach ($bids as $batch) {
			$query="insert into student_batch_mst_t(StudentId,BatchId,AcademicId,CreatedAt,UpdatedAt) values('$sid','$batch','$aid','$date','$date')";
			$this->db->query($query);
		}
	}
	public function fetchstudent($studid)
	{
		$query1=$this->db->query("SELECT  * FROM student_mst_t where Id='$studid'");
		$student= $query1->result();
		return $student;
	}
	public function getstudentdetails($studid)
	{
		$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where StudentId='$studid'");
		$batches= $query1->result();
		return $batches;
	}
	public function updatepassword($sid,$pass)
	{
		$pass=md5($pass);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update student_mst_t SET Password='$pass',UpdatedAt='$date' where Id='".$sid."'");
	}
	function deletejob($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$this->db->query("delete  from jobs_mst_t where Id='".$id."'");
	}
	function updatefeestatus($aid,$id,$studid,$pstatus,$iamount,$pamount,$pmethod,$pdate,$aremaining){
		//$aremaining=$fee[0]->Amount-$fee[0]->AmountPaid;
		$iaremaining=$iamount-$pamount;

		$query1=$this->db->query("select * from stud_fee_mst_t where Id>'$id' and StudentId='$studid' and PaymentStatus='Unpaid'");
		$fee= $query1->result();
		//print_r($fee);
		if(count($fee)>0){
			$amount=$fee[0]->Amount+$iaremaining;
			$query=$this->db->query("update stud_fee_mst_t SET Amount='$amount' where Id='".$fee[0]->Id."'");
		}
		else{
			$query1=$this->db->query("select * from stud_fee_mst_t where Id='$id'");
			$fees= $query1->result();
			if($iaremaining>0){
				$query2="insert into stud_fee_mst_t(StudentId,BatchId,Amount,AmountPaid,PaymentMethod,PaymentStatus,PaymentDate,CreatedAt,UpdatedAt) values('$id','$fees[0]->BatchId','$iaremaining','0','','Unpaid','$idate','$date','$date')";
				$this->db->query($query2);
			}
		}
		if($pstatus=="Paid"){
			//$pamount=$fee[0]->AmountPaid+$pamount;
			
			//echo "2";
			
			$query=$this->db->query("update stud_fee_mst_t SET PaymentStatus='$pstatus', PaymentMethod='$pmethod', AmountPaid='$pamount', Amount='$pamount' where Id='".$id."'");
		}
		else if($pstatus=="Unpaid"){
			//$ucamount=$fee[0]->AmountUnclear-$pamount;
			$query=$this->db->query("update stud_fee_mst_t SET PaymentStatus='$pstatus', PaymentMethod='$pmethod', AmountUnclear='$pamount' and Amount='$pamount' where Id='".$id."'");
		} 
		if($pstatus=="Unclear"){
			
			$query=$this->db->query("update stud_fee_mst_t SET PaymentStatus='$pstatus', PaymentMethod='$pmethod', PostDate='$pdate', AmountUnclear='$pamount' where Id='".$id."'");
		}
		
	}

	function transferstudents($aid,$cid,$bid,$id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$aid=$this->session->userdata('ayear');
		$query=$this->db->query("select * from student_batch_mst_t where BatchId='$id' and AcademicId='$aid'");
		$students=$query->result();
		
		foreach ($students as $stud) {
			$studid = $stud->StudentId;
			$query1="insert into student_batch_mst_t(StudentId,CourseId,AcademicId,BatchId,CreatedAt,UpdatedAt) values('$studid','$cid','$aid','$bid','$date','$date')";
			$this->db->query($query1);
		}
		//$this->db->query("delete from student_batch_mst_t where BatchId='$id'");
	}
}
?>