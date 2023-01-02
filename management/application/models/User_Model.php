<?php
class User_Model extends CI_Model 
{ 
	function checkuser($email){
		$query1=$this->db->query("SELECT  * FROM users_mst_t where Email='$email'");
		$user= $query1->result();
		return $user;
	}
	function adduser($fname,$lname,$phone,$email,$pass,$role,$uaccess,$photo)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$teacherid=0;
		if($role=="Teacher"){
			$query="insert into faculty_mst_t(FirstName,LastName,Phone,Email,Photo,CreatedAt,UpdatedAt) values('$fname','$lname','$phone','$email','$photo','$date','$date')";
			$this->db->query($query);
			$teacherid=$this->db->insert_id();
		}
		$query="insert into users_mst_t(TeacherId,FirstName,LastName,Phone,Email,Password,Role,Access,Photo,IsDefault,IsEmailVerified,CreatedAt,UpdatedAt) values('$teacherid','$fname','$lname','$phone','$email','$pass','$role','$uaccess','$photo','0','0','$date','$date')";
		$this->db->query($query);
	}
	function add_attendance($adate,$uids,$absents,$itime,$otime,$remarks)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$i=0;
		foreach ($uids as $uid) {
			$absent=0;
			if ($absents!="") {
				if (in_array($uid, $absents)) {
					$absent=1;
				}
			}
			$query="insert into user_attendance_mst_t(AttendanceDate,UserId,IsAbsent,InTime,OutTime,Remark,CreatedAt,UpdatedAt) values('$adate','$uid','$absent','$itime[$i]','$otime[$i]','$remarks[$i]','$date','$date')";
			$this->db->query($query);
			$i++;
		}
	}
	function update_attendance($edate,$adate,$uids,$absents,$itime,$otime,$remarks)
	{
		$this->delete_attendance($edate);
		$this->add_attendance($adate,$uids,$absents,$itime,$otime,$remarks);
	}
	function delete_attendance($adate)
	{
		$this->db->query("delete from user_attendance_mst_t where AttendanceDate='$adate'");
	}
	function fetch_monthly_attendance($m,$y)
	{
		date_default_timezone_set('Asia/Kolkata');
        $cmonth=date("m");
        $cyear=date("Y");
        $msdate=date($y."-".$m."-1");
        $days=date("t");
        if($cmonth!=$m){
            $days=date("t");
        }
        $result=array();
        $result['absents']=array();
        $result['presents']=array();
        $result['adates']=array();
        for ($i=1; $i<=$days ; $i++) {
            $query = $this->db->query("select * from user_attendance_mst_t where AttendanceDate='$msdate'");
            $attendance = $query->num_rows();
            if($attendance>0){
                $absents=array();
                $query = $this->db->query("select * from user_attendance_mst_t where AttendanceDate='$msdate' and IsAbsent='1'");
                $absents = $query->num_rows();
                $result['absents'][]=$absents;
                $query = $this->db->query("select * from user_attendance_mst_t where AttendanceDate='$msdate' and IsAbsent='0'");
                $absents = $query->num_rows();
                $result['presents'][]=$absents;
                $result['adates'][]=$msdate;
            }
            $msdate=date('Y-m-d', strtotime($msdate. ' + 1 days'));
        }
        return $result;
	}
	function attendance_details($adate)
	{
		$query = $this->db->query("SELECT *
         FROM users_mst_t u
         JOIN user_attendance_mst_t a ON a.UserId = u.Id where AttendanceDate='$adate'");
        $attendance = $query->result();
        return $attendance;;
	}
	function fetchusers(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM users_mst_t");
		$users= $query1->result();
		return $users;
	}
	function fetchfaculties(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM users_mst_t where TeacherId>0");
		$users= $query1->result();
		return $users;
	}
	function checkemail($email)
	{
		$student=array();
		$query1=$this->db->query("SELECT  * FROM users_mst_t where md5(Email)='$email'");
		$student= $query1->result();
		return $student;
	}
    function savechangepassword($uid,$pass)
    {
        date_default_timezone_set('Asia/Kolkata');
        $date=date("Y-m-d h:i:sa");
        $pass=md5($pass);
        $query=$this->db->query("update users_mst_t SET Password='$pass', UpdatedAt='$date' where Id='$uid'");
    }
	public function updatepassword($uid,$pass)
	{
		$pass=md5($pass);
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update users_mst_t SET Password='$pass',UpdatedAt='$date' where Id='".$uid."'");
	}
	function updateuser($id,$fname,$lname,$phone,$email,$pass,$role,$uaccess,$photo)
	{
		$date=date("Y-m-d h:i:sa");	
		$query1=$this->db->query("SELECT  * FROM users_mst_t where Id='$id'");
		$user= $query1->result();
		$tid=0;
		$password='';
		if($pass!=''){
			$password=",Password='".md5($pass)."'";;
		}
		if ($user[0]->TeacherId>0) {
			$tid=$user[0]->TeacherId;
			$query=$this->db->query("update faculty_mst_t SET FirstName='$fname',LastName='$lname',Email='$email',Phone='$phone',Photo='$photo',UpdatedAt='$date' where Id='".$tid."'");
		}
		else{

			if($role=="Teacher"){
				$query="insert into faculty_mst_t(FirstName,LastName,Phone,Email,Photo,CreatedAt,UpdatedAt) values('$fname','$lname','$phone','$email','$photo','$date','$date')";
				$this->db->query($query);
				$tid=$this->db->insert_id();
			}
		}
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query=$this->db->query("update users_mst_t SET TeacherId='$tid',FirstName='$fname',LastName='$lname',Email='$email',Phone='$phone',Photo='$photo',Role='$role',Access='$uaccess',UpdatedAt='$date' $password where Id='".$id."'");
	}
	function deleteuser($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query1=$this->db->query("SELECT  * FROM users_mst_t where Id='".$id."'");
		$user= $query1->result();
		if(count($user)>0){
			$tid=$user[0]->TeacherId;
			$this->db->query("delete  from faculty_mst_t where Id='".$tid."'");
			$this->db->query("delete  from users_mst_t where Id='".$id."'");
		}
	}
}
?>