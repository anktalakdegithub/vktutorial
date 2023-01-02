<div class="sa4d25">
<div class="container">
<?php
$from_date='';
$to_date='';
$student_id='';
$batch_id='';
if(isset($_GET['from_date'])){
    $from_date = $_GET['from_date'];
}
if(isset($_GET['to_date'])){
    $to_date = $_GET['to_date'];
}
if(isset($_GET['batch_id'])){
    $batch_id = $_GET['batch_id'];
}
if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
}
?>
<style type="text/css">
   .img-container{
   position:relative;
   display:inline-block;
   }
   .img-container .overlay{
   position:absolute;
   top:0;
   left:0;
   height: 180px;
   width:100%;
   background:rgb(0,0,0,.5);
   opacity:0;
   transition:opacity 500ms ease-in-out;
   }
   .img-container .overlay{
   opacity:1;
   }
   .img-container:hover .overlay{
   opacity:0.7;
   }
   .overlay span{
   position:absolute;
   top:50%;
   left:50%;
   transform:translate(-50%,-50%);
   color:#fff;
   }
   .updatesort
   {
   display: none;
   }
</style>
<div class="row">
   <div class="col-md-8 col-12">
      <h2 class="st_title"><i class="uil uil-analysis"></i>Attendance</h2>
      <br>
   </div>
   <div class="col-md-4 col-12 text-right">
      <button type="button" data-direction="next" class="updatesort btn btn-default steps_btn">Update Sorting</button>    
      <?php 
         $access=$this->session->userdata('access');
         $course=array();
         $course=$access->courses;
         if(in_array("add", $course) || in_array("all", $course)){
           ?>
      <a href="<?=base_url();?>admin/Attendance/attendance" class="btn btn-default steps_btn" style="padding-top: 10px !important;">Add Attendance</a>  
      <?php
         }
         ?>
          <a href="<?=base_url();?>admin/Attendance/attendance_api" class="btn btn-default steps_btn" style="padding-top: 10px !important;">Add Biometric Attendance</a>  
   </div>
