<?php
class Expense_Model extends CI_Model 
{
	function saverecords($date,$category,$amount,$vendor,$paymentid,$note)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query="insert into expense_mst_t(ExpenseDate,Category,Vendor	,Amount,PaymentMode,Notes,CreatedAt,UpdatedAt) values('$date','$category','$vendor','$amount','$paymentid','$note','$date','$date')";
		$this->db->query($query);
	}
	function fetchexpense(){
		$expense=array();	
		$result=array();	
		date_default_timezone_set('Asia/Kolkata');
		$month=date("m");
		$year=date("Y");
		$query=$this->db->query("select * from expense_mst_t where MONTH(ExpenseDate)='$month' and YEAR(ExpenseDate)='$year'");
		$expense=$query->result();
		$result=$this->Expense_Model->getexpense($expense);
		return $result;
	}
	function fetchexpensedata($cid,$vid,$sdate,$edate)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$expense=array();
		if ($cid!="" && $vid!="" && $sdate!="" && $edate!="") {
			$query1=$this->db->query("select * from expense_mst_t where Category ='$cid' and Vendor='$vid' and ExpenseDate >='$sdate' and ExpenseDate<='$edate'");
		}
		else if ($cid!="" && $vid!=""  && $sdate!="" && $edate=="") {
			$query1=$this->db->query("select * from expense_mst_t where Category='$cid' and Vendor='$vid' and ExpenseDate>='$sdate'");
		}
		else if ($cid!="" && $vid!="" && $sdate=="" && $edate!=""){
			$query1=$this->db->query("select * from expense_mst_t where Category='$cid' and ExpenseDate<='$edate' and Vendor='$vid'");
		}
		else if ($cid!="" && $vid=="" && $sdate!="" && $edate!="") {
			$query1=$this->db->query("select * from expense_mst_t where ExpenseDate>='$sdate' and ExpenseDate<='$edate' and Category='$cid'");
		}
		else if ($cid=="" && $vid!="" && $sdate!="" && $edate!="") {
			$query1=$this->db->query("select * from expense_mst_t where ExpenseDate>='$sdate' and ExpenseDate<='$edate' and Vendor='$vid'");
		}
		else if ($cid=="" && $vid=="" && $sdate!="" && $edate!="") {
			$query1=$this->db->query("select * from expense_mst_t where ExpenseDate >='$sdate' and ExpenseDate<='$edate'");
		}
		else if ($cid!="" && $vid=="" && $sdate=="" && $edate!="") {
			$query1=$this->db->query("select * from expense_mst_t where Category ='$cid' and ExpenseDate<='$edate'");
		}
		else if ($cid=="" && $vid!="" && $sdate=="" && $edate!="") {
			$query1=$this->db->query("select * from expense_mst_t where Vendor='$vid' and ExpenseDate<='$edate'");
		}
		else if ($cid=="" && $vid=="" && $sdate!="" && $edate!="") {
			$query1=$this->db->query("select * from expense_mst_t where ExpenseDate >='$sdate' and ExpenseDate<='$edate'");
		}
		elseif ($cid!="" && $vid=="" && $sdate!="" && $edate=="") {
			$query1=$this->db->query("select * from expense_mst_t where Category ='$cid' and ExpenseDate >='$sdate'");
		}
		else if ($cid=="" && $vid!="" && $sdate!="" && $edate=="") {
			$query1=$this->db->query("select * from expense_mst_t where Vendor='$vid' and ExpenseDate >='$sdate'");
		}
		else if ($cid!="" && $vid!="" && $sdate=="" && $edate=="") {
			$query1=$this->db->query("select * from expense_mst_t where Category ='$cid' and Vendor='$vid'");
		}
		else if ($cid=="" && $vid=="" && $sdate=="" && $edate!="") {
			$query1=$this->db->query("select * from expense_mst_t where ExpenseDate<='$edate'");
		}
		else if ($cid=="" && $vid=="" && $sdate!="" && $edate=="") {
			$query1=$this->db->query("select * from expense_mst_t where ExpenseDate >='$sdate'");
		}
		else if ($cid=="" && $vid!="" && $sdate=="" && $edate=="") {
			$query1=$this->db->query("select * from expense_mst_t where Vendor='$vid'");
		}
		else if ($cid!="" && $vid=="" && $sdate=="" && $edate=="") {
			$query1=$this->db->query("select * from expense_mst_t where Category ='$cid'");
		}
		else{
			$query1=$this->db->query("select * from expense_mst_t");
		}

	$expense=$query1->result();
	$result=$this->Expense_Model->getexpense($expense);
	return $result;

	}
	function getexpense($expense)
	{
	$result=array();	
	$result['expense']=array();
	$result['paymode']=array();
	$result['amount']=0;
	foreach ($expense as $row) {
			$result['amount']=$result['amount']+$row->Amount;
			$pid=$row->PaymentMode;
			$vid=$row->Vendor;
			$cid=$row->Category;
			
			if($pid!=0)
			{
			$query2=$this->db->query("select * from payment_category_mst_t where Id='$pid'");
			$paymode= $query2->result();
			$result['paymode'][]=$paymode[0];
			}
			else{
			$result['paymode'][]="";	
			}
			if($cid!=0)
			{
			$query2=$this->db->query("select * from expense_category_mst_t where Id='$cid'");
			$paymode= $query2->result();
			$result['ecategory'][]=$paymode[0];
			}
			else{
			$result['ecategory'][]="";	
			}
			if($cid!=0)
			{
			$query2=$this->db->query("select * from expense_category_mst_t where Id='$vid'");
			$paymode= $query2->result();
			$result['evendor'][]=$paymode[0];
			}
			else{
			$result['evendor'][]="";	
			}
	}

	$result['expense']=$expense;
	
	return $result;
	}


	function fetchfexpense($orgid,$branchid,$filter){
		$aid=$this->session->userdata('academic_id');
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$pstatus='Paid';
		$expense=array();
	$paymode=array();
	$result=array();

		if ($filter=="today"){
			//echo $filter;
				
	$query=$this->db->query("select * from expense_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and ExpenseDate='$date' and AcademicId='$aid'");
		}
		else if($filter=="week"){
			$ndate=new DateTime();
			 $week = $ndate->format("W");
        $year = date("Y");
$wdate = new DateTime();
$wdate->setISODate($year, $week);

$start = $wdate->format('Y-m-d');
				/*$end = $date->modify('+6 days')->format('Y-m-d');*/
						
	$query=$this->db->query("select * from expense_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and ExpenseDate>='$start' and ExpenseDate<='$date' and AcademicId='$aid'");
			
		}
		else{
		$start=date("Y-m-01");
						
	$query=$this->db->query("select * from expense_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and ExpenseDate>='$start' and ExpenseDate<='$date' and AcademicId='$aid'");
		}

	$expense=$query->result();
$result['paymode']=array();
	
	foreach ($expense as $row) {
			
			$pid=$row->PaymentMode;
			$vid=$row->Vendor;
			$cid=$row->Category;
			
			if($pid!=0)
			{
			$query2=$this->db->query("select * from payment_category_mst_t where Id='$pid'");
			$paymode= $query2->result();
			$result['paymode'][]=$paymode[0];
			}
			else{
			$result['paymode'][]="";	
			}
			if($cid!=0)
			{
			$query2=$this->db->query("select * from expense_category_mst_t where Id='$cid'");
			$paymode= $query2->result();
			$result['ecategory'][]=$paymode[0];
			}
			else{
			$result['ecategory'][]="";	
			}
			if($cid!=0)
			{
			$query2=$this->db->query("select * from expense_category_mst_t where Id='$vid'");
			$paymode= $query2->result();
			$result['evendor'][]=$paymode[0];
			}
			else{
			$result['evendor'][]="";	
			}
	}

	$result['expense']=$expense;
	return $result;
	}
	function todaysexpense($orgid,$branchid,$aid){
	$expense=array();
	$paymode=array();
	$result=array();	
	date_default_timezone_set('Asia/Kolkata');
	$date=date("Y-m-d");
	$query=$this->db->query("select * from expense_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and ExpenseDate='$date' and AcademicId='$aid'");
	$result=$query->result();
	$expense=$query->result();
	$result['paymode']=array();
	
	foreach ($expense as $row) {
			
			$pid=$row->PaymentMode;
			$vid=$row->Vendor;
			$cid=$row->Category;
			
			if($pid!=0)
			{
			$query2=$this->db->query("select * from payment_category_mst_t where Id='$pid'");
			$paymode= $query2->result();
			$result['paymode'][]=$paymode[0];
			}
			else{
			$result['paymode'][]="";	
			}
			if($cid!=0)
			{
			$query2=$this->db->query("select * from expense_category_mst_t where Id='$cid'");
			$paymode= $query2->result();
			$result['ecategory'][]=$paymode[0];
			}
			else{
			$result['ecategory'][]="";	
			}
			if($cid!=0)
			{
			$query2=$this->db->query("select * from expense_category_mst_t where Id='$vid'");
			$paymode= $query2->result();
			$result['evendor'][]=$paymode[0];
			}
			else{
			$result['evendor'][]="";	
			}
	}

	$result['expense']=$expense;
	
	return $result;
	}

	//***********************Fetch Expense Data for Edit************************//
	function fetchexpenseedit($id)
	{
	
	$expense=array();
	$paymode=array();
	$result=array();	
	$query=$this->db->query("select * from expense_mst_t where Id='".$id."'");
	$result=$query->result();
	$expense=$query->result();
	
	$result['expense']=$expense;
	

	return $result;
	}

	function updaterecords($id,$date,$category,$amount,$vendor,$paymentid,$note)
	{
	date_default_timezone_set('Asia/Kolkata');
	$date1=date("Y-m-d h:i:sa");
	$query=$this->db->query("update expense_mst_t SET ExpenseDate='$date',Category='$category',Vendor='$vendor',Amount='$amount',PaymentMode='$paymentid',Notes='$note',UpdatedAt='$date1' where Id='".$id."'");
	}	
