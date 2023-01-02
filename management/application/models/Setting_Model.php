<?php
class Setting_Model extends CI_Model 
{
	function fetchinquirysource(){
		$query1=$this->db->query("select * from enquiry_action_mst_t");
		$result= $query1->result();
		return $result;
	}
	function fetchincomesources(){
		$query1=$this->db->query("select * from income_source_mst_t");
		$result= $query1->result();
		return $result;
	}
	function fetchexpensecategories(){
		$query1=$this->db->query("select * from expense_category_mst_t");
		$result= $query1->result();
		return $result;
	}
	function fetchpaymentcategories(){
		$query1=$this->db->query("select * from payment_category_mst_t");
		$result= $query1->result();
		return $result;
	}
	function fetchhomesldier(){
		$student=array();
		$query1=$this->db->query("SELECT  * FROM slider_images_mst_t order by Sort_order");
		$sliders= $query1->result();
		return $sliders;
	}
	function upload($images)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query1=$this->db->query("SELECT  * FROM slider_images_mst_t");
		$count= $query1->num_rows();
		$norder=$count+1;	
		foreach ($images as $image) {
			$query="insert into slider_images_mst_t(SliderImages,Sort_order,CreatedAt,UpdatedAt) values('$image','$norder','$date','$date')";
			$this->db->query($query);
			$norder=$norder+1;
		}
	}
	function sort_order_slider($sids)
	{
		$i=1;
		foreach ($sids as $sid) {
			$query=$this->db->query("update slider_images_mst_t SET Sort_order='$i' where Id='$sid'");
			$i++;
		}
	}
	public function update($id,$image)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$query=$this->db->query("update slider_images_mst_t SET SliderImages='$image', UpdatedAt='$date' where Id='".$id."'");
	}
	function delete($id)
	{
		$query1=$this->db->query("delete from slider_images_mst_t where Id='$id'");
	}
}
?>