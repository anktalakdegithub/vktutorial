<div class="sa4d25">
	<div class="container">			
		<div class="row">
			<div class="col-md-8 col-6">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>New Slider</h2><br>
			</div>				
		</div>	
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
					   <div class="ui search focus mt-30 lbel25">
              <label>Select images</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" placeholder="Mobile Number" name="images" multiple data-purpose="edit-course-title" id="images" value="">                  
              </div>
            </div>
					
			
						<div id="msg"></div>
						<button data-direction="next" class="btn btn-default steps_btn" id="upload">upload</button>	
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
<script>

  $('#upload').click(function() {
     var formData = new FormData();
       $('#upload').attr("disabled", true);
   $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait images uploading....</div>');
    images=$('input[name="images"]').get(0).files;
    var error = '';
    for(var count = 0; count<images.length; count++)
    {
     formData.append("images[]", images[count]);
    }
    $.ajax({
        url: "<?= base_url()?>admin/slider/upload",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        dataType: 'json',
        success:function(data)
        {
            $('#upload').attr("disabled", false);
          if(data.code=="404"){
            $('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("Images uploaded successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                   $('#upload').attr("disabled", false);
                  location.reload();
              }, 2000);
          }
        }
  });
})
</script>