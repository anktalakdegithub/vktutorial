<style type="text/css">
	.csteps{
		width: 20.5%;
		padding: 0px;
	}
	.stepscontainer
	{
		bottom: 0px;
		position: fixed;
		width: 85%;
	}

	@media (max-width: 992px) {
		.csteps{
			width: 25%;
			padding: 0px;
		}
		.stepscontainer
		{
			bottom: 0px;
			position: fixed;
			width: 100%;
		}
	}
	.steps{
		width: 100%;
		background: #ea524f;
		border-color: #ee2a26;
		 height: 60px;
		 border-radius: 0;
		 margin-left: 0px;
		 margin-right: 0px;
	}
	.steps:hover{
		background-color: #9e0f0c;
	}
	.steps:disabled{
		background-color: #06B87C;
		border-color: #06B87C;
	}
	#step1:disabled{
		background-color: #01895b;
		border-color: #01895b;
	}
	#step1{
		background-color: #06B87C;
	}
</style>
<div class="sa4d25">
	<div class="container" id="loadcontent" style="padding-bottom: 100px;">	
	<script type="text/javascript">
	$(document).ready(function() {
	    tinymce.init({
		    selector: "#ucdesc",
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
<div class="title-icon">
	<h3 class="title"><i class="uil uil-info-circle"></i>Information</h3>
</div>	
<div class="course__form">
	<div class="general_info10">
		<div class="row">
			<div class="col-lg-12 col-md-12">													
				<div class="ui search focus mt-30 lbel25">
					<label>Course Title*</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" placeholder="Insert your course title." name="title" id="title" value="<?=$course[0]->Title;?>">	
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
									<textarea rows="5" class="ucdesc" name="description" id="ucdesc" placeholder="Insert your course description"><?=$course[0]->Description;?></textarea>
								</div>
							</div>										
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12">
				<div class="course_des_textarea mt-30 lbel25">
					<label>Batch details</label>
					<div class="course_des_bg">
						<div class="textarea_dt">
							<div class="ui form swdh339">
								<div class="field">
									<textarea rows="5" class="ucbdetails" name="description" id="ucbdetails"><?=$course[0]->Batch_details;?></textarea>
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
						foreach($categories['categories'] as $cat){
							?>
							<option value="<?=$cat->Id;?>" <?php if($cat->Id==$course[0]->Category_id){ echo "selected"; } ?>><?=$cat->Name;?></option>
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
															<input class="prompt srch_explore" type="file" placeholder="Mobile Number" name="image" id="image" value="">									
														</div>
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
	</div>
	<div class="stepscontainer row">
		<div class="csteps col-lg-3">
			<button class="steps btn btn-primary" id="step1" value="<?=$course[0]->Id;?>">Add Information</button>
		</div>
		<div class="csteps col-lg-3">
			<button class="steps btn btn-primary" id="step2" value="<?=$course[0]->Id;?>">Add Curriculum</button>
		</div>
		<div class="csteps col-lg-3">
			<button class="steps btn btn-primary" id="step3" value="<?=$course[0]->Id;?>">Add Price</button>
		</div>
		<div class="csteps col-lg-3">
			<button class="steps btn btn-primary" id="step4" data-toggle="modal" data-target="#publishcourseModal">Publish</button>
		</div>
	</div>
</div>
<div class="modal" data-keyboard="false" data-backdrop="static" id="publishcourseModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="modal-title" id="publishcourseModal">Are you sure you want to publish this course?</h5><br>
                    <div id="vmsg"></div>
                <button class="publishcourse btn steps_btn" id="publishcourse" value="<?=$course[0]->Id;?>">Yes</button>
                <button class="btn btn-default" data-dismiss="modal">No</button>
              </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	$("#updatecourse").click(function(){
	 	var formData = new FormData();
		var desc=tinyMCE.editors[$('#ucdesc').attr('id')].getContent();
	    var id=$(this).val();
	     var thumbnail=$('input[name="image"]').get(0).files;
		    formData.append('image', thumbnail[0]);
		    formData.append('ucbdetails',$('#ucbdetails').val());
	    var title=$('#title').val();
	    var category=$('#category').val();
	    formData.append('desc', desc);
	    formData.append('title', title);
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
	        		$('#msg').html('Data updated successfully');
		        }
	        }
		});
	});
	$(document).ready(function(){
	    $("#addcourse").click(function(){
	 		var formData = new FormData();
		 	var desc=tinyMCE.editors[$('#desc').attr('id')].getContent();
		 	 var thumbnail=$('input[name="image"]').get(0).files;
		    var id=$(this).val();
		    var title=$('#title').val();
		    var category=$('#category').val();
		    formData.append('desc', desc);
		    formData.append('image', thumbnail);
		    formData.append('title', title);
		    formData.append('category', category);
		    formData.append('cid',id);
		    /*$.ajax({
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
		        		$('.steps').attr("disabled",false);
		        		var cid=data.id;
		        		$('#step1').val(cid);
		        		$('#step2').val(cid);
		        		$('#step3').val(cid);
		        		$('#step4').val(cid);
		        		window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/information/"+cid);
		        		$('#loadcontent').load("<?=base_url();?>admin/course/information/"+cid);
			        }
		        }
			});*/
			$('#addcourse').val(10);
			window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/information/10");
    		$('.steps').attr("disabled",false);
    		$('.steps').css("background","#ea524f");
	    	$('#step1').css("background","#9e0f0c");
    		var cid=9;//data.id;
    		console.log(cid);
    		$('#step1').val(cid);
    		$('#step2').val(cid);
    		$('#step3').val(cid);
    		$('#step4').val(cid);
    		$('#publishcourse').val(cid);
    		window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/information/"+cid);
    		$('#loadcontent').load("<?=base_url();?>admin/course/information/"+cid);

		});
		$('#step1').click(function(){
			var cid=$(this).val();
	    	$('.steps').css("background","#ea524f");
	    	$('#step1').css("background","#9e0f0c");
	    	window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/information/"+cid);
	   		$('#loadcontent').load("<?=base_url();?>admin/course/information/"+cid);
	    });
	    $('#step2').click(function(){
	    	var cid=$(this).val();
	    	$('.steps').css("background","#ea524f");
	    	$('#step2').css("background","#9e0f0c");
	    	window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/"+cid);
	   		$('#loadcontent').load("<?=base_url();?>admin/course/curriculum/"+cid);
	    });
	    $('#step3').click(function(){
	    	var cid=$(this).val();
	    	$('.steps').css("background","#ea524f");
	    	$('#step3').css("background","#9e0f0c");
	    	window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/price/"+cid);
	   		$('#loadcontent').load("<?=base_url();?>admin/course/price/"+cid);
	    });
	    $('#step4').click(function(){
	    	var cid=$(this).val();
	    	$('.steps').css("background","#ea524f");
	    	$('#step4').css("background","#9e0f0c");
	    	window.history.replaceState(null, null,"<?=base_url();?>admin/coursedetail/publish/"+cid);
	   		$('#loadcontent').load("<?=base_url();?>admin/course/publish/"+cid);
	    });
	});
	var activeTab='';
	var url = window.location.href;
	console.log(url);
	if(url.indexOf("information")>-1){
		var urlsplit = url.split("/");
		cid=urlsplit[urlsplit.length-1];
		$('.steps').attr("disabled",false);
		$('.steps').css("background","#ea524f");
    	$('#step1').css("background","#9e0f0c");
		console.log(cid);
		$('#step1').val(cid);
		$('#step2').val(cid);
		$('#step3').val(cid);
		$('#step4').val(cid);
		$('#publishcourse').val(cid);
		$('#loadcontent').load("<?=base_url();?>admin/course/information/"+cid);
	}
	else if(url.indexOf("curriculum")>-1){
		if(url.indexOf("section_lecture")>-1){
			var urlsplit = url.split("/");
		sid=urlsplit[urlsplit.indexOf("section_lecture")+1].replace('#','');
		console.log(sid);
		$.ajax({
		        url: "<?= base_url()?>admin/course/section",
		        data: {sid:sid},
		        type: "post",
		        dataType: "json",
		        success:function(data)
		        {
		        	console.log(data);
		        	if(data.length>0){
		        		$('.steps').attr("disabled",false);
						$('.steps').css("background","#ea524f");
				    	$('#step2').css("background","#9e0f0c");
						console.log(data[0].CourseId);
						$('#step1').val(data[0].CourseId);
						$('#step2').val(data[0].CourseId);
						$('#step3').val(data[0].CourseId);
						$('#step4').val(data[0].CourseId);
						$('#publishcourse').val(data[0].CourseId);
						$('#loadcontent').load("<?=base_url();?>admin/course/section_lecture/"+sid);
		        	}
		        	else{
		        		//location.href="<?=base_url();?>admin/course/coursedetail";
		        	}
		        }
		});
	}
	else if(url.indexOf("section_lecture")>-1){
		var urlsplit = url.split("/");
		cid=urlsplit[urlsplit.length-1];
		$('.steps').attr("disabled",false);
		$('.steps').css("background","#ea524f");
    	$('#step2').css("background","#06B87C");
		console.log(cid);
		$('#step1').val(cid);
		$('#step2').val(cid);
		$('#step3').val(cid);
		$('#step4').val(cid);
		$('#publishcourse').val(cid);
		$('#loadcontent').load("<?=base_url();?>admin/course/newsection/"+cid);
	}
	else{
			var urlsplit = url.split("/");
			cid=urlsplit[urlsplit.length-1];
			$('.steps').attr("disabled",false);
			$('.steps').css("background","#ea524f");
	    	$('#step2').css("background","#06B87C");
			console.log(cid);
			$('#step1').val(cid);
			$('#step2').val(cid);
			$('#step3').val(cid);
			$('#step4').val(cid);
			$('#publishcourse').val(cid);
			$('#loadcontent').load("<?=base_url();?>admin/course/curriculum/"+cid);
		}
	}
	else if(url.indexOf("price")>-1){
		var urlsplit = url.split("/");
		cid=urlsplit[urlsplit.length-1];
		$('.steps').attr("disabled",false);
		$('.steps').css("background","#ea524f");
    	$('#step3').css("background","#06B87C");
		console.log(cid);
		$('#step1').val(cid);
		$('#step2').val(cid);
		$('#step3').val(cid);
		$('#step4').val(cid);
		$('#publishcourse').val(cid);
		$('#loadcontent').load("<?=base_url();?>admin/course/price/"+cid);
	}
	else if(url.indexOf("publish")>-1){
		var urlsplit = url.split("/");
		cid=urlsplit[urlsplit.length-1];
		$('.steps').attr("disabled",false);
		$('.steps').css("background","#ea524f");
    	$('#step4').css("background","#06B87C");
		console.log(cid);
		$('#step1').val(cid);
		$('#step2').val(cid);
		$('#step3').val(cid);
		$('#step4').val(cid);
		$('#publishcourse').val(cid);
		$('#loadcontent').load("<?=base_url();?>admin/course/publish/"+cid);
	}
	 $('body').on('click', '#publishcourse', function(){ 
        var cid=$(this).val();
        $.ajax({
            url: "<?= base_url()?>admin/course/publishcourse",
            data: {cid:cid},
            type: "post",
            success: function(data){
            	$("#publishcourseModal").modal('hide');
                swal("Course published successfully!", "", "success");
                setTimeout(function () {
                    swal.close();
                    $('#loadcontent').load('<?=base_url();?>course/coursedetails/information/'+cid);
                }, 2000); 
            }
        });
    });
</script>