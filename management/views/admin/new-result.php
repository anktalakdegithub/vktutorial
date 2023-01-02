<div class="sa4d25">
	<div class="container">			
		<div class="row">
			<div class="col-md-8 col-6">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>New result</h2><br>
			</div>				
		</div>	
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">

             <div class="ui search focus mt-30 lbel25">
              <label>Name</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Name" name="name" id="name" value="">                  
              </div>
            </div>

             <div class="ui search focus mt-30 lbel25">
              <label>Designation</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Designation" name="design" id="design" value="">                  
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
            <label>Select category</label>
            <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="category">
              <option value="">Select Category</option>
              <?php 
                foreach($categories as $cat){
                  ?>
                  <option value="<?=$cat->Id;?>"><?=$cat->Title;?></option>
                  <?php
                }
              ?>                
            </select>
          </div>
					   <div class="ui search focus mt-30 lbel25">
              <label>Select images</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" placeholder="Mobile Number" name="images" data-purpose="edit-course-title" id="images" value="">                  
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
    var category=$('#category').val();
    formData.append('category', category);
    var name=$('#name').val();
    formData.append('name', name);
    var design=$('#design').val();
    formData.append('design', design);
    $.ajax({
        url: "<?= base_url()?>admin/result/upload",
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
            swal("Result uploaded successfully!", "", "success");
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