<title>Tests</title> 
<style type="text/css">
  h4{
    color: #1c7af6;
  }
</style>
  <div class="container"> 
         <div class="panel panel-default">
            <div class="panel-body">
          <div class="row">
        <div class="col-md-12">
         <h3><?=$assignment->AssignmentName;?></h3>

         <p><span><i class="far fa-calender"></i>&nbsp;Submission date: <?=date('M d, Y', strtotime($assignment->SubmissionDate));?> </span>&nbsp;&nbsp;<span>Batches: 
                 <?php
                            foreach ($batches as $batch) {
                              ?>
                                   <?php echo $batch->Name;?>,
                        <?php
                            }
                        ?><br>
                <?php
                if($assignment->Attachments!=""){
                  ?><a class="btn btn-default" href="<?=$assignment->Attachments;?>" download><i class="fas fa-download text-primary"></i>&nbsp;Attachments</a>
                  <?php
                  }
                  ?></span>&nbsp;&nbsp;Teacher:
                         <?php
                            foreach ($teacher as $fid) {
                              ?>
                                   <?php echo $fid->FirstName.' '.$fid->LastName;?>,
                        <?php
                            }
                        ?>&nbsp;&nbsp;</p>
        </div>
        </div> 
        
    </div>
         </div>
       

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">

                           <div class="card">
                           <div class="card-body">
                             
                    <?php 
                  //  if ($assignment->IsSubmission==1) {
                    ?>     <div class="row">
                                 <div class="col-md-2 col-6">
                                  <div class="alert alert-success">
                                    <h3><?=count($submissions);?></h3>
                                    <p>Total submitted</p>
                                  </div>
                                 </div>
                                 <div class="col-md-3 col-6">
                                   <div class="alert alert-danger">
                                    <h3><?=count($students)-count($submissions);?></h3>
                                    <p>Total notsubmitted</p>
                                  </div>
                               </div>

                             </div>
<br>

                      <h4>students:</h4><br>
                      <br>
                           <div class="row">
                            <div class="col-md-1">
                              <h5>Sr. No.</h5>
                            </div>
                            <div class="col-md-4">
                              <h5>Student Name</h5>
                            </div>
                            <div class="col-md-3">
                              <h5>Points</h5>
                            </div>
                            <div class="col-md-4">
                              <h5>Check assignment</h5>
                            </div>
                            
                           </div><hr>
                           <?php
                           $i=0;
                           foreach ($students as $student) {
                           ?>
                           <form action="<?=base_url();?>admin/assignment/viewassignment" method="post">
                                <div class="row">
                                  <div class="col-md-1">
                                    <p><?=$i+1;?></p>
                                  </div>   
                                   <div class="col-md-4">
                                  <p><?=$student->FirstName.' '.$student->MiddleName.' '.$student->LastName;?></p>
                                </div>
                                <div class="col-md-3 ">
                                <?php
                                if (count($sassignments[$i])>0) {
                                  ?>
                                  <p><?=$sassignments[$i][0]->Points;?></p>
                                  <?php
                                }
                                else{
                                  ?>
                                 <p>0</p>
                                  <?php
                                }
                                ?>
            
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" value="<?=$assignment->Id;?>" name="assignmentid">
                                   <?php
                                if (count($sassignments[$i])>0) {
                                  if($sassignments[$i][0]->IsChecked==0){
                                  ?>
                                  <button class="steps_btn" type="submit" name="studid" value="<?=$student->Id;?>">check assignment</button>
                                  <?php
                                  }
                                  else{
                                    ?>
                                    <button class="steps_btn" type="submit" name="studid" value="<?=$student->Id;?>">Edit assignment</button>
                                    <?php
                                  }
                                }
                                else{
                                  ?>
                                  <button type="button" class="btn btn-default">Not submitted</button>
                                   <?php
                                }
                                ?>
                               </div>
                               </div>
                               <hr>
                               </form>
                            <?php
                            $i++;
                           }
                       /*  }
                         else{
                          ?>
                          <br>

                      <h4>students:</h4><br>
                      <div class="row">
                        <div class="col-md-12">
                        <input type="text" name="" class="form-control" placeholder="search by student name..">
                      </div>
                      </div><br>
                           <div class="row">
                            <div class="col-md-1">
                              <h5>Sr. No.</h5>
                            </div>
                            <div class="col-md-4">
                              <h5>Student Name</h5>
                            </div>
                            <div class="col-md-3">
                              <h5>Not Submitted</h5>
                            </div>
                            <div class="col-md-4">
                              <h5>Remark</h5>
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
                            <div class="col-md-3">
                              <div class="row">
                         <input type="checkbox" name="submissions[]" value="<?=$student->Id;?>">
                            </div>
        
                            </div>
                            <div class="col-md-4">
                              <input type="text" name="" class="form-control" id="remarks_<?=$student->Id;?>">
                            </div>
                           
                           </div>
                           <hr>
                            <?php
                            $i++;
                           }
                         }*/
                           ?>
                        <br>
                       </div>
                     </div>
                    </div>
                     
                   </div>
                 </div>
         
<script type="text/javascript">
var x=1;
function appendTextBox()
{
  var value=$('#topic').val();
   var value1=$('#topics').val();
// or var arr = [];
$('#vtopics').append('<br><li>'+value+'</li>');
if(value1==""){
$('#topics').val(value);
}
else{
   $('#topics').val(value1+','+value);
 }
 $('#topic').val("");
   //console.log(topics.length);
}
  $("#course").change(function(){
    $.ajax({
        url: "<?= base_url()?>index.php/Topic/fetchcoursesubjects",
        data: {id: $(this).val()},
        type: "post",
        success: function(data){
        $("#subjects").html(data);
      }
    });
   // alert('ok');
});
 $("#save").click(function(){
   var submissions = [];
       
    var remarks = [];
   $("input:checkbox[name='submissions[]']:checked").each(function(){    
   submissions.push($(this).val()); 
   $id=$(this).val();
   remarks.push($('#remarks_'+$id).val())
   });
   var id='<?=$assignment->Id;?>';
   var batch='<?=$assignment->BatchId;?>'
   var started='<?=$assignment->IsSubmission;?>';
    $.ajax({
        url: "<?= base_url()?>index.php/Assignment/addsubmissions",
        data: {'id':id,'batch':batch,'students':submissions,'remarks':remarks,'started':started},
        type: "post",
        success: function(data){
        location.reload();
      }
    });
 // alert('ok');
});
</script>