 <script>
 $(document).ready(function() {
  tinymce.init({
    selector: ".content",
    theme: "modern",
    paste_data_images: true,
     menubar: 'edit insert format table tools',
    plugins: [
      "advlist autolink lists image charmap preview hr anchor pagebreak",,
      "insertdatetime nonbreaking save table contextmenu directionality",
      "template paste textcolor colorpicker textpattern"
    ],
     mobile: { theme: 'mobile' },
    toolbar1: "preview image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
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
<div class="container">
  <div class="row">
      <div class="col-lg-12"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Student Forum</h2>
      </div>          
    </div>
  <div class="row">
      <?php 
      $i=0;
      ?>
       <?php foreach ($questions as $que): ?>

          <div class="col-12">
            <div class="card" style="width:100%;box-shadow: 0 .1rem 1rem rgba(0,0,0,.15)!important;">
 <div class="card-body">
    <div class="row">
          <div class="col-12">
             <h4 style="color: #C72127;padding-top: 5px;"><?=$que->Questions;?></h4>
            
             <p><i class="fas fa-calendar"></i>&nbsp;&nbsp;<?=date('Y-m-d h:i A',strtotime($que->CreatedAt));?> &nbsp;&nbsp; 
              <span>
                <?php
                if(!count($answers[$i])>0){
                  ?>
                  <a href="#" data-toggle="collapse" data-target="#addanswer_<?=$que->Id;?>"> Add answer</a>
                  <?php
                }
                ?>
              </span> &nbsp;&nbsp; <span><a href="#" data-toggle="collapse" data-target="#editquestion_<?=$que->Id;?>"><i class="fas fa-edit"></i> Edit question</a></span> &nbsp;<span> <a href="#" class="text-danger" data-toggle="modal" data-target="#deleteque_<?=$que->Id;?>"><i class="fas fa-trash"></i>&nbsp;Delete question</a></span></p>
              <div id="editquestion_<?=$que->Id;?>" class="collapse">
               
               <label>Edit Question</label>
               <div class="form-group">
              <label>Topic</label>
                <select class="form-control" id="topic_<?=$que->Id;?>">
                  <option value="">Select topic</option>
                  <?php
                  foreach ($topics as $topic) {
                    ?>
                    <option value="<?=$topic->Id;?>" <?php if ($topic->Id==$que->TopicId) { echo "selected";} ;?>><?=$topic->Topic;?></option>
                    <?php
                  }
                  ?>
                </select>
            </div>
              <div class="form-group">
                <label>Question</label>
                <textarea class="form-control" rows="5" id="uquestion_<?=$que->Id;?>"><?=$que->Questions;?></textarea>
              </div><br>
             <div id="uqmsg_<?=$que->Id;?>"></div>
            <br>
            <button class="updateque steps_btn" value="<?=$que->Id;?>">Update</button>
              </div>
                <div class="modal" id="deleteque_<?=$que->Id;?>" style="top: 20%;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12 text-center">
                          <h4>Are you sure you want to delete this question?</h4>
                          <button class="btn btn-default" data-dismiss="modal">No</button>
                          <button class="deleteque btn btn-danger" value="<?=$que->Id;?>">Yes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
               <?php
                if(count($answers[$i])>0){
                  ?>
                  <div class="row">
                    <div class="col-md-8"><b>Answer:</b>&nbsp; </div>
                    <div class="col-md-4 text-right"><span><a href="#" data-toggle="collapse" data-target="#editanswer_<?=$que->Id;?>"><i class="fas fa-edit"></i> Edit answer</a></span> &nbsp;<span>  <a href="#" class="text-danger" data-toggle="modal" data-target="#deleteans_<?=$answers[$i][0]->Id;?>"><i class="fas fa-trash"></i>&nbsp;Delete answer</a></span>
            </div>
                  </div>
                  <div id="editanswer_<?=$que->Id;?>" class="collapse">
               
                  <div class="ui search focus mt-30 lbel25">
              <label>Edit Answer</label>
              <div class="ui left icon input swdh19">
                <textarea class="content form-control" id="uanswer_<?=$que->Id;?>"><?=$answers[$i][0]->Answers;?></textarea>
              </div>
            </div><br>
             <div id="umsg_<?=$que->Id;?>"></div>
            <br>
            <button class="update steps_btn" value="<?=$que->Id;?>">Update</button>
              </div>
                <div class="modal" id="deleteans_<?=$answers[$i][0]->Id;?>" style="top: 20%;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12 text-center">
                          <h4>Are you sure you want to delete this?</h4>
                          <button class="btn btn-default" data-dismiss="modal">No</button>
                          <button class="delete btn btn-danger" value="<?=$answers[$i][0]->Id;?>">Yes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                    <p><?=$answers[$i][0]->Answers;?></p>
                     
               <?php
                  }
             
                if(!count($answers[$i])>0){
                  ?>
              <div id="addanswer_<?=$que->Id;?>" class="collapse">
                  <div class="ui search focus mt-30 lbel25">
              <label>Add Answer</label>
              <div class="ui left icon input swdh19">
                <textarea class="content form-control" id="answer_<?=$que->Id;?>"></textarea>
              </div>
            </div><br>
            <div id="amsg_<?=$que->Id;?>"></div>
            <br>
            <button class="add steps_btn" value="<?=$que->Id;?>">Submit</button>
              </div>
              <?php
            }
              ?>
          </div>
          </div>
        </div>
  
  </div>
   <br>
          </div>
          <?php 
      $i++;
      ?>
      <?php endforeach; ?>
                            </div>
                 <br>   
                <p><?php echo $links; ?></p>
</div>
<br><br><br><br>
<script type="text/javascript">
    $('body').on('click', '.update', function(){ 
      $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#imagemodal').modal('show');   
    });   
$('body').on('click', '.add', function(){ 
    var qid=$(this).val();
    var answer=tinyMCE.editors[$('#answer_'+qid).attr('id')].getContent();
   $('#amsg_'+qid).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait answer adding....</div>');
    $.ajax({
      url:"<?=base_url();?>admin/forum/addanswer",
          method:"POST",
          data:{qid:qid,answer:answer},
          dataType:'json',
          success:function(data)
          {
            if(data.code=="404"){
              $('#amsg_'+qid).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
            }
            else{
              swal("Answer added successfully!", "", "success");
              $('#amsg_'+qid).html("");
            setTimeout(function () {
                    swal.close();
                    location.href="<?=base_url();?>admin/forum";
                }, 2000);
            }
          }
    });
    });   
$('body').on('click', '.update', function(){ 
    var qid=$(this).val();
    var answer=tinyMCE.editors[$('#uanswer_'+qid).attr('id')].getContent();
   $('#umsg_'+qid).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait answer updateing....</div>');
    $.ajax({
      url:"<?=base_url();?>admin/forum/updateanswer",
          method:"POST",
          data:{qid:qid,answer:answer},
          dataType:'json',
          success:function(data)
          {
              $(this).attr("disabled", false);
            if(data.code=="404"){
              $('#umsg_'+qid).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
            }
            else{
              swal("Answer updated successfully!", "", "success");
              $('#umsg_'+id).html('');
            setTimeout(function () {
                    swal.close();
                    location.href="<?=base_url();?>admin/forum";
                }, 2000);
            }
          }
    });
    });   
$('body').on('click', '.updateque', function(){ 
   $('#uqmsg_'+qid).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait answer updateing....</div>');
     var qid=$(this).val();
    var topic=$('#topic_'+qid).val();
    var question=$('#uquestion_'+qid).val();
    $.ajax({
      url:"<?=base_url();?>student/updatequestion",
          method:"POST",
          data:{qid:qid,topic:topic,question:question},
          dataType:'json',
          success:function(data)
          {
              $(this).attr("disabled", false);
            if(data.code=="404"){
              $('#uqmsg_'+qid).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
            }
            else{
              swal("Question updated successfully!", "", "success");
              $('#uqmsg_'+id).html('');
            setTimeout(function () {
                    swal.close();
                    location.href="<?=base_url();?>admin/forum";
                }, 2000);
            }
          }
    });
    });   
$('.deleteque').click(function() {
    var qid=$(this).val();
    $.ajax({
      url:"<?=base_url();?>admin/forum/deletequestion",
      method:"POST",
      data:{qid:qid},
      success:function(data)
      {
        swal("Question deleted successfully!", "", "success");
        setTimeout(function () {
          swal.close();
          location.reload();
        }, 2000);
      }
    });
  })
$('.delete').click(function() {
    var aid=$(this).val();
    $.ajax({
      url:"<?=base_url();?>admin/forum/deleteanswer",
      method:"POST",
      data:{aid:aid},
      success:function(data)
      {
        swal("Answer deleted successfully!", "", "success");
        setTimeout(function () {
          swal.close();
          location.reload();
        }, 2000);
      }
    });
  })
</script>