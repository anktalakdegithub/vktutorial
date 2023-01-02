<link href="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    tinymce.init({
      selector: ".desc",
      theme: "modern",
      paste_data_images: true,
       menubar: 'edit insert format table tools',
      plugins: [
        "advlist autolink lists image charmap preview hr anchor pagebreak",,
        "insertdatetime nonbreaking save table contextmenu directionality",
        "template paste textcolor colorpicker textpattern"
      ],
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
<style type="text/css">
  .multiselect{
    border: 1px solid #e3e3e3;
    width: 500px !important;
    text-align: left !important;
  }
  .multiselect-container{
    width: 500px !important;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-6">  
      <h2 class="st_title"><i class="uil uil-analysis"></i>Past Lectures</h2><br>
    </div>       
  </div>  
  <div class="row">
    <div class="col-md-8 order-12 order-md-1">
      <div class="panel panel-default">
        <div class="panel-body"><br>
          <div  id="lectures">
           <div class="row">
              <div class="col-md-4 col-6">
                <div class="alert alert-success">
                  <h3 id="tplecturest"><?=$lectures;?></h3>
                  <p>Total lectures</p>
                </div>
              </div>
            </div>  
            <br>
            <div id="load_data"></div>
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
    <div class="col-md-4 order-1 order-md-12">
      <div class="panel panel-default">
        <div class="panel-body"><br>
          <h3>Filter by</h3>
          <br>
          <div class="form-group">
            <label>Batch</label>
            <select class="form-control" id="batch" name="batch">
              <option value="">Select Batch</option>
                <?php
                foreach ($abatches as $batch) {
                ?>
                  <option value="<?php echo $batch->Id;?>"><?php echo $batch->Name;?></option>          
                <?php
                }
                ?>
            </select>
          </div>
          <div class="form-group">
            <label>Select Month</label>
            <div class="date-own" id="datepicker">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('.date-own').datepicker({
         minViewMode: 1,
         format: 'MM'
       });
  $('body').on('click', '.delete', function(){
    $(this).attr("disabled", true);
    var formData = new FormData();
    var id=$(this).val();
    formData.append('id', id);
    $.ajax({
        url: "<?= base_url()?>admin/schedule/deletelecture",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
            swal("Lecture deleted successfully!", "", "success");
            setTimeout(function () {
                swal.close();
                $(this).attr("disabled", false);
                location.reload();
            }, 2000);
      }
    });
});
  $('body').on('click', '.update', function(){

    var id=$(this).val();
    var title=$('#title_'+id).val();
    var desc=tinyMCE.editors[$('#desc_'+id).attr('id')].getContent();
    var lectid=$('#lectid_'+id).val();
    var pass=$('#pass_'+id).val();
    var ldate=$('#ldate_'+id).val();
    var stime=$('#stime_'+id).val();
    var etime=$('#etime_'+id).val();
    var surl=$('#starturl_'+id).val();
    var sbatches = $("#batches_"+id+" option:selected");
        var batches = [];
        sbatches.each(function () {
            batches.push($(this).val());
        });
        var sfaculties = $("#faculties_"+id+" option:selected");
        var faculties = [];
        sfaculties.each(function () {
            faculties.push($(this).val());
        });
          $(this).attr("disabled", true);
   $('#msg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait lecture updating....</div>');
         var formData = new FormData();
    thumbnail=$('input[name="thumbnail_'+id+'"]').get(0).files[0];
    formData.append('thumbnail', thumbnail);
    formData.append('id', id);
    formData.append('title', title);
    formData.append('desc',desc);
    formData.append('batches', batches);
    formData.append('faculties', faculties);
    formData.append('lectid',lectid);
    formData.append('pass', pass);
    formData.append('ldate', ldate);
    formData.append('stime',stime);
    formData.append('etime',etime);
    formData.append('surl',surl);
    $.ajax({
      url: "<?=base_url();?>admin/schedule/updatelecture",
      data: formData,
      method: "post",
      dataType: 'json',
      headers: { 'IsAjax': 'true' },
      processData: false,
      contentType: false,
          success:function(data)
          {
              $(this).attr("disabled", false);
            if(data.code=="404"){
              $('#msg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
            }
            else{
              swal("Lecture updated successfully!", "", "success");
              setTimeout(function () {
                swal.close();
                //  location.href="<?=base_url();?>admin/schedule";
              }, 2000);
            }
          }
    });
  })
  $(function () {
    $('.multiselectdrop').multiselect({
        //includeSelectAllOption: true
    });
  });
  $('#batch').change(function(){
    filter_past_lectures();
  });
  $('#datepicker').on('changeDate', function (ev) {
    filter_past_lectures();
});
  function filter_past_lectures()
  {
    var date = $('#datepicker').datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
        ];
    $.ajax({
      url:"<?php echo base_url(); ?>admin/schedule/filter_past_lectures",
      method:"POST",
      data:{month:month,year:year,bid:$('#batch').val()},
      cache: false,
      success:function(data)
      {
        if(data == '')
        {
          $('#lectures').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no lectures found!!</p></div><div class="col-md-4"></div></div></div>');
        }
        else
        {
          $('#lectures').html(data);
          
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
        url:"<?php echo base_url(); ?>admin/schedule/fetch_past_lectures",
        method:"POST",
        data:{limit:limit, start:start},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no more lectures found!!</p></div><div class="col-md-4"></div></div></div>');
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