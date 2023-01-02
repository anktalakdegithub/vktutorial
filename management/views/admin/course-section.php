<div class="title-icon">
	 <a href="<?=base_url();?>admin/course/coursedetail/curriculum/<?=$cid;?>" class="title" style="display: inline-block;"><i class="fas fa-arrow-left"></i></a>&nbsp;&nbsp;<h3 class="title" style="display: inline-block;"><i class="uil uil-film"></i>New Section</h3>
</div>
<div class="course__form">
	<div class="row">
		<div class="col-lg-12">
			<div class="view_info10">
				<div class="row">
					<div class="col-lg-12 col-md-12">												
						<div class="ui search focus mt-30 lbel25">
							<label>Course section Title*</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Insert your course content title." name="stitle" data-purpose="edit-course-title" id="stitle" value="">
							</div>
						</div>	
						<div class="ui search focus mt-30 lbel25">
							<label>Course section thumbnail*</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="file" name="sthumbnail" data-purpose="edit-course-title" id="sthumbnail" value="">
							</div>
						</div>												
						<div class="ui search focus mt-30 lbel25">
							<label>Videos Price</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="" name="videos_price" data-purpose="edit-course-title" id="videos_price" value="0">
							</div>
						</div>												
						<div class="ui search focus mt-30 lbel25">
							<label>Tests Price</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="" name="tests_price" data-purpose="edit-course-title" id="tests_price" value="0">
							</div>
						</div>												
						<div class="ui search focus mt-30 lbel25">
							<label>Ppts Price</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="" name="ppts_price" data-purpose="edit-course-title" id="ppts_price" value="0">
							</div>
						</div>													
						<div class="ui search focus mt-30 lbel25">
							<label>Overall Price</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="" name="overall_price" data-purpose="edit-course-title" id="overall_price" value="0">
							</div>
						</div>									
					</div>
					<br>
						<div id="smsg"></div>
						<br>
					<div class="col-lg-2 col-md-12">
						<br>
						<button class="btn steps_btn" type="button" id="addsection" value="4">Add section</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#addsection').click(function() {
		 $('#smsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait section adding....</div>');
		var formData = new FormData();
	    var stitle=$('#stitle').val();
	    var videos_price=$('#videos_price').val();
	    var ppts_price=$('#ppts_price').val();
	    var tests_price=$('#tests_price').val();
	    var overall_price=$('#overall_price').val();
	    var thumbnail=$('input[name="sthumbnail"]').get(0).files;
	    
	    formData.append('stitle',stitle);
	    formData.append('videos_price',videos_price);
	    formData.append('ppts_price',ppts_price);
	    formData.append('tests_price',tests_price);
	    formData.append('thumbnail',thumbnail[0]);
	    formData.append('overall_price', overall_price);
	    var cid='<?=$cid;?>';
	    formData.append('cid',cid);
	   	$.ajax({
	        url: "<?= base_url()?>admin/course/addsection",
	        data: formData,
	        type: "post",
	        headers: { 'IsAjax': 'true' },
	        processData: false,
	        contentType: false,
	       	dataType: 'json',
	        success:function(data)
	        {
	        	if(data.code=="404"){
	        		$('#smsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
	        	}
	        	else{
	        		$('#loadcontent').load("<?=base_url();?>admin/course/curriculum/"+cid);
		        }
	        }
		});
		//console.log(cname);
	});
</script>