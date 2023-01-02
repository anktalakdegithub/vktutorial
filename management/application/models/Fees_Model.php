<?php
class Fees_Model extends CI_Model 
{


	function totalfees(){
		date_default_timezone_set('Asia/Kolkata');
		$year=date("Y");
		$result=array();
		$result['total']=0;
		$result['todaytotal']=0;
		$result['paid']=0;
		$result['todayspaid']=0;
		$result['unpaid']=0;
		$result['todaysunpaid']=0;
		$result['unclear']=0;
		$result['todaysunclear']=0;

		$query=$this->db->query("select SUM(Amount) as total from stud_fee_mst_t");
		$amount=$query->result();
		if($amount!=""){
			$result['total']=$amount[0]->total;
		}
		$date=date('Y-m-d');
		$query=$this->db->query("select SUM(Amount) as todaytotal from stud_fee_mst_t where PaymentDate='$date'");
		$amount=$query->result();
		if($amount!=""){
			$result['todaytotal']=$amount[0]->todaytotal;
		}
		$query=$this->db->query("select SUM(AmountPaid) as total from stud_fee_mst_t where AmountPaid>0");
		$paid=$query->result();
		if($paid!=""){
			$result['paid']=$paid[0]->total;
		}
		$date=date('Y-m-d');
		$query=$this->db->query("select SUM(AmountPaid) as todaytotal from stud_fee_mst_t where AmountPaid>0 and PaymentDate='$date'");
		$todayspaid=$query->result();
		if($todayspaid!=""){
			$result['todayspaid']=$todayspaid[0]->todaytotal;
		}
		$query=$this->db->query("select SUM(AmountUnclear) as total from stud_fee_mst_t where AmountUnclear>0 and PaymentStatus='Unclear'");
		$unclear=$query->result();
		if($unclear!=""){
			$result['unclear']=$unclear[0]->total;
		}
		$result['unpaid']=($result['total']-$result['paid'])-$result['unclear'];

		$date=date('Y-m-d');
		$query=$this->db->query("select SUM(AmountUnclear) as todaytotal from stud_fee_mst_t where AmountUnclear>0 and PaymentStatus='Unclear' and PaymentDate='$date'");
		$todaysunclear=$query->result();
		if($todaysunclear!=""){
			$result['todaysunclear']=$todaysunclear[0]->todaytotal;
		}
		$result['todaysunpaid']=($result['todaytotal']-$result['todayspaid'])-$result['todaysunclear'];
		// print_r($result);
		// die();
		return $result;
	}
	function fetch_paid_fees($startid)
	{
		$start="";
		if($startid>0){
			$start=" and Id<'$startid'";
		}
		$query=$this->db->query("select * from stud_fee_mst_t where AmountPaid>0  $start order by Id DESC");
		$income=$query->result();
		$result['income']=array();
		$result['students']=array();
		$result['paid']=0;
		$result['income']=$income;	
		foreach ($income as $row) {
			$result['paid']=$result['paid']+$row->AmountPaid;
			$sid=$row->StudentId;
			$query2=$this->db->query("select * from student_mst_t where Id='$sid'");
			$student= $query2->result();
			$result['students'][]=$student[0];	
		}
		$income=$query->result();
		return $result;
	}

