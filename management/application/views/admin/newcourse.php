<style type="text/css">
	.csteps{
		width: 33%;
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
			width: 33%;
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
		background: #1bd0dd;
		border-color: #1bd0dd;
		 height: 60px;
		 border-radius: 0;
		 margin-left: 0px;
		 margin-right: 0px;
	}
	.steps:hover{
		background-color: #1bd0dd;
	}
	.steps:disabled{
		background-color: #1bd0dd;
		border-color: #1bd0dd;
	}
	#step1:disabled{
		background-color: #05838c;
		border-color: #1bd0dd;
	}
	#step1{
		background-color: #1bd0dd;
	}
</style>
<div class="sa4d25">
	<div class="container" id="loadcontent" style="padding-bottom: 100px;">	
	<script type="text/javascript">
		$(document).ready(function() {
		  tinymce.init({
		    selector: ".desc",
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
		<div class="row">
			<div class="col-lg-12">	
				<h2 class="st_title"><i class="uil uil-analysis"></i> Create New Course</h2>
			</div>					
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="course__form">
					<div class="general_info10">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="ui search focus mt-30 lbel25">
									<label>Course Title*</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Insert your course title." name="title" id="title" value="">
									</div>
								</div>									
							</div>
			<!-- <div class="col-lg-12 col-md-12">
				<div class="ui search focus mt-30 lbel25">
					<label>Course Subtitle</label>
					<div class="ui left icon input swdh19">
						<input class="prompt srch_explore" type="text" placeholder="Insert your course subtitle." name="subtitle" id="subtitle">	
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
													<textarea rows="5" class="desc" name="description" id="desc" placeholder="Insert your course description"></textarea>
												</div>
											</div>										
										</div>
									</div>
								</div>
							</div> -->
							<div class="col-lg-12 col-md-12">
								<div class="ui search focus mt-30 lbel25">
									<label>Select category</label>
									<select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="category">
									<?php 
										foreach($categories as $cat){
											?>
											<option value="<?=$cat->CategoryId;?>"><?=$cat->CategoryName;?></option>
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

							
				<!-- <div class="ui search focus mt-30 lbel25">
					<label>Select faculty</label>
					<select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="faculty">
					<?php 
						foreach($faculties as $faculty){
							?>
							<option value="<?=$faculty->Id;?>"><?=$faculty->FirstName.' '.$faculty->LastName;?></option>
							<?php
						}
					?>							
					</select>
				</div>
				<div class="view_all_dt">	
							<h4>Preview Video</h4>
							<!--<p>Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>--
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
							<!--<p>Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>--
							<div class="upload__input">
								<div class="ui search focus mt-30 lbel25">
														<label>Select image</label>
														<div class="ui left icon input swdh19">
															<input class="prompt srch_explore" type="file" placeholder="Video Thumbail" name="video_thumbnail" id="video_thumbnail" value="">									
														</div>
													</div>
							</div>
							</div> -->
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
				</div><br>
				<button type="button" class="next steps_btn" id="addcourse" value="0">Create course</button>
			</div>
		</div>
	</div>
	<div class="stepscontainer row">
		<div class="csteps col-lg-4">
			<button class="steps btn btn-primary" disabled id="step1">Add Information</button>
		</div>
		<div class="csteps col-lg-4">
			<button class="steps btn btn-primary" disabled id="step2">Add Curriculum</button>
		</div>
		<div class="csteps col-lg-4">
			<button class="steps btn btn-primary" disabled id="step3">Add Price</button>
		</div>
		<div class="csteps col-lg-3 d-none">
			<button class="steps btn btn-primary" disabled id="step4" data-toggle="modal" data-target="#publishcourseModal">Publish</button>
		</div>
	</div>
</div>
<div class="modal" data-keyboard="false" data-backdrop="static" id="publishcourseModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h5 class="modal-title" id="publishcourseModal">Are you sure you want to publish this course?</h5><br>
                    <div id="vmsg"></div>
                <button class="publishcourse btn steps_btn" id="publishcourse">Yes</button>
                <button class="btn btn-default" data-dismiss="modal">No</button>
              </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	$(document).ready(function(){
	    $("#addcourse").click(function(){
	    	 $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait course information saving....</div>');
	    	 var formData = new FormData();
		 //	var desc=tinyMCE.editors[$('#desc').attr('id')].getContent();
		 	var id=$(this).val();
		//    var video_thumbnail=$('input[name="video_thumbnail"]').get(0).files;
	   // var video=$('input[name="video"]').get(0).files;
	    var background_image=$('input[name="background_image"]').get(0).files;
	   // formData.append('video_thumbnail', video_thumbnail[0]);
	   // formData.append('video', video[0]);
	    formData.append('background_image', background_image[0]);
	  //  formData.append('faculty', $('#faculty').val());
	    var title=$('#title').val();
	   // var subtitle=$('#subtitle').val();
	    var category=$('#category').val();
	  //  formData.append('desc', desc);
	    formData.append('title', title);
	   // formData.append('subtitle', subtitle);
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
		        		$('.steps').attr("disabled",false);
		        		var cid=data.id;
		        		$('#step1').val(cid);
		        		$('#step2').val(cid);
		        		$('#step3').val(cid);
		        		$('#step4').val(cid);
		        		window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/"+cid);
		        		$('#loadcontent').load("<?=base_url();?>admin/course/information/"+cid);
			        }
		        }
			});
			/*$('#addcourse').val(10);
			window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/information/10");
    		$('.steps').attr("disabled",false);
    		$('.steps').css("background","#1bd0dd");
	    	$('#step1').css("background","#9e0f0c");
    		var cid=9;//data.id;
    		console.log(cid);
    		$('#step1').val(cid);
    		$('#step2').val(cid);
    		$('#step3').val(cid);
    		$('#step4').val(cid);
    		$('#publishcourse').val(cid);
    		window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/information/"+cid);
    		$('#loadcontent').load("<?=base_url();?>admin/course/information/"+cid);**/

		});
		$('#step1').click(function(){
			var cid=$(this).val();
	    	$('.steps').css("background","#1bd0dd");
	    	$('#step1').css("background","rgb(0 155 166)");
	    	window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/information/"+cid);
	   		$('#loadcontent').load("<?=base_url();?>admin/course/information/"+cid);
	    });
	    $('#step2').click(function(){
	    	var cid=$(this).val();
	    	$('.steps').css("background","#1bd0dd");
	    	$('#step2').css("background","rgb(0 155 166)");
	    	window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/"+cid);
	   		$('#loadcontent').load("<?=base_url();?>admin/course/curriculum/"+cid);
	    });
	    $('#step3').click(function(){
	    	var cid=$(this).val();
	    	$('.steps').css("background","#1bd0dd");
	    	$('#step3').css("background","rgb(0 155 166)");
	    	window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/price/"+cid);
	   		$('#loadcontent').load("<?=base_url();?>admin/course/price/"+cid);
	    });
	    $('#step4').click(function(){
	    	var cid=$(this).val();
	    	$('.steps').css("background","#1bd0dd");
	    	$('#step4').css("background","rgb(0 155 166)");
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
		$('.steps').css("background","#1bd0dd");
    	$('#step1').css("background","rgb(0 155 166)");
		console.log(cid);
		$('#step1').val(cid);
		$('#step2').val(cid);
		$('#step3').val(cid);
		$('#step4').val(cid);
		$('#publishcourse').val(cid);
		$('#loadcontent').load("<?=base_url();?>admin/course/information/"+cid);
	}
	else if(url.indexOf("curriculum")>-1){
		if(url.indexOf("topic_lecture")>-1){
			var urlsplit = url.split("/");
		tid=urlsplit[urlsplit.indexOf("topic_lecture")+1].replace('#','');
		console.log(tid);
		$.ajax({
		        url: "<?= base_url()?>admin/course/fetchtopic",
		        data: {tid:tid},
		        type: "post",
		        dataType: "json",
		        success:function(data)
		        {
		        	console.log(data);
		        	if(data.length>0){
		        		$('.steps').attr("disabled",false);
						$('.steps').css("background","#1bd0dd");
				    	$('#step2').css("background","rgb(0 155 166)");
						//console.log(data[0].CourseId);
						$('#step1').val(data[0].CourseId);
						$('#step2').val(data[0].CourseId);
						$('#step3').val(data[0].CourseId);
						$('#step4').val(data[0].CourseId);
						$('#publishcourse').val(data[0].CourseId);
						$('#loadcontent').load("<?=base_url();?>admin/course/topic_lecture/"+tid);
		        	}
		        	else{
		        		//location.href="<?=base_url();?>admin/course/coursedetail";
		        	}
		        }
		});
	}
	else if(url.indexOf("editsection")>-1){
			var urlsplit = url.split("/");
		sid=urlsplit[urlsplit.indexOf("editsection")+1].replace('#','');
		//console.log(tid);
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
						$('.steps').css("background","#1bd0dd");
				    	$('#step2').css("background","rgb(0 155 166)");
						//console.log(data[0].CourseId);
						$('#step1').val(data[0].CourseId);
						$('#step2').val(data[0].CourseId);
						$('#step3').val(data[0].CourseId);
						$('#step4').val(data[0].CourseId);
						$('#publishcourse').val(data[0].CourseId);
						$('#loadcontent').load("<?=base_url();?>admin/course/editsection/"+sid);
		        	}
		        	else{
		        		//location.href="<?=base_url();?>admin/course/coursedetail";
		        	}
		        }
		});
	}
	else if(url.indexOf("newsection")>-1){
		var urlsplit = url.split("/");
		cid=urlsplit[urlsplit.length-1];
		$('.steps').attr("disabled",false);
		$('.steps').css("background","#1bd0dd");
    	$('#step2').css("background","rgb(0 155 166)");
		console.log(cid);
		$('#step1').val(cid);
		$('#step2').val(cid);
		$('#step3').val(cid);
		$('#step4').val(cid);
		$('#publishcourse').val(cid);
		$('#loadcontent').load("<?=base_url();?>admin/course/newsection/"+cid);
	}
	else if(url.indexOf("edittopic")>-1){
			var urlsplit = url.split("/");
		tid=urlsplit[urlsplit.indexOf("edittopic")+1].replace('#','');
		$.ajax({
		        url: "<?= base_url()?>admin/course/topic",
		        data: {tid:tid},
		        type: "post",
		        dataType: "json",
		        success:function(data)
		        {
		        	console.log(data);
		        	if(data.length>0){
		        		$('.steps').attr("disabled",false);
						$('.steps').css("background","#1bd0dd");
				    	$('#step2').css("background","rgb(0 155 166)");
						//console.log(data[0].CourseId);
						$('#step1').val(data[0].CourseId);
						$('#step2').val(data[0].CourseId);
						$('#step3').val(data[0].CourseId);
						$('#step4').val(data[0].CourseId);
						$('#publishcourse').val(data[0].CourseId);
						$('#loadcontent').load("<?=base_url();?>admin/course/edittopic/"+tid);
		        	}
		        	else{
		        		//location.href="<?=base_url();?>admin/course/coursedetail";
		        	}
		        }
		});
	}
	else if(url.indexOf("newtopic")>-1){
		var urlsplit = url.split("/");
		sid=urlsplit[urlsplit.indexOf("newtopic")+1].replace('#','');
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
						$('.steps').css("background","#1bd0dd");
				    	$('#step2').css("background","rgb(0 155 166)");
						//console.log(data[0].CourseId);
						$('#step1').val(data[0].CourseId);
						$('#step2').val(data[0].CourseId);
						$('#step3').val(data[0].CourseId);
						$('#step4').val(data[0].CourseId);
						$('#publishcourse').val(data[0].CourseId);
						$('#loadcontent').load("<?=base_url();?>admin/course/new_section_topic/"+sid);
		        	}
		        	else{
		        		//location.href="<?=base_url();?>admin/course/coursedetail";
		        	}
		        }
		});
	}
	else{
			var urlsplit = url.split("/");
			cid=urlsplit[urlsplit.length-1];
			$('.steps').attr("disabled",false);
			$('.steps').css("background","#1bd0dd");
	    	$('#step2').css("background","rgb(0 155 166)");
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
		$('.steps').css("background","#1bd0dd");
    	$('#step3').css("background","rgb(0 155 166)");
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
		$('.steps').css("background","#1bd0dd");
    	$('#step4').css("background","rgb(0 155 166)");
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
                    location.href="<?=base_url();?>admin/course";
                }, 2000); 
            }
        });
    });
</script>