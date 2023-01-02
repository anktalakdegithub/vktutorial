<div class="container">
	<div class="row">
		<div class="col-12">
			<h3>Change slider images:</h3><br><br><br>
			<div class="ui search focus lbel25">
              <label>Title</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" name="images" id="image" multiple>
              </div>
            </div><br><br>
			<div class="row" id="view">
			</div><br><br>
			<div id="msg"></div>
			<br>

			<button data-direction="next" class="btn btn-default steps_btn" id="upload">Upload</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("document").ready(function(){

	    $("#image").change(function() {
	        var files = this.files;
	                var i = 0;
	                           
	                for (i = 0; i < files.length; i++) {
	                    var readImg = new FileReader();
	                    var file = files[i];
	                   
	                    if (file.type.match('image.*')){
	                        readImg.onload = (function(file) {
	                            return function(e) {
	                                $('#view').append(
	                                "<div class='col-2' file = '" + file.name + "' style='list-style-type:none;'>" +                                
	                                    "<img class = 'img-thumb' src = '" + e.target.result + "' style='width:100%'/>" +
	                                "</div>"
	                                );     
	                            };
	                        })(file);
	                        readImg.readAsDataURL(file);
	                       
	                    }
	                    } 
	    });
	});
	$('#upload').click(function() {
     var formData = new FormData();
    images=$('input[name="images"]').get(0).files;
    var error = '';
    if(images.length>0){
    for(var count = 0; count<images.length; count++)
    {
     formData.append("images[]", images[count]);
    }
  $(this).attr("disabled", true);
   $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait images upoading....</div>');
    $.ajax({
        url: "<?= base_url()?>admin/setting/changesliderimages",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success:function(data)
        {
        	  $(this).attr("disabled", false);
            swal("Images uploaded successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
        }
  });
}
})
</script>