<?php
class Coupon_Model extends CI_Model 
{

	function addcoupon($coupon_code,$description,$discount_percent,$coupon_amount,$expiry_date,$spend_amount,$per_coupon,$per_user)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query="insert into coupons_mst_t(CouponCode,Description,DiscountPercent,CouponAmount,ExpiryDate,MinPrice,PerCoupon,PerUser,CreatedAt,UpdatedAt) values('$coupon_code','$description','$discount_percent','$coupon_amount','$expiry_date','$spend_amount','$per_coupon','$per_user','$date','$date')";
		$this->db->query($query);
	}
	function fetchcoupons(){
		$student=array();
		$date=date("Y-m-d");	
		$query1=$this->db->query("SELECT  * FROM coupons_mst_t where CouponId>0 order by CouponId");
		$result= $query1->result();
		return $result;
	}

	function checkcoupon($coupon){
		$student=array();
		$date=date("Y-m-d");	
		$query1=$this->db->query("SELECT  * FROM coupons_mst_t where ExpiryDate>='$date' and CouponCode='$coupon'");
		$result= $query1->result();
		return $result;
	}
	function fetchbatch($id)
	{
		$query1=$this->db->query("SELECT  * FROM batch_mst_t where Id='$id'");
		$batch= $query1->result();
		return $batch;
	}
	function batchcoursesseries($id){
		$result=array();
		$result['batch']=array();
		$result['bcourses']=array();
		$result['bseries']=array();
		$batch=$this->fetchbatch($id);
		if (count($batch)>0) {
			$cids=$batch[0]->CourseId;
			if ($cids!="") {
				$query1=$this->db->query("SELECT  * FROM course_mst_t where Id IN ($cids)");
				$result['bcourses']= $query1->result();
			}
			$sids=$batch[0]->SeriesId;
			if ($sids!="") {
				$query1=$this->db->query("SELECT  * FROM mcq_category_mst_t where Id IN ($sids)");
				$result['bseries']= $query1->result();
			}
		}
		$result['batch']=$batch;
		return $result;
	}
	function fetchbatchsstudents()
	{
		$result=array();
		$result['batches']=array();
		$result['students']=array();
		$result['courses']=array();
		$query1=$this->db->query("SELECT  * FROM batch_mst_t");
		$batches= $query1->result();
		$result['batches']=$batches;
		foreach ($batches as $batch) {
			$bid=$batch->Id;
			$cid=$batch->Course_id;
			$query1=$this->db->query("SELECT  * FROM student_batch_mst_t where BatchId='$bid'");
			$result['students'][]= $query1->num_rows();
			$query1=$this->db->query("SELECT  * FROM course_mst_t where Id='$cid'");
			$result['courses'][]= $query1->num_rows();
		}
		return $result;
	}
	function fetchbatchstudents($id)
	{
		$result=array();
		$query=$this->db->query("select * from student_mst_t INNER JOIN student_batch_mst_t ON student_mst_t.Id=student_batch_mst_t.StudentId where student_batch_mst_t.BatchId='$id'");
		$result= $query->result();
		return $result;
	}
	function updatebatch($bid,$name,$course)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update batch_mst_t SET Name='$name',Course_id='$course',UpdatedAt='$date' where Id='".$bid."'");
	}
	function deletebatch($id)
	{
		$this->db->query("delete  from student_batch_mst_t where BatchId='".$id."'");	
		$this->db->query("delete  from batch_mst_t where Id='".$id."'");
	}
	function addcourse($bid,$cids)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$courses=implode(",", $cids);
		$query=$this->db->query("update batch_mst_t SET CourseId='$courses',UpdatedAt='$date' where Id='".$bid."'");
	}
	function activatebatch($bid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update batch_mst_t SET IsArchive='0',UpdatedAt='$date' where Id='".$bid."'");
	}
	function archivebatch($bid)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update batch_mst_t SET IsArchive='1',UpdatedAt='$date' where Id='".$bid."'");
	}
	function addseries($bid,$sids)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$series=implode(",", $sids);
		$query=$this->db->query("update batch_mst_t SET SeriesId='$series',UpdatedAt='$date' where Id='".$bid."'");
	}
}
?>