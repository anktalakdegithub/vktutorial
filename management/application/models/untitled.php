function fetch_single_blog($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$query=$this->db->query("select * from blog_mst_t where Id='".$id."'");
		$result=$query->result();
		return $result;
	}