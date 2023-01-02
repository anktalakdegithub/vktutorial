<?php
class Currentaffair_Model extends CI_Model 
{
	function addpost($category,$title,$content,$curl,$photo,$post,$lbanner,$cbanner)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$cdate=date("Y-m-d");
		$query="insert into post_mst_t(CategoryId,Title,Image,Content,ContentUrl,PostDate,Ispublish,RightBanner,CenterBanner,CreatedAt,UpdatedAt) values('$category','$title','$photo','$content','$curl','$cdate','$post','$lbanner','$cbanner','$date','$date')";
		$this->db->query($query);
	}

 public function get_count() {
        return $this->db->count_all($this->table);
    }

    public function get_authors($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }
	function updatepost($id,$category,$title,$content,$curl,$image,$post)
	{
	date_default_timezone_set('Asia/Kolkata');
	$date=date("Y-m-d h:i:sa");
	$query=$this->db->query("update post_mst_t SET Title='$title',CategoryId='$category',Content='$Content',Image='$image',ContentUrl='$curl', UpdatedAt='$date' where Id='".$id."'");
	}	

	function searchposts($keyword)
	 {
	 	$search=strtolower($keyword);
		$query=$this->db->query("SELECT * FROM post_mst_t where  (lower(Title) LIKE '%$keyword%')");
		$result=$query->result();
		return $result;
	 }

	function fetchposts($keywords)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		if($keywords!=""){
			$query=$this->db->query("select * from post_mst_t  where  (lower(Title) LIKE '%$keywords%') order by Id DESC");
			$posts=$query->result();
		}
		else{
			$query=$this->db->query("select * from post_mst_t order by Id DESC");
			$posts=$query->result();
		}
		$result['categories']=array();
		foreach ($posts as $row) {
			$cid=$row->CategoryId;
			$query=$this->db->query("select * from category_mst_t where Id='".$cid."'");
			$category=$query->result();
			$result['categories'][]=$category[0];
		}
		$result['posts']=$posts;
		return $result;
	}

	function fetchpost($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$query=$this->db->query("select * from post_mst_t where Id='".$id."'");
		$post=$query->result();
		$result['category']=array();
		$result['posts']=array();
		foreach ($post as $row) {
			$cid=$row->CategoryId;
			$query=$this->db->query("select * from category_mst_t where Id='".$cid."'");
			$category=$query->result();
			$result['category']=$category[0];
			$query=$this->db->query("select * from post_mst_t where CategoryId='".$cid."' limit 3");
			$posts=$query->result();
			$result['posts']=$posts;
		}
		$result['post']=$post[0];
		$pid="0";
		$query=$this->db->query("select * from comment_mst_t where parent_comment_id='".$pid."'and postid='".$id."' order by Id DESC");
		$comments=$query->result();
		$result['replies']=array();
		foreach ($comments as $comment) {
			$cid=$comment->Id;
			$query=$this->db->query("select * from comment_mst_t where parent_comment_id='".$cid."'");
			$result['replies'][]=$query->result();
		}
		$result['comments']=$comments;
		return $result;
	}

	function deletepost($id)
	{
	$this->db->query("delete  from post_mst_t where Id='".$id."'");
	}

}
?>