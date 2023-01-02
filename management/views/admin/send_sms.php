 <div class="sa4d25">
 <div class="row">
      <div class="col-md-9 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Send sms</h2><br>
      </div>    
      <div class="col-md-3 col-6 text-right">
<!--<a href="<?=base_url();?>admin/notifications/history" class="btn steps_btn" style="padding-top:10px !important;">view history</a>-->
      </div>      
    </div>  
  <div  class="row" style="padding-left: 30px;"> 
    <div class="col-md-7">
      <div class="panel">
          
              <div class="panel-body">
     <!-- <div class="row">
        <div class="col-md-8 col-6">
      
        </div>
        <div class="col-md-4 col-6">
          <div class="form-group">
            <select class="form-control" id="batches">
              <option value="">Select batch</option>
              <?php
                        $i=0;
                        foreach($batches as $batch)
                        {
              ?>
              <option value="<?=$batch->Id?>"><?=$batch->Name?></option>
                        <?php
              $i++;
                        }
                          ?>
            </select>
           
          </div>
        </div>
      </div>-->
      <div class="row">
        <div class="col-md-10 col-7">
          <input type="checkbox" name="select" class="select">&nbsp;&nbsp;<Strong>Select All</Strong>
        </div>
        <div class="col-md-2 col-5">
          <p id="count">0 Selected</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
         <input type="text" name="" placeholder="Search by student name" class="form-control" id="searchstud" style="width: 100%;">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12" id="studentdata" style="height:330px;overflow: auto;">
                    <?php
                        $i=0;
                        foreach($students as $row)
                        {
                          ?>
                          <div class="row">
                              <div class="col-md-1 col-3"><input type="checkbox" name="student" value="<?php echo $row->Id;?>"></div>
                              <div class="col-md-11 col-9">
                               <h4><?php echo $row->FirstName.' '.$row->MiddleName.' '.$row->LastName;?></h4>
                              <a href="#"><i class="fas fa-envelope"></i></a>&nbsp;Email:&nbsp;&nbsp; <?php echo $row->Email;?>&nbsp;&nbsp; 
              <span><a href="#"><i class="fas fa-phone"></i></a>&nbsp;Contact No.:&nbsp;&nbsp; <?php echo $row->Phone;?></span>
                             </div>
</div>
                  <hr>               
                      <?php
                      $i++;
                      }
                      ?>
                  
     </div>
     </div>            
 </div>
 </div>
</div>
 <div class="col-md-5">
  <div class="panel">
          
              <div class="panel-body">
  <div class="row">
    <div class="col-md-12" style="padding: 10px;">
   <h3>Send SMS</h3><br>
   <!--<div class="form-group row">
    <label class="col-md-4">Select sms template</label>
    <div class="col-md-6">
       <ul class="nav nav-tabs" id="tabs">
         
    <select class="form-control" id="studtemplate">
    <option value="">select template</option>
<option value="app">App Download</option>
    <option value="pmeeting">Parents meeting</option>
      <option value="Birthday">Birthday wishing</option>
     <option value="Holiday">Holiday SMS</option>
      <option value="Event">Event SMS</option>
    <option value="assubmission">Assignment submission</option>
    <option value="asincomplete">Assignment incomplete</option>
    <option value="fwishes">Festival wishes</option>
    <option value="ewishes">Exam wishes</option>
    <option value="relect">Lecture reschedule</option>
    <option value="clect">Lecture cancel</option>
    <option value="alect">Lecture absent</option>
    <option value="exam">Exam announcement</option>
    <option value="cexam">Exam cancelled</option>
    <option value="late">Late Entry</option>
    <option value="rexam">Exam result</option>
    <option value="rpayment">Payment reminder</option>
    <option value="Custom" selected>Custom Message</option>
    </select>
     </ul>
    </div>
 </div>-->
      <div class="tab-content" style="width: 100%;">
  <div class="stemplates" id="pmeeting" style="width: 100%;display: none;">
    

    <h4>SMS message</h4>
    <p>
      Dear <span id="parents">&lt;name&gt;</span>,<br>
        Kindaly attend the parents meeting on <input type="date" id="pdate"> from <input type="time" id="pstime"> to <input type="time" id="petime"> at <input type="text" id="venue">.
    </p>
</div>
<div class="stemplates" id="Birthday" style="width: 100%;display: none;">
 <p>Dear &lt;name&gt;,<br>
  <textarea rows="3"  id="bmessage" class="form-control"></textarea></p>
</div>
<div class="stemplates" id="Holiday" style="width: 100%;display: none;">
 <p>Dear &lt;name&gt;,<br>
