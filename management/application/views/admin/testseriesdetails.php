<script type="text/javascript">
  $(document).ready(function() {
  tinymce.init({
    selector: ".content",
    theme: "modern",
    paste_data_images: true,
    plugins: [
      "advlist autolink lists image charmap preview hr anchor pagebreak",,
      "insertdatetime nonbreaking save table contextmenu directionality",
      "template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "preview image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontselect fontsizeselect",
    image_advtab: true,
    file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.onchange = function() {
      var file = this.files[0];
      var reader = new FileReader();
      
      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // call the callback and populate the Title field with the file name
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    
    input.click();
  },
    templates: [{
      title: 'Test template 1',
      content: 'Test 1'
    }, {
      title: 'Test template 2',
      content: 'Test 2'
    }]
  });
  });
</script>
<style type="text/css">
  .nav-pills .active {
       font-size: 14px !important;
    font-weight: 500 !important;
    font-family: 'Roboto', sans-serif !important;
    color: #fff !important;
    background: #ed2a26 !important;
    padding: 10px 20px !important;
    border-radius: 25px !important;
    border: 0 !important;
    height: 40px !important;
}
</style>
<div class="container">
  <div class="panel">
    <div class="panel-body">
      <div class="row"> 
        <div class="col-md-10 col-8">
          <h2><?=$mcqtest[0]->Title;?></h2>
          <p> 
          <span><i class="fas fa-clock"></i> <?=$mcqtest[0]->CreatedAt;?></span></p>
          <?php
            $string = strip_tags($mcqtest[0]->Description);
            if (strlen($string) > 500) {
                $stringCut = substr($string, 0, 500);
                $endPoint = strrpos($stringCut, ' ');
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '... <a href="/this/story">Read More</a>';
            }
          ?>
          <p>Description: <?=$string;?></p>
        </div>
        <div class="col-md-2 text-center"><br>
          <?php 
        $access=$this->session->userdata('access');
        $tseries=array();
        $tseries=$access->tseries;
        if(in_array("add", $tseries) || in_array("all", $tseries)){
        ?>
        <a href="<?=base_url();?>admin/test/newtest/<?=$mcqtest[0]->Id;?>"  class="btn btn-default steps_btn" style="padding-top:10px !important;">+&nbsp;New Test</a><br>
          <a href="<?=base_url();?>admin/test/addstudents/<?=$mcqtest[0]->Id;?>"  class="btn btn-default steps_btn" style="padding-top:10px !important;margin-top: 15px;">+&nbsp;Add students</a>
          <?php 
            }
            ?>
        </div>
      </div>
    </div>

  </div>
  <br><br>
    <div class="row">
    <div class="col-md-8">
      <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="pill" href="#tests">Tests&nbsp;<span class="badge badge-light" style="border-radius: 10px;" id="qcount"><?=count($tests);?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="pill" href="#students">Students&nbsp;<span class="badge badge-light" style="border-radius: 10px;"><?=count($students);?></span></a>
      </li>
    </ul>
  </div>
</div>
<br>
<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="tests">
  <div class="panel">
          <div class="panel-body">
  <br>
    <?php 
    $i=0;
    foreach ($tests as $test) {
      ?>
      <div class="row"> 
      <div class="col-8 col-md-10">
        
            <h4><a href="<?=base_url();?>admin/test/testdetails/<?=$test->Id;?>"><?=$test->ExamName;?>
               <?php 
            if($test->IsAccessible==1){
              ?>
              <span class="badge badge-success">Free</span>
              <?php 
            }
            ?>
            </a></h4>
           
            <p>Total Questions: <?=$questions[$i];?> &nbsp; Total Marks: <?=$marks[$i];?></p>
            
          </div>
           <div class="col-2 col-md-1 text-center">
            <?php 
            if($test->IsAccessible!=1){
              ?>
              <button class="accessible btn btn-default" value="<?=$test->Id;?>"><i class="fas fa-eye"></i></button>
              <?php
            }
            else{
              ?>
              <button class="notaccessible btn text-danger btn-default" value="<?=$test->Id;?>"><i class="fas fa-eye"></i></button>
              <?php
            }
            ?>
          </div>
           <div class="col-2 col-md-1 text-center">
              <div class="dropdown">
  <a id="dropdownMenuButton" data-toggle="dropdown" style="cursor: pointer;" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-v"></i>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <?php 
  if(in_array("edit", $tseries) || in_array("all", $tseries)){
  ?>
    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#editModel_<?=$test->Id;?>">Edit</a>
  <?php 
  }
  if(in_array("delete", $tseries) || in_array("all", $tseries)){
  ?>
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModel_<?=$test->Id;?>">Delete</a>
  <?php 
  }
  ?>
  </div>
</div>
            </div>
          </div>
     <hr>

<div class="modal" id="editModel_<?=$test->Id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Test</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row container">
          <div class="col-md-12">
           <div class="ui search focus lbel25">
            <label>Title</label>
            <div class="ui left icon input swdh19">
              <input class="prompt srch_explore" type="text" placeholder="Enter title" id="title_<?=$test->Id;?>" value="<?=$test->ExamName;?>">
            </div>
            </div>
           <div class="ui search focus mt-30 lbel25">
              <label>Duration(in minutes)</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="number" placeholder="Minutes" id="duration_<?=$test->Id;?>" value="<?=$test->Duration;?>">
              </div>
            </div>
           <div class="ui search focus mt-30 lbel25">
              <label>Passing Percentage</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="30" id="pmarks_<?=$test->Id;?>" value="<?=$test->PassingPercent;?>">
              </div>
            </div>
           <div class="ui search focus mt-30 lbel25">
              <label>Instructions</label>
              <div class="ui left icon input swdh19">
                <textarea class="content form-control" id="instructions_<?=$test->Id;?>" rows="2" placeholder="Instructions">
                  <?=$test->Instructions;?>
                </textarea>
              </div>
            </div>
          </div>
          <br>
          <div id="msg_<?=$test->Id;?>"></div>
        </div><br>
        <div class="text-left">
          <button type="button" class="update btn btn-default steps_btn" value="<?=$test->Id;?>">Update</button>
        </div>
      </div>

    </div>
  </div>
</div>
 <div class="modal" id="deleteModel_<?=$test->Id;?>">
  <div class="modal-dialog">
    <div class="modal-content moda-sm">
      <div class="modal-body text-center">
        <h5>Are you sure you want to delete this test.?</h5><br>
        <button type="button" class="btn btn-default" class="close" data-dismiss="modal">No</button>
        <button type="button" class="delete btn btn-danger" value="<?=$test->Id;?>">Yes</button>
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
 <div class="tab-pane" id="students">
  <div class="panel">
    <div class="panel-body">
      <br>
          <?php 
    $i=0;
    foreach ($students as $stud) {
      ?>
      <div class="row"> 
        <div class="col-md-12">
          <h4><?=$stud->FirstName.' '.$stud->LastName;?></h4>
          <p><span><i class="fas fa-envelope"></i>&nbsp; <?=$stud->Email;?></span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; <?=$stud->Phone;?></span></p>
        </div>
      </div>
     <hr>
     <?php 
   }
   ?>
    </div>
  </div>
  <br>
  </div>
</div>
</div>
<script type="text/javascript">

  $('.accessible').click(function(){
    var id=$(this).val();
    var isaccessible = 1;
    accessible(id,isaccessible);
  });
  $('.notaccessible').click(function(){
    var id=$(this).val();
    var isaccessible = 0;
    accessible(id,isaccessible);
  });

  function accessible(id,isaccessible)
  {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/test/accesstest",
        method:"POST",
        data:{id:id,isaccessible:isaccessible},
        success:function(data)
        {
          if(isaccessible!=1){
            swal("Test is not freely accessible.", "", "success");
          }
          else{
            swal("Test is freely accessible.", "", "success");
          }
          setTimeout(function () {
            swal.close();
            location.reload();
          }, 2000);
        }
      });
  }

  $('.update').click(function(){
    var id=$(this).val();
    var title=$('#title_'+id).val();
    var pmarks=$('#pmarks_'+id).val();
    var duration=$('#duration_'+id).val();
    var minutes=$('#minutes_'+id).val();
    var instructions=tinyMCE.editors[$('#instructions_'+id).attr('id')].getContent();
    $.ajax({
      url:"<?php echo base_url(); ?>admin/test/updatetest",
      method:"POST",
      data:{id:id,title:title,pmarks:pmarks,duration:duration,instructions:instructions},
      dataType:'json',
      success:function(data)
      {
        if(data.code=="404"){
          $('#emsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
        }
        else{
            swal("Exam data updated successfully!", "", "success");
            setTimeout(function () {
              swal.close();
              location.reload();
            }, 2000);
          }
        }
      });
    });
   $('.delete').click(function(){
    var id=$(this).val();
  $.ajax({
    url:"<?php echo base_url(); ?>admin/test/deletetest",
        method:"POST",
        data:{id:id},
        success:function(data)
        {
          swal("Test deleted successfully!", "", "success");
            setTimeout(function () {
              swal.close();
              location.reload();
            }, 2000);
        }
  });
});
</script>