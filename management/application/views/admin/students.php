  <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script>

<style type="text/css">
	.multiselect{
		border: 1px solid #e3e3e3;
		width: 400px !important;
		text-align: left !important;
	}
	.multiselect-container{
		width: 400px !important;
	}

</style>	
<div class="sa4d25">
	<div class="container-fluid">			
		<div class="row">
			<div class="col-md-9">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>Students</h2><br>
			</div>	
			<div class="col-md-3 col-6 text-right">
				<button data-direction="next" class="btn btn-default steps_btn" data-toggle="modal" data-target="#studentModel">New Student</button>	
				<!--<button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#importModal"><i class="fas fa-upload"></i> Import Students</button>-->	
			</div>					
		</div>	
		<div class="modal" id="importModal">
		    <div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
				        <h4 class="modal-title">Import Students</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				     </div>
			       	<!-- Modal body -->
			       	<div class="modal-body">
				        <h5>Download excel format:</h5>
				        <a type="button" class="btn btn-default" href="<?=base_url();?>public/studentexcelformat.xlsx" download><i class="fa fa-download"></i> Download</a>
				        <p>* Fill data in excel sheet and upload it. *</p>
			         	<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label>
							<select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="batch">
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
							<label>Select excel</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="file" name="uploadexcel" data-purpose="edit-course-title" id="document" value="">									
							</div>
						</div>
			            <div id="msg1"></div>
			        </div>

				    <!-- Modal footer -->
				    <div class="modal-footer">
			        	<button class="btn btn-default steps_btn" id="upload">upload</button>
			       	</div>
				</div>
		  	</div>
		</div>
		<div class="modal" id="studentModel">
		    <div class="modal-dialog modal-lg">
			    <div class="modal-content">
					<div class="modal-header">
				        <h4 class="modal-title">New student</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				     </div>

			       <!-- Modal body -->
			       <div class="modal-body">
				        <div class="row justify-content-md-center">
							<div class="col-12">
								<div class="row">
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>First Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="First Name" name="title" data-purpose="edit-course-title" id="fname">									
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>Middle Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="Middle Name" name="title" data-purpose="edit-course-title" id="mname" value="">									
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>Last Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="Last Name" name="title" data-purpose="edit-course-title" id="lname" value="">									
											</div>
										</div>
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Mobile Number</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Mobile Number" name="title" data-purpose="edit-course-title" id="phone" value="">									
									</div>
								</div>	
								<div class="ui search focus mt-30 lbel25">
									<label>Email</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="email" placeholder="Email" name="title" data-purpose="edit-course-title" id="email" value="">	
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25 d-md-none d-none">
									<label>Type</label>
									<input type="radio" name="type" value="student" checked>Student<br>
										<input type="radio" name="type" value="institute">Institute<br>				
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Select Image</label>
									<div class="ui left icon input swdh19">
										<input type="file" name="photo" value="photo">
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
							<label>Select Batches</label> 
							<select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="batches">
								<?php 
									foreach($batches as $batch){
										?>
										<option value="<?=$batch->Id;?>"><?=$batch->Name;?></option>
										<?php
									}
								?>									
							</select>
						</div>
									<br>
									<div id="msg"></div>
								<button data-direction="next" class="steps_btn" id="submit">Add</button>
							</div>		
						</div>
			        </div>
				</div>
		  	</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search by student name..." aria-label="Search by student name..."  id="sname" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="searchstud"><i class="fas fa-search"></i></button>
  </div>