	function deletefees($id)
	{
		$this->db->query("delete from stud_fee_mst_t where Id='$id'");
	}
	function fetchmonthlypaidfees($month,$year)
	{
		$query=$this->db->query("select * from stud_fee_mst_t where AmountPaid>0 and MONTH(PaymentDate)='$month' and YEAR(PaymentDate)='$year' order by Id DESC");
		$income=$query->result();
		$result['income']=array();
		$result['students']=array();
		$result['paid']=0;
		$result['income']=$income;	
		foreach ($income as $row) {
			$result['paid']=$result['paid']+$row->AmountPaid;
			$sid=$row->StudentId;
			$query2=$this->db->query("select * from student_mst_t where Id='$sid'");
			$student= $query2->result();
			$result['students'][]=$student[0];	
		}
		$income=$query->result();
		return $result;
	}
	function fetchmonthlyunpaidfees($month,$year,$batch)
	{
		$filter_batch= '';
		if($batch!=''){
			$filter_batch = "and BatchId='$batch'";
		}
		$query=$this->db->query("select * from stud_fee_mst_t where AmountPaid<Amount  and MONTH(PaymentDate)='$month' and YEAR(PaymentDate)='$year' $filter_batch order by Id DESC");
		$income=$query->result();
		$result['income']=array();
		$result['students']=array();
		$result['unpaid']=0;	
		foreach ($income as $row) {
			$unpaid=$row->Amount-($row->AmountPaid+$row->AmountUnclear);
			if($unpaid>0){
				$result['income'][]=$row;
				$result['unpaid']=$result['unpaid']+$row->AmountPaid;
				$sid=$row->StudentId;
				$query2=$this->db->query("select * from student_mst_t where Id='$sid'");
				$student= $query2->result();
				$result['students'][]=$student[0];
			}	
		}
		$income=$query->result();
		return $result;
	}
	function fetchmonthlyunclearfees($month,$year)
	{
		$query=$this->db->query("select * from stud_fee_mst_t where PaymentStatus='Unclear' and MONTH(PaymentDate)='$month' and YEAR(PaymentDate)='$year' order by Id DESC");
		$income=$query->result();
		$result['income']=array();
		$result['students']=array();
		$result['unclear']=0;	
		foreach ($income as $row) {
			$result['income'][]=$row;
			$result['unclear']=$row->AmountUnclear;
			$sid=$row->StudentId;
			$query2=$this->db->query("select * from student_mst_t where Id='$sid'");
			$student= $query2->result();
			$result['students'][]=$student[0];
		}
		$income=$query->result();
		return $result;
	}
	function fetch_unpaid_fees($startid)
	{
		$start="";
		if($startid>0){
			$start=" and Id<'$startid'";
		}
		$month = date('m');
		$year = date('Y');
		$query=$this->db->query("select * from stud_fee_mst_t where AmountPaid<Amount and MONTH(PaymentDate)='$month' and YEAR(PaymentDate)='$year' $start order by Id DESC");
		$income=$query->result();
		$result['income']=array();
		$result['students']=array();
		$result['unpaid']=0;	
		foreach ($income as $row) {
			$unpaid=$row->Amount-($row->AmountPaid+$row->AmountUnclear);
			if($unpaid>0){
				$result['income'][]=$row;
				$result['unpaid']=$result['unpaid']+$row->AmountPaid;
				$sid=$row->StudentId;
				$query2=$this->db->query("select * from student_mst_t where Id='$sid'");
				$student= $query2->result();
				$result['students'][]=$student[0];
			}	
		}
		$income=$query->result();
		return $result;
	}
	function fetch_unclear_fees($startid)
	{
		$start="";
		if($startid>0){
			$start=" and Id<'$startid'";
		}
		$query=$this->db->query("select * from stud_fee_mst_t where PaymentStatus='Unclear'   $start order by Id DESC");
		$income=$query->result();
		$result['income']=array();
		$result['students']=array();
		$result['unclear']=0;	
		foreach ($income as $row) {
			$result['income'][]=$row;
			$result['unclear']=$row->AmountUnclear;
			$sid=$row->StudentId;
			$query2=$this->db->query("select * from student_mst_t where Id='$sid'");
			$student= $query2->result();
			$result['students'][]=$student[0];
		}
		$income=$query->result();
		return $result;
	}
	function updatefees($id,$iamount,$idate){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update stud_fee_mst_t SET Amount='$iamount', PaymentDate='$idate' where Id='".$id."'");
	}
	function updatefeestatus($aid,$id,$studid,$pstatus,$iamount,$pamount,$pmethod,$pdate,$remaining){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$iaremaining=$iamount-$pamount;
		$query1=$this->db->query("select * from stud_fee_mst_t where Id>'$id' and StudentId='$studid' and PaymentStatus='Unpaid'");
		$fee= $query1->result();
		if(count($fee)>0){
			$amount=$fee[0]->Amount+$iaremaining;
			$query=$this->db->query("update stud_fee_mst_t SET Amount='$amount' where Id='".$fee[0]->Id."'");
		}
		$query1=$this->db->query("select * from stud_fee_mst_t where Id='$id'");
		$fee= $query1->result();
		if($pstatus=="Paid"){
			$paid=$fee[0]->AmountPaid+$pamount;
			$query=$this->db->query("update stud_fee_mst_t SET PaymentStatus='$pstatus', PaymentMethod='$pmethod', Amount='$pamount',AmountPaid='$pamount' where Id='".$id."'");
			$query=$this->db->query("insert into income_mst_t(StudentId,Amount,PaymentMode,SourceId,Date
			) values('$studid','$pamount','$pmethod','1','$date')");
		}
		else if($pstatus=="Unclear"){
			$query=$this->db->query("update stud_fee_mst_t SET PaymentStatus='$pstatus', PaymentMethod='$pmethod', Amount='$pamount', AmountUnclear='$pamount' where Id='".$id."'");
		}
		else{
			$ucamount=$fee[0]->AmountUnclear-$pamount;
			$query=$this->db->query("update stud_fee_mst_t SET PaymentStatus='$pstatus', PaymentMethod='$pmethod', Amount='$pamount', AmountUnclear='$ucamount' where Id='".$id."'");
		}
	}
}
?>