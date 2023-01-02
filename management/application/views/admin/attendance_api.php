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
      <h2 class="st_title"><i class="uil uil-analysis"></i>API Attendance</h2>
      <br>
   </div>
   
</div>
<div class="row">
   <div class="col-md-12 order-12 order-md-1">
                <div class="card">
                    <div class="card-body">
        <div class="row">
        <div class="col-md-4 my-3">
                    <label>Select Batch</label>
                        <div class="input-group">
                            <select class="custom-select form-control" id="batch_id">
                                <option selected>Choose...</option>
                                <?php 
                                foreach($batches as $batch){
                                    $batch = json_encode($batch);
                                    $batch = json_decode($batch,true);
                                ?>
                                <option value="<?php echo $batch['Id'] ; ?>"><?php echo $batch['Name'] ; ?></option>
                                <?php  }  ?>
                            </select>
                        </div>
            </div>
           
            <div class="col-md-4 my-3">
                        <label>Select Dates</label>
                                <input type="date" class="form-control"  id="from_date" value="<?=date('Y-m-d');?>">
            </div>
  <div class="col-md-4 my-3">
                      <br><button type="button" class="btn btn-primary" id="go">Go</button>
            </div>


        </div>

                    </div>
                </div>
      <!-- <div class="row" id="load_data"> -->
        <div class="card">
            <div class="card-body">
                <div id="load_data_message"></div>
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
     
   </div>
</div>
<script type="text/javascript">
   
 $('#batch_id').change(function(){
        var from_date = $('#from_date').val();
       // alert(batch_id);
        $.ajax({
        url:"<?php echo base_url(); ?>admin/attendance/attendanceapi",
        method:"POST",
        data:{from_date:from_date,batch_id:$(this).val()},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no more fees found!!</p></div><div class="col-md-4"></div></div></div>');
            action = 'active';
          }
          else
          {
            $('#students').html(data);
          }
        }
      });
  });
 
 $('#go').click(function(){
        var from_date = $('#from_date').val();
       // alert(batch_id);
        $.ajax({
        url:"<?php echo base_url(); ?>admin/attendance/attendanceapi",
        method:"POST",
        data:{from_date:from_date,batch_id:$('#batch_id').val()},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no more fees found!!</p></div><div class="col-md-4"></div></div></div>');
            action = 'active';
          }
          else
          {
            $('#students').html(data);
          }
        }
      });
  });



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
        var attendance_date = $('#from_date').val();
        var batch_id = $('#batch_id').val();
        $.ajax({
        url: "<?= base_url()?>admin/attendance/addattendanceapi",
        data: {batch_id:batch_id,sids:sids,in_time:in_time,out_time:out_time,is_late:is_late,attendance_date:attendance_date,is_absent:is_absent,remark:remark},
        type: "post",
        success: function(data){
           // location.href="<?=base_url();?>admin/Attendance?date=<?=date('Y-m-d');?>";
           alert(data);
        }
        });
   });
  
   
</script>

