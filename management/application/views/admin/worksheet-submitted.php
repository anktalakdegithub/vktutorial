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
      <div class="row" id="load_data">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Late submitted</th>
                </tr>
            </thead>
            <tbody id="students">
                <?php 
                $i=1;
                print_r($students);
                foreach ($students as $stud) {
                  ?>
                  <tr class="students" data-id="<?=$stud->Id;?>">
                    <th scope="col"><?=$i;?></th>
                    <th scope="col"><?=$stud->FirstName.' '.$stud->LastName;?></th>
                    <th scope="col">
                      <?php 
                      if($stud->is_late==1){
                        ?>
                        <span class="badge badge-warning">Late</span>
                        <?php
                      }
                      ?>
                    </th>
                  </tr>
                  <?php
                  $i++;
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-default steps_btn" name="save" id="save">Save</button>
      </div>
   </div>
</div>
</div>
<script type="text/javascript">
   $('#save').click(function(){
        var sids=[];
        var late_submitted = [];
        var is_late = [];
        var i=0;
        $( ".students" ).each(function() {
          if($('.is_submitted:checked').eq(i).val()){
              sids.push($(this).attr('data-id'));

            if($('.late_submitted:checked').eq(i).val()){
              is_late.push("1");
            }
            else{
              is_late.push("0");
            }
            }
          i++;
        });
        var worksheet_id = $(this).val();
        $.ajax({
        url: "<?= base_url()?>admin/course/save_worksheet_submitted",
        data: {sids:sids,is_late:is_late,worksheet_id:worksheet_id},
        type: "post",
        success: function(data){
            location.href="<?=base_url();?>admin/course/worksheet_submitted?worksheet_id=<?=$worksheet_id;?>&batch_id=<?=$batch_id;?>";
        }
        });
   });
</script>