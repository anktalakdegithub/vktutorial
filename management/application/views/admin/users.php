<link href="<?=base_url();?>/assets/vendor/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?=base_url();?>/assets/vendor/bootstrap/js/bootstrap-select.min.js"></script>

<div class="sa4d25">
<div class="container">			
<div class="row">
<div class="col-md-9 col-6">	
<h2 class="st_title"><i class="uil uil-analysis"></i>Users</h2><br>
</div>	
<div class="col-md-3 col-6 text-right">
<?php 
  $access=$this->session->userdata('access');
  $setting=array();
  $setting=$access->users;
  if(in_array("add", $setting) || in_array("all", $setting))
  {
?>
	<button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#FacultyModal">New User</button>
<?php 
  }
?> 
</div>					
</div>	
<div class="card">
<div class="card-body">
<?php
$i=0;
foreach ($users as $row) {
	$access=json_decode($row->Access);
	$role=$row->Role;
	if ($row->Role=="") {
		$role="admin";
	}
?>
	<div class="row"><div class="col-md-1" style="">
		<img src="<?=$row->Photo;?>" style="width:100%;border-radius: 50px;">
	</div><div class="col-md-8" style="">
	<h4><?=$row->FirstName;?> <?=$row->LastName;?> (<?=$role;?>)</h4>
	<p><span><i class="fas fa-envelope"></i>&nbsp; <?=$row->Email;?></span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; <?=$row->Phone;?></span></p>

	</div><div class="col-md-3 text-right">
	<?php 
		if(in_array("edit", $setting) || in_array("all", $setting))
	  	{
	?>
		<a href="#" data-toggle="modal" data-target="#editModal_<?=$row->Id;?>"><i class="fas fa-edit"></i></a>
	<?php 
		}
		if(in_array("delete", $setting) || in_array("all", $setting))
		{
	?>
		&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#deleteModal_<?=$row->Id;?>"><i class="fas fa-trash"></i></a>'
	<?php 
		}
	?>	
</div></div><hr>
<div class="modal" id="editModal_<?=$row->Id;?>">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
			<div class="modal-header">
            <h3>Change details</h3>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
          	<div class="row justify-content-md-center">
		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<div class="ui search focus mt-30 lbel25">
						<label>First Name</label>
						<div class="ui left icon input swdh19">
							<input class="prompt srch_explore" type="text" placeholder="First Name" name="title" data-purpose="edit-course-title" id="fname_<?=$row->Id;?>" value="<?=$row->FirstName;?>">	
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="ui search focus mt-30 lbel25">
						<label>Last Name</label>
						<div class="ui left icon input swdh19">
							<input class="prompt srch_explore" type="text" placeholder="Last Name" name="title" data-purpose="edit-course-title" id="lname_<?=$row->Id;?>" value="<?=$row->LastName;?>">	
						</div>
					</div>
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Mobile Number</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="text" placeholder="Mobile Number" name="title" data-purpose="edit-course-title" id="phone_<?=$row->Id;?>" value="<?=$row->Phone;?>">									
				</div>
			</div>	
			<div class="ui search focus mt-30 lbel25">
				<label>Email</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="email" placeholder="Email" name="title" data-purpose="edit-course-title" id="email_<?=$row->Id;?>" value="<?=$row->Email;?>">									
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Password</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="password" placeholder="Password" data-purpose="edit-course-title" id="pass_<?=$row->Id;?>" value="<?=$row->Password;?>">									
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Photo</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="file" id="photo_<?=$row->Id;?>">			
					<input class="prompt srch_explore" type="hidden" id="ephoto_<?=$row->Id;?>" value="<?=$row->Photo;?>">							
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
              <label>Salary Type</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="stype_<?=$row->Id;?>" style="min-width: 100% !important;">
              	<option <?php if ($row->SalaryType=="Hourly") { echo "selected"; }?>>Hourly</option>
                <option <?php if ($row->SalaryType=="Weekly") { echo "selected"; }?>>Weekly</option>
                <option <?php if ($row->SalaryType=="Monthly") { echo "selected"; }?>>Monthly</option>            
              </select>
            </div>
			<div class="ui search focus mt-30 lbel25">
				<label>Salary</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="number" placeholder="Ex. 10000" id="salary_<?=$row->Id;?>" value="<?=$row->Salary;?>">		
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Role</label>
				<input type="radio" name="role_<?=$row->Id;?>" <?php if ($row->Role=="Admin") {echo "checked";} ?> value="Admin">Admin&nbsp;&nbsp;
				<input type="radio" name="role_<?=$row->Id;?>" <?php if ($row->Role=="Staff") {echo "checked";} ?> value="Staff">Staff&nbsp;&nbsp;
				<input type="radio" name="role_<?=$row->Id;?>" <?php if ($row->Role=="Teacher") {echo "checked";} ?> value="Teacher">Teacher&nbsp;&nbsp;
				<input type="radio" name="role_<?=$row->Id;?>" <?php if ($row->Role=="Other") {echo "checked";} ?> value="Other">Other
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Access</label>
				<div class="table table-responsive">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th>Access</th>
								<th>Add</th>
								<th>Edit</th>
								<th>Delete</th>
								<th>All</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Courses</td>
								<td><input type="checkbox" name="courses_<?=$row->Id;?>" <?php if (in_array("add", $access->courses)) { echo "checked"; } ?> value="add" <?php if (in_array("add", $access->courses)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="courses_<?=$row->Id;?>" <?php if (in_array("edit", $access->courses)) { echo "checked"; } ?> value="edit" <?php if (in_array("edit", $access->courses)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="courses_<?=$row->Id;?>" <?php if (in_array("delete", $access->courses)) { echo "checked"; } ?> value="delete" <?php if (in_array("delete", $access->courses)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="courses_<?=$row->Id;?>" <?php if (in_array("all", $access->courses)) { echo "checked"; } ?> value="all" <?php if (in_array("all", $access->courses)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Test Series</td>
								<td><input type="checkbox" name="tseries_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->tseries)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="tseries_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->tseries)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="tseries_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->tseries)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="tseries_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->tseries)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Assignments</td>
								<td><input type="checkbox" name="assignments_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->assignments)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="assignments_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->assignments)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="assignments_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->assignments)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="assignments_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->assignments)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Live Lectures</td>
								<td><input type="checkbox" name="lectures_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->lectures)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="lectures_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->lectures)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="lectures_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->lectures)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="lectures_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->lectures)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Batches</td>
								<td><input type="checkbox" name="batches_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->batches)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="batches_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->batches)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="batches_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->batches)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="batches_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->batches)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Students</td>
								<td><input type="checkbox" name="students_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->students)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="students_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->students)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="students_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->students)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="students_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->students)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Enquiries</td>
								<td><input type="checkbox" name="enquiries_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->enquiries)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="enquiries_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->enquiries)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="enquiries_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->enquiries)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="enquiries_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->enquiries)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Faculty</td>
								<td><input type="checkbox" name="faculty_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->faculties)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="faculty_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->faculties)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="faculty_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->faculties)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="faculty_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->faculties)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Study Material</td>
								<td><input type="checkbox" name="smaterial_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->smaterials)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="smaterial_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->smaterials)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="smaterial" value="delete" <?php if (in_array("delete", $access->smaterials)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="smaterial_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->smaterials)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Current Affairs</td>
								<td><input type="checkbox" name="caffairs_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->caffairs)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="caffairs_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->caffairs)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="caffairs_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->caffairs)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="caffairs_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->caffairs)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Jobs</td>
								<td><input type="checkbox" name="jobs_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->jobs)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="jobs_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->jobs)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="jobs_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->jobs)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="jobs_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->jobs)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Activities</td>
								<td><input type="checkbox" name="activitie_<?=$row->Id;?>s" value="add" <?php if (in_array("add", $access->activities)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="activities_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->activities)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="activities_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->activities)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="activities_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->activities)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Workshops</td>
								<td><input type="checkbox" name="workshops_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->workshops)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="workshops_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->workshops)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="workshops_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->workshops)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="workshops_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->workshops)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Student Results, Testimonials, Gallery, Guest-gallery & Video gallery</td>
								<td><input type="checkbox" name="gallery_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->gallery)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="gallery_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->gallery)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="gallery_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->gallery)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="gallery_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->gallery)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Sms & Notifications</td>
								<td><input type="checkbox" name="notifications_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->notifications)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="notifications_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->notifications)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="notifications_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->notifications)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="notifications_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->notifications)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Users</td>
								<td><input type="checkbox" name="Users_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->users)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="users_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->users)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="users_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->users)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="users_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->users)) { echo "checked"; } ?>></td>
							</tr>
							<tr>
								<td>Account</td>
								<td><input type="checkbox" name="account_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->accounts)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="account_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->accounts)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="account_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->accounts)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="account_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->accounts)) { echo "checked"; } ?>></td>
							<tr>
								<td>Setting</td>
								<td><input type="checkbox" name="setting_<?=$row->Id;?>" value="add" <?php if (in_array("add", $access->setting)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="setting_<?=$row->Id;?>" value="edit" <?php if (in_array("edit", $access->setting)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="setting_<?=$row->Id;?>" value="delete" <?php if (in_array("delete", $access->setting)) { echo "checked"; } ?>></td>
								<td><input type="checkbox" name="setting_<?=$row->Id;?>" value="all" <?php if (in_array("all", $access->setting)) { echo "checked"; } ?>></td>
							</tr>
						</tbody>
					</table>
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
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title">New User</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>

<!-- Modal body -->
<div class="modal-body">
    <div class="row justify-content-md-center">
		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<div class="ui search focus mt-30 lbel25">
						<label>First Name</label>
						<div class="ui left icon input swdh19">
							<input class="prompt srch_explore" type="text" placeholder="First Name" name="title" data-purpose="edit-course-title" id="fname">	
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="ui search focus mt-30 lbel25">
						<label>Last Name</label>
						<div class="ui left icon input swdh19">
							<input class="prompt srch_explore" type="text" placeholder="Last Name" name="title" data-purpose="edit-course-title" id="lname">									
						</div>
					</div>
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Mobile Number</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="text" placeholder="Mobile Number" name="title" data-purpose="edit-course-title" id="phone">									
				</div>
			</div>	
			<div class="ui search focus mt-30 lbel25">
				<label>Email</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="email" placeholder="Email" name="title" data-purpose="edit-course-title" id="email">	
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Password</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="password" placeholder="Password" name="title" data-purpose="edit-course-title" id="pass">	
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Photo</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="file" id="photo">	
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
              <label>Salary Type</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="stype" style="min-width: 100% !important;">
              	<option>Per Lecture</option>
                <option>Weekly</option>
                <option>Monthly</option>            
              </select>
            </div>
			<div class="ui search focus mt-30 lbel25">
				<label>Salary</label>
				<div class="ui left icon input swdh19">
					<input class="prompt srch_explore" type="number" placeholder="Ex. 10000" id="salary" value="">		
				</div>
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Role</label>
				<input type="radio" name="role" value="Admin">Admin&nbsp;&nbsp;
				<input type="radio" name="role" value="Staff">Staff&nbsp;&nbsp;
				<input type="radio" name="role" value="Teacher">Teacher&nbsp;&nbsp;
				<input type="radio" name="role" value="Other">Other
			</div>
			<div class="ui search focus mt-30 lbel25">
				<label>Access</label>
				<div class="table table-responsive">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th>Access</th>
								<th>Add</th>
								<th>Edit</th>
								<th>Delete</th>
								<th>All</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Courses</td>
								<td><input type="checkbox" name="courses" value="add"></td>
								<td><input type="checkbox" name="courses" value="edit"></td>
								<td><input type="checkbox" name="courses" value="delete"></td>
								<td><input type="checkbox" name="courses" value="all"></td>
							</tr>
							<tr>
								<td>Test Series</td>
								<td><input type="checkbox" name="tseries" value="add"></td>
								<td><input type="checkbox" name="tseries" value="edit"></td>
								<td><input type="checkbox" name="tseries" value="delete"></td>
								<td><input type="checkbox" name="tseries" value="all"></td>
							</tr>
							<tr>
								<td>Assignments</td>
								<td><input type="checkbox" name="assignments" value="add"></td>
								<td><input type="checkbox" name="assignments" value="edit"></td>
								<td><input type="checkbox" name="assignments" value="delete"></td>
								<td><input type="checkbox" name="assignments" value="all"></td>
							</tr>
							<tr>
								<td>Live Lectures</td>
								<td><input type="checkbox" name="lectures" value="add"></td>
								<td><input type="checkbox" name="lectures" value="edit"></td>
								<td><input type="checkbox" name="lectures" value="delete"></td>
								<td><input type="checkbox" name="lectures" value="all"></td>
							</tr>
							<tr>
								<td>Batches</td>
								<td><input type="checkbox" name="batches" value="add"></td>
								<td><input type="checkbox" name="batches" value="edit"></td>
								<td><input type="checkbox" name="batches" value="delete"></td>
								<td><input type="checkbox" name="batches" value="all"></td>
							</tr>
							<tr>
								<td>Students</td>
								<td><input type="checkbox" name="students" value="add"></td>
								<td><input type="checkbox" name="students" value="edit"></td>
								<td><input type="checkbox" name="students" value="delete"></td>
								<td><input type="checkbox" name="students" value="all"></td>
							</tr>
							<tr>
								<td>Enquiries</td>
								<td><input type="checkbox" name="enquiries" value="add"></td>
								<td><input type="checkbox" name="enquiries" value="edit"></td>
								<td><input type="checkbox" name="enquiries" value="delete"></td>
								<td><input type="checkbox" name="enquiries" value="all"></td>
							</tr>
							<tr>
								<td>Faculty</td>
								<td><input type="checkbox" name="faculty" value="add"></td>
								<td><input type="checkbox" name="faculty" value="edit"></td>
								<td><input type="checkbox" name="faculty" value="delete"></td>
								<td><input type="checkbox" name="faculty" value="all"></td>
							</tr>
							<tr>
								<td>Study Material</td>
								<td><input type="checkbox" name="smaterial" value="add"></td>
								<td><input type="checkbox" name="smaterial" value="edit"></td>
								<td><input type="checkbox" name="smaterial" value="delete"></td>
								<td><input type="checkbox" name="smaterial" value="all"></td>
							</tr>
							<tr>
								<td>Current Affairs</td>
								<td><input type="checkbox" name="caffairs" value="add"></td>
								<td><input type="checkbox" name="caffairs" value="edit"></td>
								<td><input type="checkbox" name="caffairs" value="delete"></td>
								<td><input type="checkbox" name="caffairs" value="all"></td>
							</tr>
							<tr>
								<td>Jobs</td>
								<td><input type="checkbox" name="jobs" value="add"></td>
								<td><input type="checkbox" name="jobs" value="edit"></td>
								<td><input type="checkbox" name="jobs" value="delete"></td>
								<td><input type="checkbox" name="jobs" value="all"></td>
							</tr>
							<tr>
								<td>Activities</td>
								<td><input type="checkbox" name="activities" value="add"></td>
								<td><input type="checkbox" name="activities" value="edit"></td>
								<td><input type="checkbox" name="activities" value="delete"></td>
								<td><input type="checkbox" name="activities" value="all"></td>
							</tr>
							<tr>
								<td>Workshops</td>
								<td><input type="checkbox" name="workshops" value="add"></td>
								<td><input type="checkbox" name="workshops" value="edit"></td>
								<td><input type="checkbox" name="workshops" value="delete"></td>
								<td><input type="checkbox" name="workshops" value="all"></td>
							</tr>
							<tr>
								<td>Student Results, Testimonials, Gallery, Guest-gallery & Video gallery</td>
								<td><input type="checkbox" name="gallery" value="add"></td>
								<td><input type="checkbox" name="gallery" value="edit"></td>
								<td><input type="checkbox" name="gallery" value="delete"></td>
								<td><input type="checkbox" name="gallery" value="all"></td>
							</tr>
							<tr>
								<td>Sms & Notifications</td>
								<td><input type="checkbox" name="notifications" value="add"></td>
								<td><input type="checkbox" name="notifications" value="edit"></td>
								<td><input type="checkbox" name="notifications" value="delete"></td>
								<td><input type="checkbox" name="notifications" value="all"></td>
							</tr>
							<tr>
								<td>Users</td>
								<td><input type="checkbox" name="Users" value="add"></td>
								<td><input type="checkbox" name="users" value="edit"></td>
								<td><input type="checkbox" name="users" value="delete"></td>
								<td><input type="checkbox" name="users" value="all"></td>
							</tr>
							<tr>
								<td>Account</td>
								<td><input type="checkbox" name="account" value="add"></td>
								<td><input type="checkbox" name="account" value="edit"></td>
								<td><input type="checkbox" name="account" value="delete"></td>
								<td><input type="checkbox" name="account" value="all"></td>
							<tr>
								<td>Setting</td>
								<td><input type="checkbox" name="setting" value="add"></td>
								<td><input type="checkbox" name="setting" value="edit"></td>
								<td><input type="checkbox" name="setting" value="delete"></td>
								<td><input type="checkbox" name="setting" value="all"></td>
							</tr>
						</tbody>
					</table>
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
    $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait user creating....</div>');
var fname=$('#fname').val();
var lname=$('#lname').val();
var phone=$('#phone').val();
var email=$('#email').val();
var stype=$('#stype').val();
var salary=$('#salary').val();
var pass=$('#pass').val();
var role=$('input[name="role"]:checked').val();
var courses=[];
var students=[];
var tseries=[];
var assignments=[];
var lectures=[];
var faculty=[];
var smaterial=[];
var caffairs=[];
var jobs=[];
var activities=[];
var workshops=[];
var gallery=[];
var notifications=[];
var users=[];
var account=[];
var setting=[];
var enquiries=[];
var batches=[];
$('input[name="courses"]:checked').map(function() {
courses.push($(this).val());
}).get();
$('input[name="tseries"]:checked').map(function() {
tseries.push($(this).val());
}).get();
$('input[name="students"]:checked').map(function() {
students.push($(this).val());
}).get();
$('input[name="assignments"]:checked').map(function() {
assignments.push($(this).val());
}).get();
$('input[name="lectures"]:checked').map(function() {
lectures.push($(this).val());
}).get();
$('input[name="faculty"]:checked').map(function() {
faculty.push($(this).val());
}).get();
$('input[name="smaterial"]:checked').map(function() {
smaterial.push($(this).val());
}).get();
$('input[name="caffairs"]:checked').map(function() {
caffairs.push($(this).val());
}).get();
$('input[name="jobs"]:checked').map(function() {
jobs.push($(this).val());
}).get();
$('input[name="activities"]:checked').map(function() {
activities.push($(this).val());
}).get();
$('input[name="workshops"]:checked').map(function() {
workshops.push($(this).val());
}).get();
$('input[name="gallery"]:checked').map(function() {
gallery.push($(this).val());
}).get();
$('input[name="notifications"]:checked').map(function() {
notifications.push($(this).val());
}).get();
$('input[name="users"]:checked').map(function() {
users.push($(this).val());
}).get();
$('input[name="account"]:checked').map(function() {
account.push($(this).val());
}).get();
$('input[name="setting"]:checked').map(function() {
setting.push($(this).val());
}).get();
$('input[name="enquiries"]:checked').map(function() {
enquiries.push($(this).val());
}).get();
$('input[name="batches"]:checked').map(function() {
batches.push($(this).val());
}).get();
var formData = new FormData();
photo=$('#photo').get(0).files[0];
formData.append('photo', photo);
formData.append('fname', fname);
formData.append('lname', lname);
formData.append('phone', phone);
formData.append('email', email);
formData.append('stype', stype);
formData.append('salary', salary);
formData.append('role', role);
formData.append('courses', JSON.stringify(courses));
formData.append('tseries', JSON.stringify(tseries));
formData.append('students', JSON.stringify(students));
formData.append('assignments', JSON.stringify(assignments));
formData.append('lectures', JSON.stringify(lectures));
formData.append('faculty', JSON.stringify(faculty));
formData.append('smaterial', JSON.stringify(smaterial));
formData.append('caffairs', JSON.stringify(caffairs));
formData.append('jobs', JSON.stringify(jobs));
formData.append('activities', JSON.stringify(activities));
formData.append('workshops', JSON.stringify(workshops));
formData.append('gallery', JSON.stringify(gallery));
formData.append('notifications', JSON.stringify(notifications));
formData.append('users', JSON.stringify(users));
formData.append('account', JSON.stringify(account));
formData.append('setting', JSON.stringify(setting));
formData.append('batches', JSON.stringify(batches));
formData.append('enquiries', JSON.stringify(enquiries));
formData.append('pass', pass);
$.ajax({
url:"<?=base_url();?>admin/users/adduser",
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
swal("User added successfully!", "", "success");
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
    $('#msg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait user updating....</div>');
var fname=$('#fname_'+id).val();
var lname=$('#lname_'+id).val();
var phone=$('#phone_'+id).val();
var email=$('#email_'+id).val();
var stype=$('#stype_'+id).val();
var salary=$('#salary_'+id).val();
var pass=$('#pass_'+id).val();
var role=$('input[name="role_'+id+'"]:checked').val();
var courses=[];
var students=[];
var tseries=[];
var assignments=[];
var lectures=[];
var faculty=[];
var smaterial=[];
var caffairs=[];
var jobs=[];
var activities=[];
var workshops=[];
var gallery=[];
var notifications=[];
var users=[];
var account=[];
var setting=[];
var enquiries=[];
var batches=[];
$('input[name="courses_'+id+'"]:checked').map(function() {
courses.push($(this).val());
}).get();
$('input[name="tseries_'+id+'"]:checked').map(function() {
tseries.push($(this).val());
}).get();
$('input[name="students_'+id+'"]:checked').map(function() {
students.push($(this).val());
}).get();
$('input[name="assignments_'+id+'"]:checked').map(function() {
assignments.push($(this).val());
}).get();
$('input[name="lectures_'+id+'"]:checked').map(function() {
lectures.push($(this).val());
}).get();
$('input[name="faculty_'+id+'"]:checked').map(function() {
faculty.push($(this).val());
}).get();
$('input[name="smaterial_'+id+'"]:checked').map(function() {
smaterial.push($(this).val());
}).get();
$('input[name="caffairs_'+id+'"]:checked').map(function() {
caffairs.push($(this).val());
}).get();
$('input[name="jobs_'+id+'"]:checked').map(function() {
jobs.push($(this).val());
}).get();
$('input[name="activities_'+id+'"]:checked').map(function() {
activities.push($(this).val());
}).get();
$('input[name="workshops_'+id+'"]:checked').map(function() {
workshops.push($(this).val());
}).get();
$('input[name="gallery_'+id+'"]:checked').map(function() {
gallery.push($(this).val());
}).get();
$('input[name="notifications_'+id+'"]:checked').map(function() {
notifications.push($(this).val());
}).get();
$('input[name="users_'+id+'"]:checked').map(function() {
users.push($(this).val());
}).get();
$('input[name="account_'+id+'"]:checked').map(function() {
account.push($(this).val());
}).get();
$('input[name="setting_'+id+'"]:checked').map(function() {
setting.push($(this).val());
}).get();
$('input[name="enquiries_'+id+'"]:checked').map(function() {
enquiries.push($(this).val());
}).get();
$('input[name="batches_'+id+'"]:checked').map(function() {
batches.push($(this).val());
}).get();
var formData = new FormData();
photo=$('#photo_'+id).get(0).files[0];
formData.append('id', id);
formData.append('photo', photo);
formData.append('ephoto', $('#ephoto_'+id));
formData.append('fname', fname);
formData.append('lname', lname);
formData.append('phone', phone);
formData.append('email', email);
formData.append('stype', stype);
formData.append('salary', salary);
formData.append('role', role);
formData.append('courses', JSON.stringify(courses));
formData.append('tseries', JSON.stringify(tseries));
formData.append('students', JSON.stringify(students));
formData.append('assignments', JSON.stringify(assignments));
formData.append('lectures', JSON.stringify(lectures));
formData.append('faculty', JSON.stringify(faculty));
formData.append('smaterial', JSON.stringify(smaterial));
formData.append('caffairs', JSON.stringify(caffairs));
formData.append('jobs', JSON.stringify(jobs));
formData.append('activities', JSON.stringify(activities));
formData.append('workshops', JSON.stringify(workshops));
formData.append('gallery', JSON.stringify(gallery));
formData.append('notifications', JSON.stringify(notifications));
formData.append('users', JSON.stringify(users));
formData.append('account', JSON.stringify(account));
formData.append('setting', JSON.stringify(setting));
formData.append('batches', JSON.stringify(batches));
formData.append('enquiries', JSON.stringify(enquiries));
formData.append('pass', pass);
$.ajax({
url:"<?=base_url();?>admin/users/updateuser",
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
swal("User data updated successfully!", "", "success");
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
url:"<?=base_url();?>admin/users/deleteuser",
method:"POST",
data:{id:id},
success:function(data)
{
swal("User deleted successfully!", "", "success");
setTimeout(function () {
	swal.close();
	location.reload();
}, 2000);
}
});
})

</script>