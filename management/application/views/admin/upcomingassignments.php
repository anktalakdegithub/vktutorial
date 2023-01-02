<title>Tests</title> 
<style type="text/css">
</style>
   <div class="container">
    <div class="row">
      <div class="col-md-8 col-6">  
        <h2 class="st_title"><i class="uil uil-analysis"></i>Assignments</h2><br>
      </div>  
<div class="col-md-4 col-6 text-right">  
        <?php 

        $access=$this->session->userdata('access');
        $aassignments=array();
        $aassignments=$access->assignments;
        if(in_array("add", $aassignments) || in_array("all", $aassignments)){
          ?>
          <a href="<?=base_url();?>admin/assignment/newassignment" class="btn steps_btn" style="padding-top:10px !important;">New assignment</a>
          <?php 
        }
        ?>
      </div>       
    </div>  
     <div class="row">
            <div class="col-md-8 order-12 order-md-1">
          <div class="panel panel-default">
            <div class="panel-body">
           <!-- Button to Open the Modal -->

                         <div id="assignments"><br>
                             <div class="row">
                       <div class="col-md-3 col-6">
                                  <div class="alert alert-success">
                                    <h3 id="tplecturest"><?=count($assignments);?></h3>
                                    <p>Total assignments</p>
                                  </div>
                                 </div>
                              
                          </div>  <br>
                          <?php
                            if (count($assignments)>0) {
      
      
        $i=0;
                foreach ($assignments  as $assign) {
              ?>
            <div class="row">
              <div class="col-md-9 col-9">
                <h4><a href="<?=base_url();?>admin/assignment/assignmentdetails/<?=$assign->Id;?>"><?=$assign->AssignmentName;?></a></h4>

               <p><i class="far fa-calendar-alt text-primary"></i>&nbsp;&nbsp;<span>Submission date: <?=date('M d, Y', strtotime($assign->SubmissionDate));?></span>&nbsp;&nbsp;<span>Batches: 
                 <?php
                            foreach ($batches[$i] as $batch) {
                              ?>
                                   <?php echo $batch->Name;?>,
                        <?php
                            }
                        ?>&nbsp;&nbsp;
                <?php
                if($assign->Attachments!=""){
                  ?><a class="btn btn-default" href="<?=$assign->Attachments;?>" download><i class="fas fa-download text-primary"></i>&nbsp;Attachments</a>
                  <?php
                  }
                  ?></span> &nbsp;&nbsp;<span><?php 
      if($assign->Note!=""){
        ?>
       <a href="#" data-toggle="collapse" style="text-decoration: underline;" data-target="#collapsenote_<?=$assign->Id;?>">Instructions</a>
      
      <?php 
      }
      ?></span>&nbsp;&nbsp;Teacher:
                         <?php
                            foreach ($faculty[$i] as $fid) {
                              ?>
                                   <?php echo $fid->FirstName.' '.$fid->LastName;?>,
                        <?php
                            }
                        ?>&nbsp;&nbsp;</p>
      <div id="collapsenote_<?=$assign->Id;?>" class="collapse">
          <p><?=$assign->Note;?></p>
      </div>
              </div>
              <div class="col-md-3 col-3">
                <?php 
        if(in_array("edit", $aassignments) || in_array("all", $aassignments)){
          ?>
                <button type="button" class="steps_btn" data-toggle="modal" data-target="#changesmodal_<?=$assign->Id;?>">Make changes</button>
                <?php 
              }
              ?>

<!-- The Modal -->
<div class="modal" id="changesmodal_<?=$assign->Id;?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <div id="option_<?=$assign->Id;?>" class="mbody_<?=$assign->Id;?>">
          <h4 class="modal-title">Select an option</h4><br>
        <div class="row text-center">
          <div class="col-md-4">

            <div class="reschedule card changes_<?=$assign->Id;?> shadow-sm" style="cursor: pointer;border: 2px solid #1c7af6" id="<?=$assign->Id;?>">
              <div class="card-body">
                <i class="fas fa-clock"></i>
                <h4>Reschedule assignment</h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="upload card changes_<?=$assign->Id;?> shadow-sm" style="cursor: pointer;" id="<?=$assign->Id;?>">
              <div class="card-body">
                <i class="fas fa-upload"></i>
                <h4>Upload attachments</h4>
              </div>
            </div>
          </div>
        </div><br>
         <button type="button" class="next steps_btn" value="<?=$assign->Id;?>">Next</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <div id="optionform_<?=$assign->Id;?>" class="mbody_<?=$assign->Id;?>" style="display: none;">
      <div id="rescheduleform_<?=$assign->Id;?>" class="mform_<?=$assign->Id;?>">
        <div class="form-group">
          <label>Change submission date</label>
          <input type="date" class="form-control" value="<?=$assign->SubmissionDate;?>" id="sdate_<?=$assign->Id;?>">
        </div>
        <div id="smsg_<?=$assign->Id;?>"></div>
        <button type="button" class="previous btn btn-default" value="<?=$assign->Id;?>">Previous</button>
          <button type="button" class="submission steps_btn" id="submission" value="<?=$assign->Id;?>">Save changes</button>
      </div>
      <div id="uploadform_<?=$assign->Id;?>" class="mform_<?=$assign->Id;?>" style="display: none;">
        <div class="form-group">
          <label>Select assignments</label>
          <input type="file" class="form-control" id="uattachment_<?=$assign->Id;?>">
        </div>
        <div id="umsg_<?=$assign->Id;?>"></div>
        <button type="button" class="previous btn btn-default" value="<?=$assign->Id;?>">Previous</button>
          <button type="button" class="attachment  steps_btn" id="attachment" value="<?=$assign->Id;?>">Save changes</button>
      </div>
    </div>
   <br>
      <a href="#" style="text-decoration: underline;" data-toggle="modal" data-target="#deleteModal_<?=$assign->Id;?>">Delete assignment</a>
    </div>
    </div>
  </div>
</div>
              </div>
              </div> 
              <hr>
              <div class="modal" id="deleteModal_<?=$assign->Id;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                 <!-- Modal body -->
                              <div class="modal-body">
                                  <h3>Are you sure you want to delete?</h3>
            <button data-direction="preve" class="delete steps_btn" value="<?=$assign->Id;?>">Delete</button> 
      
          </div>
        </div>
      </div>
    </div>

              <?php
              $i++;
              }
      }
    else{
                  ?>
                  <div class="card card-default" style="padding: 30px;">
                                  <div class="row">
                                    <div class="col-md-4">
                                  </div>
                                  <div class="col-md-4 text-center">
                                   
                                    <p>no assignments found!!</p>
                                  </div>
                                  <div class="col-md-4">
                                  </div>
                                </div>
                                </div>
                                <?php
                }
                  ?>
      </div></div>
    </div>