It is notified to all the students that class will be closed on <input type="date" id="hsdate"> to <input type="date" id="hedate">
on account of <textarea rows="2"  id="hmessage" class="form-control"></textarea>
</div>
<div class="stemplates" id="Event" style="width: 100%;">
  <p>Dear &lt;name&gt;,<br>
    <textarea rows="3"  id="emessage" class="form-control"></textarea></p>
</div>
<div class="stemplates" id="app" style="width: 100%;display: none;">
  <p>Dear &lt;name&gt;,<br>
    Test Academy Online Classes, Study Materials, current affairs, govt. jobs, pdf & Test Series Download the app: https://bit.ly/TestAcademy</p>
</div>
<div class="stemplates" id="assubmission" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
Your assignment of <input type="text" id="assname"> submission date is <input type="date" id="assdate"></p>
</div>
<div class="stemplates" id="asincomplete" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
    didnt completed the<input type="text" id="asinname"> assignment given on date  <input type="date" id="asindate">
Attention recomended</p>
</div>
<div class="stemplates" id="fwishes" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
we wish you and your entire family a very happy <input type="text" id="fwname"></p>
</div>
<div class="stemplates" id="ewishes" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
All the best for your exam, put your best affords and hard work will pay for sure.</p>
</div>
<div class="stemplates" id="relect" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
your <input type="text" id="relname"> lecture is rescheduled on <input type="date" id="reldate"> from <input type="time" id="relstime"> to  <input type="time" id="reletime">
by <input type="text" id="relteacher">.</p>
</div>
<div class="stemplates" id="clect" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
your lecture <input type="text" id="clname"> on <input type="date" id="cldate"> has been cancelled.</p>
</div>
<div class="stemplates" id="exam" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
your <input type="text" id="ename"> test is scheduled on <input type="date" id="edate"> from <input type="time" id="estime"> to  <input type="time" id="eetime">
all the best.</p>
</div>
<div class="stemplates" id="cexam" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
your <input type="text" id="cename"> test conducted on <input type="date" id="cedate"> has been canceled .  </p>
</div>
<div class="stemplates" id="late" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br> was <input type="number" id="latemin"> min late for todays lecture
attention on punctuality recommended   </p>
</div>
<div class="stemplates" id="alect" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
    Dear name,
You were absent for the lecture conducted on  <input type="date" id="aldate"> from <input type="time" id="alstime"> to  <input type="time" id="aletime"> </p>
</div>
<div class="stemplates" id="rexam" style="width: 100%;display: none;">
   <p>Dear Parent,
Reportcard has been given to the students. Please check.</p>
</div>
<div class="stemplates" id="rpayment" style="width: 100%;display: none;">
   <p>Dear &lt;name&gt;,<br>
you are requested to pay the due fees. Ignore if already paid.</p>
</div>
<div class="stemplates" id="Custom" style="width: 100%;">
   <p>Dear &lt;name&gt;,<br>
    <textarea rows="3"  id="imessage" class="form-control"></textarea></p>
</div>
</div>
<div id="studentmsg"></div>
<button type="button" class="btn btn-primary" id="studsms">Send</button>
      </div>

  </div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
  $('body').on('click', '.select', function(){
    if ($(this).is(':checked')) {
        $("input[name='student']").attr('checked', true);
    } else {
        $("input[name='student']").attr('checked', false);
    }
    $('#count').html($("input[name='student']:checked").length+" selected");
});
$('body').on('click', 'input[name="student"]', function(){
    $('#count').html($("input[name='student']:checked").length+" selected");
});
 $('body').on('input', '#searchstud', function(){
    $.ajax({
        url: "<?= base_url()?>admin/student/searchsmsstudents",
        data: {'search':$(this).val(),'bid':$('#batches').val()},
        method: "post",
        dataType:'json',
        success: function(response){
          var len =response.students.length;
      // console.log(len);
       var htmltext="";
      // var len=data.length;
      if(len==0){
        htmltext+='<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no students found!!</p></div><div class="col-md-4"></div></div></div>';
      }
      else{
       for (var i = 0; i < len; i++) {
         htmltext+='<div class="row"><div class="col-md-1 col-3"><input type="checkbox" name="student" value="'+response.students[i].StudentId+'"></div><div class="col-md-11 col-9"><h4>'+response.students[i].FirstName+' '+response.students[i].MiddleName+' '+response.students[i].LastName+'</h4><br><a href="#"><i class="fas fa-envelope"></i></a>&nbsp;&nbsp;&nbsp;Email:&nbsp;&nbsp; '+response.students[i].Email+'              <span><a href="#"><i class="fas fa-phone"></i></a>&nbsp;&nbsp;&nbsp;Contact No.:&nbsp;&nbsp; '+response.students[i].Phone+'</span></div></div><hr>';
       }
       }
       $('#studentdata').html(htmltext);
      // alert(len);
      }
    });
});
var setDateTime = function(date, str){
    var sp = str.split(':');
    date.setHours(parseInt(sp[0],10));
    date.setMinutes(parseInt(sp[1],10));
    date.setSeconds(parseInt(sp[2],10));
    return date;
}
$("#send").click(function(){
  var students = [];
  $("input[name='student']:checked").each(function() {
    students.push($(this).val());
  });
  title=$('#title').val();
  body=$('#body').val();
  if(students.length==0){
    $('#smsg').html('<div class="alert alert-danger"><strong>Error! </strong>Please select atleast one student.</div>');
  }
  else if(title==""){
    $('#smsg').html('<div class="alert alert-danger"><strong>Error! </strong>Notification title required.</div>');
  }
  else{
    $('#smsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait notification sending to students....</div>');
    var formData = new FormData();
    file=$('input[name="image"]').get(0).files[0];
    formData.append('file', file);
    formData.append('title', title);
    formData.append('students',students);
    $.ajax({
      url: "<?=base_url();?>admin/notifications/sendnotification",
      data: formData,
      method: "post",
      headers: { 'IsAjax': 'true' },
      processData: false,
      contentType: false,
      success: function(response){
      $('#smsg').html('<div class="alert alert-success"><strong>Success! </strong>Notification send successfully.</div>');
      }
    });
  }
});

