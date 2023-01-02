<?php
class Income_Model extends CI_Model 
{
	function saverecords($date,$sourceid,$amount,$paymentid,$note)
	{
		$rept=10001;
		$query=$this->db->query("select RecNo from income_mst_t");
		$count=$query->num_rows();
		$incomes=$query->result();
		$reptno=array();
		foreach ($incomes as $income) {
			$reptno[]=$income->RecNo;
		}
		while(in_array($rept, $reptno)){
			$rept=$rept+1;
		}
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into income_mst_t(RecNo,SourceId,Date,PaymentMode,	Amount,Notes,CreatedAt,UpdatedAt) values('$rept','$sourceid','$date','$paymentid','$amount','$note','$date','$date')";

		$this->db->query($query);
		
	}
	function calculateincome()
	{
		date_default_timezone_set('Asia/Kolkata');
		$year=date("Y");
		$query=$this->db->query("select SUM(Amount) as total from income_mst_t where YEAR(CreatedAt)='$year'");
		$fee=$query->result();
		$result=$fee[0]->total;
		return $result;
	}	
	function overallincome($orgid,$aid){
		$result=array();
	    $result['months']=array();
	    $result['bamount']=array();
	    $result['amount']=array();
	    $query=$this->db->query("select * from branch_mst_t where OrgId='$orgid'");
		$branches= $query->result();
		$result['branches']=$branches;
		date_default_timezone_set('Asia/Kolkata');
		$cdate=date("Y-m-d");
		$cmonth = date("m",strtotime($cdate));
		$cyear=date("Y",strtotime($cdate));
		$month=01;
		$fdate =date('Y-01-01');
	    $ldate = date("Y-m-d",strtotime($fdate."+1 year"));
		$month = date("m",strtotime($fdate));
		$j=0;
		foreach ($branches as $row) {
			$bid=$row->Id;
			$result['bamount'][$j]=array();
			if($aid>0){
				$query=$this->db->query("select COALESCE(SUM(AmountPaid),0) as total from stud_fee_mst_t where OrgId='".$orgid."' and BranchId='$bid' and AcademicId='$aid'");
				$fee=$query->result();
				$result['bamount'][$j][]=$fee[0]->total;
				$query=$this->db->query("select COALESCE(SUM(AmountUnclear),0) as total from stud_fee_mst_t where OrgId='".$orgid."' and BranchId='$bid' and AcademicId='$aid'");
				$fee=$query->result();
				$result['bamount'][$j][]=$fee[0]->total;
				$query=$this->db->query("select COALESCE(SUM(Amount),0) as total from stud_fee_mst_t where OrgId='".$orgid."' and PaymentStatus='Unpaid' and PaymentDate>'$cdate' and BranchId='$bid' and AcademicId='$aid'");
				$fee=$query->result();
				$result['bamount'][$j][]=$fee[0]->total;
				
			}
			else
			{
				$query=$this->db->query("select COALESCE(SUM(AmountPaid),0) as total from stud_fee_mst_t where OrgId='".$orgid."' and BranchId='$bid' and YEAR(PaymentDate)='$cyear'");
				$fee=$query->result();
				$result['bamount'][$j][]=$fee[0]->total;
				$query=$this->db->query("select COALESCE(SUM(AmountUnclear),0) as total from stud_fee_mst_t where OrgId='".$orgid."' and BranchId='$bid' and YEAR(PaymentDate)='$cyear'");
				$fee=$query->result();
				$result['bamount'][$j][]=$fee[0]->total;
				$query=$this->db->query("select COALESCE(SUM(Amount),0) as total from stud_fee_mst_t where OrgId='".$orgid."' and PaymentStatus='Unpaid' and PaymentDate>'$cdate' and BranchId='$bid' and YEAR(PaymentDate)='$cyear'");
				$fee=$query->result();
				$result['bamount'][$j][]=$fee[0]->total;
			}
			$j++;
		}
	    while($fdate<$ldate){
			//echo $cmonth;
			$amount=0;
			$bamount=0;
			foreach ($branches as $row) {
				$bid=$row->Id;
				if($aid>0){
					$query=$this->db->query("select COALESCE(SUM(Amount),0) as total from income_mst_t where OrgId='".$orgid."' and BranchId='$bid' and MONTH(Date)='$month' and AcademicId='$aid'");
					$income=$query->result();
					$query=$this->db->query("select COALESCE(SUM(AmountPaid),0) as total from stud_fee_mst_t where OrgId='".$orgid."' and BranchId='$bid' and MONTH(PaymentDate)='$month' and AcademicId='$aid'");
					$fee=$query->result();
					$amount=$amount+$income[0]->total+$fee[0]->total;
				}
				else{
					$query=$this->db->query("select COALESCE(SUM(Amount),0) as total from income_mst_t where OrgId='".$orgid."' and BranchId='$bid' and MONTH(Date)='$month' and YEAR(Date)='$cyear'");
					$income=$query->result();
					$query=$this->db->query("select COALESCE(SUM(AmountPaid),0) as total from stud_fee_mst_t where OrgId='".$orgid."' and BranchId='$bid' and MONTH(PaymentDate)='$month' and YEAR(PaymentDate)='$cyear'");
					$fee=$query->result();
					$amount=$amount+$income[0]->total+$fee[0]->total;
				}
			}
				$result['amount'][]=$amount;
			
			
			$result['months'][]=date("M",strtotime($fdate));
		    $fdate = date("Y-m-d",strtotime($fdate."+1 month"));
		    $month = date("m",strtotime($fdate));
		}
	
		return $result;
	}
	function fetchincome(){
		date_default_timezone_set('Asia/Kolkata');
		$month=date("m");
		$year=date("Y");
		$query=$this->db->query("select * from income_mst_t where MONTH(Date)='$month' and YEAR(Date)='$year'");
		$incomeid=$query->result();
		$result=$this->Income_Model->getincome($incomeid);
		return $result;
	}
	function fetchallincome($startid){
		date_default_timezone_set('Asia/Kolkata');
		$start="";
		if($startid>0){
			$start=" where Id<'$start'";
		}
		$query=$this->db->query("select * from income_mst_t $start order by Id DESC");
		$incomeid=$query->result();
		$result=$this->Income_Model->getincome($incomeid);
		return $result;
	}
	function fetchincomedata($id,$sdate,$edate)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$income=array();
		$source="";
		$fedate="";
		$fsdate="";
		if ($id!="") {
			$source="where SourceId='$id'";
		}
		if ($sdate!="") {
			if($source==""){
				$fsdate.="where ";
			}
			else{
				$fsdate.=" and ";
			}
			$fsdate=" DATE(Date)>='$sdate'";
		}
		if ($edate!="") {
			if($source=="" && $sdate==""){
				$fedate.="where ";
			}
			else{
				$fedate.=" and ";
			}
			$fedate=" DATE(Date)<='$edate'";
		}
		$query1=$this->db->query("select * from income_mst_t $source $fsdate $fedate");
		$incomeid= $query1->result();
		$result=$this->Income_Model->getincome($incomeid);
		return $result;

	}
	function getincome($incomeid)
	{
		$result=array();
		$result['income']=array();
		$result['paymode']=array();
		
		$result['total']=0;
		foreach ($incomeid as $income) {
			$iid=$income->SourceId;
			$pid=$income->PaymentMode;

			$result['total']=$result['total']+(int)$income->Amount;
			if($iid!=0)
			{
				$query2=$this->db->query("select * from income_source_mst_t where Id='$iid'");
				$income= $query2->result();
				$result['income'][]=$income[0];
			}
			else{
				$income="";	
			}
			if($pid!=0)
			{
				$query3=$this->db->query("select * from payment_category_mst_t where Id='$pid'");
				$paymode= $query3->result();
				$result['paymode'][]=$paymode[0];
			}
			else{
				$paymode="";	
			}
		}
		/*$query4=$this->db->query("select * from stud_fee_mst_t where StudId='$id'");
		$fees= $query4->result();*/
		$result['incomeid']=$incomeid;
		return $result;
	}
