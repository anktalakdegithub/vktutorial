<?php
class Blog_Model extends CI_Model 
{
	function addpost($category,$title,$content,$photo,$post,$slug)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$cdate=date("Y-m-d");
		$user_id=$this->session->userdata('user_id');
		$content=str_replace("'", "\'", $content);
		$title=str_replace("'", "\'", $title);
		$slug=str_replace("'", "\'", $slug);
		$query="insert into blog_mst_t(user_id,CategoryId,Title,Image,Content,PostDate,Ispublish,post_slug,CreatedAt,UpdatedAt) values('$user_id','$category','$title','$photo','$content','$cdate','$post','$slug','$date','$date')";
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
	function updatepost($id,$category,$title,$content,$image,$post,$slug)
	{
	date_default_timezone_set('Asia/Kolkata');
	$date=date("Y-m-d h:i:sa");
		$content=str_replace("'", "\'", $content);
		$title=str_replace("'", "\'", $title);
		$slug=str_replace("'", "\'", $slug);
	$query=$this->db->query("update blog_mst_t SET Title='$title',CategoryId='$category',Content='$content',Image='$image',post_slug='$slug', UpdatedAt='$date' where Id='".$id."'");
	}	
	function update_featured($id,$featured)
	{
	date_default_timezone_set('Asia/Kolkata');
	$date=date("Y-m-d h:i:sa");
	$query=$this->db->query("update blog_mst_t SET is_featured='$featured', UpdatedAt='$date' where Id='".$id."'");
	}	
	function update_publish($id,$ispublish)
	{
	date_default_timezone_set('Asia/Kolkata');
	$date=date("Y-m-d h:i:sa");
	$query=$this->db->query("update blog_mst_t SET Ispublish='$ispublish', UpdatedAt='$date' where Id='".$id."'");
	}	

	function searchposts($keyword)
	 {
	 	$search=strtolower($keyword);
		$query=$this->db->query("SELECT * FROM blog_mst_t where  (lower(Title) LIKE '%$keyword%')");
		$result=$query->result();
		return $result;
	 }