$("#batches").change(function(){
  if($(this).val()!=""){
  $.ajax({
        url: "<?= base_url()?>admin/student/fetchbatchtudents",
        data: {'bid':$(this).val()},
        method: "post",
        dataType:'json',
        success: function(response){
          var len = Object.keys(response.students).length;
          //console.log(len);
          var htmltext="";
          // var len=data.length;
          if(len==0){
            htmltext+='<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no students found!!</p></div><div class="col-md-4"></div></div></div>';
          }
          else{
            for (var i = 0; i < len; i++) {
              htmltext+='<div class="row"><div class="col-md-1 col-3"><input type="checkbox" name="student" value="'+response.students[i].StudentId+'"></div><div class="col-md-11 col-9"><h4>'+response.students[i].FirstName+' '+response.students[i].MiddleName+' '+response.students[i].LastName+'</h4><a href="#"><i class="fas fa-envelope"></i></a>&nbsp;&nbsp;&nbsp;Email:&nbsp;&nbsp; '+response.students[i].Email+'              <span><a href="#"><i class="fas fa-phone"></i></a>&nbsp;&nbsp;&nbsp;Contact No.:&nbsp;&nbsp; '+response.students[i].Phone+'</span></div></div><hr>';
           }
          }
       $('#studentdata').html(htmltext);
      // alert(len);
      }
    });
}
 });
