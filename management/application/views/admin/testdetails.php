<div class="modal" id="questionModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Question</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <div class="form-group">
                        <label>Question: </label>
                        <textarea class="content form-control" id="question" rows="2" placeholder="Question">
                        </textarea>
                      </div>
                      <div class="row form-group">
                        <label class="col-md-3">Correct answer: </label>
                      <label class="col-md-9">Options</label>
                      </div>
                      
                      <div class="row form-group">
                        <div class="col-md-3">
                                    <input type="checkbox" name="canswer" value="opt1">
                                            </div>
                        <div class="col-md-9">
                          <textarea class="options content form-control" id="option_1" name="options" rows="2" placeholder="Option 1"></textarea>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col-md-3">
                          <input type="checkbox" name="canswer" value="opt2">
                        </div>
                        <div class="col-md-9">
                          <textarea class="content options form-control" id="option_2" name="options" rows="2" placeholder="Option 2"></textarea>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col-md-3">
                          <input type="checkbox" name="canswer" value="opt3">
                        </div>
                        <div class="col-md-9">
                          <textarea class="content options form-control" id="option_3" name="options" rows="2" placeholder="Option 3"></textarea>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col-md-3">
                          <input type="checkbox" name="canswer" value="opt4">
                        </div>
                        <div class="col-md-9">
                          <textarea class="content options form-control" id="option_4" name="options" rows="2" placeholder="Option 4"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Correct answer explaination: </label>
                      <textarea class="content form-control" id="aexplain" rows="2" placeholder="Question">
                        </textarea>
                      </div>
                       <div class="ui search focus mt-30 lbel25">
                  <label>Marks</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="number" placeholder="Marks" id="qmarks">                  
                  </div>
                </div>
                 <div class="ui search focus mt-30 lbel25">
                  <label>Negative Marks</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="number" placeholder="Negative Marks" id="nmarks">                  
                  </div>
                </div>
                <br>
                      <div id="aqmsg"></div>
                   <br>
                    <button type="button" class="btn btn-primary steps_btn" id="addquestions" value="<?=$test[0]->Id;?>">Add</button>
     
                               
      </div>

    </div>
  </div>
</div>
<div class="modal" id="uploadModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Upload Questions</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <br>
      <h5>Download excel format:</h5>
        <a type="button" class="btn btn-default" href="https://cbspace.sgp1.cdn.digitaloceanspaces.com/reliable-academy/test-series/question-excel-format.xlsx" download><i class="fa fa-download"></i> Download</a>
        <p>* Fill data in excel sheet and upload it. *</p>
          <br>
             <div class="ui search focus mt-30 lbel25">
                  <label>Select excel file</label>
                  <div class="ui left icon input swdh19">
                       <input type="file" class="prompt srch_explore" name="uploadexcel" id="uploadexcel" accept=".xlsx" required/>
                             
                  </div>
                </div>
              <div id="uqmsg"></div><br>
             <button type="button" class="btn btn-primary steps_btn" id="uploadquestions" value="<?=$test[0]->Id;?>">Upload</button>
            
      </div>

    </div>
  </div>
