<?php
class Salary_Model extends CI_Model 
{
	function fetchsalary($month,$year)
	{
		$result=array();
		$result['salaries']=array();
		$result['teachers']=array();
		$teachers=array();
		$query=$this->db->query("select * from salary_mst_t where MONTH(CreatedAt)='$month' and YEAR(CreatedAt)='$year'");
		$salaries= $query->result();
		foreach ($salaries as $sal) {
			$tid=$sal->TeacherId;
			$query=$this->db->query("select * from faculty_mst_t where Id='$tid'");
			$teacher= $query->result();
			$teachers[]=$teacher[0];
		}
		$result['salaries']=$salaries;
		$result['teachers']=$teachers;
		return $result;
	}
	function faculty_salaries($id){
		$query=$this->db->query("select * from salary_mst_t where TeacherId='$id' and IsPaid='1'");
		$salaries= $query->result();
		return $salaries;
	}
	function calculatesalary()
	{
		$result=array();
		$result['salaries']=array();
		$result['teachers']=array();
		date_default_timezone_set('Asia/Kolkata');
		$month=date('m', strtotime(date('Y-m-d')." -1 month"));
		$year=date('Y');
		if($month=="dec"){
			$year=date('Y', strtotime(date('Y-m-d')." -1 month"));
		}
		$query=$this->db->query("select * from faculty_mst_t");
		$teachers= $query->result();
		$tlecture=0;
		$salay=0;
		foreach ($teachers as $teacher) {
			$salary=$teacher->Salary;
			$tid=$teacher->Id;
			$query=$this->db->query("select * from lecture_mst_t where MONTH(Lecture_date)='$month' and YEAR(Lecture_date)='$year' and IsAttendance='1'");
			$alectures= $query->result();
			$lectures=array();
			foreach ($alectures as $lect) {
				$fids=explode(",",$lect->Faculty);
				$totalhours=0;
				if(in_array($tid, $fids)){
					$lectures[]=$lect;
					$time1 = strtotime($lect->Start_time);
					//print_r($lect->Start_time);
					$time2 = strtotime($lect->End_time);
					$diff = abs($time2 - $time1);

// Convert $diff to minutes
$tmins = $diff/60;// Get hours
$hours = floor($tmins/60);
$totalhours=$totalhours+$hours;
				}
			}
			$absents=0;
			if($teacher->SalaryType=="Per Lecture")
			{
				$salary=($lecture-$absents)*$teacher->Salary;
			}
			else if($teacher->SalaryType=="Weekly"){
				$salary=4*$teacher->Salary;
			}
			else if($teacher->SalaryType=="Hourly"){
				$salary=$totalhours*$teacher->Salary;
			}
			else{
				$salary=$teacher->Salary;
			}
			date_default_timezone_set('Asia/Kolkata');
			$date=date("Y-m-d h:i:sa");
			$query="insert into salary_mst_t(TeacherId,TotalLecture,TotalHours,Salary,CreatedAt,UpdatedAt) values('$tid','$tlecture','$totalhours','$salary','$date','$date')";
			$this->db->query($query);
		}
		return $result;
	}
	function updatesalarystatus($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update salary_mst_t SET IsPaid='1', UpdatedAt='$date' where Id='".$id."'");
	}
}
?>