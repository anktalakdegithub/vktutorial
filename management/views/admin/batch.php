<div class="container">
  <div class="row">
      <div class="col-md-10 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Batches</h2><br>
      </div>    
      <div class="col-md-2 col-6">
        <?php 
          $access=$this->session->userdata('access');
          $abatch=array();
          $abatch=$access->batches;
          if(in_array("add", $abatch) || in_array("all", $abatch))
          {
        ?>
        <button data-direction="next" class="btn btn-default steps_btn" data-toggle="modal" data-target="#batchModel">Create Batch</button>  
        <?php 
          }
        ?>
      </div>      
    </div>  
<br>
	<div class="card">
      <div class="card-body">
        <div class="row">
          
              <div class="col-md-1 col-1">#</div>
              <div class="col-md-3 col-1">Batch Name</div>
              <div class="col-md-3 col-1">Course Name</div>
              <div class="col-md-1 col-1">Total Students</div>
              <div class="col-md-2 col-1">Last Modified Date</div>
              <div class="col-md-2 col-1">Action</div>
           </div>
       </div>
     </div>
        <?php 
        $i=0;
        foreach ($batches as $batch) {
          date_default_timezone_set('Asia/Kolkata');
          $date=date("h:i:sa"); 
        ?>
        <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-1"><p><?=$i+1;?></p></div>
              <div class="col-md-3 col-1"><p><a href="<?=base_url();?>admin/batch/batch_details/<?=$batch->Id;?>"><?=$batch->Name;?></a></p></div>
              <div class="col-md-3 col-1"><p><?=$batch->Name;?></p></div>
              <div class="col-md-1 col-1"><p><?=$students[$i];?></p></div>
              <div class="col-md-2 col-1"><p><?=$batch->UpdatedAt;?></p></div>
              <div class="col-md-2 col-1"> <div class="dropdown">
  <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <?php 
      if(in_array("add", $abatch) || in_array("all", $abatch))
      {
    ?>
    <a class="dropdown-item" href="<?=base_url();?>admin/batch/addstudents/<?=$batch->Id;?>">Add students</a>
    <?php 
      }
      if(in_array("edit", $abatch) || in_array("all", $abatch))
      {
    ?> 
    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#editModal_<?=$batch->Id;?>">Edit</a>
    <?php 
      }
      if(in_array("delete", $abatch) || in_array("all", $abatch))
      {
    ?> 
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal_<?=$batch->Id;?>">Delete</a>
    <?php 
    }
    ?>  
  </div>
</div>
          
          </div> </div></div></div>
    <div class="modal" id="deleteModal_<?=$batch->Id;?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <h3>Are you sure you want to delete?</h3>
            <button data-direction="preve" class="delete btn btn-default steps_btn" value="<?=$batch->Id;?>">Delete</button> 
          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="editModal_<?=$batch->Id;?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3>Edit Batch</h3>
          </div>
          <div class="modal-body">
            <div class="ui search focus lbel25">
              <label>Batch Name</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Enter Batch Name" id="title_<?=$batch->Id;?>" data-purpose="edit-course-title" maxlength="60" value="<?=$batch->Name;?>">
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Select course</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="course_<?=$batch->Id;?>">
                <option value="">Select Course</option>
                <?php 
                  foreach($courses['courses'] as $course){
                    ?>
                    <option value="<?=$course->Id;?>" <?php if($course->Id==$batch->Course_id){ echo "selected"; } ?>><?=$course->Title;?></option>
                    <?php
                  }
                ?>              
              </select>
        </div>
            <br>
            <div id="msg_<?=$batch->Id;?>"></div>
            <button data-direction="next" class="update btn btn-default steps_btn" value="<?=$batch->Id;?>">Update</button> 
      </div>
          </div>
        </div>
      </div>
          <?php
          $i++;
        }
        ?>
      </div>
    </div>
</div>

   <div class="modal" id="batchModel">
                          <div class="modal-dialog">
                            <div class="modal-content">
                <div class="modal-header">
                                <h3>New Batch</h3>
                              </div>
                              <div class="modal-body">
          <div class="ui search focus lbel25">
                                  <label>Batch Name</label>
                                  <div class="ui left icon input swdh19">
                                    <input class="prompt srch_explore" type="text" placeholder="Enter Batch Name" id="title" data-purpose="edit-course-title" maxlength="60">                  
                                  </div>
                                </div>
                                <div class="ui search focus mt-30 lbel25">
          <label>Select course</label>
                  <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="course">
                    <option value="">Select Course</option>
          <?php 
            foreach($courses['courses'] as $course){
              ?>
              <option value="<?=$course->Id;?>"><?=$course->Title;?></option>
              <?php
            }
          ?>              
          </select>
        </div>
            <br>
            <div id="msg"></div>
            <button data-direction="next" class="btn btn-default steps_btn" id="add">Add</button> 
      </div>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
	 $('#add').click(function() {
     var formData = new FormData();
    var name=$('#title').val();
    var course=$('#course').val();
    formData.append('name',name);
    formData.append('course',course);
    $.ajax({
        url: "<?= base_url()?>admin/Batch/addbatch",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        dataType: 'json',
        success:function(data)
        {
          if(data.code=="404"){
            $('#cmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("Batch created successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
        }
  });
  //console.log(cname);
});
    $('.update').click(function() {
     var formData = new FormData();
     var id=$(this).val();
    var name=$('#title_'+id).val();
    var course=$('#course_'+id).val();
    formData.append('id',id);
    formData.append('name',name);
    formData.append('course',course);
    $.ajax({
        url: "<?= base_url()?>admin/Batch/updatebatch",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        dataType: 'json',
        success:function(data)
        {
          if(data.code=="404"){
            $('#msg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("Batch updated successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
        }
  });
  //console.log(cname);
});
                  $(".delete").click(function(){
                 $(this).attr("disabled", true);
   var formData = new FormData();
   var id=$(this).val();
    formData.append('id', id);
    $.ajax({
        url: "<?= base_url()?>admin/batch/deletebatch",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
           swal("Batch deleted successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
                     $(this).attr("disabled", false);
              location.reload();
                }, 2000);
         
    }
    });
  
});
</script>