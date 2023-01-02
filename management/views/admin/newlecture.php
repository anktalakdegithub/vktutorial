  <link href="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script>

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
<style type="text/css">
	.multiselect{
		border: 1px solid #e3e3e3;
		width: 500px !important;
		text-align: left !important;
	}
	.multiselect-container{
		width: 500px !important;
		height: 300px;
    overflow: auto;
	}
</style>
<div class="sa4d25">
	<div class="container-fluid">	
		<div class="row">
			<div class="col-lg-12">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>New Lecture</h2>
			</div>					
		</div>			
		<div class="course__form">
			<div class="general_info10">							
				<div class="row justify-content-md-center">
					<div class="col-12">
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture Thumbnail</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="file" placeholder="Lecture  title" name="thumbnail" data-purpose="edit-course-title" id="thumbnail">
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture Title</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Lecture  title" name="title" data-purpose="edit-course-title" id="title">
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture Description</label>
							<div class="ui left icon input swdh19">
								<textarea class="form-control" id="desc"></textarea>
							</div>
						</div>	
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture date & time</label>
							<div class="row">
								<div class="col-4">
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="date" name="title" data-purpose="edit-course-title" id="ldate">
									</div>
								</div>
								<div class="col-4">
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="time" name="title" data-purpose="edit-course-title" id="stime">
									</div>
								</div>
								<div class="col-4">
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="time" name="title" data-purpose="edit-course-title" id="etime">
									</div>
								</div>
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label> 
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="batches">
								<option value="0">Open lecture</option>
								<?php 
									foreach($batches as $batch){
										?>
										<option value="<?=$batch->Id;?>"><?=$batch->Name;?></option>
										<?php
									}
								?>									
							</select>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Select Faculty</label>
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore" multiple id="faculties">
								<?php 
									foreach($faculties as $faculty){
										?>
										<option value="<?=$faculty->Id;?>"><?=$faculty->FirstName.' '.$faculty->LastName;?></option>
										<?php
									}
								?>							
							</select>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecuture Start URL</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Lecuture Start URL" name="title" data-purpose="edit-course-title" id="starturl">									
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecuture Id</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Lecture Id" name="title" data-purpose="edit-course-title" id="lectid">									
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture Password</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Password" name="title" data-purpose="edit-course-title" id="pass">									
							</div>
						</div>	
						<br>
						<div id="msg"></div>
						<div class="text-right">
							<button data-direction="next" class="btn btn-default steps_btn" id="submit">Add</button>	
						</div>
					</div>		
				</div>
			</div>					
		</div>
	</div>
</div>
<script type="text/javascript">
	//$('#batches').selectpicker();
	 $(function () {
        $('.multiselectdrop').multiselect({
            //includeSelectAllOption: true
        });
    });
	$('#submit').click(function() {
		var title=$('#title').val();
		var desc=tinyMCE.editors[$('#desc').attr('id')].getContent();
		var lectid=$('#lectid').val();
		var pass=$('#pass').val();
		var ldate=$('#ldate').val();
		var stime=$('#stime').val();
		var etime=$('#etime').val();
		var surl=$('#starturl').val();
		var sbatches = $("#batches option:selected");
        var batches = [];
        sbatches.each(function () {
           	batches.push($(this).val());
        });
        var sfaculties = $("#faculties option:selected");
        var faculties = [];
        sfaculties.each(function () {
           	faculties.push($(this).val());
        });
          $(this).attr("disabled", true);
   $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait lecture creating....</div>');
		
	        var formData = new FormData();
    thumbnail=$('input[name="thumbnail"]').get(0).files[0];
    formData.append('thumbnail', thumbnail);
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
      url: "<?=base_url();?>admin/schedule/addlecture",
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
    		$('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
    	}
    	else{
    		swal("Lecture created successfully!", "", "success");
		    setTimeout(function () {
              	swal.close();
              	location.href="<?=base_url();?>admin/schedule";
          	}, 2000);
        }
    }
});
	})
</script>