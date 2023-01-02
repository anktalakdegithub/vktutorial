<?php
class Sms_Model extends CI_Model 
{
	public function send_sms($phone,$msg)
	{
                $url = "http://sms.hspsms.com:/sendSMS";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, 'username=RELIABLEACADEMY&message='.$msg.'&sendername=RELIBL&smstype=PROMO&numbers='.$phone.'&apikey=92b22b47-a854-4b0f-8212-bdbe3b0ec51e');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                return $result;
	}
        function addgroupsms($sids,$msg)
        {
                $sid=implode(",", $sids);
                date_default_timezone_set('Asia/Kolkata');
                $date=date("Y-m-d h:i:sa");
                $query="insert into sms_mst_t(StudentId,Message,Sending_Time) values('$sid','$msg','$date')";
                $this->db->query($query);
                $msgid=$this->db->insert_id();
                return $msgid;
        }
        function update_smscodes($msgid,$scodes)
        {
                $scode=implode(",", $scodes);
                $query=$this->db->query("update sms_mst_t SET SmsCode='$scode' where Id='".$msgid."'");
        }
        function fetchallsms($startid)
        {
                $start="";
                if ($startid>0) {
                        $start=" where Id<'$startid'";
                }
                $query=$this->db->query("select * from sms_mst_t $start order by Id DESC LIMIT 10");
                $sms=$query->result();
                return $sms;
        }
        function fetch_sms_students($msgid)
        {
                $result=array();
                $result['students']=array();
                $result['status']=array();
                $result['sms']=array();
                $query=$this->db->query("select * from sms_mst_t where Id='$msgid'");
                $sms=$query->result();
                if (count($sms)>0) {
                        $result['sms']=$sms;
                        $sids=explode(",", $sms[0]->StudentId);
                        $scodes=explode(",", $sms[0]->SmsCode);
                        $i=0;
                        foreach ($sids as $sid) {
                                $query=$this->db->query("select * from student_mst_t where Id='$sid'");
                                $student=$query->result();
                                if (count($student)>0) {
                                        $result['students'][]=$student[0];
                                        $url="http://sms.hspsms.com/getDLR?username=RELIABLEACADEMY&msgid=".$scodes[$i]."&apikey=92b22b47-a854-4b0f-8212-bdbe3b0ec51e";
                                            $ch = curl_init();
                                            // Will return the response, if false it print the response
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            // Set the url
                                            curl_setopt($ch, CURLOPT_URL,$url);
                                            // Execute
                                            $sresult=curl_exec($ch);
                                            // Closing
                                            curl_close($ch);
                                            $sstatus=json_decode($sresult);
                                            $result['status'][]=$sstatus[0]->dlr_status;
                                }
                                $i++;
                        }
                }
                return $result;
        }
        function fetch_monthly_sms($month,$year)
        {
                $query=$this->db->query("select * from sms_mst_t where MONTH(Sending_Time)='$month' and YEAR(Sending_Time)='$year'");
                $sms=$query->result();
                return $sms;
        }
}