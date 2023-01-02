<div class="title-icon">
	 <a href="<?=base_url();?>admin/course/coursedetail/curriculum/<?=$section[0]->CourseId;?>" class="title" style="display: inline-block;"><i class="fas fa-arrow-left"></i></a>&nbsp;&nbsp;<h3 class="title" style="display: inline-block;"><i class="uil uil-film"></i>Edit Section</h3>
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
								<input class="prompt srch_explore" type="text" placeholder="Insert your course content title." name="stitle" data-purpose="edit-course-title" id="stitle" value="<?=$section[0]->Title;?>">
							</div>
						</div>	
						<div class="ui search focus mt-30 lbel25">
							<label>Course section thumbnail*</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="file" name="sthumbnail" data-purpose="edit-course-title" id="sthumbnail" value="">
								<input class="prompt srch_explore" type="hidden" name="ethumbnail" data-purpose="edit-course-title" id="ethumbnail" value="<?=$section[0]->Thumbnail;?>">
							</div>
						</div>										
						<div class="ui search focus mt-30 lbel25">
							<label>Videos Price</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="" name="videos_price" data-purpose="edit-course-title" id="videos_price" value="<?=$section[0]->VideosPrice;?>">
							</div>
						</div>												
						<div class="ui search focus mt-30 lbel25">
							<label>Tests Price</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="" name="tests_price" data-purpose="edit-course-title" id="tests_price" value="<?=$section[0]->TestsPrice;?>">
							</div>
						</div>												
						<div class="ui search focus mt-30 lbel25">
							<label>Ppts Price</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="" name="ppts_price" data-purpose="edit-course-title" id="ppts_price" value="<?=$section[0]->PptsPrice;?>">
							</div>
						</div>												
						<div class="ui search focus mt-30 lbel25">
							<label>Ppts Price</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="" name="ppts_price" data-purpose="edit-course-title" id="overall_price" value="<?=$section[0]->Price;?>">
							</div>
						</div>											
					</div>
					<div class="col-lg-12">	
						<div id="smsg"></div>
						<br>
					<div class="col-lg-2 col-md-12">
						
						<button class="btn steps_btn" type="button" id="updatesection" value="<?=$section[0]->Id;?>">Update section</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#updatesection').click(function() {
		 $('#smsg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait section updating....</div>');
		var formData = new FormData();
	    var stitle=$('#stitle').val();
	     var ethumbnail=$('#ethumbnail').val();
	    var thumbnail=$('input[name="sthumbnail"]').get(0).files;
	    formData.append('title',stitle);
	    formData.append('ethumbnail',ethumbnail);
	    formData.append('thumbnail',thumbnail[0]);
	     var videos_price=$('#videos_price').val();
	    var ppts_price=$('#ppts_price').val();
	    var tests_price=$('#tests_price').val();
	    var overall_price=$('#overall_price').val();
	    formData.append('videos_price',videos_price);
	    formData.append('ppts_price',ppts_price);
	    formData.append('tests_price',tests_price);
	    formData.append('overall_price',overall_price);
	    var sid='<?=$section[0]->Id;?>';
	    var cid='<?=$section[0]->CourseId;?>';
	    formData.append('sid',sid);
	   	$.ajax({
	        url: "<?= base_url()?>admin/course/updatesection",
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