	function fetchposts($category)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$posts=array();
		if($category!=""){
			$query=$this->db->query("select * from blog_category_mst_t where category_slug='$category'");
			$posts=$query->result();
			$query=$this->db->query("select blog_mst_t.*,blog_category_mst_t.* from blog_mst_t inner join blog_category_mst_t on blog_mst_t.CategoryId=blog_category_mst_t.Id where blog_category_mst_t.category_slug='$category'");
			$posts=$query->result();
		}
		else{
			$query=$this->db->query("select * from blog_mst_t order by Id DESC");
			$posts=$query->result();
		}
		$result['categories']=array();
		$result['users']=array();
		foreach ($posts as $row) {
			$cid=$row->CategoryId;
			$query=$this->db->query("select * from blog_category_mst_t where Id='".$cid."'");
			$category=$query->result();
			$result['categories'][]=$category[0];
			$user_id=$row->user_id;
			$query=$this->db->query("select * from users_mst_t where Id='".$user_id."'");
			$user=$query->result();
			
		}
		$result['posts']=$posts;
		return $result;
	}
	function fetch_featured_blogs(){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$posts=array();
		$query=$this->db->query("select * from blog_mst_t where is_featured='1' and ispublish='1'");
		$blogs=$query->result();
		$result['blogs']=$blogs;
		return $result;
	}

	function fetchauthor_posts($user_id){
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$posts=array();
		$query=$this->db->query("select * from blog_mst_t where ispublish='1' and user_id='$user_id'");
			$posts=$query->result();
		$result['categories']=array();
		foreach ($posts as $row) {
			$cid=$row->CategoryId;
			$query=$this->db->query("select * from blog_category_mst_t where Id='".$cid."'");
			$category=$query->result();
			$result['categories'][]=$category[0];
			$user_id=$row->user_id;
		}
		$result['posts']=$posts;
		return $result;
	}
	function fetchblogs($page,$category)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$blogs=array();
		if($category!=""){
			$query=$this->db->query("select * from blog_mst_t where CategoryId='$category' and ispublish='1' $publish order by Id DESC LIMIT 10 OFFSET $page");
			$blogs=$query->result();
		}
		else{
			$query=$this->db->query("select * from blog_mst_t where ispublish='1'order by Id DESC LIMIT 10 OFFSET $page");
			$blogs=$query->result();
		}
		$result['categories']=array();
		foreach ($blogs as $row) {
			$cid=$row->CategoryId;
			$query=$this->db->query("select * from blog_category_mst_t where Id='".$cid."'");
			$category=$query->result();
			$result['categories'][]=$category;
		}
		$result['blogs']=$blogs;
		return $result;
	}

	function fetchadminresources($page,$category,$author)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$posts=array();
		if($category!=""){
			$query=$this->db->query("select * from blog_mst_t where CategoryId='$category' order by Id DESC LIMIT 10 OFFSET $page");
			$posts=$query->result();
		}
		else if($author!=""){
			$query=$this->db->query("select * from blog_mst_t where user_id='$author' order by Id DESC LIMIT 10 OFFSET $page");
			$posts=$query->result();
		}
		else{
			$query=$this->db->query("select * from blog_mst_t  order by Id DESC LIMIT 10 OFFSET $page");
			$posts=$query->result();
		}
		$result['categories']=array();
		$result['users']=array();
		foreach ($posts as $row) {
			$cid=$row->CategoryId;
			$query=$this->db->query("select * from blog_category_mst_t where Id='".$cid."'");
			$category=$query->result();
			$result['categories'][]=$category[0];
			$user_id=$row->user_id;
		}
		$result['posts']=$posts;
		return $result;
	}
	function fetchhomeposts()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$query=$this->db->query("select * from blog_mst_t order by Id DESC LIMIT 6");
		$posts=$query->result();
		$result['categories']=array();
		foreach ($posts as $row) {
			$cid=$row->CategoryId;
			$query=$this->db->query("select * from blog_category_mst_t where Id='".$cid."'");
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
		$query=$this->db->query("select * from blog_mst_t where Id='".$id."'");
		$post=$query->result();
		$result['category']=array();
		$result['posts']=array();
		$result['user']=array();
		foreach ($post as $row) {
			$cid=$row->CategoryId;
			$user_id=$row->user_id;
			$query=$this->db->query("select * from users_mst_t where Id='".$user_id."'");
			$user=$query->result();
			$result['user']=$user[0];
			$query=$this->db->query("select * from blog_category_mst_t where Id='".$cid."'");
			$category=$query->result();
			$result['category']=$category[0];
			$query=$this->db->query("select * from blog_mst_t where CategoryId='".$cid."' limit 3");
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

	function fetch_single_blog($slug)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$query=$this->db->query("select * from blog_mst_t where post_slug='".$slug."'");
		$result=$query->result();
		return $result;
	}

	function deletepost($id)
	{
			$query=$this->db->query("select * from blog_mst_t where Id='".$id."'");
			$post=$query->result();
			if (count($post)>0) {
				if($post[0]->Image!=''){
					if(file_exists("./".$post[0]->Image)){
						
				unlink("./".$post[0]->Image);
					}
				}
			}
	$this->db->query("delete  from blog_mst_t where Id='".$id."'");
	}

	function fetchidpost($id)
	{
		$query=$this->db->query("select * from blog_mst_t where Id='".$id."'");
		$post=$query->result();
		return $post;
	}
	function addcategory($name,$keywords)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$cdate=date("Y-m-d");
		$query="insert into blog_category_mst_t(Name,keywords,CreatedAt,UpdatedAt) values('$name','$keywords','$date','$date')";
		$this->db->query($query);
	}

	function fetchcategories()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();
		$query=$this->db->query("select * from blog_category_mst_t order by Id DESC");
		$categories=$query->result();
		$result['categories']=$categories;
		$result['blogs']=array();
		foreach ($categories as $category) {
			$id=$category->Id;
			$query=$this->db->query("select * from blog_mst_t where CategoryId='".$id."' order by Id DESC");
			$blogs=$query->num_rows();
			$result['blogs'][]=$blogs;
		}
		return $result;
	}

	function fetchcategory($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:sa");
		$result=array();

		$query=$this->db->query("select * from blog_category_mst_t where Id='".$id."'");
		$categories=$query->result();
		
		$result['category']=$categories[0];
		$pid=$categories[0]->Id;
			$query=$this->db->query("select * from blog_mst_t where CategoryId='".$pid."' order by Id DESC");
			$nposts=$query->num_rows();
			$posts=$query->result();
			$result['posts']=$posts;
			$result['nposts']=$nposts;
		return $result;
	}

    function updatecategory($id,$name,$keywords)
	{
	date_default_timezone_set('Asia/Kolkata');
	$date=date("Y-m-d h:i:sa");
	$query=$this->db->query("update blog_category_mst_t SET Name='$name',keywords='$keywords', UpdatedAt='$date' where Id='".$id."'");
	}	


	function deletecategory($id)
	{
		$query=$this->db->query("select * from blog_mst_t where CategoryId='".$id."'");
			$posts=$query->result();
			foreach ($posts as $post) {
				if($post->Image!=''){
					if(file_exists("./".$post->Image)){
						
						unlink("./".$post->Image);
					}
				}
			}
	$this->db->query("delete  from blog_category_mst_t where Id='".$id."'");
	$this->db->query("delete from  blog_mst_t where CategoryId='".$id."'");
	}
}
?>