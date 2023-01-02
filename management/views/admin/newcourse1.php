<script type="text/javascript">
	$(document).ready(function() {
  tinymce.init({
    selector: "#desc",
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
<div class="sa4d25">
<div class="container">			
<div class="row">
<div class="col-lg-12">	
<h2 class="st_title"><i class="uil uil-analysis"></i> Create New Course</h2>
</div>					
</div>				
<div class="row">
<div class="col-12">
<div class="course_tabs_1">
<div class="course__form">
<div class="general_info10">
<div class="row">
<div class="col-lg-12 col-md-12">															
<div class="ui search focus mt-30 lbel25">
<label>Course Title*</label>
<div class="ui left icon input swdh19">
<input class="prompt srch_explore" type="text" placeholder="Insert your course title." name="title" id="title" value="">															
<div class="badge_num">60</div>
</div>
</div>									
</div>
<div class="col-lg-12 col-md-12">
<div class="course_des_textarea mt-30 lbel25">
<label>Course Description*</label>
<div class="course_des_bg">
<div class="textarea_dt">															
	<div class="ui form swdh339">
		<div class="field">
			<textarea rows="5" name="description" id="desc" placeholder="Insert your course description"></textarea>
		</div>
	</div>										
</div>
</div>
</div>
</div>
<div class="col-lg-12 col-md-12">
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
								<!--<option class="text-primary" value="new"><a href="#">+Add New</a></option>					-->			
							</select>
							<style type="text/css">
								#cdata{
									display: none;
								}
							</style>
						</div>

<div class="ui search focus mt-30 lbel25" id="cdata">
<label>New category*</label>
<div class="ui left icon input swdh19">
<input class="prompt srch_explore" type="text" placeholder="Insert new category." name="ncategory" id="ncategory">															
</div>
</div>
  <br><br><br>  </div> 
    <div class="view_info10">
<div class="row">
<div class="col-lg-12">	
<div class="view_all_dt">	
<div class="view_img_left">	
<div class="view__img">	
	<img src="<?=base_url();?>assets/images/courses/add_img.jpg" alt="">
</div>
</div>
<div class="view_img_right">	
<h4>Cover Image</h4>
<!--<p>Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>-->
<div class="upload__input">
	<div class="ui search focus mt-30 lbel25">
							<label>Select image</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="file" placeholder="Mobile Number" name="image" data-purpose="edit-course-title" maxlength="60" id="image" value="">									
							</div>
						</div>
</div>
</div>
</div>
<div class="view_all_dt">	
<div class="view_img_left">	
<div class="view__img">	
	<img src="<?=base_url();?>assets/images/courses/add_video.jpg" alt="">
</div>
</div>
<div class="view_img_right">	
<h4>Promotional Video</h4>
<!--<p>Students who watch a well-made promo video are 5X more likely to enroll in your course. We've seen that statistic go up to 10X for exceptionally awesome videos. Learn how to make yours awesome!</p>-->
<div class="upload__input">
	<div class="ui search focus mt-30 lbel25">
		<label>Select video</label>
		<div class="ui left icon input swdh19">
			<input class="prompt srch_explore" type="file" placeholder="Insert youtube video embeded url." name="video" id="video" value="">										
		</div>
	</div><br>
		<div class="text-center"><h3>OR</h3></div>
	  	<div class="ui search focus mt-30 lbel25">
                <label>Youtube embeded link</label>
                <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Insert youtube video embeded url." name="yurl" data-purpose="edit-course-title" maxlength="60" id="yurl" value="">				              
                </div>
              </div>
</div>
</div>
</div>
</div>
<br>
<div class="col-md-12"><br>

</div>
<div class="col-md-12"><br>
	<div id="msg"></div>
</div>
   <div class="text-right">
   	<br><br><br><br>
              <button data-direction="next" class="btn btn-default steps_btn" id="publish">Publish</button>  
            </div>
</div>
</div>        												
</div>
</div>

</div>
</div>

</div>
</div>
</div>
</div>
<script type="text/javascript">
	 $("#category").change(function(){
		var cat=$(this).val();
		
		if(cat=="new"){
			//console.log(cat);
			$('#cdata').css({"display":"block !important"});
		}
		else{
			$('#cdata').css({"display":"none !important"});
		}
	});
		$('#publish').click(function() {
		 var formData = new FormData();
		 var desc=tinyMCE.editors[$('#desc').attr('id')].getContent();
    
    var title=$('#title').val();
    image=$('input[name="image"]').get(0).files[0];
    video=$('input[name="video"]').get(0).files[0];
    var category=$('#category').val();
     var yurl=$('#yurl').val();
    formData.append('image', image);
    formData.append('video', video);
    formData.append('desc', desc);
    formData.append('yurl', yurl);
    formData.append('title', title);
    formData.append('category', category);
    $.ajax({
        url: "<?= base_url()?>admin/course/addcourse",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
       	dataType: 'json',
        success:function(data)
        {
        	if(data.code=="404"){
        		$('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
        	}
        	else{
        		swal("Course created successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.href="<?=base_url();?>admin/course"
	          	}, 2000);
	        }
        }
	});
})
</script>