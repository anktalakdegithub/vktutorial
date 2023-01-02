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
      <!-- <a href="<?=base_url();?>admin/Attendance/attendance" class="btn btn-default steps_btn" style="padding-top: 10px !important;">Add Attendance</a>   -->
      <?php
         }
         ?>
   </div>
</div>
<div class="row">
   <div class="col-md-12 order-12 order-md-1">
        <div class="row">
            <div class="col-md-4 my-3">
                <div class="card">
                    <div class="card-body">
                    <label>Select Batch</label>
                        <div class="input-group">
                       
                            <select class="custom-select form-control" id="batch_id">
                                <option selected>Choose...</option>
                                <?php 
                                foreach($batches as $batch){

                                    $batch = json_encode($batch);
                                    $batch = json_decode($batch,true);
                            ?>
                                 <option value="1"><?php echo $batch['Name'] ; ?></option>
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
            <div class="col-md-4 my-3">
                <div class="card">
                    <div class="card-body">
                        <label>Select Date</label>
                        <div >
                            <!-- <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down ml-1"></i> -->
                            <input type="date" class="form-control" value="" id="date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3">
                <div class="card">
                    <div class="card-body">
                    <label>Present/Absent</label>
                        <div class="input-group">
                           
                            <!-- <input type="text" class="form-control" id="event_search" placeholder="search event by name.."> -->
                            <select class="custom-select form-control" id="type">
                                <!-- <option selected>Choose...</option> -->
                                <option value="1">Present</option>
                                <option value="2">Absent</option>
                                <!-- <option value="3">Three</option> -->
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
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
                        <th scope="col">student_name</th>
                        <th scope="col">attendance_date</th>
                        <th scope="col">in_time</th>
                        <th scope="col">out_time</th>
                        <th scope="col">present/absent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 0;
                    // echo '<pre>';
                    // print_r($students);
                    // die;
                    foreach($students as $stu){
                        // echo '<pre>';
                        // print_r($stu);
                        // die;
                        $stu = json_encode($stu);
                        $stu = json_decode($stu,true);
                        // print_r($stu['FirstName']);
                        // echo  $stu['FirstName'];
                    ?>
                    <tr>
                        <th scope="row"><?php echo ++$i; ?></th>
                        <td><?php echo $stu['FirstName'].' '.$stu['MiddleName'].' '.$stu['LastName'] ; ?></td>
                        <td><?php  if($stu['attendance_date']){
                                        echo date("d-M-Y", strtotime($stu['attendance_date']))  ;
                                    }else{
                                        
                                    } ?></td>
                        <td><?php  if($stu['in_time']){
                                        echo date("h:i A", strtotime($stu['in_time'])) ;
                                    }else{
                                        
                                    } ?></td>
                        <td><?php  if($stu['out_time']){
                                        echo date("h:i A", strtotime($stu['out_time'])) ;
                                    }else{
                                        
                                    } ?></td>
                        <td><?php 
                            if($stu['attendance_date']){
                                ?>
                                <span class="badge badge-pill badge-success">Present</span>
                                <?php
                            }else{
                                ?>
                                <span class="badge badge-pill badge-danger">Absent</span>
                                <?php
                            }
                            // echo $stu['FirstName'].' '.$stu['MiddleName'].' '.$stu['LastName'] ; 
                            ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    
                    
                </tbody>
            </table>
            </div>
        </div>
        
      <!-- </div> -->
        <div align="center">
            <?php //$pagination?>
        </div>
   </div>
</div>
<script type="text/javascript">
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