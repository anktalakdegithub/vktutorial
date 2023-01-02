<?php
class Category_Model extends CI_Model 
{
	function fetchcategories()
	{
		
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$query=$this->db->query("select * from course_category_mst_t order by CategoryId DESC");
		$result=$query->result();
		return $result;
	}

	function fetchcategory($id)
	{
		
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();

		$query=$this->db->query("select * from course_category_mst_t where CategoryId='".$id."'");
		$categories=$query->result();
		
		$result['category']=$categories[0];
		$pid=$categories[0]->Id;
			$query=$this->db->query("select * from post_mst_t where CategoryId='".$pid."' order by CategoryId DESC");
			$nposts=$query->num_rows();
			$posts=$query->result();
			$result['posts']=$posts;
			$result['nposts']=$nposts;
		return $result;
	}

	function addcategory($cname,$thumbnail)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query="insert into course_category_mst_t(CategoryName,Thumbnail,CreatedAt,UpdatedAt) values('$cname','$thumbnail','$date','$date')";
			$this->db->query($query);
	}
	function updatecategory($id,$cname,$file)
	{
		date_default_timezone_set('Asia/Kolkata');
	$date=date("Y-m-d h:i:sa");
	$query=$this->db->query("update course_category_mst_t SET CategoryName='$cname',Thumbnail='$file', UpdatedAt='$date' where CategoryId='".$id."'");
	}

	function deletecategory($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");	
		$query1=$this->db->query("SELECT  * FROM course_category_mst_t where CategoryId='$id'");
		$category= $query1->result();
		if(count($category)>0)
		{
			if($category[0]->Thumbnail!=""){
				$url=str_replace("https://arkdes.sgp1.cdn.digitaloceanspaces.com/","",$category[0]->Thumbnail);
            	$this->Spaces_Model->delete_file($url);
            } 
		}
		$this->db->query("delete  from course_category_mst_t where CategoryId='".$id."'");
	}
}
?>