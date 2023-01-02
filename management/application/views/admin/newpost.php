 <script>
 $(document).ready(function() {
  tinymce.init({
    selector: "#content",
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
  .hidden{display:none;}
</style>
<div class="container">
  <div class="row">
      <div class="col-md-10 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>New Post</h2><br>
      </div>       
    </div>  

      <div class="content">
        
           
            <div class="card">
              <div class="card-body">
               <div class="row">
          <div class="col-12">
           <div class="ui search focus lbel25">
                  <label>Title</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Enter title" id="title" data-purpose="edit-course-title">                  
                  </div>
                </div>
               <div class="ui search focus mt-30 lbel25">
							<label>Select category</label>
							<select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="category">
								<?php 
									foreach($categories as $cat){
										?>
										<option value="<?=$cat->Id;?>"><?=$cat->Name;?></option>
										<?php
									}
								?>								
							</select>
						</div>
             
             <div class="ui search focus mt-30 lbel25">
              <label>Select Image</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" name="fileupload" data-purpose="edit-course-title" id="fileupload" value="">                  
              </div>
            </div>
               <div class="ui search focus mt-30 lbel25">
              <label>Post Description</label>
              <div class="ui left icon input swdh19">
                <textarea class="form-control" id="content"></textarea>
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
                  <label>Post date</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="date" id="pdate" data-purpose="edit-course-title">                  
                  </div>
                </div><br>
                <div id="msg" style="width: 60%;"></div><br>
                <div class="text-right">
              <button data-direction="next" class="btn btn-default steps_btn" id="publish">Publish</button>  
            </div>
              
            </div>
            
          </div>
        
        </div>
      </div>
    </div>
    <script type="text/javascript">
       $("#publish").click(function(){
   var formData = new FormData();
    var category=$('#category').val();
    file=$('input[name="fileupload"]').get(0).files[0];
    var title=$('#title').val();
    var pdate=$('#pdate').val();
    var content=tinyMCE.editors[$('#content').attr('id')].getContent();
    formData.append('file', file);
    formData.append('title', title);
    formData.append('pdate', pdate);
    formData.append('category', category);
    formData.append('content', content);
    formData.append('post', "1");
      $(this).attr("disabled", true);
   $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait post creating....</div>');
    $.ajax({
        url: "<?= base_url()?>admin/current_affair/addpost",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        dataType:'json',
        success: function(data){
            $(this).attr("disabled", false);
          if(data.code=="404"){
            $('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("Post created successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
        window.location.href = "<?= base_url()?>admin/current_affair";
                }, 2000);
          }
         
    }
    });
  
});
    </script>