</div>
					</div>
				</div><br>
		<div class="card">
			<div class="card-body" id="students">

				<div id="load_data"></div>
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
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
		<h4>Filter by</h4>
		<br>
		<input type="hidden" id="page" value="0" name="">
		<div class="form-group">
			<label>Select course</label>
				<select class="form-control" id="fcourse">
					<option value="">Select course</option>
					<?php 
						foreach($courses as $course){
							?>
							<option value="<?=$course->Id;?>"><?=$course->Title;?></option>
							<?php
						}
					?>									
				</select>
		</div><br>
		<div class="form-group">
			<label>Select batch</label>
				<select class="form-control" id="fbatch">
					<option value="">Select batch</option>
					<?php 
						foreach($batches as $batch){
							?>
							<option value="<?=$batch->Id;?>"><?=$batch->Name;?></option>
							<?php
						}
					?>									
				</select>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
	$('#searchstud').click(function(){
    $.ajax({
        url: "<?= base_url()?>admin/student/searchstudents",
        data: {'search':$('#sname').val()},
        method: "post",
        success: function(data){
        
       $('#students').html(data);
      // alert(len);
      }
    });
});
	 $(function () {
        $('.multiselectdrop').multiselect({
            //includeSelectAllOption: true
        });
    });
		$('#submit').click(function() {
		var fname=$('#fname').val();
		var mname=$('#mname').val();
		var lname=$('#lname').val();
		var phone=$('#phone').val();
		var email=$('#email').val();
		var formData = new FormData();

		  var sbatches = $("#batches option:selected");
		var batches = [];
        sbatches.each(function () {
           	batches.push($(this).val());
        });

      file=$('input[name="photo"]').get(0).files[0];
      formData.append('file', file);
      formData.append('batches', batches);
      formData.append('fname' , fname);
      formData.append('lname' , lname);
      formData.append('mname' , mname);
      formData.append('phone' , phone);
      formData.append('email' , email);
      formData.append('type' , $('input[name="type"]:checked').val());
		$.ajax({
			url:"<?=base_url();?>admin/student/addstudent",
	        data: formData,
	        type: "post",
	        headers: { 'IsAjax': 'true' },
	        dataType: "json",
	        processData: false,
	        contentType: false,
	        success:function(data)
	        {
	        	if(data.code=="404"){
	        		$('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
	        	}
	        	else{
	        		swal("New student added successfully!", "", "success");
				    setTimeout(function () {
		              	swal.close();
		              	location.reload();
		          	}, 2000);
		        }
	        }
		});
	});
	
		$('body').on('click', '.assign', function(){ 
		var sid=$(this).val();
			  var sbatches = $("#batch_"+sid+" option:selected");
		var batch = [];
        sbatches.each(function () {
           	batch.push($(this).val());
        });
		$.ajax({
			url:"<?=base_url();?>admin/student/assignbatch",
	        method:"POST",
	        data:{sid:sid,batch:batch},
	        success:function(data)
	        {
        		swal("Batch assign successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.reload();
	          	}, 2000);
	        }
		});
	});
			$('body').on('click', '.change', function(){ 
		var sid=$(this).val();
			  var sbatches = $("#cbatch_"+sid+" option:selected");
		var batch = [];
        sbatches.each(function () {
           	batch.push($(this).val());
        });
		$.ajax({
			url:"<?=base_url();?>admin/student/changebatch",
	        method:"POST",
	        data:{sid:sid,batch:batch},
	        success:function(data)
	        {
        		swal("Batch assign successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.reload();
	          	}, 2000);
	        }
		});
	});
					$('body').on('click', '.pchange', function(){ 
		var sid=$(this).val();
		var pass=$('#npass_'+sid).val();
		$.ajax({
			url:"<?=base_url();?>admin/student/changepassword",
	        method:"POST",
	        data:{sid:sid,pass:pass},
	        success:function(data)
	        {
        		swal("Password change successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	//location.reload();
	          	}, 2000);
	        }
		});
	});
	 $('#upload').click(function(){
     var formData = new FormData();

      file=$('input[name="uploadexcel"]').get(0).files[0];
      formData.append('file', file);
      formData.append('batch', $('#batch').val());
      $("#upload").attr("disabled", true);
    $('#msg1').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait excel uploading....</div>');
      $.ajax({
        url: "<?= base_url()?>admin/student/importexcel",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data){
          $("#upload").attr("disabled", false);
          $('#msg1').html("");
        if(data.code=="200"){
           swal("Students imported successfully!", "", "success");
      setTimeout(function () {
              swal.close();
              location.reload();
          }, 2000);
        }
        else{
           $('#msg1').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
        }

      }
    });
   })
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

	$('body').on('change', '#fbatch', function(){ 
		$('#load_data').html('');
        	$('#page').val(0);
		fetchstudents();

	});
	$('body').on('change', '#fcourse', function(){ 
		$('#load_data').html('');
        	$('#page').val(0);
		fetchstudents();
	});
    function load_data(limit)
    {
     fetchstudents();
    }

function fetchstudents(){
	 $.ajax({
        url:"<?=base_url();?>admin/student/fetchstudents",
        method:"POST",
        data:{limit:limit, page:$('#page').val(), batch_id : $('#fbatch').val(), course_id: $('#fcourse').val()},
        cache: false,
        dataType:'JSON',
        success:function(data)
        {
        	$('#page').val(data.page);
          if(data.output == '')
          {
            $('#load_data_message').html('');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data.output);
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