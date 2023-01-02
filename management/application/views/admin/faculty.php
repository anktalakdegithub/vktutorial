<link href="<?=base_url();?>/assets/vendor/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?=base_url();?>/assets/vendor/bootstrap/js/bootstrap-select.min.js"></script>
		
<div class="sa4d25">
	<div class="container-fluid">			
		<div class="row">
			<div class="col-md-9">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>Faculties</h2><br>
			</div>	
			<div class="col-md-3 col-6 text-right">
				<button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#FacultyModal">New Faculty</button>	
				<!--<button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#importModal"><i class="fas fa-upload"></i> Import Students</button>-->	
			</div>					
		</div>	
		<div class="card">
			<div class="card-body">
				<?php
				$i=0;
				foreach ($faculties as $row) {
					?>
			<div class="row"><div class="col-md-9" style="">
			<h4><?=$row->FirstName;?> <?=$row->LastName;?></h4>
			<p><span><i class="fas fa-envelope"></i>&nbsp; <?=$row->Email;?></span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; <?=$row->Phone;?></span></p>
			
			</div><div class="col-md-3 text-right">
				<a href="#" data-toggle="modal" data-target="#editModal_<?=$row->Id;?>"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#deleteModal_<?=$row->Id;?>"><i class="fas fa-trash"></i></a>'
			
			</div></div><hr>
			 <div class="modal" id="editModal_<?=$row->Id;?>">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
								<div class="modal-header">
                                <h3>Change details</h3>
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
												<input class="prompt srch_explore" type="text" placeholder="First Name" id="fname_<?=$row->Id;?>" value="<?=$row->FirstName;?>">									
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>Middle Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="Middle Name" id="mname_<?=$row->Id;?>" value="<?=$row->MiddleName;?>">									
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>Last Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="Last Name" id="lname_<?=$row->Id;?>" value="<?=$row->LastName;?>">									
											</div>
										</div>
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Photo</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="file" id="photo_<?=$row->Id;?>">	
										<input type="hidden" value="<?=$row->Photo;?>" id="ephoto_<?=$row->Id;?>" name="">
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Mobile Number</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Mobile Number" id="phone_<?=$row->Id;?>" value="<?=$row->Phone;?>">									
									</div>
								</div>	
								<div class="ui search focus mt-30 lbel25">
									<label>Email</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="email" placeholder="Email" id="email_<?=$row->Id;?>" value="<?=$row->Email;?>">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Password</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Password" id="pass_<?=$row->Id;?>" value="">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Facebook Link</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Facebook Link"  value="<?=$row->facebook;?>" id="facebook_<?=$row->Id;?>">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Twitter Link</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Twitter Link"  value="<?=$row->twitter;?>" id="twitter_<?=$row->Id;?>">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>LinkedIn Link</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="LinkedIn Link"  value="<?=$row->linkedin;?>" id="linkedin_<?=$row->Id;?>">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Youtube Link</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Youtube Link"  value="<?=$row->youtube;?>" id="youtube_<?=$row->Id;?>">									
									</div>
								</div>
									<br>
								</div>		
						</div>	
						<div id="msg_<?=$row->Id;?>"></div>
						<button data-direction="next" class="update btn btn-default steps_btn" value="<?=$row->Id;?>">Update</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal" id="deleteModal_<?=$row->Id;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
								 <!-- Modal body -->
                              <div class="modal-body">
                              		<h3>Are you sure you want to delete?
						<button data-direction="next" class="delete btn btn-default steps_btn" value="<?=$row->Id;?>">Delete</button>	
			
					</div>
				</div>
			</div>
		</div>
					<?php		
							$i++;
		}
		?>
			</div>
		</div>
		<div class="modal" id="FacultyModal">
		    <div class="modal-dialog modal-lg">
			    <div class="modal-content">
					<div class="modal-header">
				        <h4 class="modal-title">New Faculty</h4>
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
												<input class="prompt srch_explore" type="text" placeholder="First Name" id="fname">									
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>Middle Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="Middle Name" id="mname" value="">									
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>Last Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="Last Name" id="lname" value="">									
											</div>
										</div>
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Photo</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="file" id="photo">	
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Mobile Number</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Mobile Number" id="phone" value="">									
									</div>
								</div>	
								<div class="ui search focus mt-30 lbel25">
									<label>Email</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="email" placeholder="Email" id="email" value="">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Password</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Password" id="pass" value="">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Facebook Link</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Facebook Link" id="facebook" value="">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Twitter Link</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Twitter Link" id="twitter" value="">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>LinkedIn Link</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="LinkedIn Link" id="linkedin" value="">									
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Youtube Link</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Youtube Link" id="youtube" value="">									
									</div>
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
		
	</div>