</div>
<div class="row">
   <div class="col-md-12 order-12 order-md-1">
        <div class="row">
            <div class="col-md-3 my-3">
                <div class="card">
                    <div class="card-body">
                    <label>Select Batch</label>
                        <div class="input-group">
                       
                            <select class="custom-select form-control" id="batch_id">
                                <option value="" selected>Choose...</option>
                                <?php 
                                foreach($batches as $batch){

                                    $batch = json_encode($batch);
                                    $batch = json_decode($batch,true);
                            ?>
                                 <option value="<?=$batch['Id'];?>" <?php if($batch_id==$batch['Id']){ echo "selected"; } ?>><?php echo $batch['Name'] ; ?></option>
                            <?php
                                }
                                ?>
                                <!-- <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option> -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card">
                    <div class="card-body">
                    <label>Select student</label>
                        <div class="input-group">
                       
                            <select class="custom-select form-control" id="student_id">
                                <option value="" selected>Choose...</option>
                               
                                <!-- <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option> -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-3">
                <div class="card">
                    <div class="card-body">
                        <label>Select Dates</label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="date" class="form-control"  id="from_date" value="<?=$from_date;?>">
                        
                          </div>

                          <div class="col-md-4">
                            <input type="date" class="form-control"  id="to_date" value="<?=$to_date;?>">
                        
                          </div>
                        <div class="col-md-4">
                          <button type="submit" class="btn btn-primary" id="filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
      <!-- <div class="row" id="load_data"> -->
        <div class="card">
            <div class="card-body">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Student Contact</th>
                        <th scope="col">Batch Name</th>
                        <th scope="col">Attendance Date</th>
                        <th scope="col">In Time</th>
                        <th scope="col">Out Time</th>
                        <th scope="col">Present/Absent</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 0;
                    // echo '<pre>';
                    // print_r($students);
                    // die;
                    foreach($students as $stu){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i+1; ?></th>
                        <td><?=$stu->FirstName.' '.$stu->MiddleName.' '.$stu->LastName ; ?></td>
                        <td><?=$stu->Phone;?><?php if(count($parents[$i])>0){ echo ","; } ?> 
                          <?php 
                          $j=0;
                          foreach ($parents[$i] as $parent) {
                            if($i==(count($parents[$i])-1))
                            {
                            ?>
                            <?=$parent->Phone;?>
                            <?php
                            }
                            else{
                              ?>
                            <?=$parent->Phone;?>,
                            <?php
                            }
                           $j++;
                          }
                          ?>
                        <td><?=$stu->Name;?></td>
                        <td><?=$stu->attendance_date?></td>
                        <td><?php  if($stu->is_absent!="1"){
                                        echo date("h:i A", strtotime($stu->in_time)) ;
                                    }else{
                                        echo "-";
                                    } ?></td>
                        <td><?php  if($stu->is_absent!="1"){
                                        echo date("h:i A", strtotime($stu->out_time)) ;
                                    }else{
                                        echo "-";
                                    } ?></td>
                        <td><?php 
                            if($stu->attendance_date){
                              if($stu->is_absent==1){
?>
                                <span class="badge badge-pill badge-danger">Absent</span>
                                <?php
                              }
                              else{
                                ?>
                                <span class="badge badge-pill badge-success">Present</span>
                                <?php
                              } 
                                if($stu->is_late==1){
                                    ?>
                                    <span class="badge badge-pill badge-warning">Late</span>
                                    <?php
                                }
                            } else{
                                ?>
                                <span class="badge badge-pill badge-danger">Absent</span>
                                <?php
                            }
                            // echo $stu->FirstName.' '.$stu->MiddleName.' '.$stu->LastName ; 
                            ?></td>
                            <td><?=$stu->remark;?></td>
                            <td>
                              <?php 
                            if($stu->attendance_date){
                                ?>
                                
                              <button class="update_data btn btn-default" data-id="<?=$stu->attendance_id;?>"  data-in-time="<?=$stu->in_time;?>" data-absent="<?=$stu->is_absent;?>" data-late="<?=$stu->is_late;?>" data-remark="<?=$stu->remark;?>" data-out-time="<?=$stu->out_time;?>" data-type="update" data-toggle="modal" data-target="#attendanceModel"><i class="fa fa-edit"></i></button>
                                <?php
                            }else{
                                ?>
                                <button class="add_data btn btn-default" data-toggle="modal" data-id="<?=$stu->StudentId;?>" data-type="add" data-target="#attendanceModel"><i class="fa fa-edit"></i></button>
                                <?php
                            }
                            // echo $stu->FirstName.' '.$stu->MiddleName.' '.$stu->LastName ; 
                            ?>

                                 <button class="delete_data btn btn-default" data-toggle="modal" data-id="<?=$stu->attendance_id;?>" data-type="add" data-target="#deleteattendanceModal"><i class="fa fa-trash"></i></button>
                            </td>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                    
                    
                </tbody>
            </table>
            </div>
        </div>
          <div class="modal" id="deleteattendanceModal">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-body">
                                <h3>Are you sure you want to delete?</h3>
                                  <button class="btn btn-danger deleteattendance" id="deleteattendance" value="">Delete</button> 
                              </div>
                            </div>
                          </div>
                        </div>
           <div class="modal" id="attendanceModel">
                          <div class="modal-dialog">
                            <div class="modal-content">
                <div class="modal-header">
                                <h3>Change Details</h3>
                              </div>
                              <div class="modal-body">
                                 <div class="ui search focus lbel25 mb-3">
                                  <label>In Time</label>
                                  <div class="ui left icon input swdh19">
                                    <input class="prompt srch_explore" type="time" placeholder="Enter In Time" id="in_time">                  
                                  </div>
                                </div>
                                 <div class="ui search focus lbel25 mb-3">
                                  <label>Out Time</label>
                                  <div class="ui left icon input swdh19">
                                    <input class="prompt srch_explore" type="time" placeholder="Enter In Time" id="out_time">                  
                                  </div>
                                </div><br>
                                 <div class="ui search focus lbel25 mb-3">
                                 <input type="checkbox" id="is_late">  <strong>Is Late?</strong>
                                </div>
                                 <div class="ui search focus lbel25 mb-3">
                                 <input type="checkbox" id="is_absent">  <strong>Is Absent?</strong>
                                </div>
                                 <div class="ui search focus lbel25 mb-3">
                                  <label>Enter Remark</label>
                                 <textarea class="form-control" id="remark"></textarea>
                                </div>
            <br>
            <div id="msg"></div>
            <button data-direction="next" class="btn btn-default steps_btn" id="add" data-type="" value="">Add</button> 
      </div>
          </div>
        </div>
      </div>
      <!-- </div> -->
        <div align="center">
            <?php //$pagination?>
        </div>
   </div>
</div>
<script type="text/javascript">

$('body').on('change', '#batch_id', function(){ 
  getbatchstudents();
});
function getbatchstudents() {
  $.ajax({
    url:"<?=base_url();?>admin/batch/getbatchstudents",
      method:"POST",
      data:{'batch_id':$('#batch_id').val()},
      dataType: 'JSON',
      success:function(data)
      {
      var html='<option value="">Select student</option>';
      for(i=0;i<data.length;i++){
        html+='<option value="'+data[i].Id+'">'+data[i].FirstName+' '+data[i].LastName+'</option>'
      }
      $('#student_id').html(html);
      }
  });
}

  $('body').on('click', '.delete_data', function(){ 
    $('#deleteattendance').val($(this).attr('data-id'));
  });
  $('body').on('click', '.update_data', function(){ 
    $('#in_time').val($(this).attr('data-in-time'));
    $('#out_time').val($(this).attr('data-out-time'));
    $('#remark').val($(this).attr('data-remark'));
    $('#is_absent').val($(this).attr('data-absent'));
    if($(this).attr('data-absent')==1){
      $('#is_absent').attr('checked', true);
    }
     if($(this).attr('data-late')==1){
      $('#is_late').attr('checked', true);
    }
    $('#add').attr("data-type",$(this).attr('data-type'));
    $('#add').val($(this).attr('data-id'));
  //  $('#in_time').val($(this).attr('data-in-time'));
  });
  $('body').on('click', '.add_data', function(){ 
    $('#add').val($(this).attr('data-id'));
    $('#add').attr("data-type",$(this).attr('data-type'));
    $('#in_time').val("");
    $('#remark').val("");
    $('#out_time').val("");
  //  $('#in_time').val($(this).attr('data-in-time'));
  });
  $('body').on('click', '#add', function(){ 
    var in_time = $('#in_time').val();
    var out_time = $('#out_time').val();
    var attendance_date = $('#date').val();
    var remark = $('#remark').val();
    var is_late=0;
    if($('#is_late:checked').val()){
             is_late=1;
            }
    var is_absent=0;
    if($('#is_absent:checked').val()){
             is_absent=1;
            }
            var type=$(this).attr('data-type');
            var id = $(this).val();
    $.ajax({
        url: "<?= base_url()?>admin/attendance/update_attendance",
        data: {in_time:in_time,out_time:out_time,is_late:is_late,type:type,id:id,attendance_date:attendance_date,remark:remark,is_absent:is_absent},
        type: "post",
        success: function(data){
                swal("Attendance updated successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
                   location.reload();
                }, 2000);
        }
        });
  });
   $("#load_data").sortable({
      update: function (event, ui) {
        $('.updatesort').css("display","inline-block");
      }
   });
   $('.updatesort').click(function(){
        var sids=[];
        $( ".courses" ).each(function() {
        sids.push($(this).attr('id'));
        });
        console.log(sids);
        $.ajax({
        url: "<?= base_url()?>admin/course/sort_order_courses",
        data: {sids:sids},
        type: "post",
        success: function(data){
                swal("Sort order updated successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
                    location.reload();
                }, 2000);
        }
        });
   });

    $('.deleteattendance').click(function() {
      var attendance_id=$(this).val();
      $.ajax({
          url: "<?= base_url()?>admin/attendance/deleteattendance",
          data: {attendance_id:attendance_id},
          type: "post",
          success:function(data)
          {
              swal("Data deleted successfully!", "", "success");
              setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
    });
    //console.log(cname);
  });
   $('body').on('click', '.delete', function(){ 
   var id=$(this).val();
   $('#dmsg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait course deleting....</div>');
   $.ajax({
   url:"<?=base_url();?>admin/course/deletecourse",
   method:"POST",
   data:{id:id},
   success:function(data)
     {
       swal("course deleted successfully!", "", "success");
       setTimeout(function () {
           swal.close();
           //  location.href="<?=base_url();?>admin/course";
       }, 2000);
     }
   });
   })

   $('#filter').click(function(){
    // $('#get_report').click(function(){
       
        let batch_id = document.querySelector("#batch_id").value;
        let student_id = document.querySelector("#student_id").value;
        let from_date = document.querySelector("#from_date").value;
        let to_date = document.querySelector("#to_date").value;
       location.href="Attendance?batch_id="+batch_id+"&student_id="+student_id+"&from_date="+from_date+"&to_date="+to_date;
    //   })
        // var sids=[];
        // $( ".courses" ).each(function() {
        // sids.push($(this).attr('id'));
        // });
        // console.log(sids);
        // $.ajax({
        // url: "<?= base_url()?>admin/course/sort_order_courses",
        // data: {sids:sids},
        // type: "post",
        // success: function(data){
        //         swal("Sort order updated successfully!", "", "success");
        //     setTimeout(function () {
        //             swal.close();
        //             location.reload();
        //         }, 2000);
        // }
        // });
   });
</script>
