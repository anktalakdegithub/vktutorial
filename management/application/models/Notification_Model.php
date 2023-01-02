<?php
class Notification_Model extends CI_Model 
{

 
    function addstudnotification($orgid,$branchid,$studid,$body,$nurl,$type)
    {
         date_default_timezone_set('Asia/Kolkata');
                $date=date("Y-m-d h:i:sa");   
            $query="insert into studnotifications_mst_t(OrgId,StudentId,Type,Message,Nurl,Ndate) values('$orgid','$studid','$type','$body','$nurl','$date')";
            $this->db->query($query);
    }
    
    function fetchstudnotifications($studid)
    {
        $query=$this->db->query("select * from notifications_mst_t");
        return $query->num_rows();
    }
   function addstudnotifications($studids,$title)
    {
         date_default_timezone_set('Asia/Kolkata');
                $date=date("Y-m-d h:i:sa");   
                $query="insert into studnotifications_mst_t(Message,StudentId,Ndate) values";
                foreach ($studids as $sid) {
                   $query.="('$title','$sid','$date')";
                }
                $query=rtrim($query,",");

            $this->db->query($query);
    }
    function fetchnotifications($startid,$limit)
    {
      if($startid>0){
        $query1=$this->db->query("SELECT  * FROM notifications_mst_t where Id<'$startid' ORDER BY ID DESC limit $limit");
      }
      else{
        $query1=$this->db->query("SELECT  * FROM notifications_mst_t ORDER BY ID DESC limit $limit");
      }
      $notifications= $query1->result();
      return $notifications;
    }
     function fetchstudentnotifications($studid,$startid,$limit)
    {
      $notifications=array();
      if($startid>0){
        $query1=$this->db->query("SELECT  * FROM notifications_mst_t where Id<'$startid' ORDER BY ID DESC limit $limit");
      }
      else{
        $query1=$this->db->query("SELECT  * FROM notifications_mst_t ORDER BY ID DESC limit $limit");
      }
      $anotifications= $query1->result();
      foreach ($anotifications as $row) {
        /*$studids=explode(",", $row->Students);
        if(in_array($studid, $studids)){
          $notifications[]=$row;
        }
*/
$notifications[]=$row;
      }
      return $notifications;
    }
    function closenotification($id)
    {
        $query=$this->db->query("update notifications_mst_t SET IsView='1' where Id='".$id."'");
    }
    function updatenstatus($orgid,$branchid)
    {
        echo $branchid;
        $query=$this->db->query("update notifications_mst_t SET IsNew='0' where OrgId='".$orgid."' and BranchId='$branchid' and IsNew='1'");
    }
    function deletenotification($id)
    {
      $query=$this->db->query("delete from notifications_mst_t where Id='$id'");
    }
    public function send_notification($batch_id,$type)
    {
      $query1=$this->db->query("SELECT  * FROM  student_batch_mst_t join device_tokens on device_tokens.student_id=student_batch_mst_t.StudentId where student_batch_mst_t.BatchId='$batch_id'");
      $students= $query1->result();
      $msg="";
      if($type=="lecture"){
        $msg="New lecture is added.";
      }
      else if($type=="worksheet"){
        $msg="New worksheet is added.";
      }
      else if($type=="assignment"){
        $msg="New assignment is added.";
      }
      else if($type=="qw"){
        $msg="New oral & written questions is added.";
      }
      else if($type=="exam"){
        $msg="New exam is added.";
      }
      else if($type=="counselling"){
        $msg="New counselling is added.";
      }
      $tokens = array_column($students, "token");
      if($tokens!=''){
      $url = 'https://fcm.googleapis.com/fcm/send';
      $priority="high";
      $notification= array('title' => $msg, 
        'body' => '',
        'sound' => 'default',
        "icon" => "https://vktutorials.com/img/VKLOGO.png"
      );
      $fields = array(
       'registration_ids' => $tokens,
       'notification' => $notification
      );


      $headers = array(
        'Authorization:key=AAAA70R-RoQ:APA91bFDQSWOuYq7KcbHnA7OV36e3eploF7sLrkP7dcRnrtTwztRfzZJMRx5OrTpqb-5-uPCRX0v9UVRTZ_v_kDGQM0WD1c8SUv0rpoGV9VAnccVo0Bxf-jUDpJomp8xudG5JO1nmlXs',
        'Content-Type: application/json'
      );

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch); 
    //  print_r($result);
      if ($result === FALSE) {
     //  die('Curl failed: ' . curl_error($ch));
      }
    }
      curl_close($ch);
    }
}
?>