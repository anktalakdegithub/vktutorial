<div class="sa4d25">
	<div class="container">			
		<div class="row">
			<div class="col-md-8 col-6">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>Study Materials</h2><br>
			</div>		
			<div class="col-md-4 col-6">
				<button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#categoryModel">New category</button>	
				<button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#studyModel">Upload study material</button>	
			</div>			
		</div>	

	  <div class="row">
            <div class="col-md-12 order-12 order-md-1">
          <div class="card">
            <div class="card-body">
    <div id="load_data">
      
    </div>
            <div id="load_data_message"></div>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            </div>
          </div>
        </div>
      </div>
<script type="text/javascript">
   $('body').on('change', '.epdetail input[type=radio]', function(){ 
    var id=this.id;
    if($(this).val()=="1"){
      $('#pricedetails_'+id).css({'display':'block'});
    }
    else{
      $('#pricedetails_'+id).css({'display':'none'});
    }
});
	$(document).ready(function(){

    var limit = 15;
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit)
    {
      $.ajax({
        url:"<?=base_url();?>admin/studymaterial/fetchstudymaterials",
        method:"POST",
        data:{limit:limit},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"> </div> <div class="col-md-4 text-center"><p>not found!!</p> </div> <div class="col-md-4"></div></div></div>');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        setTimeout(function(){
          load_data(limit);
        }, 1000);
      }
    });

  });
</script>
			 <div class="modal" id="studyModel">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>New study material</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              	<div class="ui search focus lbel25">
									<label>Title</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Enter title" id="title" data-purpose="edit-course-title" maxlength="60">									
									</div>
								</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Select category</label>
							<select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="category">
								<?php 
									foreach($categories as $cat){
										?>
										<option value="<?=$cat->Id;?>"><?=$cat->Name;?></option>
										<?php
									}
								?>								
							</select>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Select document</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="file" placeholder="Mobile Number" name="document" data-purpose="edit-course-title" maxlength="60" id="document" value="">									
							</div>
						</div>	
               <div class="col-lg-12 mt-30"> 
                          <label>Payment Type*</label>
                        <div class="form-check">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="pdetail" value="0" checked>Free
  </label>
</div><br>
<div class="form-check">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="pdetail" value="1">Paid
  </label>
</div><br>      
                      </div>
                      <div class="col-lg-12 col-md-12" id="pricedetails" style="display: none;">                        
                              <div class="ui search focus mt-30 lbel25">
                                <label>Price*</label>
                                <div class="ui left icon input swdh19">
                                  <input class="prompt srch_explore" type="number"  name="price" data-purpose="edit-course-title" id="price" value="0">
                                </div>
                              </div>                  
                            </div>
         
						<br>
						<div id="msg"></div>
						<button data-direction="next" class="btn btn-default steps_btn" id="upload">upload</button>	
			
					</div>
				</div>
			</div>
		</div>
	</div>
		 <div class="modal" id="categoryModel">
                          <div class="modal-dialog">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>New category</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                              	<div class="ui search focus lbel25">
									<label>Name</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Enter title" id="cname" data-purpose="edit-course-title" maxlength="60">									
									</div>
								</div>
							
						<br>
						<div id="msg"></div>
						<button data-direction="next" class="btn btn-default steps_btn" id="add">Add</button>	
			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	  $('#studyModel input[type=radio]').change(function(){
    if($(this).val()=="1"){
      $('#pricedetails').css({'display':'block'});
    }
    else{
      $('#pricedetails').css({'display':'none'});
    }
});
$('body').on('click', '#upload', function(){ 
    var formData = new FormData();
    var title=$('#title').val();
    file=$('input[name="document"]').get(0).files[0];
    var category=$('#category').val();
    formData.append('file', file);
    formData.append('title', title);
    formData.append('category', category);
      var ptype=$("input[name='pdetail']:checked"). val();
      formData.append('ptype',ptype);
      var price=$('#price').val();
      formData.append('price',price);
   //   $(this).attr("disabled", true);
   $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait study material uploading....</div>');
    $.ajax({
        url: "<?= base_url()?>admin/studymaterial/uploadstudymaterial",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        dataType: 'json',
        success:function(data)
        {
           // $(this).attr("disabled", false);
          if(data.code=="404"){
            $('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("Study material uploaded successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
        }
  });
})
  $('body').on('click', '.update', function(){ 
    var id=$(this).val();
		 var formData = new FormData();
    var title=$('#title_'+id).val();
    file=$('input[name="document_'+id+'"]').get(0).files[0];
    var category=$('#category_'+id).val();
    formData.append('file', file);
    formData.append('title', title);
    formData.append('category', category);
      var ptype=$("input[name='pdetail_"+id+"']:checked"). val();
      formData.append('ptype',ptype);
      var price=$('#price_'+id).val();
      formData.append('price',price);
      formData.append('id',id);
   //   $(this).attr("disabled", true);
   $('#msg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait study material uploading....</div>');
    $.ajax({
        url: "<?= base_url()?>admin/studymaterial/updatestudymaterial",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
       	dataType: 'json',
        success:function(data)
        {
           // $(this).attr("disabled", false);
        	if(data.code=="404"){
        		$('#msg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
        	}
        	else{
        		swal("Study material uploaded successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	//location.reload();
	          	}, 2000);
	        }
        }
	});
})
	$('#add').click(function() {
		 var formData = new FormData();
    var cname=$('#cname').val();
    formData.append('cname',cname);
   	$.ajax({
        url: "<?= base_url()?>admin/category/addcategory",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
       	dataType: 'json',
        success:function(data)
        {
          
        	if(data.code=="404"){
        		$('#cmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
        	}
        	else{
        		swal("Categroy added successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.reload();
	          	}, 2000);
	        }
        }
	});
	//console.log(cname);
});
       $('body').on('click', '.delete', function(){ 
                 $(this).attr("disabled", true);
   var formData = new FormData();
   var id=$(this).val();
    formData.append('id', id);
    $.ajax({
        url: "<?= base_url()?>admin/studymaterial/deletestudymaterial",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
           swal("Study material deleted successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
                     $(this).attr("disabled", false);
              location.reload();
                }, 2000);
         
    }
    });
  
});
</script>