</div>
<div class="modal" id="publishModal">
  <div class="modal-dialog">
    <div class="modal-content">


      <!-- Modal body -->
      <div class="modal-body text-center">
    <h5>Are you sure you want to publish this exam?</h5><br>   
    <button type="button" class="btn btn-default" class="close" data-dismiss="modal">No</button>
    <button type="button" class="btn btn-success" id="publish">Yes</button>
      </div>

      

    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    tinymce.init({
    selector: ".content",
    theme: "modern",
    paste_data_images: true,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons | fontselect fontsizeselect",
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
    background: #0eb67c !important;
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
        <div class="col-md-9 col-8">
          <h2><?=$test[0]->ExamName;?></h2>
          <p><span><i class="fas fa-clock"></i> <?=$test[0]->CreatedAt;?></span></p>
          <p>Total Questions: <?=count($questions);?></p>
           <p>Total Marks: <?=$marks;?></p>
        </div>
        <div class="col-md-3 text-center" style="padding: 30px;">
          <?php 
           if($test[0]->IsPublished==0 && count($questions)>0){
          ?>
           <button type="button" class="btn btn-success" data-toggle="modal" data-target="#publishModal">Publish</button><br><br>
          <?php
        }
          ?>
        </div>
      </div>
    </div>
  </div><br>

  <div class="row">
    <div class="col-md-6">
      <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="pill" href="#questions">Questions&nbsp;<span class="badge badge-light" style="border-radius: 10px;" id="qcount"><?=count($questions);?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="pill" href="#results">Results&nbsp;<span class="badge badge-light" style="border-radius: 10px;"><?=count($students);?></span></a>
      </li>
    </ul>
  </div>
  <div class="col-md-6 text-right">
      <?php 
        $access=$this->session->userdata('access');
        $tseries=array();
        $tseries=$access->tseries;
        if(in_array("add", $tseries) || in_array("all", $tseries)){
        ?>
      <button class="btn btn-primary steps_btn" data-toggle="modal" data-target="#questionModal">Add more questions</button>
      <button type="button" class="btn btn-primary steps_btn" data-toggle="modal" data-target="#uploadModal">Upload questions</button>   
      <?php 
        }
      ?>          
  </div>
</div>
<br>
<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="questions">
    <div class="row">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-body">
             <?php 
                $i=0;
                if(count($questions)>0){
                  ?>
                 <br><br>
                   <div class="row">
                    <div class="col-md-12 order-12 order-md-1">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <br>
                          <div id="load_data">
                          </div>
                          <div id="load_data_message"></div>
                          <br />
                          <br />
                          <br />
                          <br />
                          <br />
                          <br />
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                  foreach ($questions as $ques) {
                    ?>
                    <?php
                  }
                }
                else{
                 ?>
                  <div class="col-md-12">

                    <div class="text-center" style="padding: 100px;">
                      <h3>No questions added yet.</h3>
                      <p>Questions will be shown up here.</p>
                    </div>
                    <div class="row">
                    <div class="col-md-12 text-center">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#questionModal">Add more questions</button>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">Upload questions</button>
                    </div>
                  </div>
                  </div>
                <?php
                  }
                ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane" id="results">
    <div class="row">
      <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
            <br>
            <?php 
            $i=0;
            if(count($results)>0){
            foreach ($students as $stud) {
              ?>
              <div class="row">
                <div class="col-md-9 col-9">
              <h4><a href="<?=base_url();?>admin/test/viewresults/<?=$test[0]->Id;?>/<?=$stud->Id;?>" class="student"><?=$stud->FirstName.' '.$stud->LastName;?></a><span class="badge badge-warning" style="font-size: 10px;">
                <?php 
                if(count($results[$i])>1){
                ?>
                <?=count($results[$i])-1;?> retakes
                <?php 
              }
              ?>
              </span></h4>
              <p><span><strong>Marks : </strong><?=$results[$i][0]->Marks;?>/<?=$marks;?></span>&nbsp;&nbsp;&nbsp;<span><strong>Right Answered : </strong><?=$results[$i][0]->RightAnswered;?>/<?=count($questions);?></span></p>
              </div>
              <div class="col-md-3 col-3 text-center">
               <h4><?=$results[$i][0]->Percentage;?> %</h4>
               <?php 
               if($test[0]->PassingPercent>$results[$i][0]->Percentage){
               ?>
                  <p class="text-danger">Fail</p>
                  <?php
                }
                else{
                  ?>
                  <p class="test-success">Pass</p>
                  <?php
               }
               ?>
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
      <?php 
    }
    else{
       ?>
          <div class="col-md-12">
            <div class="text-center" style="padding: 100px;">
              <h3>Not students given exams yet.</h3>
              <p>Students result will shown up here.</p>
            </div>
          </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
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
      var examid='<?=$test[0]->Id;?>'
      $.ajax({
        url:"<?php echo base_url(); ?>admin/test/fetchanswersheet",
        method:"POST",
        data:{examid:examid,limit:limit, start:start},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('');
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
$('body').on('click', '.updateque', function(){
  var id=$(this).val();
  var qmarks=$('#qmarks_'+id).val();
  var nmarks=$('#nmarks_'+id).val();
  var question=tinyMCE.editors[$('#question_'+id).attr('id')].getContent();
  var aexplain=tinyMCE.editors[$('#aexplain_'+id).attr('id')].getContent();
  var options = [];
      $('input[name="options_'+id+'"]').each(function(checkbox) {
        options.push($(this).val());
      });
      var cans = [];
      $('input[name="canswer_'+id+'"]:checked').each(function(checkbox) {
        cans.push($(this).val());
      });
    $('#aqmsg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait test creating....</div>');
    $.ajax({
      url: "<?= base_url()?>admin/test/updatequestion",
      type: "post",
      data:{id:id,question:question,options:options,cans:cans,qmarks:qmarks,aexplain:aexplain,nmarks:nmarks},
      success: function(data){
       // $("#submit").attr("disabled", false);
       swal("Question added successfully!!.", "", "success");
            setTimeout(function () {
            swal.close();
          }, 2000);
        
      }
    });
  });
$('#addquestions').click(function(){
  var qmarks=$('#qmarks').val();
  var nmarks=$('#nmarks').val();
  var question=tinyMCE.editors[$('#question').attr('id')].getContent();
  var aexplain=tinyMCE.editors[$('#aexplain').attr('id')].getContent();
  var options = [];
  var n=1;
  $('textarea[name="options"]').each(function(checkbox) {
   value=tinyMCE.editors[$('#option_'+n).attr('id')].getContent();
   if(value!=""){
      options.push(value);
    }
    n++;
  });
  var len=options.length;
  
  var cans = [];
  $('input[name="canswer"]:checked').each(function(checkbox) {
    cans.push($(this).val());
  });
  
  var canswers=[];
  if(question==""){
 $('#aqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>Please enter question.</div>')
  }
  else if(qmarks=="")
  {
 $('#aqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>Please enter marks.</div>');
  }
  else if(len<2){
     $('#aqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>Please enter atleast two options.</div>');
  }
  else if(cans<1){
     $('#aqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>Please enter atleast one correct answer.</div>');
  }
  else{
  if(cans.includes('opt1')){
    canswers.push("1");
  }
  else{
    canswers.push("0");
  }
  if(cans.includes('opt2')){
    canswers.push("1");
}
  else{
    canswers.push("0");
  }
  if(cans.includes('opt3')){
    canswers.push("1");
}
  else{
    canswers.push("0");
  }
  if(cans.includes('opt4')){
    canswers.push("1");
}
  else{
    canswers.push("0");
  }
  if(cans.includes('opt1') && tinyMCE.editors[$('#option_1').attr('id')].getContent()==""){
    $('#aqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>Correct asnwer can not be blank.</div>');
  }
else if(cans.includes('opt2') && tinyMCE.editors[$('#option_2').attr('id')].getContent()==""){
    $('#aqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>Correct asnwer can not be blank.</div>');
  }
  else if(cans.includes('opt3') && tinyMCE.editors[$('#option_3').attr('id')].getContent()==""){
    $('#aqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>Correct asnwer can not be blank.</div>');
  }
  else if(cans.includes('opt4') && tinyMCE.editors[$('#option_4').attr('id')].getContent()==""){
    $('#aqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>Correct asnwer can not be blank.</div>');
  }
  else{
  var id=$(this).val();
  $.ajax({
    url:"<?php echo base_url(); ?>admin/test/addquestion",
        method:"POST",
        data:{id:id,question:question,options:options,canswers:canswers,qmarks:qmarks,aexplain:aexplain,nmarks:nmarks},
        dataType:'json',
        success:function(data)
        {

            setTimeout(function () {
             $('#aqmsg').html('<div class="alert alert-success"><strong>Success! </strong>Question added successfully.</div>');
          }, 5000);
            tinyMCE.editors[$('#question').attr('id')].setContent('');
            tinyMCE.editors[$('#aexplain').attr('id')].setContent('');
            $('#qmarks').val('0');
              tinyMCE.editors[$('#option_1').attr('id')].setContent('');
            tinyMCE.editors[$('#option_2').attr('id')].setContent('');
            tinyMCE.editors[$('#option_3').attr('id')].setContent('');
            tinyMCE.editors[$('#option_4').attr('id')].setContent('');
        }
  });
}
}
});
$('#uploadquestions').click(function(){
    var formData = new FormData();
  file=$('input[name="uploadexcel"]').get(0).files[0];
  formData.append('file', file);
    formData.append('id',$(this).val());
   // $("#uploadquestions").attr("disabled", true);
    $('#uqmsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait excel uploading....</div>');
      $.ajax({
        url: "<?= base_url()?>admin/test/uploadquestions",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data){
          $("#uploadquestions").attr("disabled", false);
          $('#msg1').html("");
        if(data.code=="200"){
           $('#uqmsg').html('');
           swal("Questions uploaded successfully!", "", "success");
      setTimeout(function () {
              swal.close();
            //  location.reload();
          }, 2000);
        }
        else{
           $('#uqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
        }

      }
    });
   })
$('#publish').click(function(){
    var formData = new FormData();
    formData.append('id','<?=$test[0]->Id;?>');
      $.ajax({
        url: "<?= base_url()?>admin/test/publishexam",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
         swal("Exam published successfully!", "", "success");
      setTimeout(function () {
              swal.close();
              location.reload();
          }, 2000);
      }
    });
   })

$('body').on('click', '.deleteque', function(){
    var formData = new FormData();
    formData.append('id',$(this).val());
      $.ajax({
        url: "<?= base_url()?>admin/test/deletequestion",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
         swal("Question deleted successfully!", "", "success");
      setTimeout(function () {
              swal.close();
              location.reload();
          }, 2000);
      }
    });
   })
</script>