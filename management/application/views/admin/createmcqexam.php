<style type="text/css">
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css');
  #msform {
      position: relative;
      margin-top: 20px
  }




  #msform fieldset:not(:first-of-type) {
      display: none
  }

  #msform fieldset .form-card {
      text-align: left;
      color: #9E9E9E
  }


 #msform .action-button {
       font-size: 14px !important;
    font-weight: 500 !important;
    font-family: 'Roboto', sans-serif !important;
    color: #fff !important;
    background: #ed2a26 !important;
    padding: 0px 20px !important;
    border-radius: 25px !important;
    border: 0 !important;
    height: 40px !important;
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #ed2a26 !important
}

#msform .action-button-previous {
       font-size: 14px !important;
    font-weight: 500 !important;
    font-family: 'Roboto', sans-serif !important;
    color: #fff !important;
    background: #ed2a26 !important;
    padding: 0px 20px !important;
    border-radius: 25px !important;
    border: 0 !important;
    height: 40px !important;
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #ed2a26
}

  select.list-dt {
      border: none;
      outline: 0;
      border-bottom: 1px solid #ccc;
      padding: 2px 5px 3px 5px;
      margin: 2px
  }

  select.list-dt:focus {
      border-bottom: 2px solid #ed2a26 !important
  }

  .card {
      z-index: 0;
      border: none;
      border-radius: 0.5rem;
      position: relative
  }

  .fs-title {
      font-size: 25px;
      color: #2C3E50;
      margin-bottom: 10px;
      font-weight: bold;
      text-align: left
  }

  #progressbar {
      margin-bottom: 30px;
      overflow: hidden;
      color: lightgrey
  }

  #progressbar .active {
      color: #000000
  }

  #progressbar li {
      list-style-type: none;
      font-size: 12px;
      width: 33.3%;
      float: left;
      position: relative
  }

  #progressbar #create:before {
      font-family: FontAwesome;
      content: "\f067"
  }

  #progressbar #upload:before {
      font-family: FontAwesome;
      content: "\f093"
  }

  #progressbar #finish:before {
      font-family: FontAwesome;
      content: "\f00c"
  }

  #progressbar li:before {
      width: 50px;
      height: 50px;
      line-height: 45px;
      display: block;
      font-size: 18px;
      color: #ffffff;
      background: lightgray;
      border-radius: 50%;
      margin: 0 auto 10px auto;
      padding: 2px
  }

  #progressbar li:after {
      content: '';
      width: 100%;
      height: 2px;
      background: lightgray;
      position: absolute;
      left: 0;
      top: 25px;
      z-index: -1
  }

  #progressbar li.active:before,
  #progressbar li.active:after {
      background: #ed2a26 !important
  }


  .fit-image {
      width: 100%;
      object-fit: cover
  }
</style>
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
<div class="container">
    <h3>Create Exam</h3>
