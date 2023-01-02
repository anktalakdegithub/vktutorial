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
      <h2 class="st_title"><i class="uil uil-analysis"></i> Exam Submitted</h2>
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
                    <th scope="col">Is Absent?</th>
                    <th scope="col">Marks</th>
                    <th scope="col">Remark</th>
                </tr>
            </thead>
            <tbody id="students">
                <?php 
                $i=1;
                foreach ($students as $stud) {
                  ?>
                  <tr  class="students" data-id="<?=$stud->Id;?>">
                    <th scope="col"><?=$i;?></th>
                    <th scope="col"><?=$stud->FirstName.' '.$stud->LastName;?></th>
                    <th scope="col"><input type="checkbox" class="is_absent" name="is_absent"></th>
                    <!-- <th scope="col"><input type="checkbox" class="late_submitted" name="late_submitted"></th> -->
                    <th scope="col"><input type="number" class="marks" name="marks"></th>
                    <th scope="col">
                      <textarea class="from-control remark" name="remark" id="remark" cols="30" rows="2"></textarea>
                    </th>
                  </tr>
                  <?php
                  $i++;
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-default steps_btn" name="save" id="saveasexam" value="<?=$exam_id;?>">Save</button>
      </div>
   </div>
</div>
</div>
<script type="text/javascript">
   $('#saveasexam').click(function(){

        var sids=[];
        var marks = [];
        var is_absent = [];
        var remark = [];
        var i=0;
        $( ".students" ).each(function() {
          
              sids.push($(this).attr('data-id'));
              remark.push($('.remark').eq(i).val());
              marks.push($('.marks').eq(i).val());
            if($('.is_absent').eq(i).is(':checked')){
              is_absent.push(1);
            }
            else{
              is_absent.push(0);
            }
         
         
          i++;
        });
        var exam_id = $(this).val();
        $.ajax({
        url: "<?= base_url()?>admin/course/save_exam_submitted",
        data: {'sids':sids,'marks':marks,'exam_id':exam_id,'is_absent':is_absent,'remark':remark},
        type: "post",
        success: function(data){
         location.href="<?=base_url();?>admin/course/exam_result?exam_id=<?=$exam_id;?>&batch_id=<?=$batch_id;?>";
          //  alert();
        }
        });
   });
</script>