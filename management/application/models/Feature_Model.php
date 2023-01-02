<?php
class Feature_Model extends CI_Model 
{
	function fetchallfeatures(){
		$webdb = $this->load->database('reliablewebdb', TRUE);
		$result=array();
		$result['categories']=array();
		$result['feature']=array();
		$query1=$webdb->query("SELECT  * FROM features_category_mst_t LIMIT 2");
		$categories= $query1->result();
		$result['categories']=$categories;
		foreach ($categories as $category) {
			$cid=$category->Id;
			$query1=$webdb->query("SELECT  * FROM features_mst_t where CategoryId='$cid' order by Id desc");
			$result['feature'][]= $query1->result();
		}
		return $result;
	}
	function fetchhomefeatures()
	{
		$webdb = $this->load->database('reliablewebdb', TRUE);
		$query1=$webdb->query("SELECT  * FROM features_mst_t order by Sort_order LIMIT 5");
		$result= $query1->result();
		return $result;
	}
}
?>