<script type="text/javascript">
    $(document).ready(function() {
      tinymce.init({
        selector: "#content",
        theme: "modern",
        mode: "exact",
        paste_data_images: true,
         menubar: 'edit insert format table tools',
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
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
      <div class="content">
          <div class="row">
      <div class="col-md-10 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>New Blog</h2><br>
      </div>       
    </div>  
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card card-body">
              <div class="card-header">
                <div class="form-group">
                  <label>Post Category</label>
                  <select class="form-control" id="category" name="category">
                     <?php
                      $i=0;
                      foreach ($categories as $row) {
                     ?>
                    <option value="<?=$row->Id;?>"><?=$row->Name;?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Post Title</label>
                  <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                  <label>Post Main Image</label>
                <input type="file" class="form-control" id="fileupload" name="fileupload">
                </div>
                <div class="form-group">
                  <label>Post Content</label>
                 <textarea class="form-control" id="content" name="content"></textarea>
                  <input name="image" type="file" id="upload" class="hidden" onchange="">
                </div>
                 <div class="form-group">
                  <label>Post Slug</label>
                  <input type="text" placeholder="ex. what-is-algorithmic-trading" name="title" id="slug" class="form-control" value="">
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div id="msg"></div>
                  </div>
                  <div class="col-md-4 text-right">
                  <button type="button" class="btn btn-primary" id="publish">Publish</button></div>
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
    var content=tinyMCE.editors[$('#content').attr('id')].getContent();
    formData.append('file', file);
    formData.append('title', title);
    formData.append('slug', $('#slug').val());
    formData.append('category', category);
    formData.append('content', content);
    $.ajax({
        url: "<?= base_url()?>admin/blogs/addblog",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        dataType:'json',
        success: function(response){
          if(response.code=="404"){
            $('#msg').html('<div class="alert alert-danger">'+response.msg+'</div>');
          }
          else{
            $('#msg').html('<div class="alert alert-success">'+response.msg+'</div>'); 
            //location.href = "<?= base_url()?>admin/post";
          }
      // 
    }
    });
  
});
</script>