</div>
<script type="text/javascript">
		$('#submit').click(function() {
		var fname=$('#fname').val();
		var mname=$('#mname').val();
		var lname=$('#lname').val();
		var phone=$('#phone').val();
		var email=$('#email').val();
		var pass=$('#pass').val();
		var facebook=$('#facebook').val();
		var twitter=$('#twitter').val();
		var linkedin=$('#linkedin').val();
		var youtube=$('#youtube').val();
		var formData = new FormData();
		photo=$('#photo').get(0).files[0];
		formData.append('photo', photo);
		formData.append('fname', fname);
		formData.append('mname', mname);
		formData.append('lname', lname);
		formData.append('phone', phone);
		formData.append('email', email);
		formData.append('pass', pass);
		formData.append('facebook', facebook);
		formData.append('twitter', twitter);
		formData.append('linkedin', linkedin);
		formData.append('youtube', youtube);
		$.ajax({
			url:"<?=base_url();?>admin/faculty/addfaculty",
			method:"POST",
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
	        		swal("Faculty added successfully!", "", "success");
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
		var fname=$('#fname_'+id).val();
		var mname=$('#mname_'+id).val();
		var lname=$('#lname_'+id).val();
		var phone=$('#phone_'+id).val();
		var email=$('#email_'+id).val();
		var pass=$('#pass_'+id).val();
		var facebook=$('#facebook_'+id).val();
		var twitter=$('#twitter_'+id).val();
		var linkedin=$('#linkedin_'+id).val();
		var youtube=$('#youtube_'+id).val();
		var ephoto=$('#ephoto_'+id).val();
		var formData = new FormData();
		photo=$('#photo_'+id).get(0).files[0];
		formData.append('photo', photo);
		formData.append('ephoto', ephoto);
		formData.append('fname', fname);
		formData.append('mname', mname);
		formData.append('lname', lname);
		formData.append('phone', phone);
		formData.append('email', email);
		formData.append('pass', pass);
		formData.append('facebook', facebook);
		formData.append('twitter', twitter);
		formData.append('linkedin', linkedin);
		formData.append('youtube', youtube);
		formData.append('id', id);
		$.ajax({
			url:"<?=base_url();?>admin/faculty/updatefaculty",
			method:"POST",
			data: formData,
			type: "post",
			headers: { 'IsAjax': 'true' },
			processData: false,
			contentType: false,
			dataType: 'json',
	        success:function(data)
	        {
	        	if(data.code=="404"){
	        		$('#msg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
	        	}
	        	else{
	        		swal("Faculty data updated successfully!", "", "success");
				    setTimeout(function () {
		              	swal.close();
		              	location.reload();
		          	}, 2000);
		        }
	        }
		});
	})
	$('body').on('click', '.delete', function(){ 
		var id=$(this).val();
		$.ajax({
			url:"<?=base_url();?>admin/faculty/deletefaculty",
	        method:"POST",
	        data:{id:id},
	        success:function(data)
	        {
        		swal("faculty deleted successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.reload();
	          	}, 2000);
	        }
		});
	})

</script>