function todaysincome($orgid,$branchid,$aid){
	date_default_timezone_set('Asia/Kolkata');
	$date=date("Y-m-d");
	$result=array();
	$result['income']=array();
	$result['students']=array();
	$pstatus="Paid";
	$query=$this->db->query("select * from fee_pay_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and Date(CreatedAt)='$date' and Status='$pstatus'");
	$income=$query->result();
	$result['income']=$income;	
	foreach ($income as $row) {
		$sid=$row->StudentId;
		$query2=$this->db->query("select * from student_mst_t where Id='$sid' and OrgId='$orgid' and BranchId='$branchid'");
		$student= $query2->result();
		$result['students'][]=$student[0];
			
	}	
	return $result;
	}
	function todaysincomes(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$result=array();
		$result['income']=array();
		$result['students']=array();
		$pstatus="Unpaid";
		$query=$this->db->query("select * from stud_fee_mst_t where PaymentDate<='$date' and PaymentStatus='$pstatus'");
		$income=$query->result();
		$result['income']=$income;	
		foreach ($income as $row) {
			$orgid=$row->OrgId;
			$branchid=$row->BranchId;
			$sid=$row->StudId;
			$query2=$this->db->query("select * from student_mst_t where Id='$sid'");
			$student= $query2->result();
			$result['students'][]=$student[0];
			$duration="today is ";
				if($row->PaymentDate<$date){
					$duration=$row->PaymentDate." was";
				}
				$query1=$this->db->query("select * from student_mst_t where Id='$sid'");
				$student= $query1->result();
				$msg="Dear ".$student[0]->Name.", ".$duration." last date of your these months fees";
				$this->Sms_model->sms($orgid,$student[0]->Phone,$msg);
				$this->Sms_model->savestudentsms($orgid,$branchid,$student[0]->Id,$msg);
			
			$type="fees";
			$url=base_url()."student/viewstudentdetails/".$student[0]->Id;
			$nmsg=$duration."last date of ".$student[0]->Name." fees";
			$this->Notification_Model->addnotification($orgid,$branchid,$type,$nmsg,$url);
		}	
		return $result;
	}
	function upcomingincome($orgid,$branchid,$aid){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$wdate=date("Y-m-d", strtotime("+1 week"));
		$result=array();
		$result['income']=array();
		$result['students']=array();
		$pstatus="Unpaid";
		$query=$this->db->query("select * from stud_fee_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and PaymentDate>'$wdate' and PaymentDate<'$date' and PaymentStatus='$pstatus' and AcademicId='$aid'");
		$income=$query->result();
		$result['income']=$income;	
		foreach ($income as $row) {
			$sid=$row->StudId;
			$query2=$this->db->query("select * from student_mst_t where Id='$sid' and OrgId='$orgid' and BranchId='$branchid'");
			$student= $query2->result();
			$result['students'][]=$student[0];
				
		}	
		return $result;
	}
	function fetchfincome($orgid,$branchid,$filter){
		
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$pstatus='Paid';
		$aid=$this->session->userdata('academic_id');

		if ($filter=="today"){
			//echo $filter;
			$query=$this->db->query("select * from fee_pay_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and Date(CreatedAt)='$date' and Status='$pstatus'");
		}
		else if($filter=="week"){
			$ndate=new DateTime();
			 $week = $ndate->format("W");
        $year = date("Y");
			$wdate = new DateTime();
			$wdate->setISODate($year, $week);

			$start = $wdate->format('Y-m-d');
				/*$end = $date->modify('+6 days')->format('Y-m-d');*/
			$query=$this->db->query("select * from fee_pay_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and Date(CreatedAt)>'$start' and Date(CreatedAt)<'$date' and Status='$pstatus'");
			
		}
		else{
		$start=date("Y-m-01");
			$query=$this->db->query("select * from fee_pay_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and Date(CreatedAt)>'$start' and Date(CreatedAt)<'$date' and Status='$pstatus'");
		}
		$result=array();
		$result['income']=array();
		$result['students']=array();
		$pstatus="Unpaid";
		
		$income=$query->result();
		$result['income']=$income;	
		foreach ($income as $row) {
			$sid=$row->StudentId;
			$query2=$this->db->query("select * from student_mst_t where Id='$sid' and OrgId='$orgid' and BranchId='$branchid'");
			$student= $query2->result();
			$result['students'][]=$student[0];
		}	
		return $result;
	}
	function fetchincomeedit($id){
		$result=array();
		$incomeid=array();
		$income=array();
		$paymode=array();
		$result['income']=array();
		$result['paymode']=array();
		$query=$this->db->query("select * from income_mst_t where Id='".$id."'");
		$result=$query->result();
		$incomeid=$query->result();

		
		foreach ($incomeid as $income) {
				$iid=$income->SourceId;
				$pid=$income->PaymentMode;
				if($iid!=0)
				{
				$query2=$this->db->query("select * from income_source_mst_t where Id='$iid'");
				$income= $query2->result();
				$result['income'][]=$income[0];
				}
				else{
				$income="";	
				}
				if($pid!=0)
				{
				$query3=$this->db->query("select * from payment_category_mst_t where Id='$pid'");
				$paymode= $query3->result();
				$result['paymode'][]=$paymode[0];
				}
				else{
				$paymode="";	
				}
		}

			
			/*$query4=$this->db->query("select * from stud_fee_mst_t where StudId='$id'");
			$fees= $query4->result();*/
			$result['incomeid']=$incomeid;
			
			

			
		return $result;
	}
	function totalincome(){
		$query=$this->db->query("select SUM(Amount) as income from income_mst_t");
		$result=$query->result();
		return $result;
	}
	function updaterecords($id,$date,$sourceid,$amount,$paymentid,$note)
	{
	date_default_timezone_set('Asia/Kolkata');
	$date1=date("Y-m-d h:i:sa");
	$query=$this->db->query("update income_mst_t SET SourceId='$sourceid',Date='$date',Amount='$amount',PaymentMode='$paymentid',Notes='$note',UpdatedAt='$date1' where Id='".$id."'");
	}

	function fetchsource($orgid){
	$query=$this->db->query("select * from income_source_mst_t where OrgId='".$orgid."'");
	$result=$query->result();
	return $result;
	}

	function fetchcategory(){
	$orgid=1;	
	$query=$this->db->query("select * from expense_category_mst_t where OrgId='".$orgid."'");
	$result=$query->result();
	return $result;
	}
	function deleteincome($id)
	{
	$this->db->query("delete  from income_mst_t where Id='".$id."'");
	}
	
}

?>	