<br>
<div class="container-fluid" id="grad1">
    <div class="row">
        <div class="col-md-12">
          <ul id="progressbar">
                                <li class="active text-center" id="create"><strong>Create exam</strong></li>
                                <li id="upload" class="text-center"><strong>Upload questions</strong></li>
                                <li id="finish" class="text-center"><strong>Finish</strong></li>
                            </ul><br><br>
            <div class="card">
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            
                            <div class="container">
                            <fieldset id="firststep">
                              <div class="card">
                                <div class="card-body">
                        
                         <div class="ui search focus lbel25">
                  <label>Title</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Enter title" id="title" data-purpose="edit-course-title">                  
                  </div>
                </div>
                 <div class="ui search focus mt-30 lbel25">
                  <label>Duration(in minutes)</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="number" placeholder="Minutes" id="duration" data-purpose="edit-course-title" maxlength="60">                  
                  </div>
                </div>
                 <div class="ui search focus mt-30 lbel25">
                  <label>Passing Percentage</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="30" id="pmarks" data-purpose="edit-course-title" maxlength="60">                  
                  </div>
                </div>
                <div class="form-group mt-40">
                  <span class="mt-40">
                    <input type="checkbox" id="isnegative" data-purpose="edit-course-title">
                  </span>&nbsp;<label>Is Negative Marking?</label>
                </div>
                <div class="ui search focus mt-30 lbel25">
                  <label>Instructions</label>
                  <div class="ui left icon input swdh19">
                    <textarea class="content form-control" id="instructions" rows="2" placeholder="Instructions">
                    </textarea>
                  </div>
                </div>
                  <br>
                        <div id="emsg"></div>
                      </div>
                    </div>
                          <div class="text-right">
                      <button type="button" name="next" class="next action-button" value="<?=$id;?>" id="addexam">Next</button>
                    </div>
                            </fieldset>
                            <fieldset id="secondstep">
                              <br>
                                <div class="row">
                                    <div class="col-md-8">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="pill" href="#manually">Add manually</a>
                          </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="pill" href="#excel">Uplaod questions excel</a>
                            </li>
                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Total Question:</strong><span id="tquestions">0</span>&nbsp;&nbsp;<strong>Total Marks:</strong><span id="tmarks">0</span></p>
                                    </div>
                                </div>
                                <br><br>
                <div class="tab-content">
                    <div class="tab-pane container active" id="manually">
                      <br>
                      <div class="row form-group">
                        <label class="col-md-3">Question: </label>
                      <div class="col-md-9">
                        <textarea class="content form-control" id="question" rows="2" placeholder="Question">
                        </textarea>
                      </div>
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
                      <div class="row form-group">
                        <label class="col-md-3">Correct answer explaination: </label>
                      <div class="col-md-9">
                        <textarea class="content form-control" id="aexplain" rows="2" placeholder="Question">
                        </textarea>
                      </div>
                      </div>
                       <div class="ui search focus mt-30 lbel25">
                  <label>Marks</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="number" placeholder="Marks" id="qmarks" data-purpose="edit-course-title" maxlength="60">                  
                  </div>
                </div>
                <br>
                      <div id="aqmsg"></div>
                      <button type="button" class="btn btn-primary" id="addquestions" value="2">Add</button>
                    </div>
                    <div class="tab-pane container fade" id="excel">
                      <br>
                      <h5>Download excel format:</h5>
                        <a type="button" class="btn btn-default" href="https://cbspace.sgp1.cdn.digitaloceanspaces.com/reliable-academy/test-series/question-excel-format.xlsx" download><i class="fa fa-download"></i> Download</a>
                        <p>* Fill data in excel sheet and upload it. *</p>
                          <br>
                             <div class="ui search focus mt-30 lbel25">
                  <label>Select excel file:</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="file" id="uploadexcel" name="uploadexcel" >                  
                  </div>
                </div><br>
                              <div id="uqmsg"></div>
                              <button type="button" class="btn btn-primary" id="uploadquestions" value="2">Upload</button>
                    </div>
                </div>
                <div class="text-right">
                                <input type="button" name="next" class="next action-button" value="Next" id="finishbtn" />
                              </div>
                            </fieldset>
                            <fieldset id="thirstep">
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>Exam Created Successfully.</h5>
                                            <button class="next action-button" type="button" id="endbtn">Finish</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$('#addexam').click(function(){
    var title=$('#title').val();
  var pmarks=$('#pmarks').val();
  var duration=$('#duration').val();
  var isnegative=0;
  if ($('#isnegative').is(':checked')) {
    isnegative=1;
  }
   var instructions=tinyMCE.editors[$('#instructions').attr('id')].getContent();
    var id=$(this).val();
  $.ajax({
    url:"<?php echo base_url(); ?>admin/test/addtest",
        method:"POST",
        data:{id:id,title:title,pmarks:pmarks,duration:duration,instructions:instructions,isnegative:isnegative},
        dataType:'json',
        success:function(data)
        {
          if(data.code=="404"){
            $('#emsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            $('#addquestions').val(data.id);
            $('#uploadquestions').val(data.id);
                $('#endbtn').val(data.id);
            $('fieldset').css({'display':'none'});
            $('#secondstep').css({'display':'block'});
            $('li').removeClass('active');
            $('#upload').addClass('active');
          }
        }
  });
});
$('#addquestions').click(function(){
   var qmarks=$('#qmarks').val();
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
        data:{id:id,question:question,options:options,canswers:canswers,qmarks:qmarks,aexplain:aexplain},
        dataType:'json',
        success:function(data)
        {
             setTimeout(function () {
             $('#aqmsg').html('<div class="alert alert-success"><strong>Success! </strong>Question added successfully.</div>');
          }, 2000);
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
    $("#uploadquestions").attr("disabled", true);
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
           $('#tquestions').html(data.tquestions);
                $('#tmarks').html(data.tmarks);
      setTimeout(function () {
              swal.close();
          }, 2000);
        }
        else{
           $('#uqmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
        }

      }
    });
   })
$('#finishbtn').click(function(){
  $('fieldset').css({'display':'none'});
  $('#thirstep').css({'display':'block'});
  $('li').removeClass('active');
  $('#finish').addClass('active');
})
$('#endbtn').click(function(){
    var id=$(this).val();
    location.href="<?=base_url();?>admin/test/testdetails/"+id;
})
</script>