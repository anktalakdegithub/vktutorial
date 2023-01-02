  <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"></script>
<style type="text/css">
		.multiselect{
		border: 1px solid #e3e3e3;
		width: 400px !important;
		text-align: left !important;
	}
	.multiselect-container-fluid{
		width: 400px !important;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-1">
							<?php 
                    if($student[0]->Photo!=""){
                      ?>
                  <img src="<?=$student[0]->Photo?>" alt="..." style="width:100%;">
                  <?php
                }
                else{
                  ?>
                  <img src="https://acceronclass.classblue.in/public/assets/images/student.png" style="width:100%;">
                  <?php
                }
                ?>
						</div>
						<div class="col-md-9">
							<h4><?=$student[0]->FirstName.' '.$student[0]->LastName;?></h4>
              <p><strong>Student Code:</strong><?=$student[0]->Student_Code;?>&nbsp;&nbsp;<strong>Password:</strong><?=$student[0]->Password;?></p>
							<p><span><i class="fas fa-phone-alt"></i>&nbsp;<?=$student[0]->Phone;?></span>&nbsp;&nbsp;<span><i class="fas fa-envelope"></i>&nbsp;<?=$student[0]->Email;?></span></p>

							<?php 
                $abatches=array();
							if(count($batches)>0){
								?>
							<p><span>Batches: 
								<?php 
									foreach ($batches as $batch) {
										$abatches[]=$batch->Id;
										?>
										<?=$batch->Name;?>,
										<?php
									}
								?>	
							</span></p>
							<?php 
						}
						?>
						</div>
						<div class="col-md-2 text-left">
              <div class="dropdown">
                <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" data-toggle="modal" data-target="#editModal">Edit Student</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#assignModal">Assign Batch</a>

            <!--  <a class="dropdown-item" data-toggle="modal" data-target="#courseModal">Assign course</a>
               <?php 
              if($student[0]->Type=="institute"){
                ?>
                  <a class="dropdown-item copylink" href="#">Copy Link</a>
            <?php
              }
              ?> -->
            <!--  <a class="dropdown-item" data-toggle="modal" data-target="#seriesModal">Assign test series</a>-->

              <?php 
              if ($student[0]->IsBlock==1) {
                ?>
                <a  class="dropdown-item" data-toggle="modal" data-target="#rarchiveModal" style="margin-bottom: 5px;">Unblock Student</a>
                <?php
              }
              else{
                ?>
                <a class="dropdown-item" data-toggle="modal" data-target="#archiveModal" style="margin-bottom: 5px;">Delete Student</a>
                <?php
              }
              ?>
              
						</div>
					</div><div class="modal" id="courseModal">
                              <div class="modal-dialog">
                                <div class="modal-content">
                            <div class="modal-header">
                                      <h3>Add Course</h3>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label>Course</label>
                                        <select class="form-control" id="course">
                                        <?php 
                                          foreach($acourses['courses'] as $course){
                                            ?>
                                            <option value="<?=$course->Id;?>"><?=$course->Title;?></option>
                                            <?php
                                          }
                                        ?>   
                                        </select>
                                     </div>
                                     <label>Select Access</label><Br>
                                     <input type="checkbox" name="access" value="Videos">Videos<br>
                                     <input type="checkbox" name="access" value="PPTs">PPTs<br>
                                     <input type="checkbox" name="access" value="Tests">Tests<br><br>
                            <button data-direction="next" class="btn btn-default steps_btn" id="addcourse">Add</button> 
                        </div>
                      </div>
                  </div>
              </div>
              <div class="modal" id="seriesModal">
                              <div class="modal-dialog">
                                <div class="modal-content">
                            <div class="modal-header">
                                      <h3>Add Test Series</h3>
                                    </div>
                                    <div class="modal-body">
                            <div class="form-group">
                                        <label>Test series</label>
                                        <select class="form-control" id="series">
                                        <?php 
                                          foreach($aseries['mcqtests'] as $ser){
                                            ?>
                                            <option value="<?=$ser->Id;?>"><?=$ser->Title;?></option>
                                            <?php
                                          }
                                        ?>   
                                        </select>
                                     </div>
                            <button data-direction="next" class="btn btn-default steps_btn" id="addseries">Add</button> 
                        </div>
                      </div>
                  </div>
              </div>
					           <div class="modal" id="assignModal">
                          <div class="modal-dialog">
                            <div class="modal-content">
                <div class="modal-header">
                                <h3>Assign Batch</h3>
                              </div>
                              <div class="modal-body">
                                <div class="ui search focus mt-30 lbel25">
					              <label>Select batches</label>
					              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" multiple id="sbatch">
					                <?php 
					                  foreach($obatches as $batch){
					                    ?>
					                    <option value="<?=$batch->Id;?>" <?php if(in_array($batch->Id, $abatches)){ echo "selected";} ?>><?=$batch->Name;?></option>
					                    <?php
					                  }
					                ?>                
					              </select>
					            </div>
            <br>
            <div id="amsg"></div>
            <button data-direction="next" class="steps_btn" id="assign" value="<?=$student[0]->Id;?>">Assign</button> 
      </div>
          </div>
        </div>
      </div>

              <?php 
              if ($student[0]->IsBlock==1) {
                ?>
                <div class="modal" id="rarchiveModal">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-body">
                                        <h4>Are you sure you want to unblock this student?</h4>   
                              <button data-direction="next" class="btn btn-default steps_btn" id="activate">Yes</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>
                    </div>
                </div>
                <?php
              }
              else{
                ?>
                <div class="modal" id="archiveModal">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-body">
                                        <h4>Are you sure you want to block this student?</h4>   
                              <button data-direction="next" class="btn btn-default steps_btn" id="archive">Yes</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>
                    </div>
                </div>
                <?php
              }
              ?>
        <div class="modal" id="editModal">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                <div class="modal-header">
                                <h3>Edit Student</h3>
                              </div>
                              <div class="modal-body">
                		<div class="row justify-content-md-center">
							<div class="col-12">
								<div class="row">
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>First Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="First Name" name="title" data-purpose="edit-course-title" value="<?=$student[0]->FirstName;?>" id="fname">									
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>Middle Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="Middle Name" name="title" data-purpose="edit-course-title" id="mname" value="<?=$student[0]->MiddleName;?>">									
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="ui search focus mt-30 lbel25">
											<label>Last Name</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="text" placeholder="Last Name" name="title" data-purpose="edit-course-title" id="lname" value="<?=$student[0]->LastName;?>">									
											</div>
										</div>
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Mobile Number</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" placeholder="Mobile Number" name="title" data-purpose="edit-course-title" id="phone" value="<?=$student[0]->Phone;?>">									
									</div>
								</div>	
								<div class="ui search focus mt-30 lbel25">
									<label>Email</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="email" placeholder="Email" name="title" data-purpose="edit-course-title" id="email"  value="<?=$student[0]->Email;?>">									
									</div>
								</div>

            <div class="ui search focus mt-30 lbel25">
              <label>Password</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="password" placeholder="Password" name="title" data-purpose="edit-course-title" id="password" value="<?=$student[0]->Password;?>">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Photo</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" placeholder="Profile" name="photo" data-purpose="edit-course-title" id="photo" value="<?=$student[0]->Photo;?>">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Date of birth</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="date" placeholder="Date Of Birth" name="title" data-purpose="edit-course-title" id="dob" value="<?=$student[0]->DateOfBirth;?>">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25 row">
              <label class="col-md-2">Gender</label>
              <div class="col-md-10">
              <input type="radio" id="gender" name="gender" value="Female" <?php if($student[0]->Gender=="Female"){ echo "checked"; } ?>>Female
                <input type="radio" id="gender" name="gender" value="Male" <?php if($student[0]->Gender=="Male"){ echo "checked"; } ?>>Male  
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Address</label>
              <div class="ui left icon input swdh19">
                <textarea class="prompt srch_explore" style="width: 100%;" placeholder="Address" id="address"><?=$student[0]->Address;?></textarea>     
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>State</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="State" name="title" data-purpose="edit-course-title" id="state" value="<?=$student[0]->State;?>">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>City</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="City" name="title" data-purpose="edit-course-title" id="city" value="<?=$student[0]->City;?>">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Pincode</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Pincode" name="title" data-purpose="edit-course-title" id="pincode" value="<?=$student[0]->Pincode;?>">                 
              </div>
            </div>
						</div>		
						</div>
            <br>
            <div id="umsg"></div>
            <button data-direction="next" class="steps_btn" id="update" value="<?=$student[0]->Id;?>">Update</button> 
      </div>
          </div>
        </div>
      </div>
				</div>
			</div></div>
    </div><br>
			<style type="text/css">
				.nav-link.active{
					font-size: 14px !important;
				    font-weight: 500 !important;
				    font-family: 'Roboto', sans-serif !important;
				    color: #fff !important;
				    background: #031358 !important;
				    border-radius: 25px !important;
				    border: 0 !important;
				    height: 40px !important;
				    padding-top: 10px;
				}
			</style>
			<ul class="nav nav-pills">
			  
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#profile">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#admission">Admission</a>
        </li>
        <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#fees">Fees</a>
			  </li>
			 <!--  <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#attendance">Attendance</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#assignments">Assignments</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#tests">Test Series</a>
			  </li> -->
			</ul>
			<br>
			<div class="tab-content">
				<div class="tab-pane container-fluid active" id="profile">
					<div class="card-body">
                     <div >
                    <h4>Personal details:</h4>
                    <div class="card">
                    	<div class="card-body">
                    		 <p class="text-left"><a href="#"><i class="fa fa-envelope"></i>&nbsp;Email:&nbsp;</a> <?=$student[0]->Email;?></p>
                 <p class="text-left"><a href="#"><i class="fa fa-key"></i>&nbsp;Password:&nbsp;</a> <?=$student[0]->Password;?></p>
                 <p class="text-left"><a href="#"><i class="fa fa-phone"></i>&nbsp;Phone:&nbsp;</a><?=$student[0]->Phone;?></p>
                 <p class="text-left"><a href="#"><i class="fas fa-calendar-alt"></i>&nbsp;DOB:&nbsp;</a> <?=$student[0]->DateOfBirth;?></p>
                 <p class="text-left"><a href="#"><i class="fas fa-address-card"></i>&nbsp;Address:&nbsp;</a> <?=$student[0]->Address.', <br>'.$student[0]->City.' '.$student[0]->Pincode.' '.$student[0]->State;?></p>
                  <p class="text-left"><a href="#"><i class="fas fa-calendar-alt"></i>&nbsp;Admission Date:&nbsp;</a> <?=$student[0]->CreatedAt;?></p>
                    </div>
                </div>
                <div class="row">
                      <div class="col-md-8">
                      	<h4>Gaurdian details:</h4>
                      </div>
                      <div class="col-md-4"><br>
                      	<button type="button" class="btn steps_btn"data-toggle="modal" data-target="#parentModel">Add guardians</button>
                      </div>
                  </div>
                    <div id="parentModel" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3>Add Details</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
      	<div class="row justify-content-md-center">
          <div class="col-12">
            <div class="ui search focus mt-30 lbel25 row">
              <label class="col-md-2">Relation</label>
              <div class="col-md-10">
                <input type="radio" name="relation" value="Father" checked>&nbsp;Father&nbsp;
                <input type="radio" name="relation" value="Mother">&nbsp;Mother  &nbsp;
                <input type="radio" name="relation" value="Other">&nbsp;Other  &nbsp;
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="ui search focus mt-30 lbel25">
                  <label>Name</label>
                </div>
              </div>
              <div class="col-md-1" style="padding-right: 0px;">
                <div class="ui search focus mt-30 lbel25">
                  <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="addressing" style="min-width: 100% !important;">
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Miss.</option>               
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="First Name" name="title" data-purpose="edit-course-title"  id="gfname" value="">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Middle Name" name="title" data-purpose="edit-course-title"  id="gmname" value="">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Last Name" name="title" data-purpose="edit-course-title"  id="glname" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Mobile Number</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Mobile Number" name="title" data-purpose="edit-course-title" id="gphone" value="">                  
              </div>
            </div>  
            <div class="ui search focus mt-30 lbel25">
              <label>Email</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="email" placeholder="Email" name="title" data-purpose="edit-course-title" id="gemail" value="">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Occupation</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Occupation" name="title" data-purpose="edit-course-title" id="occupation" value="">
              </div>
            </div>
            <br>
            <div id="gmsg"></div><br>
            <button type="button" class="steps_btn" id="addparents" value="<?=$student[0]->Id;?>">Save</button>
          </div>    
        </div>
      </div>
    </div>

  </div>
</div> 

                   <br>
                   <div id="parents">
                    <?php
                       if(count($parents)>0){
                      foreach ($parents as $parent) {
                    ?>
                       <div class="card" style="border: 1px solid #e4eaec;">
    <div class="card-body">
  <div class="row">
  <div class="col-md-10">
    <h4><?=$parent->Addressing.' '.$parent->FirstName.' '.$parent->MiddleName.' '.$parent->LastName;?>(<?=$parent->Relation;?>)</h4>
    <p>
      <?php
      if($parent->Email!=""){
        ?>
        <i class="fa fa-envelope"></i>&nbsp;<?=$parent->Email;?>&nbsp;&nbsp;
        <?php
      }
      ?>
      <?php
      if($parent->Phone!=""){
        ?>
        <span><i class="fa fa-phone"></i>&nbsp;<?=$parent->Phone;?></span>&nbsp;&nbsp;
        <?php
      }
      ?>
       <?php
      if($parent->Occupation!=""){
        ?>
        <span><i class="fa fa-briefcase"></i>&nbsp;<?=$parent->Occupation;?></span>
        <?php
      }
      ?>
    </p>
  </div>
  <div class="col-md-2">
    <a class="pedit" data-toggle="modal" data-target="#peditmodal_<?=$parent->Id;?>" style="cursor:pointer"><i class="fas fa-edit"></i>Edit</a>&nbsp;&nbsp;<a data-toggle="modal" data-target="#pdeletemodal_<?=$parent->Id;?>" style="cursor:pointer"><i class="fas fa-trash"></i>Delete</a>
     <div id="peditmodal_<?=$parent->Id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3>Edit Details</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
       <div class="row justify-content-md-center">
          <div class="col-12">
            <div class="ui search focus mt-30 lbel25 row">
              <label class="col-md-2">Relation</label>
              <div class="col-md-10">
                <input type="radio" name="relation_<?=$parent->Id;?>" value="Father"  <?php if($parent->Relation=="Father"){ echo "checked";} ?>>&nbsp;Father&nbsp;
                <input type="radio" name="relation_<?=$parent->Id;?>" value="Mother"  <?php if($parent->Relation=="Mother"){ echo "checked";} ?>>&nbsp;Mother  &nbsp;
                <input type="radio" name="relation_<?=$parent->Id;?>" value="Other"  <?php if($parent->Relation=="Other"){ echo "checked";} ?>>&nbsp;Other  &nbsp;
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="ui search focus mt-30 lbel25">
                  <label>Name</label>
                </div>
              </div>
              <div class="col-md-1" style="padding-right: 0px;">
                <div class="ui search focus mt-30 lbel25">
                  <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="addressing_<?=$parent->Id;?>" style="min-width: 100% !important;">
                    <option value="Mr." <?php if($parent->Relation=="Mr."){ echo "Selected";} ?>>Mr.</option>
                    <option value="Mrs." <?php if($parent->Relation=="Mrs."){ echo "Selected";} ?>>Mrs.</option>
                    <option value="Miss." <?php if($parent->Relation=="Miss."){ echo "Selected";} ?>>Miss.</option>               
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="First Name" name="title" data-purpose="edit-course-title"  id="gfname_<?=$parent->Id;?>" value="<?=$parent->FirstName;?>">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Middle Name" name="title" data-purpose="edit-course-title"  id="gmname<?=$parent->Id;?>" value="<?=$parent->MiddleName;?>">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Last Name" name="title" data-purpose="edit-course-title"  id="glname_<?=$parent->Id;?>" value="<?=$parent->LastName;?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Mobile Number</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Mobile Number" name="title" data-purpose="edit-course-title" id="gphone_<?=$parent->Id;?>" value="<?=$parent->Phone;?>">                  
              </div>
            </div>  
            <div class="ui search focus mt-30 lbel25">
              <label>Email</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="email" placeholder="Email" name="title" data-purpose="edit-course-title" id="gemail_<?=$parent->Id;?>" value="<?=$parent->Email;?>">                 
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Occupation</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" placeholder="Occupation" name="title" data-purpose="edit-course-title" id="occupation_<?=$parent->Id;?>" value="<?=$parent->Occupation;?>">
              </div>
            </div>
            <br>
            <div id="gmsg_<?=$parent->Id;?>"></div><br>
            <button type="button" class="update steps_btn" value="<?=$parent->Id;?>">Save</button>
          </div>    
        </div>
      </div>
    </div>

  </div>
</div> 
  <div id="pdeletemodal_<?php echo $parent->Id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
       <h4>Are you sure?</h4> 
      </div>

      <div class="modal-footer">
        <button type="button" class="pdelete btn steps_btn" value="<?php echo $parent->Id;?>">Delete</button>
      </div>
    </div>

  </div>
</div>  
  </div>
</div>
   </div>  </div>
                      <?php
                    }
                }
                    else{
                    	?>
                    	<div class="card">
                    		<div class="card-body text-center">
                    			<h5>No data found!!</h5>
                    		</div>
                    	</div>
                    	<?php
                    }
                    ?>
                </div>
                    </div>
                  </div>
				</div>
			  	<div class="tab-pane container-fluid" id="admission">
			  		<h4>Courses:</h4>
					<div class="row">
						<?php 
							foreach ($courses as $course) {
								?>
								<div class="col-md-3">
									<div class="card">
										<img class="card-img-top" src="<?=$course->Cover_image;?>" alt="Card image" style="max-height: 150px;overflow: hidden;width: 100%;">
										<div class="card-body">
											<h4><?=$course->Title;?></h4>
                      <p><strong>Batch Name: </strong><?=$course->Name;?></p>
                      <a href="#" class="text-danger" data-toggle="modal" data-target="#removeCourseModal_<?=$course->Id;?>">Remove</a>
                      <div class="modal" id="removeCourseModal_<?=$course->Id;?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-body">
                                        <h4>Are you sure you want to remove student from this course?</h4>   
                              <button data-direction="next" class="rcourse btn btn-default steps_btn" value="<?=$course->Id;?>">Yes</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>
                    </div>
                </div>
										</div>
									</div>
								</div>
								<?php
							}
						?>	
					</div>
					<br>
				<!--	<h4>Test series:</h4>
					<div class="row">
						<?php 
							foreach ($tseries as $series) {
								?>
								<div class="col-md-3">
									<div class="card">
										<img class="card-img-top" src="<?=$series->Thumbnail;?>" alt="Card image" style="max-height: 150px;overflow: hidden;width: 100%;">
										<div class="card-body">
											<h4><?=$series->Title;?></h4>
                      <a href="#" class="text-danger" data-toggle="modal" data-target="#removeSeriesModal_<?=$series->Id;?>">Remove</a>
                      <div class="modal" id="removeSeriesModal_<?=$series->Id;?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-body">
                                        <h4>Are you sure you want to remove student from this test series?</h4>   
                              <button data-direction="next" class="rseries btn btn-default steps_btn" value="<?=$series->Id;?>">Yes</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>
                    </div>
                </div>
										</div>
									</div>
								</div>
								<?php
							}
						?>
					</div>-->
				</div>
			  	<div class="tab-pane container-fluid fade" id="fees">
			  		<div class="row">
			  			<div class="col-md-12 text-right">
			  				<button class="steps_btn" data-toggle="modal" data-target="#feeModal">Add fees</button>
			  				<br><br>
			  			</div>
			  		</div>
			  		        <div class="modal" id="feeModal">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                <div class="modal-header">
                                <h3>Add Fees</h3>
                              </div>
                              <div class="modal-body">
                		<div class="row justify-content-md-center">
							<div class="col-12">
								   <div class="ui search focus mt-30 lbel25">
					              <label>Select batches</label>
					              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="batch">
					              	<option value="">select batch</option>
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
											<label>Fees</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title" id="bfees" value="0">									
											</div>
										</div>
									 <div class="row">
                  <div class="col-md-4">
                    <div class="ui search focus mt-30 lbel25">
                    	<label>Discount</label>
                      <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="dtype" style="min-width: 100% !important;">
                        <option value="&#8377;">&#8377;</option>
                        <option value="%">%</option>             
                      </select>
                    </div>
                  </div>
              <div class="col-md-8">
              	<label>&nbsp;</label>
                <div class="ui search focus mt-30 lbel25">
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="number" placeholder="" name="title" data-purpose="edit-course-title"  id="discount" value="0">                  
                  </div>
                </div>
                  </div>
                </div>
                <div class="ui search focus mt-30 lbel25">
                	<label>Total Fees</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="number" placeholder="" name="title" data-purpose="edit-course-title"  id="tfees" value="0" disabled>         
                  </div>
                </div> 
									<div class="ui search focus mt-30 lbel25">
											<label>Amount paid</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title" id="apaid">									
											</div>
										</div>
										<div class="ui search focus lbel25 mt-30">
						                    <label>Payment Method</label>
						                    <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="pmethod">
						                        <?php
						                        foreach ($pmethod as $method) {
						                          ?>
						                          <option value="<?=$method->Id;?>"><?=$method->PaymentCategory;?></option>
						                          <?php
						                        }
						                        ?>
						                    </select>
						                 </div>
										<div class="ui search focus mt-30 lbel25">
											<label>Amount remaining</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title" id="aremaining" value="0" disabled>									
											</div>
										</div>
									
									<div class="ui search focus mt-30 lbel25">
											<label>No of installments</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title" id="noi" value="1">									
											</div>
										</div>
									
										<div class="ui search focus mt-30 lbel25">
											<label>Installment amount</label>
											<div class="ui left icon input swdh19">
												<input class="prompt srch_explore" type="number" name="title" data-purpose="edit-course-title" id="iamount" value="0">									
											</div>
										</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Installment Type</label>
									<select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="itype">
					                <option value="Monthly">Monthly</option>    
					                <option value="Weekly">Weekly</option>        
					              	</select>
								</div>
								 <?php
                          date_default_timezone_set('Asia/Kolkata');
                          $date=date("Y-m-d");
                      ?>
								<div class="ui search focus mt-30 lbel25">
									<label>Installment date</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="date" name="title" data-purpose="edit-course-title" id="idate" value="<?=$date;?>">				
									</div>
								</div>	
						</div>		
						</div>
            <br>
            <div id="fmsg"></div>
            <button data-direction="next" class="steps_btn" id="addfee" value="<?=$student[0]->Id;?>">Add</button> 
      </div>
          </div>
        </div>
      </div>
			  		<div class="card">
			  			<div class="card-body">
			  				<div class="row">

                      <div class="col-md-2 col-6">
                        <div class="alert alert-primary">
                         	<b>Total(Rs.)</b>
                          <h3><?=($paid+$unpaid+$unclear);?></h3>
                      	</div>
                      </div>
                      <div class="col-md-2 col-6">
                        <div class="alert alert-success">
                          <b>Received(Rs.)</b>
                          <h3><?=$paid;?></h3>
                        </div>
                      </div>
                      <div class="col-md-2 col-6">
                        <div class="alert alert-warning">
                          <b>Uncleared(Rs.)</b>
                          <h3><?=$unclear;?></h3>
                      </div>
                    </div>
                      <div class="col-md-2 col-6">
                        <div class="alert alert-danger">
                          <b>Balanced(Rs.)</b>
                          <h3><?=$unpaid;?></h3>
                        </div>
                      </div>
                    </div><br>
			  				     <h4 style="color: green;">Paid</h4><br>
                    
                      <?php
                      $i=0;
                          foreach ($fees as $row) {
                           if($row->PaymentStatus=="Paid" && $row->Amount==$row->AmountPaid){
                              ?>
                              <div class="row">
                              	<div class="col-md-8">
                         <h4>Rs. <?=$row->Amount;?></h4>
                                <p> Paid on <?=$row->PaymentDate;?>
                                </p>
                             <!--     <a href="#" data-toggle="modal" data-target="#deletemodal_<?php echo $row->Id;?>"><i class="fa fa-envelope" aria-hidden="true"></i> Email</a>
                                 &nbsp;<a href="#" data-toggle="modal" data-target="#deletemodal_<?php echo $row->Id;?>"><i class="fas fa-sms"></i> SMS</a> -->
                              
                        </div>
                        <div class="col-md-4">
                                 <a href="#" data-toggle="modal" data-target="#feditmodal_<?php echo $row->Id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>&nbsp;
                                 <a href="#" data-toggle="modal" data-target="#fdeleteModal_<?php echo $row->Id;?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </div>
                    </div>
                             <hr>
                            <div class="modal" id="fdeleteModal_<?=$row->Id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <h3>Are you sure you want to delete?</h3>
                                    <button data-direction="next" class="deletefees btn btn-default steps_btn" value="<?=$row->Id;?>">Delete</button> 
                                  </div>
                                </div>
                              </div>
                            </div>
                              <?php
                           }
                           $i++;
                          }
                          
                       ?>
                   <h4 style="color: red;">Unpaid</h4><br>
                    
                      <?php
                          foreach ($fees as $row) {
                           if($row->PaymentStatus=="Paid" && $row->Amount!=$row->AmountPaid){
                              ?>
                              <div class="row">
                              	<div class="col-md-9">
                                  <h4>Rs. <?=$row->Amount;?> (<?=$row->AmountPaid;?> Rs. Paid)</h4>
                                  <p> Due on <?=$row->PaymentDate;?></p>
                                </div>
                                <div class="col-md-3">
                                  <p>
                                    <a href="#" data-toggle="modal" data-target="#editmodal_<?php echo $row->Id;?>"><i class="fas fa-money-bill-alt"></i> Pay</a>&nbsp;&nbsp;
                                     <a href="#" data-toggle="modal" data-target="#feditmodal_<?php echo $row->Id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#deletemodal_<?php echo $row->Id;?>"><i class="fas fa-trash"></i> Delete</a>
                                  </p>
                                </div>
                              </div>
                              <hr>
                              <?php
                           }
                           else if($row->PaymentStatus=="Unpaid"){
                            
                              ?>
                              <div class="row">
                              	<div class="col-md-9">
                                  <h4>Rs. <?=$row->Amount;?></h4>
                                  <p><?=$row->Amount;?> Due on <?=$row->PaymentDate;?></p>
                                </div>
                                <div class="col-md-3">
                                  <p>
                                    <a href="#" data-toggle="modal" data-target="#editmodal_<?php echo $row->Id;?>"><i class="fas fa-money-bill-alt"></i> Pay</a>&nbsp;&nbsp;
                                     <a href="#" data-toggle="modal" data-target="#feditmodal_<?php echo $row->Id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#deletemodal_<?php echo $row->Id;?>"><i class="fas fa-trash"></i> Delete</a>
                                  </p>
                                </div>
                              </div>
                             <hr>
                            <?php
                           }
                          }
                          
                       ?>
                         <h4 style="color: yellow;">Unclear</h4><br>
                    
                      <?php
                          foreach ($fees as $row) {
                           if($row->PaymentStatus=="Unclear"){
                              ?>
                              <div class="alert">
                         <h4>Rs. <?=$row->Amount;?>
                           <?php
                           if ($row->AmountUnclear>0) {
                             ?>
                             (<?=$row->AmountUnclear;?> Rs. Unclear)
                             <?php
                           }
                           ?>
                         </h4>
                                <p><?=$row->Amount;?> Due on <?=$row->PaymentDate;?> created on <?=$row->CreatedAt;?></p>
                                <p>
                                   <a href="#" data-toggle="modal" data-target="#editmodal_<?php echo $row->Id;?>"><i class="fas fa-money-bill-alt"></i> Pay</a>&nbsp;&nbsp;
                                     <a href="#" data-toggle="modal" data-target="#feditmodal_<?php echo $row->Id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>&nbsp;&nbsp;
                                 &nbsp;<a href="#" data-toggle="modal" data-target="#deletemodal_<?php echo $row->Id;?>"><i class="fas fa-trash"></i> Delete</a>


                                </p>
                        </div>
                             <hr>
                            
                              <?php
                           }
                          }
             ?>
			  			</div>
			  		</div>
			  	</div>
			  	<div class="tab-pane container-fluid" id="attendance">
			  		
			  	</div>
			  	<div class="tab-pane container-fluid" id="assignments">
			  		
			  	</div>
			</div>
		</div>
	</div>
</div>
  <?php
      foreach ($fees as $row) {
        ?>
         <div class="modal" id="fdeleteModal_<?=$row->Id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <h3>Are you sure you want to delete?</h3>
                                    <button data-direction="next" class="deletefees btn btn-default steps_btn" value="<?=$row->Id;?>">Delete</button> 
                                  </div>
                                </div>
                              </div>
                            </div>
                           
        <?php
       if($row->PaymentStatus=="Paid"){
          ?>
                           
       <div class="modal" id="editmodal_<?=$row->Id;?>">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Fee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

                      <!-- Modal body -->
                <div class="modal-body">
                  <div class="ui search focus lbel25 mt-30">
                  <label>Installment Amount</label>
                  <div class="ui left icon input swdh19">           
                      <input type="text" class="prompt srch_explore" name="iamount" disabled id="piamount_<?=$row->Id;?>" value="<?=$row->Amount;?>">
                    </div>
                  </div>
                    <div class="ui search focus lbel25 mt-30">
                    <label>Amount remaining</label>
                    <div class="ui left icon input swdh19">
                      <input type="text" class="prompt srch_explore" disabled name="parmount" id="paremaining_<?=$row->Id;?>" value="<?=($row->Amount)-($row->AmountPaid);?>">
                    </div>
                  </div>   
                    <div class="ui search focus lbel25 mt-30">
                    <label>Amount</label>
                    <div class="ui left icon input swdh19">
                      <input type="text" class="prompt srch_explore" name="pamount" id="ppamount_<?=$row->Id;?>">
                    </div>
                  </div>
                   <div class="ui search focus lbel25 mt-30">
                    <label>Payment status</label>
                      <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="ppstatus_<?=$row->Id;?>">
                         <option value="Paid" selected>Paid</option>
                        <option value="Unclear">Unclear</option>
                      </select>
                  </div>
                       <div class="ui search focus lbel25 mt-30">
                    <label>Payment Method</label>
                      <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="ppmethod_<?=$row->Id;?>">
                        <?php
                        foreach ($pmethod as $method) {
                          ?>
                          <option value="<?=$method->Id;?>" <?php if($method->Id==$row->Id) echo "selected"; ?>><?=$method->PaymentCategory;?></option>
                          <?php
                        }
                        ?>
                      </select>
                  </div>
                    <div class="ui search focus lbel25 mt-30">
                    <label>Postdated date(only if payment status is unclear)</label>
                    <div class="ui left icon input swdh19">
                      <input type="date" class="prompt srch_explore" name="ppdate" id="ppdate_<?=$row->Id;?>">
                    </div>
                  </div>
                  <div id="paidmsg_<?=$row->Id;?>"></div>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="updatepaid steps_btn" value="<?=$row->Id;?>">Update</button>
                      </div>

                    </div>
                  </div>
                  </div>

                              <?php
                           }
                           if($row->PaymentStatus=="Unpaid"){
                              ?>
                           
            <div id="editmodal_<?php echo $row->Id;?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
 
                <!-- Modal content-->
                <div class="modal-content">
                   <div class="modal-header">
                        <h4 class="modal-title">Pay Fees</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                         <div class="ui search focus lbel25 mt-30">
                    <label>Installment amount</label>
                    <div class="ui left icon input swdh19">
                      <input type="text" class="prompt srch_explore" name="iamount" disabled id="upiamount_<?=$row->Id;?>" value="<?=$row->Amount;?>">
                    </div>
                  </div>
                  <div class="ui search focus lbel25 mt-30">
                    <label>Amount remaining</label>
                    <div class="ui left icon input swdh19">
                      <input type="text" class="prompt srch_explore" name="iamount" disabled id="uparemaining_<?=$row->Id;?>" value="<?=($row->Amount)-($row->AmountPaid);?>">
                    </div>
                  </div>
              <div class="ui search focus lbel25 mt-30">
                    <label>Amount</label>
                    <div class="ui left icon input swdh19">
                      <input type="text" class="prompt srch_explore" name="pamount" id="uppamount_<?=$row->Id;?>">
                    </div>
                  </div>
                         <div class="ui search focus lbel25 mt-30">
                    <label>Payment status</label>
                    <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="uppstatus_<?=$row->Id;?>">
                        <option value="Paid">Paid</option>
                        <option value="Unclear">Unclear</option>
                      </select>
                  </div>
                    <div class="ui search focus lbel25 mt-30">
                    <label>Payment Method</label>
                    <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="uppmethod_<?=$row->Id;?>">
                         <?php
                        foreach ($pmethod as $method) {
                          ?>
                          <option value="<?=$method->Id;?>"><?=$method->PaymentCategory;?></option>
                          <?php
                        }
                        ?>
                      </select>
                  </div>
                  <div class="ui search focus lbel25 mt-30">
                    <label>Postdated date(only if payment status is unclear)</label>
                    <div class="ui left icon input swdh19">
                      <input type="date" class="prompt srch_explore" name="ppdate" id="uppdate_<?=$row->Id;?>">
                    </div>
                  </div>
                    
      </div>
       <div id="unpaidmsg_<?=$row->Id;?>"></div>
    </div>
      <div class="modal-footer">
        <button type="button" class="updateunpaid steps_btn" value="<?php echo $row->Id;?>">Update</button>
      </div>
    </div>

  </div>
</div>        
  <div id="deletemodal_<?php echo $row->Id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
       <h4>Are you sure?</h4> 
      </div>

      <div class="modal-footer">
        <button type="button" class="deletefees btn btn-success" value="<?php echo $row->Id;?>">Delete</button>
      </div>
    </div>

  </div>
</div>  
                              <?php
                           }   
                        if($row->PaymentStatus=="Unclear"){
                              ?>
                           
                <div class="modal" id="editmodal_<?=$row->Id;?>">
                    <div class="modal-dialog">
                      <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Fees</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                          <div class="ui search focus lbel25 mt-30">
                    <label>Installment amount</label>
                    <div class="ui left icon input swdh19">
                      <input type="text" class="prompt srch_explore" name="iamount" disabled id="uciamount_<?=$row->Id;?>" value="<?=$row->Amount;?>">
                    </div>
                  </div>
                     <div class="ui search focus lbel25 mt-30">
                    <label>Amount remaining</label>
                    <div class="ui left icon input swdh19">
                      <input type="text" class="prompt srch_explore" name="iamount" disabled id="ucaremaining_<?=$row->Id;?>" value="<?=($row->Amount)-($row->AmountPaid);?>">
                    </div>
                  </div>
              <div class="ui search focus lbel25 mt-30">
                    <label>Amount unclear</label>
                    <div class="col-md-9">
                      <input type="text" class="prompt srch_explore" disabled name="pamount" id="ucpamount_<?=$row->Id;?>" value="<?=$row->AmountUnclear;?>">
                    </div>
                  </div>
                         <div class="ui search focus lbel25 mt-30">
                    <label>Payment status</label>
                     <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="ucpstatus_<?=$row->Id;?>">
                        <option value="Paid">Paid</option>
                         <option value="Unpaid" >Unpaid</option>
                      </select>
                  </div>
                    <div class="ui search focus lbel25 mt-30">
                    <label>Payment Method</label>
                    <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="ucpmethod_<?=$row->Id;?>">
                         <?php
                        foreach ($pmethod as $method) {
                          ?>
                          <option value="<?=$method->Id;?>" <?php if($method->Id==$row->Id) echo "selected"; ?>><?=$method->PaymentCategory;?></option>
                          <?php
                        }
                        ?>
                      </select>
                  </div>
                    <div class="ui search focus lbel25 mt-30">
                    <label>Postdated date(only if payment status is unclear)</label>
                    <div class="ui left icon input swdh19">
                      <input type="date" class="prompt srch_explore" name="ppdate" id="ucpdate_<?=$row->Id;?>" value="<?=$row->PostDate;?>">
                    </div>
                  </div>
                   <div id="unclearmsg_<?=$row->Id;?>">
                   </div>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="updateunclear steps_btn" value="<?php echo $row->Id;?>">Update</button>
     </div>

                    </div>
                  </div>
                  </div>
                              <?php
                           }
                           ?>
            <div id="feditmodal_<?php echo $row->Id;?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Fees</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                         <div class="ui search focus lbel25 mt-30">
                    <label>Installment amount</label>
                    <div class="ui left icon input swdh19">
                      <input type="text" class="prompt srch_explore" name="iamount"  id="pfiamount_<?=$row->Id;?>" value="<?=$row->Amount;?>">
                    </div>
                  </div>
                  <div class="ui search focus lbel25 mt-30">
                    <label>Installment date</label>
                    <div class="ui left icon input swdh19">
                      <input type="date" class="prompt srch_explore" name="ppdate" value="<?=$row->PaymentDate;?>" id="idate_<?=$row->Id;?>">
                    </div>
                  </div>
                    
      </div>
       <div id="unpaidmsg_<?=$row->Id;?>"></div>
    </div>
      <div class="modal-footer">
        <button type="button" class="editfees steps_btn" value="<?php echo $row->Id;?>">Update</button>
      </div>
    </div>

  </div>
</div>       
                           <?php
                          }
                       
                          
                       ?> 
<script type="text/javascript">
  $('.nav-link').click(function(){
    var type=$(this).attr('href');
     var studid='<?=$student[0]->Id;?>';
    if(type=="#attendance"){
       $(type).load('<?=base_url();?>admin/student/student_attendance/'+studid);
    }
    if(type=="#assignments"){
       $(type).load('<?=base_url();?>admin/student/student_assignments/'+studid);
    }
    if(type=="#tests"){
       $(type).load('<?=base_url();?>admin/student/student_tests/'+studid);
    }
  });
  $('.rcourse').click(function() {
      var cid=$(this).val();
      var sid='<?=$student[0]->Id;?>';
      $.ajax({
          url: "<?= base_url()?>admin/student/removecourse",
          data: {sid:sid,cid:cid},
          type: "post",
          success:function(data)
          {
              swal("Remove from course successfully!", "", "success");
              setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
    });
    //console.log(cname);
  });
  $('.rseries').click(function() {
      var tid=$(this).val();
      var sid='<?=$student[0]->Id;?>';
      $.ajax({
          url: "<?= base_url()?>admin/student/removeseries",
          data: {sid:sid,tid:tid},
          type: "post",
          success:function(data)
          {
              swal("Remove from series successfully!", "", "success");
              setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
    });
    //console.log(cname);
  });
  $('#addcourse').click(function() {
      var cid=$('#course').val();
      var access =[];
      $('input[name="access"]:checked').each(function(){
        access.push($(this).val());
      })
      var sid='<?=$student[0]->Id;?>';
      $.ajax({
          url: "<?= base_url()?>admin/student/addcourse",
          data: {sid:sid,cid:cid,access:access},
          type: "post",
          success:function(data)
          {
              swal("Course added successfully!", "", "success");
              setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
    });
    //console.log(cname);
  });
  $('#addseries').click(function() {
      
      var tid=$('#series').val();
      var sid='<?=$student[0]->Id;?>';
      $.ajax({
          url: "<?= base_url()?>admin/student/addseries",
          data: {sid:sid,tid:tid},
          type: "post",
          success:function(data)
          {
              swal("Test series added successfully!", "", "success");
              setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
    });
    //console.log(cname);
  });
	$(".update").click(function(){
    var id=$(this).val();
    var fname=$('#gfname_'+id).val();
    var mname=$('#gmname_'+id).val();
    var lname=$('#glname_'+id).val();
    var phone=$('#gphone_'+id).val();
    var email=$('#gemail_'+id).val();
    var addressing=$('#addressing_'+id).val();
    var occupation=$('#occupation_'+id).val();
    var relation=$("input[name='relation_"+id+"']:checked").val();
    $.ajax({
        url: "<?=base_url()?>admin/student/updateparent",
        data: {id:id,fname:fname,mname:mname,lname:lname,phone:phone,email:email,occupation:occupation,relation:relation,addressing:addressing},
        type: "post",
        dataType:'json',
        success: function(data){
          if(data.code=="200"){
          $('#gmsg_'+id).html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>');
          location.reload();
        }
        else{
           $('#gmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
           }
      }
    });
});
	   $(".pdelete").click(function(){
    $id=$(this).val();
    $.ajax({
        url: "<?=base_url()?>admin/student/deleteparent",
        data: {id:$id},
        type: "post",
        success: function(data){
          location.reload();
      }
    });
});
	$("#addparents").click(function(){
	var formData = new FormData();
  var fname=$('#gfname').val();
  var mname=$('#gmname').val();
  var lname=$('#glname').val();
  var email=$('#gemail').val();
  var phone=$('#gphone').val();
  var occupation=$('#occupation').val();
  var addressing=$('#addressing').val();
  var relation=$("input[name='relation']:checked").val();
  formData.append('fname', fname);
  formData.append('relation', relation);
  formData.append('mname', mname);
  formData.append('lname', lname);
  formData.append('email',email);
  formData.append('addressing', addressing);
  formData.append('phone', phone);
  formData.append('occupation', occupation);
  formData.append('studid',$(this).val());
  $.ajax({
    url: "<?= base_url()?>admin/student/addparents",
    data: formData,
    type: "post",
    headers: { 'IsAjax': 'true' },
    processData: false,
    contentType: false,
   	dataType: 'json',
    success:function(data)
    {
      if(data.code=="404"){
    		$('#gmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
    	}
    	else{
    		$('#gmsg').html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>');
         $('#gemail').val("");
          $('#gphone').val("");
          $('#gname').val("");
          var htmltext='<div class="card" style="border: 1px solid #e4eaec;"><div class="card-body"><div class="row"><div class="col-md-10"><h4>'+addressing+' '+fname+' '+mname+' '+lname+'('+relation+')</h4><p><i class="fa fa-envelope"></i>&nbsp;'+email+'&nbsp;&nbsp;<span><i class="fa fa-phone"></i>&nbsp;'+phone+'</span></p></div><div class="col-md-2"></div></div></div>';
          $('#parents').append(htmltext);
    		
      }
    }
	});
});
	$(function () {
        $('#sbatch').multiselect({
            //includeSelectAllOption: true
        });
    });
    $('#discount').on('input', function() {
  calculate();
});
$('body').on('change', '#dtype', function(){
  calculate();
});
$('body').on('change', '#bfees', function(){
  calculate();
});
$(document).ready(function() { 
      $("#apaid").change(function() { 
                var apaid=$('#apaid').val();
                var final=$('#tfees').val();
                var iamount=$('#iamount').val();
                  var aremaining=final-apaid;
                
                $('#aremaining').val(aremaining);
                console.log(aremaining);
               if(aremaining<iamount || iamount=="0"){
                
                  $('#iamount').val(aremaining);
                  $('#noi').val('1');
                }
                else{
                var iamount=$('#iamount').val();
                var aremaining=$('#aremaining').val();
                var famount=0;
                var count=(aremaining/iamount);
                
                $('#noi').val(Math.ceil(count));
                }

            }); 

    

            $("#iamount").change(function() { 
                var iamount=$('#iamount').val();
                var aremaining=$('#aremaining').val();
                var famount=0;
                var count=(aremaining/iamount);
                
                $('#noi').val(Math.ceil(count));
            }); 
           
           
        });
function calculate(){
    var fees=$('#bfees').val();
    var discount=$('#discount').val();
    var dtype=$('#dtype').val();
    var totalfees=0;
    if (dtype=="%") {
      totalfees=fees-(discount/100)*fees;
    }
    else{
      totalfees=fees-discount;
    }
    $('#tfees').val(totalfees);
    $('#apaid').val(totalfees);
    $('#aremaining').val(0);
    $('#iamount').val(0);
    $('#noi').val("0");
} 
$('#update').click(function() {
	  var formData = new FormData();
	  var fname=$('#fname').val();
	  var mname=$('#mname').val();
	  var lname=$('#lname').val();
	  var email=$('#email').val();
	  var password=$('#password').val();
	  var phone=$('#phone').val();
	  var dob=$('#dob').val();
	  var address=$('#address').val();
	  var city=$('#city').val();
	  var state=$('#state').val();
	  var pincode=$('#pincode').val();
	  var photo=$('input[name="photo"]').get(0).files[0];
	  var gender=$("input[name='gender']:checked"). val();
	  formData.append('fname', fname);
	  formData.append('gender', gender);
	  formData.append('mname', mname);
	  formData.append('lname', lname);
	  formData.append('email',email);
	  formData.append('password', password);
	  formData.append('phone', phone);
	  formData.append('dob', dob);
	  formData.append('address',address);
	  formData.append('city', city);
	  formData.append('pincode', pincode);
	  formData.append('photo', photo);
	  formData.append('sid', $(this).val());
	  formData.append('ephoto', '<?=$student[0]->Photo;?>');
	  $.ajax({
		url:"<?=base_url();?>admin/student/updatestudent",
        data: formData,
	    type: "post",
	    headers: { 'IsAjax': 'true' },
	    processData: false,
	    contentType: false,
	   	dataType: 'json',
        success:function(data)
        {
        	if(data.code=="404"){
        		$('#umsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
        	}
        	else{
        		$('#umsg').html('');
        		swal("Student updated successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.reload();
	          	}, 2000);
	        }
        }
	});
});

		$('body').on('click', '#assign', function(){ 
		var sid=$(this).val();
			  var sbatches = $("#sbatch option:selected");
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
	$(".updatepaid").click(function(){
    var id=$(this).val();
    var studid='<?=$student[0]->Id;?>';
    var pstatus=$('#ppstatus_'+id).val();
    var iamount=$('#piamount_'+id).val();
    var pamount=$('#ppamount_'+id).val();
    var pmethod=$('#ppmethod_'+id).val();
    var remaining=$('#paremaining_'+id).val();
    var pdate=$('#ppdate_'+id).val();
    $.ajax({
        url: "<?= base_url()?>admin/fees/updatefeestatus",
        data: {id:id,studid:studid,pstatus:pstatus,iamount:iamount,pamount:pamount,pmethod:pmethod,pdate:pdate,remaining:remaining},
        type: "post",
        dataType:'json',
        success: function(data){
          if(data.code=="200"){
          location.reload();
        }
        else{
          $('#paidmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
        }
      }
    });
   // alert('ok');
  
});

   $(".updateunpaid").click(function(){
    var id=$(this).val();
    var studid='<?=$student[0]->Id;?>';
    var pstatus=$('#uppstatus_'+id).val();
    var iamount=$('#upiamount_'+id).val();
    var pamount=$('#uppamount_'+id).val();
    var pmethod=$('#uppmethod_'+id).val();
    var pdate=$('#uppdate_'+id).val();
      var remaining=$('#uparemaining_'+id).val();
    $.ajax({
        url: "<?= base_url()?>admin/student/updatefeestatus",
        data: {id:id,studid:studid,pstatus:pstatus,iamount:iamount,pamount:pamount,pmethod:pmethod,pdate:pdate,remaining:remaining},
        type: "post",
        dataType:'json',
        success: function(data){
         if(data.code=="200"){
          location.reload();
            }
            else{
              $('#unpaidmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
            }
          }
        });
   // alert('ok');
  
});
      $(".editfees").click(function(){
    var id=$(this).val();
    var studid='<?=$student[0]->Id;?>';
    var iamount=$('#pfiamount_'+id).val();
    var pdate=$('#idate_'+id).val();
     // var remaining=$('#aremaining_'+id).val();
    $.ajax({
        url: "<?= base_url()?>admin/student/updatefees",
        data: {id:id,studid:studid,iamount:iamount,idate:pdate},
        type: "post",
        dataType:'json',
        success: function(data){
         if(data.code=="200"){
         location.reload();
        }
        else{
          $('#unpaidmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
        }
      }
    });
   // alert('ok');
  
});

  $(".updateunclear").click(function(){
    var id=$(this).val();
    var studid='<?=$student[0]->Id;?>';
    var pstatus=$('#ucpstatus_'+id).val();
    var iamount=$('#uciamount_'+id).val();
    var pamount=$('#ucpamount_'+id).val();
      var remaining=$('#paremaining_'+id).val();
    var pmethod=$('#ucpmethod_'+id).val();
    var pdate=$('#ucpdate_'+id).val();
      var remaining=$('#ucaremaining_'+id).val();
    $.ajax({
        url: "<?= base_url()?>admin/student/updatefeestatus",
        data: {id:id,studid:studid,pstatus:pstatus,iamount:iamount,pamount:pamount,pmethod:pmethod,pdate:pdate,remaining:remaining},
        type: "post",
        dataType:'json',
        success: function(data){
          if(data.code=="200"){
          location.reload();
        }
        else{
          $('#unclearmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
        }
      }
    });
   // alert('ok');
  
});
 $("#batch").change(function(){
    var id=$(this).val();
    $.ajax({
        url: "<?= base_url()?>admin/batch/fetchbatch",
        data: {id:id},
        type: "post",
        dataType:'json',
        success: function(data){
        	console.log("ok");
          $('#bfees').val(data.Price);
          $('#apaid').val(data.Price);
          $('#tfees').val(data.Price);
          $('#aremaining').val("0");
          $('#noi').val("0");
          $('#iamount').val("0");
      }
    });
   // alert('ok');
  
});
 $(document).ready(function() { 
      $("#apaid").change(function() { 
                var apaid=$('#apaid').val();
                var final=$('#tfees').val();
                var iamount=$('#iamount').val();
                  var aremaining=final-apaid;
                
                $('#aremaining').val(aremaining);
               if(aremaining<iamount || iamount=="0"){
                
                  $('#iamount').val(aremaining);
                  $('#noi').val('1');
                }
                else{
                var iamount=$('#iamount').val();
                var aremaining=$('#aremaining').val();
                var famount=0;
                var count=(aremaining/iamount);
                
                $('#noi').val(Math.ceil(count));
                }

            }); 

    
            $("#noi").change(function() { 
                //var iamount=$('#iamount').val();
                var aremaining=$('#aremaining').val();
                var famount=0;
                var noi = $('#noi').val();
                var iamount=(parseInt(aremaining)/parseInt(noi));
                
                $('#iamount').val(iamount);
            }); 

            $("#iamount").change(function() { 
                var iamount=$('#iamount').val();
                var aremaining=$('#aremaining').val();
                var famount=0;
                var count=(aremaining/iamount);
                
                $('#noi').val(Math.ceil(count));
            }); 
           
           
        });
 $('#addfee').click(function(){
     var formData = new FormData();
      fees=$('#bfees').val();
      batch=$('#batch').val();
       tfees=$('#tfees').val();
      apaid=$('#apaid').val();
      aremaining=$('#aremaining').val();
      payment=$('#pmethod').val();
      iamount=$('#iamount').val();
      itype=$('#itype').val();
      noi=$('#noi').val();
      idate=$('#idate').val();
      var discount=$('#discount').val();
  var dtype=$('#dtype').val();
  if (dtype=="%") {
    discount=(discount/100)*tfees;
  }
  formData.append('batch', batch);
      formData.append('fees', fees);
      formData.append('tfees', tfees);
      formData.append('discount', discount);
      formData.append('apaid', apaid);
      formData.append('payment', payment);
      formData.append('aremaining', aremaining);
      formData.append('iamount', iamount);
      formData.append('itype', itype);
      formData.append('noi', noi);
      formData.append('idate', idate);
      formData.append('sid', '<?=$student[0]->Id;?>');
    $.ajax({
        url: "<?=base_url()?>admin/student/addfeesdetail",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data){
        if(data.code=="200"){
        	$('#fmsg').html('');
          swal("Fees added successfully!", "", "success");
				    setTimeout(function () {
		              	swal.close();
		              	location.reload();
		          	}, 2000);
        }
        else{
           $('#fmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
        }

      }
    });
 // alert('ok');
    
  });
  $('#activate').click(function() {
      var sid='<?=$student[0]->Id;?>';
      $.ajax({
          url: "<?= base_url()?>admin/student/unblockstudent",
          data: {sid:sid},
          type: "post",
          success:function(data)
          {
              swal("Student unblock successfully!", "", "success");
              setTimeout(function () {
                  swal.close();
                  location.href="<?=base_url();?>admin/student";
              }, 2000);
          }
    });
    //console.log(cname);
  });
  $('#archive').click(function() {
      var sid='<?=$student[0]->Id;?>';
      $.ajax({
          url: "<?= base_url()?>admin/student/blockstudent",
          data: {sid:sid},
          type: "post",
          success:function(data)
          {
              swal("Student block successfully!", "", "success");
              setTimeout(function () {
                  swal.close();
                  location.href="<?=base_url();?>admin/student";
              }, 2000);
          }
    });
    //console.log(cname);
  });
    $('.deletefees').click(function() {
      var fees_id=$(this).val();
      $.ajax({
          url: "<?= base_url()?>admin/student/deletefees",
          data: {fees_id:fees_id},
          type: "post",
          success:function(data)
          {
              swal("Data deleted successfully!", "", "success");
              setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
    });
    //console.log(cname);
  });
  $('.copylink').click(function(){
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val("<?=base_url();?>institute/<?=$student[0]->FirstName;?>").select();
    document.execCommand("copy");
    $temp.remove();
  })
</script>