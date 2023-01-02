<div class="title-icon">
	 <a href="<?=base_url();?>admin/course/coursedetail/curriculum/<?=$section[0]->CourseId;?>" class="title" style="display: inline-block;"><i class="fas fa-arrow-left"></i></a>&nbsp;&nbsp;<h3 class="title" style="display: inline-block;"><i class="uil uil-film"></i>New Lecture Topic</h3>
</div>
<div class="course__form">
	<div class="row">
		<div class="col-lg-12">
			<div class="view_info10">
				<div class="row">
					<div class="col-lg-12 col-md-12">	
						<div class="ui search focus mt-30 lbel25">
							<label>Course Lecture Topic*</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Enter topic name." name="ttitle" data-purpose="edit-course-title" id="ttitle" value="">
							</div>
						</div>		
						<div class="ui search focus mt-30 lbel25">
							<label>Course topic thumbnail*</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="file" name="sthumbnail" data-purpose="edit-course-title" id="sthumbnail" value="">
							</div>
						</div>									
					</div>
					<div class="col-lg-2 col-md-12">
						<br>
						<div id="tmsg"></div>
						<br>
						<button class="btn steps_btn" type="button" id="addlecture">Add Topic</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#addlecture').click(function() {
		$(this).prop('disabled', true);
		var formData = new FormData();
	    var ttitle=$('#ttitle').val();
	    formData.append('ttitle',ttitle);
	    var sid='<?=$section[0]->Id;?>';
	    var cid='<?=$section[0]->CourseId;?>';
	    var thumbnail=$('input[name="sthumbnail"]').get(0).files;
	    
	    formData.append('sid',sid);
	    formData.append('cid',cid);
	    formData.append('thumbnail',thumbnail[0]);
	   	$.ajax({
	        url: "<?= base_url()?>admin/course/add_section_topic",
	        data: formData,
	        type: "post",
	        headers: { 'IsAjax': 'true' },
	        processData: false,
	        contentType: false,
	       	dataType: 'json',
	        success:function(data)
	        {
		$('#addlecture').prop('disabled', false);
	        	if(data.code=="404"){
	        		$('#tmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
	        	}
	        	else{
	        		var tid=data.tid;
window.history.replaceState(null, null,"<?=base_url();?>admin/course/coursedetail/curriculum/topic_lecture/"+tid);
	        		var url = '<?=base_url();?>admin/course/topic_lecture/'+tid;
                    $("#loadcontent").load(url);
		        }
	        }
		});
		//console.log(cname);
	});
</script>