<a href="<?=base_url();?>admin/assignment/pastassignments">click here to view past  assignments</a>
  </div>
        <div class="col-md-4 order-1 order-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
                <h4>Filter by</h4>
                <br>
               <!--  <div class="form-group">
                  <label>Academic years</label>
                   <select class="form-control" id="ayear" name="ayear">
                        <option value="">Select Academic year</option>
                        <?php
                          $i=1;
                          foreach($academic as $row)
                          {
                            if($this->session->userdata('academic_id')==$row->Id){
                            ?>
                                   <option value="<?php echo $row->Id;?>" selected><?php echo $row->Academic_Year;?></option>          
                        <?php
                        }
                        ?>
                                   <option value="<?php echo $row->Id;?>"><?php echo $row->Academic_Year;?></option>          
                        <?php
                        $i++;
                        }
                        ?>
                      </select>
                </div>
               -->
                <div class="form-group">
                  <label>Batch</label>
                  <select class="form-control" id="batch" name="batch">
                    <option value="">Select Batch</option>
                     <?php
                            foreach ($allbatches as $batch) {
                              ?>
                                   <option value="<?php echo $batch->Id;?>"><?php echo $batch->Name;?></option>          
                        <?php
                            }
                        ?>
                  </select>
                </div>
                 <div class="form-group">
                  <label>Date</label>
                  <?php
                    date_default_timezone_set('Asia/Kolkata');
                    $date=date("Y-m-d");
                  ?>
                  <input type="date" id="sdate" class="form-control" min="<?=$date;?>"><br>
                   <input type="date" id="edate" class="form-control" min="<?=$date;?>">
                </div>
          </div>
        </div>
      </div>
        </div>
  </div>
  
