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
				<h2 class="st_title"><i class="uil uil-analysis"></i> Create New PPT</h2>
			</div>					
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="course__form">
					<div class="general_info10">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="ui search focus mt-30 lbel25">
									<label>PPT Title*</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Insert your ppt title." name="title" id="title" value="">
									</div>
								</div>									
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="ppt_des_textarea mt-30 lbel25">
									<label>PPT Description*</label>
									<div class="ppt_des_bg">
										<div class="textarea_dt">
											<div class="ui form swdh339">
												<div class="field">
													<textarea rows="5" class="desc" name="description" id="desc" placeholder="Insert your ppt description"></textarea>
												</div>
											</div>										
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="ui search focus mt-30 lbel25">
									<label>Upload PPT</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="file" placeholder="Mobile Number" name="ppt" id="ppt" value="">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Select Thumbnail</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="file" placeholder="Mobile Number" name="image" id="image" value="">									
									</div>
								</div>
							</div> 

						<div class="col-lg-12">	
							<div class="ui search focus mt-30 lbel25">
								<label style="font-size: 14px;font-weight: 500;font-family: 'Roboto', sans-serif;margin-bottom: 10px !important;color: #333; text-align: left;display: block;">Payment Type*</label>
								<div class="form-check">
								  <label class="form-check-label">
								    <input type="radio" class="form-check-input" name="pdetail" value="0" >Free
								  </label>
								</div><br>
								<div class="form-check">
								  <label class="form-check-label">
								    <input type="radio" class="form-check-input" name="pdetail" value="1" checked>Subscription
								  </label>
								</div>	
							</div>		
						</div>
						<div class="col-lg-12 col-md-12" id="pricedetails">												
										<div class="ui search focus mt-30 lbel25">
											<label>Price in &#8377; </label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="number"  name="price" data-purpose="edit-course-title" id="price" value="0">
											</div>
										</div>									
									</div>	
							<div class="col-md-8">
							    <div id="msg"></div>
							</div>											
						</div>
					</div>
				</div><br>
				<button type="button" class="next steps_btn" id="addppt" value="0">Create PPT</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('input[type=radio]').change(function(){
	  	if($(this).val()=="1"){
	  		$('#pricedetails').css({'display':'block'});
	  	}
	  	else{
	  		$('#pricedetails').css({'display':'none'});
	  	}
	});
	$(document).ready(function(){
	    $("#addppt").click(function(){
	    	 $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait ppt information saving....</div>');
	    	 var formData = new FormData();
		 	var desc=tinyMCE.editors[$('#desc').attr('id')].getContent();
		 	 var thumbnail=$('input[name="image"]').get(0).files[0];
		 	 var ppt=$('input[name="ppt"]').get(0).files[0];
		    var id=$(this).val();
		    var title=$('#title').val();
		    var ptype=$("input[name='pdetail']:checked"). val();
	    var price=$('#price').val();
		    formData.append('desc', desc);
		    formData.append('image', thumbnail);
		    formData.append('ppt', ppt);
		    formData.append('title', title);
		    formData.append('ptype',ptype);
		    formData.append('price',price);
		    $.ajax({
		        url: "<?= base_url()?>admin/ppt/addppt",
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
		        		$('#msg').html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>');
			        }
		        }
			});
		});
	});
</script>