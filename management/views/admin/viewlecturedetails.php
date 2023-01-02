<title>Tests</title> 
<style type="text/css">
  h4{
    color: #1c7af6;
  }
</style>
   <div class="container">
         <div class="panel panel-default">
            <div class="panel-body">
              <br>
        <div class="row">
        <div class="col-md-12">
         <h3><?=$lecture->Title;?>&nbsp;</h3>
         <p><b>Date & time:</b><?=date('M d, Y', strtotime($lecture->Lecture_date));?>  from <?=$lecture->Start_time;?> to <?=$lecture->End_time;?></p>
         <p><span><i class="fas fa-user"></i> &nbsp;Faculties: 
                <?php
                foreach ($faculties as $faculty) {
                  ?>
                  <?=$faculty->FirstName.' '. $faculty->LastName;?>,
                  <?php
                }
                ?>
              </span></p>
              <p>Batches: 
              <?php
                foreach ($batches as $batch) {
                  ?>
                  <?=$batch->Name;?>,
                  <?php
                }
                ?>
                  
                </p>
        </div>
        </div>  
      </div>
    </div>
        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-2 col-6">
                                  <div class="alert alert-success">
                                    <h3><?=count($students)-count($absents);?></h3>
                                    <p>Total present</p>
                                  </div>
                                 </div>
                                 <div class="col-md-2 col-6">
                                   <div class="alert alert-danger">
                                    <h3><?=count($absents);?></h3>
                                    <p>Total absent</p>
                                  </div>
                               </div>

                             </div>
<br>

                      <h4>All students:</h4><br>
                    
                           <div class="row">
                            <div class="col-md-1">
                              <h5>Sr. No.</h5>
                            </div>
                            <div class="col-md-4">
                              <h5>Student Name</h5>
                            </div>
                            <div class="col-md-2">
                              <h5>Is absent?</h5>
                            </div>
                           </div><hr>
                         <?php
                         $i=0;
                         foreach ($students as $student) {
                          ?>
                            <div class="row">
                              <div class="col-md-1">
                                <p><?=$i+1;?></p>
                              </div>   
                               <div class="col-md-4">
                              <p><?=$student->FirstName.' '.$student->MiddleName.' '.$student->LastName;?></p>
                            </div>
                            <div class="col-md-2">
                               <p id="attend_<?=$student->Id;?>">
                                 <?php 
                                 if (!in_array($student->Id, $absents)) {
                                   ?>
                                   <span class="badge badge-success">present</span>
                                 
                                <?php
                                 }
                                 else{
                                  ?>
                                  <span class="badge badge-danger">absent</span>
                                  <?php
                                 }
                                  ?>
                               </p>
                               <p id="studattend_<?=$student->Id;?>" style="display: none;">
                                <select class="form-control" id="select_<?=$student->Id;?>">
                                 <option value="present">present</option>
                               <option value="absent">absent</option>
                             </select></p>
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
       
<script type="text/javascript">

 $(".editattend").click(function(){
  var id=$(this).val();
  $('#studattend_'+id).css("display","block");
   $('#attend_'+id).css("display","none");
   $(this).css("display","none");
   $('#updateattend_'+id).css("display","block");
});
$(".updateattend").click(function(){
  var studid=$(this).val();
 var attend=$('#select_'+studid).val();
 var id='<?=$lecture->Id;?>';
 
  $.ajax({
        url: "<?= base_url()?>index.php/Attendance/updateattendance",
        data: {id:id,attend:attend,studid:studid},
        type: "post",
        success: function(data){
        if (attend=="present") {
          $('#attend_'+studid).html('<span class="badge badge-success">present</span>');
        }
        else {
          $('#attend_'+studid).html('<span class="badge badge-danger">absent</span>');
        }
        $('#studattend_'+studid).css("display","none");
   $('#attend_'+studid).css("display","block");
        $('#updateattend_'+studid).css("display","none");
        $('#editattend_'+studid).css("display","block");
      }
    });
}); 
</script>