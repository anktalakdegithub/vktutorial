 <div class="sa4d25">
 <div class="row">
      <div class="col-md-9 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Send Email</h2><br>
      </div>    
      <div class="col-md-3 col-6 text-right">
<!-- <a href="<?=base_url();?>admin/notifications/history" class="btn steps_btn" style="padding-top:10px !important;">view history</a> -->
      </div>      
    </div>  
  <div  class="row" style="padding-left: 30px;"> 
    <div class="col-md-7">
      <div class="card">
          
              <div class="card-body">
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
   <div class="card">
          
              <div class="card-body">
                <h3>Send Email</h3>
<div class="row">
    <div class="col-md-12">
  
<div id="smsg"></div><br>
<div class="form-group">
  <label>Title</label>
  <input type="text" class="form-control" name="title" id="title">
</div>
 <div class="form-group">
  <label>Message</label>
  <textarea class="body form-control" id="message"></textarea>
 </div>
<div id="smsg"></div>
<button type="button" class="btn btn-primary" id="send">Send</button>

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
  if(students.length==0){
    $('#smsg').html('<div class="alert alert-danger"><strong>Error! </strong>Please select atleast one student.</div>');
  }
  else if(title==""){
    $('#smsg').html('<div class="alert alert-danger"><strong>Error! </strong>Notification title required.</div>');
  }
  else{
    $('#smsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait notification sending to students....</div>');
    var formData = new FormData();
    formData.append('title', $('#title').val());
    formData.append('message', $('#message').val());
    formData.append('students',students);
    $.ajax({
      url: "<?=base_url();?>admin/emails/sendemail",
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
</script>