<script type="text/javascript">
   $('body').on('click', '.delete', function(){
                 $(this).attr("disabled", true);
   var formData = new FormData();
   var id=$(this).val();
    formData.append('id', id);
    $.ajax({
        url: "<?= base_url()?>admin/assignment/deleteassignment",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
           swal("Assignment deleted successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
                     $(this).attr("disabled", false);
              location.reload();
                }, 2000);
         
    }
    });
  
});
  $('body').on('click', '.reschedule', function(){
    var id=this.id;
    $('.changes_'+id).css({ border: '2px solid #e4e4e4'})
    $(this).css({ border: '2px solid #1c7af6'});
    $('.mform_'+id).css({ display: 'none'});
    $('#rescheduleform_'+id).css({ display: 'block'});
  });
  $('body').on('click', '.upload', function(){
     var id=this.id;
    $('.changes_'+id).css({ border: '2px solid #e4e4e4'})
    $(this).css({ border: '2px solid #1c7af6'});
    $('.mform_'+id).css({ display: 'none'});
    $('#uploadform_'+id).css({ display: 'block'});
  });
  $('body').on('click', '.next', function(){
     var id=$(this).val();
     console.log(id);
    $('.mbody_'+id).css({ display: 'none'});
    $('#optionform_'+id).css({ display: 'block'});
  });
  $('body').on('click', '.previous', function(){
     var id=$(this).val();
    $('.mbody_'+id).css({ display: 'none'});
    $('#option_'+id).css({ display: 'block'});
  });

 $('body').on('click', '.attachment', function(){
  $(this).attr("disabled", true);
   
  var id=$(this).val();
   $('#umsg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait document uploading....</div>');
 
  var formData = new FormData();
  formData.append('id',id);
  file=$('#uattachment_'+id).get(0).files[0];
  formData.append('file', file);
  $.ajax({
    url: "<?=base_url()?>admin/assignment/uploadattachments",
    data: formData,
    type: "post",
    headers: { 'IsAjax': 'true' },
    dataType: "json",
    processData: false,
    contentType: false,
    success: function(data){
       $(this).attr("disabled", false);
     if (data.code=="200") {
           swal("Attachment added successfully!", "", "success");
          setTimeout(function () {
              swal.close();
              location.href="<?=base_url();?>admin/assignment";
          }, 2000);   
        }
      else{
         $('#umsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
      }
    }
  });
});
 $('body').on('click', '.submission', function(){
   var id=$(this).val();
  var formData = new FormData();
  formData.append('id',id);
  sdate=$('#sdate_'+id).val();
  formData.append('sdate', sdate);
  $.ajax({
    url: "<?=base_url()?>admin/assignment/reschedulesubmission",
    data: formData,
    type: "post",
    headers: { 'IsAjax': 'true' },
    dataType: "json",
    processData: false,
    contentType: false,
    success: function(data){
      if (data.code=="200") {
        $('#smsg_'+id).html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>');
          
           setTimeout(function () {
              location.href="<?=base_url();?>admin/assignment";
          }, 2000); 
      }
      else{
         $('#smsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
      }
    }
  });
});
  $('#batch').change(function(){
    fetchassignments();
  });
  $('#sdate').change(function(){
    fetchassignments();
  });
  $('#edate').change(function(){
    fetchassignments();
  });
 function fetchassignments()
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/assignment/uassignments",
        method:"POST",
        data:{bid:$('#batch').val(), sdate:$('#sdate').val(), edate:$('#edate').val()},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#assignments').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no assignments found!!</p></div><div class="col-md-4"></div></div></div>');
           
          }
          else
          {
            $('#assignments').html(data);
            
          }
        }
      })
    }
  $(document).ready(function(){

    var limit = 7;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start)
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/assignment/fetchassignments",
        method:"POST",
        data:{limit:limit, start:start, ayear:$('#ayear').val()},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<h3>No More Result Found</h3>');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });

  });

</script>