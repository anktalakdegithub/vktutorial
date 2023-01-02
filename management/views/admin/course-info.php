<script type="text/javascript">
	$(document).ready(function() {
	    tinymce.init({
		    selector: ".desc",
		    theme: "modern",
		    paste_data_images: true,
		    menubar: 'edit insert format table tools',
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
			    input.setAttribute('accept', 'image/');
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
		    }],
		    height : 400
	  	});
 	});
</script>
<div class="title-icon">
	<h3 class="title"><i class="uil uil-info-circle"></i>Information</h3>
</div>	
<div class="course__form">
	<div class="general_info10">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="ui search focus mt-30 lbel25">
					<label>Course Title</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" placeholder="Insert your course title." name="title" id="title" value="<?=$course[0]->Title;?>">	
					</div>
				</div>									
			</div>
			<div class="col-lg-12 col-md-12">
				<div class="ui search focus mt-30 lbel25">
					<label>Course Subtitle</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" placeholder="Insert your course subtitle." name="subtitle" id="subtitle" value="<?=$course[0]->Subtitle;?>">	
					</div>
				</div>									
			</div>
			<div class="col-lg-12 col-md-12">
				<div class="course_des_textarea mt-30 lbel25">
					<label>Course Description</label>
					<div class="course_des_bg">
						<div class="textarea_dt">
							<div class="ui form swdh339">
								<div class="field">
									<textarea rows="5" class="desc" name="description" id="ucdesc" placeholder="Enter course description"><?=$course[0]->Description;?></textarea>
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
							<option value="<?=$cat->CategoryId;?>" <?php if($cat->CategoryId==$course[0]->Category_id){ echo "selected"; } ?>><?=$cat->CategoryName;?></option>
							<?php
						}
					?>							
					</select>
					<style type="text/css">
						#cdata{
							display: none;
						}
					</style>
				</div>

				<div class="ui search focus mt-30 lbel25">
					<label>Select faculty</label>
					<select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="faculty">
					<?php 
						foreach($faculties as $faculty){
							?>
							<option value="<?=$faculty->Id;?>" <?php if($faculty->Id==$course[0]->Faculty_id){ echo "selected"; } ?>><?=$faculty->FirstName.' '.$faculty->LastName;?></option>
							<?php
						}
					?>							
					</select>
				</div>
				<div class="view_all_dt">	
							<h4>Preview Video</h4>
							<!--<p>Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>-->
							<div class="upload__input">
								<div class="ui search focus mt-30 lbel25">
														<label>Select Video</label>
														<div class="ui left icon input swdh19">
															<input class="prompt srch_explore" type="file" placeholder="Preview Video" name="video" id="video" value="">									
														</div>
													</div>
							</div>
							</div>
				<div class="view_all_dt">	
							<h4>Video Thumbail</h4>
							<!--<p>Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>-->
							<div class="upload__input">
								<div class="ui search focus mt-30 lbel25">
														<label>Select image</label>
														<div class="ui left icon input swdh19">
															<input class="prompt srch_explore" type="file" placeholder="Video Thumbail" name="video_thumbnail" id="video_thumbnail" value="">									
														</div>
													</div>
							</div>
							</div>
				<div class="view_all_dt">	
				<h4>Background Image</h4>
				<!--<p>Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>-->
				<div class="upload__input">
					<div class="ui search focus mt-30 lbel25">
											<label>Select image</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="file" placeholder="Background Image" name="background_image" id="background_image" value="">									
											</div>
										</div>
				</div>
				</div>
			</div> 	
			<div class="col-md-8">
			    <div id="msg"></div>
			</div>											
		</div>
	</div>
</div>
<button type="button" class="next steps_btn" id="updatecourse" value="<?=$course[0]->Id;?>">Save</button>
<script type="text/javascript">
	$("#updatecourse").click(function(){
		$('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait course information saving....</div>');
	 	var formData = new FormData();
		var desc=tinyMCE.editors[$('#ucdesc').attr('id')].getContent();
	    var id=$(this).val();
	    var video_thumbnail=$('input[name="video_thumbnail"]').get(0).files;
	    var video=$('input[name="video"]').get(0).files;
	    var background_image=$('input[name="background_image"]').get(0).files;
	    formData.append('video_thumbnail', video_thumbnail[0]);
	    formData.append('video', video[0]);
	    formData.append('background_image', background_image[0]);
	    formData.append('faculty', $('#faculty').val());
	    var title=$('#title').val();
	    var subtitle=$('#subtitle').val();
	    var category=$('#category').val();
	    formData.append('desc', desc);
	    formData.append('title', title);
	    formData.append('subtitle', subtitle);
	    formData.append('category', category);
	    formData.append('cid',id);
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
	        		$('#addcourse').val(data.id);
	        		$('#msg').html('<div class="alert alert-success"><strong>Success! </strong>Data updated successfully</div>');
		        }
	        }
		});
	});
	
</script>