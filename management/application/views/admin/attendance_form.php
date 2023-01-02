<div class="sa4d25">
<div class="container">
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
      <h2 class="st_title"><i class="uil uil-analysis"></i> Add Attendance</h2>
      <br>
   </div>
   <div class="col-md-4 col-12 text-right">
          
      <?php 
    date_default_timezone_set('Asia/Kolkata');
         $access=$this->session->userdata('access');
         $course=array();
         $course=$access->courses;
        //  if(in_array("add", $course) || in_array("all", $course)){
           ?>
      <!-- <a href="<?=base_url();?>admin/Attendance/attendance" class="btn btn-default steps_btn" style="padding-top: 10px !important;">Add Attendance</a>   -->
      <?php
        //  }

         ?>
   </div>
</div>
<div class="card card-body">
<div class="row">
   <div class="col-md-12 order-12 order-md-1">
        <div class="row">
      <div class="col-md-4 my-3">
                <div class="card">
                    <div class="card-body">
                    <label>Select Course</label>
                        <div class="input-group">
                            <select class="custom-select form-control" id="course_id">
                                <option selected>Choose...</option>
                                <?php 
                                foreach($courses as $batch){
                            ?>
                                 <option value="<?=$batch->Id ; ?>"><?php echo $batch->Title ; ?></option> 
                            <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3">
                <div class="card">
                    <div class="card-body">
                    <label>Select Batch</label>
                        <div class="input-group">
                       
                            <select class="custom-select form-control" id="batch_id">
                                <option selected>Choose...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3">
              <div class="card">
                    <div class="card-body">
                    <label>Choose Attendance Date</label>
                    <input type="date" class="form-control" name="attendance_date" id="attendance_date" value="<?=date('Y-m-d');?>">
                    </div>
                </div>
            </div>
        </div>
      <div class="row" id="load_data">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">student_name</th>
                    <th scope="col">in_time</th>
                    <th scope="col">out_time</th>
                    <th scope="col">Late</th>
                    <th scope="col">is_absent?</th>
                    <th scope="col">Remark</th>
                </tr>
            </thead>
            <tbody id="students">
                
            </tbody>
        </table>
        <button class="btn btn-default steps_btn" name="save" id="save">Save</button>
      </div>
   </div>
</div>
</div>
<script type="text/javascript">
   $("#load_data").sortable({
   update: function (event, ui) {
   $('.updatesort').css("display","inline-block");
   }
   });
   $('#course_id').change(function(){
      $.ajax({
        url: "<?= base_url()?>admin/batch/getcoursebatches",
        data: {course_id:$(this).val()},
        type: "post",
        dataType: 'JSON',
        success: function(data){
          //console.log(data);
            var html='<option value="">Select batch</option>';
            for (var i = 0; i < data.length; i++) {
              //console.log(data[i]);
              html+='<option value="'+data[i].Id+'">'+data[i].Name+'</option>';
            }
            $('#batch_id').html(html);
        }
      });
   })
   $('#batch_id').change(function(){
      $.ajax({
        url: "<?= base_url()?>admin/batch/getbatchstudents",
        data: {batch_id:$(this).val()},
        type: "post",
        dataType: 'JSON',
        success: function(data){
          //console.log(data);
            var html='';
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              html+='<tr class="students" data-id="'+data[i].Id+'"><td>'+(i+1)+'</td><td>'+data[i].FirstName+' '+data[i].LastName+'</td><td><input type="time" name="in_time" class="in_time form-control"/></td><td><input type="time" name="out_time" class="out_time form-control"/></td><td><input type="checkbox" name="is_late" class="is_late"/></td><td><input type="checkbox" name="is_absent" class="is_absent"/></td><td><textarea class="form-control remark"></textarea></td></tr>';
            }
            $('#students').html(html);
        }
      });
   })
   $('#save').click(function(){
        // $.ajax({
        //     type: "GET",
        //     url: "http://164.52.212.19:6005/api/v2/SendSMS?ApiKey=H+W/OCqlPh8H/ydSpwJPsZd0JY15p8iRIX3Bv9&ClientId={ClientId}&SenderId=SMSADS&Message={Message}&MobileNumbers={MobileNumbers}&Is_Unicode={Is_Unicode}&Is_Flash={Is_Flash}",
        //     contentType: "application/json",
        //     dataType: 'json',
        //     success: function (response) {               
        //     }
        // });
        var sids=[];
        var in_time = [];
        var out_time = [];
        var is_late = [];
        var remark = [];
        var is_absent = [];
        var i=0;
        $( ".students" ).each(function() {
         // if ($('.in_time').eq(i).val()!='') {
            sids.push($(this).attr('data-id'));
            in_time.push($('.in_time').eq(i).val());
            out_time.push($('.out_time').eq(i).val());
            remark.push($('.remark').eq(i).val());
            if($('.is_late').eq(i).is(':checked')){
              is_late.push("1");
            }
            else{
              is_late.push("0");
            }
            if($('.is_absent').eq(i).is(':checked')){
              is_absent.push("1");
            }
            else{
              is_absent.push("0");
            }
       //   }
          i++;
        });
        var attendance_date = $('#attendance_date').val();
        $.ajax({
        url: "<?= base_url()?>admin/attendance/addattendance",
        data: {sids:sids,in_time:in_time,out_time:out_time,is_late:is_late,attendance_date:attendance_date,is_absent:is_absent,remark:remark},
        type: "post",
        success: function(data){
            location.href="<?=base_url();?>admin/Attendance?date=<?=date('Y-m-d');?>";
        }
        });
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
        let date = document.querySelector("#date").value;
        let type = document.querySelector("#type").value;
       location.href="Attendance?batch_id="+batch_id+"&date="+date+"&type="+type;
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