$("#studsms").click(function(){
     var indiaTime = new Date().toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
current = new Date(indiaTime);
var c = current.getTime();
 start = setDateTime(new Date(current), '09:00:00');
 end = setDateTime(new Date(current), '21:00:00');

    var smstemplate=$('#studtemplate').val();
    var students = [];
    $("input[name='student']:checked").each(function() {
      students.push($(this).val());
    });
    console.log(students);
    if(students.length==0){
        $('#studentmsg').html('<div class="alert alert-danger"><strong>Error! </strong>please select atleast one student.</div>');
    }
    else if(smstemplate==""){
      $('#studentmsg').html('<div class="alert alert-danger"><strong>Error! </strong>please select a template.</div>');
    }
   /*  else  if ( c < start.getTime() || c > end.getTime())
    {
      $('#studentmsg').html('<div class="alert alert-danger"><strong>Error! </strong>please send sms between 09:00 AM to 09:00 PM.</div>');
    }*/
    else{
  
   
        $("#studsms").attr("disabled", true);
    
          $('#studentmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait sms sending to students....</div>');
      var message='';
  if(smstemplate=="pmeeting"){
    var pdate=$('#pdate').val();
    var pstime=$('#pstime').val();
    var petime=$('#petime').val();
    var venue=$('#venue').val();
     message="Kindaly attend the parents meeting on "+pdate+" from "+pstime+" to "+petime+" at "+venue+"."
  }
  else if (smstemplate=="Birthday") {
    message=$('#bmessage').val();
  }
   else if (smstemplate=="Holiday") {
    message="It is notified to all the students that class will be closed on "+$('#hsdate').val()+" to "+$('#hedate').val()+" on account of "+$('#hmessage').val()+".";
  }
   else if (smstemplate=="Event") {
    message=$('#emessage').val();
  }
  else if (smstemplate=="app") {
    message="Test Academy Online Classes, Study Materials, current affairs, govt. jobs, pdf & Test Series Download the app: https://bit.ly/TestAcademy";
  }
   else if (smstemplate=="assubmission") {
    message="assignment of "+$('#assname').val()+" submission date is "+$('#assdate').val()+".";
  }
   else if (smstemplate=="asincomplete") {
    message="you  didn\'t completed the "+$('#asinname').val()+" assignment given on date  "+$('#asindate').val()+" Attention recomended.";
  }
   else if (smstemplate=="fwishes") {
    message="we wish you and your entire family a very happy "+$('#fwname').val()+".";
  }
   else if (smstemplate=="ewishes") {
    message="All the best for your exam, put your best affords and hard work will pay for sure.";
  }
   else if (smstemplate=="relect") {
    message="your "+$('#relname').val()+" lecture is rescheduled on "+$('#reldate').val()+" from "+$('#relstime').val()+" to  "+$('#reletime').val()+" by "+$('#relteacher').val()+".";
  }
   else if (smstemplate=="clect") {
    message="your lecture "+$('#clname').val()+" on "+$('#cldate').val()+" has been cancelled.";
  }
   else if (smstemplate=="alect") {
    message="You were absent for the lecture conducted on  "+$('#aldate').val()+" from "+$('#alstime').val()+" to  "+$('#aletime').val()+".";
  }
   else if (smstemplate=="exam") {
    message="your "+$('#ename').val()+"> test is scheduled on "+$('#edate').val()+" from "+$('#estime').val()+" to "+$('#eetime').val()+" all the best.";
  }
   else if (smstemplate=="cexam") {
    message="your "+$('#cename').val()+" test conducted on "+$('#cedate').val()+" has been canceled .";
  }
   else if (smstemplate=="late") {
    message="you were "+$('#latemin').val()+" min late for todays lecture attention on punctuality recommended.";
  }
   else if (smstemplate=="rexam") {
    message="Dear parent, Reportcard has been given to the students. Please check.";
  }
   else if (smstemplate=="rpayment") {
    message="you are requested to pay the due fees. Ignore if already paid.";
  }
   else if (smstemplate=="Custom") {
    message=$('#imessage').val();
  }
  $.ajax({
      url: "<?= base_url()?>admin/sms/send_sms",
      data: {'smstemplate':smstemplate,'students':students,'message':message},
      type: "post",
      success: function(data){
        $('#studsms').attr("disabled", false);
        $('#studentmsg').html('<div class="alert alert-success"><strong>Success! </strong>Sms send successfully.</div>');
      }
    });
  }
});
$("#studtemplate").change(function(){
  var template=$(this).val();
  if(template=="pmeeting"){
    $('.stemplates ').css("display","none");
    $('#pmeeting').css("display","block");
  }
  else if(template=="Birthday"){
    $('.stemplates ').css("display","none");
    $('#Birthday').css("display","block");
  }
  else if(template=="Holiday"){
    $('.stemplates ').css("display","none");
    $('#Holiday').css("display","block");
  }
  else if(template=="Event"){
    $('.stemplates ').css("display","none");
    $('#Event').css("display","block");
  }
  else if(template=="app"){
    $('.stemplates ').css("display","none");
    $('#app').css("display","block");
  }
  else if(template=="assubmission"){
    $('.stemplates ').css("display","none");
    $('#assubmission').css("display","block");
  }
  else if(template=="asincomplete"){
    $('.stemplates ').css("display","none");
    $('#asincomplete').css("display","block");
  }
  else if(template=="fwishes"){
    $('.stemplates ').css("display","none");
    $('#fwishes').css("display","block");
  }
  else if(template=="ewishes"){
    $('.stemplates ').css("display","none");
    $('#ewishes').css("display","block");
  }
  else if(template=="relect"){
    $('.stemplates ').css("display","none");
    $('#relect').css("display","block");
  }
  else if(template=="clect"){
    $('.stemplates ').css("display","none");
    $('#clect').css("display","block");
  }
  else if(template=="alect"){
    $('.stemplates ').css("display","none");
    $('#alect').css("display","block");
  }
  else if(template=="exam"){
    $('.stemplates ').css("display","none");
    $('#exam').css("display","block");
  }
  else if(template=="cexam"){
    $('.stemplates ').css("display","none");
    $('#cexam').css("display","block");
  }
  else if(template=="late"){
    $('.stemplates ').css("display","none");
    $('#late').css("display","block");
  }
  else if(template=="rexam"){
    $('.stemplates ').css("display","none");
    $('#rexam').css("display","block");
  }
  else if(template=="rpayment"){
    $('.stemplates ').css("display","none");
    $('#rpayment').css("display","block");
  }
  else if(template=="Custom"){
    $('.stemplates ').css("display","none");
    $('#Custom').css("display","block");
  }
 });
</script>