function totalexpense($orgid,$branchid,$aid){
		date_default_timezone_set('Asia/Kolkata');
		$cdate=date("Y-m-d");
		 $cmonth = date("m",strtotime($cdate));
		$cyear=date("Y",strtotime($cdate));
		$month=01;

   $fdate =date('Y-01-01');
   $month = date("m",strtotime($fdate));
   $result=array();
 //  echo $month;
   $result['amount']=array();
   $result['months']=array();
    while($month<=$cmonth){
		//echo $cmonth;
		
		$query=$this->db->query("select COALESCE(SUM(Amount),0) as total from expense_mst_t where OrgId='".$orgid."' and BranchId='$branchid' and MONTH(ExpenseDate)='$month' and AcademicId='$aid'");
	$income=$query->result();
	$result['amount'][]=$income[0]->total;
	$result['months'][]=date("M",strtotime($fdate));
		   $fdate = date("Y-m-d",strtotime($fdate."+1 month"));
		 $month = date("m",strtotime($fdate));
		}
		return $result;
	}

	function overallexpense($orgid,$aid){
		$result=array();
	    $result['amount']=array();
	    $result['branches']=array();
	    $result['bamount']=array();
	    $query=$this->db->query("select * from branch_mst_t where OrgId='$orgid'");
		$branches= $query->result();
		date_default_timezone_set('Asia/Kolkata');
		$cdate=date("Y-m-d");
		 $cmonth =date("m",strtotime($cdate));
		$cyear=date("Y",strtotime($cdate));
		$month=01;

   $fdate =date('Y-01-01');
    $ldate = date("Y-m-d",strtotime($fdate."+1 year"));
   $month = date("m",strtotime($fdate));
   $result=array();
 //  echo $month;
   $result['amount']=array();
   $result['months']=array();
  $j=0;
		foreach ($branches as $row) {
			$result['bamount'][$j]=0;

			$j++;
		}
   while($fdate<$ldate){
		//echo $cmonth;
		$amount=0;
		$j=0;
		 $bamount=0;
		foreach ($branches as $row) {
			$bid=$row->Id;
			if($aid>0)
			{
				$query=$this->db->query("select COALESCE(SUM(Amount),0) as total from expense_mst_t where OrgId='".$orgid."' and BranchId='$bid' and MONTH(ExpenseDate)='$month' and AcademicId='$aid'");
			}
			else{
				$query=$this->db->query("select COALESCE(SUM(Amount),0) as total from expense_mst_t where OrgId='".$orgid."' and BranchId='$bid' and MONTH(ExpenseDate)='$month' and YEAR(ExpenseDate)='$cyear'");
			}
			$income=$query->result();
			$bamount=$income[0]->total;
			$amount=$amount+$income[0]->total;
			$result['bamount'][$j]=$result['bamount'][$j]+$bamount;
			
			$j++;
				}
			$result['amount'][]=$amount;
			$result['months'][]=date("M",strtotime($fdate));
		    $fdate = date("Y-m-d",strtotime($fdate."+1 month"));
		    $month = date("m",strtotime($fdate));
		}
		
		$result['branches']=$branches;
		return $result;
	}

	function fetchoverallexpense($aid,$orgid){
		date_default_timezone_set('Asia/Kolkata');
		$year=date("Y");
		$aid=$this->session->userdata('academic_id');
		$expense=array();	
		$result=array();	
		$sql='';
		if($aid>0){
			$sql="select * from expense_mst_t where OrgId='".$orgid."' and AcademicId='$aid'";
		}
		else{
			$sql="select * from expense_mst_t where OrgId='".$orgid."' and YEAR(ExpenseDate)='$year'";
		}
		$query=$this->db->query($sql);
		$expense=$query->result();
		$result=$this->Expense_Model->getexpense($expense);
		$result['branches']=$this->Expense_Model->expensebranch($expense);
		return $result;
	}
	function fetchorgexpense($orgid,$aid,$bid,$sdate,$edate)
	{
		$branch='';
		$start='';
		$end='';
		if (!empty($bid)) {
			$branch=" and BranchId='$bid'";
		}
		if (!empty($sdate)) {
			$start=" and PaymentDate>='$sdate'";
		}
		if (!empty($edate)) {
			$end=" and PaymentDate<='$edate'";
		}
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d");
		$year=date("Y");
		
		$pstatus="Paid";
		$sql='';
		if($aid>0){
			$sql="select * from expense_mst_t where OrgId='".$orgid."' and AcademicId='$aid' $branch $start $end";
		}
		else{
			$sql="select * from expense_mst_t where OrgId='".$orgid."' and YEAR(ExpenseDate)='$year' $branch $start $end";
		}
		$query=$this->db->query($sql);
		$expense=$query->result();
		$result=$this->Expense_Model->getexpense($expense);
		$result['branches']=$this->expensebranch($expense);
		return $result;
	}
	function expensebranch($expense){
		$result=array();
		foreach ($expense as $row) {
			
		$bid=$row->BranchId;
			$query2=$this->db->query("select * from branch_mst_t where Id='$bid'");
			$branch= $query2->result();
			$result[]=$branch[0];
		}
		return $result;
	}
	function deleteexpense($id)
	{
	$this->db->query("delete  from expense_mst_t where Id='".$id."'");
	}
}
?>	