<div class="container-fluid">
	<?php 
	$student_id = 0;
	$from_date ='';
	$to_date='';
	if(isset($_GET['student_id'])){
		$student_id = $_GET['student_id'];
	}
	if(isset($_GET['from_date'])){
		$from_date = $_GET['from_date'];
	}
	if(isset($_GET['to_date'])){
		$to_date = $_GET['to_date'];
	}

	?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-1">
							<img src="https://acceronclass.classblue.in/public/assets/images/student.png" style="width:100%;">
						</div>
						<div class="col-md-7">
							<h4><?=$batch[0]->Name;?></h4>
							<p><span><i class="fas fa-calendar"></i>&nbsp;<?=$batch[0]->CreatedAt;?></span></p>
						</div>
						<div class="col-md-4 text-center">
							<!--
							<button data-direction="next" class="btn btn-default steps_btn" data-toggle="modal" data-target="#courseModel" style="margin-bottom: 5px;">&nbsp; &nbsp;Add Course &nbsp; &nbsp;</button>
							<button data-direction="next" class="btn btn-default steps_btn" data-toggle="modal" data-target="#seriesModel" style="margin-bottom: 5px;">Add Test Series</button>-->
							<a href="<?=base_url();?>admin/batch/addstudents/<?=$batch[0]->Id;?>" style="padding-top: 10px !important;" class="btn btn-default steps_btn">Add students</a>
							<?php 
							if ($batch[0]->IsArchive==1) {
								?>
								<button data-direction="next" class="btn btn-default steps_btn" data-toggle="modal" data-target="#rarchiveModal" style="margin-bottom: 5px;">Activate Batch</button>
								<div class="modal" id="rarchiveModal">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-body">
												<h4>Are you sure you want to activate this batch?</h4>   
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
								<!-- <button data-direction="next" class="btn btn-default steps_btn" data-toggle="modal" data-target="#archiveModal" style="margin-bottom: 5px;">Archive Batch</button>
								<div class="modal" id="archiveModal">
		                          	<div class="modal-dialog">
		                            	<div class="modal-content">
		                              		<div class="modal-body">
		                                		<h4>Are you sure you want to archive this batch?</h4>   
									            <button data-direction="next" class="btn btn-default steps_btn" id="archive">Yes</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
									      	</div>
								        </div>
								    </div>
								</div> -->
								<?php
							}
							?>
							<div class="modal" id="courseModel">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h3>Add Course</h3>
										</div>
										<div class="modal-body">
											<?php 
											$cids=explode(",", $batch[0]->CourseId);
											foreach($courses['courses'] as $course){
												?>
												<div class="row">
													<div class="col-2"><br>
														<input type="checkbox" name="courses" value="<?=$course->Id;?>" <?php if (in_array($course->Id, $cids)) { echo "selected"; }?>>
													</div>
													<div class="col-10">
														<div class="card">
															<div class="card-body">
																<div class="row">
																	<div class="col-4">
																		<img class="card-img" src="<?=$course->Cover_image;?>">
																	</div>
																	<div class="col-4">
																		<h4><?=$course->Title;?></h4>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
											?>   
											<button data-direction="next" class="btn btn-default steps_btn" id="addcourse">Add</button> 
										</div>
									</div>
								</div>
							</div>
							<div class="modal" id="seriesModel">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h3>Add Test Series</h3>
										</div>
										<div class="modal-body">
											<?php 
											$sids=explode(",", $batch[0]->SeriesId);
											foreach($series['mcqtests'] as $ser){
												?>
												<div class="row">
													<div class="col-2"><br>
														<input type="checkbox" name="series" <?php if (in_array($ser->Id, $sids)) { echo "selected"; }?> value="<?=$ser->Id;?>">
													</div>
													<div class="col-10">
														<div class="card">
															<div class="card-body">
																<div class="row">
																	<div class="col-4">
																		<img class="card-img" src="<?=$ser->Thumbnail;?>">
																	</div>
																	<div class="col-4">
																		<h4><?=$ser->Title;?></h4>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
											?>   
											<button data-direction="next" class="btn btn-default steps_btn" id="addseries">Add</button> 
										</div>
									</div>
								</div>
							</div>                <button class="btn btn-primary" data-toggle="modal" data-target="#transferModal">Transfer students</button>

						</div>
						<div id="transferModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>Select academic year</label>
											<select class="form-control" id="ayear">
												<option value="">Select academic year</option>
												<?php 
												foreach ($ayears as $ayear) {
													?>
													<option value="<?=$ayear->year_id;?>"><?=$ayear->academic_year;?></option>
													<?php
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Select course</label>
											<select class="form-control" id="tcourse_id">
												<option value="">Select course</option>
												<?php 
												foreach ($courses['courses'] as $course) {
													?>
													<option value="<?=$course->Id;?>"><?=$course->Title;?></option>
													<?php
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Select batch</label>
											<select class="form-control" id="tbatch_id">
												<option value="">Select batch</option>
												<?php 
												foreach ($abatches as $abatch) {
													?>
													<option value="<?=$abatch->Id;?>"><?=$abatch->Name;?></option>
													<?php
												}
												?>
											</select>
										</div>
										<div id="tmsg"></div>
										<button class="btn btn-primary" type="button" id="transfer" value="<?=$batch[0]->Id;?>">Transfer</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<style type="text/css">
				.nav-link.active{
					font-size: 14px !important;
					font-weight: 500 !important;
					font-family: 'Roboto', sans-serif !important;
					color: #fff !important;
					background: #06b87c !important;
					border-radius: 25px !important;
					border: 0 !important;
					height: 40px !important;
					padding-top: 10px;
				}
			</style><br>
			<div class="row">
				<div class="col-md-12 col-12">
					<ul class="nav nav-pills">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="pill" href="#students-tab">Students</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#lectures-tab">Lectures</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#woorksheet-tab">Worksheet</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#assignment-tab">Assignment</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#question-tab">Oral & Writing</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#exam-tab">Exam</a>
						</li>
					</ul>
				</div>
				
						
			</div>
			
			
			<br>
			<div class="tab-content">
				<div class="tab-pane active" id="students-tab">
					<div class="row">
						<div class="col-md-2 col-6">
							<div class="alert alert-primary text-center">
								<h3 id="total_student"><?=count($students);?></h3>
								<p>Total students</p>
							</div>
						</div>
						<div class="col-md-8 col-12"></div>
						<div class="col-md-2 col-6">
						<button id="students_btn" class="btn btn-success">Create Excel</button>
						</div>
					</div>
					<div class="card card-body" id="students_data">
						<table class="table table-stripped">
							<thead>
								<tr>
									<th>#</th>
									<th>Student Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Total Fees</th>
									<th>Paid Fees</th>
									<th>Unclear Fees</th>
									<th>Unpaid Fees</th>
								</tr>
							</thead>
							<tbody  id="filter_student">
								<?php 
								$i=0;
								//print_r($students);
								foreach ($students as $stud) {
									date_default_timezone_set('Asia/Kolkata');
									$date=date("h:i:sa");	
									?>
									<tr>
										<td><?=$i+1;?></td>
										<td><?=$stud->FirstName.' '.$stud->MiddleName.' '.$stud->LastName;?></td>
										<td><?=$stud->Email;?></td>
										<td><?=$stud->Phone;?></td>
										<td><?=$stud->total_fees;?></td>
										<td>
											<?php 
											if ($stud->paid_fees!="") {
												echo $stud->paid_fees;
											}
											?>
										</td>
										<td>
											<?php 
											if ($stud->unclear_fees!="") {
												echo $stud->unclear_fees;
											}
											?>
										</td>
										<td>
											<?php 
											if ($stud->paid_fees!="" && $stud->total_fees) {
												echo $stud->total_fees-$stud->paid_fees;
											}
											?>
										</td>
									</tr>
									<?php
									$i++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="lectures-tab">
					<div class="row">
						<div class="col-md-12">
							<div class="row justify-content-between">
							<div class="col-md-3 col-12">
								<div class="alert alert-primary text-center">
									<h3 id="total_lectures"><?=count($lectures);?></h3>
									<p>Total Lectures</p>
								</div>
							</div>
							<?php if (isset($_GET['student_id'])) {
								?>
								<div class="col-md-3 col-12">
								<div class="alert alert-success text-center">
									<h3 id="total_present">0</h3>
									<p>Total Present</p>
								</div>
							</div>
							<div class="col-md-3 col-12">
								<div class="alert alert-danger text-center">
									<h3 id="total_absent">0</h3>
									<p>Total Absent</p>
								</div>
							</div>
								<?php
							}
							?>
							
							<div class="col-md-2 col-12 ">
							<button id="lectures_btn" class="btn btn-success">Create Excel</button>
							</div>
							</div>
						</div>

						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>Select Subject</label>
									<select class="form-control" id="lsubject">
										<option value="">Select subject</option>
										<?php 
										foreach ($bsubjects as $sub) {
											?>
											<option value="<?=$sub->Id;?>"><?=$sub->Title;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>Select Topic</label>
									<select class="form-control" id="ltopic">
										<option value="">Select topic</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>Select Student</label>
									<select class="form-control" id="lstudent">
										<option value="">Select student</option>
										<?php 
										foreach ($students as $stud) {
											?>
											<option value="<?=$stud->Id;?>" <?php if($stud->Id==$student_id){ echo "selected"; } ?>><?=$stud->FirstName.' '.$stud->LastName;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>Start Date</label>
									<div class="input-group">

										<input type="date" class="form-control" value="" id="start_date">

									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>End Date</label>
									<div class="input-group">
										<!-- <i class="fa fa-calendar"></i>&nbsp;
											<span></span> <i class="fa fa-caret-down ml-1"></i>  -->
											<input type="date" class="form-control" value="" id="end_date">


											<div class="input-group-append">
												<button type="submit" class="btn btn-primary" id="lecture_filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card card-body" id="lectures_data">
							<table class="table table-stripped">
								<thead>
									<tr>
										<th>#</th>
										<th>Lecture Title</th>
										<th>Lecture Date</th>
										<th>Faculty</th>
										<th>Subject</th>
										<th>Topic</th>
									</tr>
								</thead>
								<tbody id="filter_lecture">
									<?php 
									$i=0;
									$present=0;
									$absent=0;
									date_default_timezone_set('Asia/Kolkata');
									foreach ($lectures as $lect) {
									// print_r($lect);
										date_default_timezone_set('Asia/Kolkata');
										$time=date("h:i:sa");
										$date=date("Y-m-d");
										?>
										<tr>
											<td><?=$i+1;?></td>
											<td><a href="<?=base_url();?>admin/course/lecture_attendance?lecture_id=<?=$lect->lecture_id;?>"><?=$lect->lecture_title;?></a>
												<?php
												     	if(isset($_GET['student_id'])){
                                		if($lect->attendance_id){
                                			if($lect->is_absent==1){
                                				$absent=$absent+1;
                                				echo '<span class="badge badge-danger">absent</span>';
                                			}
                                			else{
                                				$present=$present+1;
                                				echo'<span class="badge badge-success">present</span>';
                                			}
                                		}
                                	}
                                	?>
											</td>
											<td><?=$lect->lecture_date;?> &nbsp;&nbsp;<?=date('h:i A',strtotime($lect->start_time));?> - <?=date('h:i A',strtotime($lect->end_time));?></td>
											<td><?=$lect->FirstName.' '.$lect->LastName;?></td>
											<td><?=$lect->subject;?></td>
											<td><?=$lect->Topic;?></td>
										</tr>

										<?php
										$i++;
									}
									?>
								</tbody>
							</table>
						</div>
					</div>

				<div class="tab-pane" id="woorksheet-tab">
					<div class="row">
						<div class="col-md-12">
						<div class="row justify-content-between">
							<div class="col-md-3">
								<div class="alert alert-primary text-center">
									<h3 id="total_worksheet"><?=count($woorksheet);?></h3>
									<p>Total workheet</p>
								</div>
							</div>
							<?php if (isset($_GET['student_id'])) {
								?>
								<div class="col-md-3 col-12">
								<div class="alert alert-success text-center">
									<h3 id="worksheet_submit">0</h3>
									<p>Total Submitted</p>
								</div>
							</div>
							<div class="col-md-3 col-12">
								<div class="alert alert-danger text-center">
									<h3 id="worksheet_notsubmit">0</h3>
									<p>Total Not Submitted</p>
								</div>
							</div>
								<?php
							}
							?>


							<div class="col-md-2 col-12 ">
							<button id="woorksheet_btn" class="btn btn-success">Create Excel</button>
							</div>
							</div>

						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>Select Subject</label>
									<select class="form-control" id="wsubject">
										<option value="">Select subject</option>
										<?php 
										foreach ($bsubjects as $sub) {
											?>
											<option value="<?=$sub->Id;?>"><?=$sub->Title;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>Select Topic</label>
									<select class="form-control" id="wtopic">
										<option value="">Select topic</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>Select Student</label>
									<select class="form-control" id="wstudent">
										<option value="">Select student</option>
										<?php 
										foreach ($students as $stud) {
											?>
											<option value="<?=$stud->Id;?>" <?php if($stud->Id==$student_id){ echo "selected"; } ?>><?=$stud->FirstName.' '.$stud->LastName;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>Start Date</label>
									<div class="input-group">

										<input type="date" class="form-control" value="" id="wstart_date">

									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 my-3">
							<div class="card">
								<div class="card-body">
									<label>End Date</label>
									<div class="input-group">
									<!-- <i class="fa fa-calendar"></i>&nbsp;
										<span></span> <i class="fa fa-caret-down ml-1"></i>  -->
										<input type="date" class="form-control" value="" id="wend_date">


										<div class="input-group-append">
											<button type="submit" class="btn btn-primary" id="worksheet_filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body" id="woorksheet_data">
							<table class="table table-stripped">
								<thead>
									<tr>
										<th>#</th>
										<th>Worksheet Title</th>
										<th>Document</th>
										<th>Date</th>
										<th>Subject</th>
										<th>Topic</th>
									</tr>
								</thead>
								<tbody  id="filter_worksheet">
									<?php 
									$i=0;
									date_default_timezone_set('Asia/Kolkata');
									$w_submit=0;
									$w_nsubmit=0;
									foreach ($woorksheet as $ppt) {
									// print_r($ppt);
										date_default_timezone_set('Asia/Kolkata');
										$time=date("h:i:sa");
										$date=date("Y-m-d");
										?>
										<tr>
											<td><?=$i+1;?></td>
											<td><a  href="<?=base_url();?>admin/course/worksheet_submit?worksheet_id=<?=$ppt->worksheet_id;?>&batch_id=<?=$ppt->batch_id;?>"> <?=$ppt->worksheet_title;?></a>
														<?php
												     	if(isset($_GET['student_id'])){
                                		if($ppt->is_submitted){
                                			if($lect->is_submitted==1){
                                				$w_submit=$w_submit+1;
                                				//echo $w_submit;
                                				echo '<span class="badge badge-success">submitted</span>';
                                			}
                                			else{
                                				$w_nsubmit=$w_nsubmit+1;
                                			echo '<span class="badge badge-danger">not submitted</span>';
                                				}
                                		}
                                	}
                                	?>
											</td>
											<td><a href="<?=$ppt->worksheet_document;?>" download><i class="fas fa-file-download"></i> Document</a></td>
											<td><?=$ppt->submission_date;?></td>
											<td><?=$ppt->subject;?></td>
											<td><?=$ppt->Topic;?></td>
										</tr>


										<?php
										$i++;
									}
									?>
								</tbody>
							</table>
						</div>
					</div>	
				</div>	

							<div class="tab-pane" id="assignment-tab">
								<div class="row">
									<div class="col-md-12">
									<div class="row justify-content-between">
										<div class="col-md-3 col-6">
											<div class="alert alert-primary text-center">
												<h3 id="total_assignment"><?=count($assignment);?></h3>
												<p>Total Assignment</p>
											</div>
										</div>
										<?php if (isset($_GET['student_id'])) {
											?>
											<div class="col-md-3 col-12">
											<div class="alert alert-success text-center">
												<h3 id="assignment_submit">0</h3>
												<p>Total Submitted</p>
											</div>
										</div>
										<div class="col-md-3 col-12">
											<div class="alert alert-danger text-center">
												<h3 id="assignment_notsubmit">0</h3>
												<p>Total Not Submitted</p>
											</div>
										</div>
											<?php
										}
										?>
										
							<div class="col-md-2 col-12 ">
							<button id="assignment_btn" class="btn btn-success">Create Excel</button>
							</div>
							</div>
									</div>

									<div class="col-md-3 my-3">
										<div class="card">
											<div class="card-body">
												<label>Select Subject</label>
												<select class="form-control" id="asubject">
													<option value="">Select subject</option>
													<?php 
													foreach ($bsubjects as $sub) {
														?>
														<option value="<?=$sub->Id;?>"><?=$sub->Title;?></option>
														<?php
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-3 my-3">
										<div class="card">
											<div class="card-body">
												<label>Select Topic</label>
												<select class="form-control" id="atopic">
													<option value="">Select topic</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-3 my-3">
										<div class="card">
											<div class="card-body">
												<label>Select Student</label>
												<select class="form-control" id="astudent">
													<option value="">Select student</option>
													<?php 
													foreach ($students as $stud) {
														?>
														<option value="<?=$stud->Id;?>" <?php if($stud->Id==$student_id){ echo "selected"; } ?>><?=$stud->FirstName.' '.$stud->LastName;?></option>
														<?php
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-3 my-3">
										<div class="card">
											<div class="card-body">
												<label>Start Date</label>
												<div class="input-group">

													<input type="date" class="form-control" value="" id="astart_date">

												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3 my-3">
										<div class="card">
											<div class="card-body">
												<label>End Date</label>
												<div class="input-group">
										<!-- <i class="fa fa-calendar"></i>&nbsp;
											<span></span> <i class="fa fa-caret-down ml-1"></i>  -->
											<input type="date" class="form-control" value="" id="aend_date">


											<div class="input-group-append">
												<button type="submit" class="btn btn-primary" id="assignment_filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body" id="assignment_data">
								<table class="table table-stripped">
									<thead>
										<tr>
											<td>#</td>
											<td>Assignment Title</td>
											<td>Document</td>
											<td>Submission Date</td>
											<td>Subject</td>
											<td>Topic</td>
										</tr>	
									</thead>
									<tbody id="filter_assignment">
										
								<?php 
								$i=0;
								date_default_timezone_set('Asia/Kolkata');
								$a_submit=0;
									$a_nsubmit=0;
								foreach ($assignment as $ppt) {
									date_default_timezone_set('Asia/Kolkata');
									$time=date("h:i:sa");
									$date=date("Y-m-d");
									?>
									<tr>
										<td><?=$i+1;?></td>
										<td><a  href="<?=base_url();?>admin/course/assignment_submit?assignment_id=<?=$ppt->id;?>&batch_id=<?=$ppt->batch_id;?>" ><?=$ppt->assignment_title;?></a>
												<?php
												     	if(isset($_GET['student_id'])){
                                		if($ppt->is_submitted){
                                			if($ppt->is_submitted==1){
                                				$a_submit=$a_submit+1;
                                				echo'<span class="badge badge-success">submitted</span>';
                                			}
                                			else{
                                				$a_nsubmit=$a_nsubmit+1;
                                			echo '<span class="badge badge-danger">not submitted</span>';
                                				}
                                		}
                                	}
                                	?>
										</td>
										<td><a href="<?=$ppt->document_upload;?>"><i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; Document</a></td>
										<td><?=date("d-M-Y", strtotime($ppt->submission_date)); ?></td>
										<td><?=$ppt->subject;?></td>
										<td><?=$ppt->Topic;?></td>
									</tr>	

										<?php
										$i++;
									}
									?>
									</tbody>
								</table>
								</div>
							</div>	
						</div>
						<div class="tab-pane" id="question-tab">
							<div class="row">
								<div class="col-md-12">
								<div class="row justify-content-between">
									<div class="col-md-3 col-12">
										<div class="alert alert-primary text-center">
											<h3 id="total_question"><?=count($question);?></h3>
											<p>Total Oral & Writing</p>
										</div>
									</div>
									<?php if (isset($_GET['student_id'])) {
											?>
											<div class="col-md-3 col-12">
											<div class="alert alert-success text-center">
												<h3 id="qw_submit">0</h3>
												<p>Total Submitted</p>
											</div>
										</div>
										<div class="col-md-3 col-12">
											<div class="alert alert-danger text-center">
												<h3 id="qw_notsubmit">0</h3>
												<p>Total Not Submitted</p>
											</div>
										</div>
											<?php
										}
										?>
										
							<div class="col-md-2 col-12 ">
							<button id="question_btn" class="btn btn-success">Create Excel</button>
							</div>
							</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>Select Subject</label>
											<select class="form-control" id="qsubject">
												<option value="">Select subject</option>
												<?php 
												foreach ($bsubjects as $sub) {
													?>
													<option value="<?=$sub->Id;?>"><?=$sub->Title;?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>Select Topic</label>
											<select class="form-control" id="qtopic">
												<option value="">Select topic</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>Select Student</label>
											<select class="form-control" id="qstudent">
												<option value="">Select student</option>
												<?php 
												foreach ($students as $stud) {
													?>
													<option value="<?=$stud->Id;?>" <?php if($stud->Id==$student_id){ echo "selected"; } ?>><?=$stud->FirstName.' '.$stud->LastName;?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>Start Date</label>
											<div class="input-group">

												<input type="date" class="form-control" value="" id="qstart_date">

											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>End Date</label>
											<div class="input-group">
										<!-- <i class="fa fa-calendar"></i>&nbsp;
											<span></span> <i class="fa fa-caret-down ml-1"></i>  -->
											<input type="date" class="form-control" value="" id="qend_date">


											<div class="input-group-append">
												<button type="submit" class="btn btn-primary" id="question_filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body" id="question_data">
									<table class="table table-stripped">
									<thead>
										<tr>
											<td>#</td>
											<td>Title</td>
											<td>Document</td>
											<td>Submission Date</td>
											<td>Subject</td>
											<td>Topic</td>
										</tr>	
									</thead>
									<tbody id="filter_question">
								
								<?php 
								$i=0;
								date_default_timezone_set('Asia/Kolkata');
								$qw_submit=0;
									$qw_nsubmit=0;
								foreach ($question as $que) {
									date_default_timezone_set('Asia/Kolkata');
									$time=date("h:i:sa");
									$date=date("Y-m-d");
									?>
									<tr>
										<td><?=$i+1;?></td>
										<td><a  href="<?=base_url();?>admin/course/question_write_submit?question_id=<?=$que->question_id;?>&batch_id=<?=$que->batch_id;?>" ><?=$que->Title;?></a>
												<?php
												     	if(isset($_GET['student_id'])){
                                		if($que->is_submitted){
                                			if($que->is_submitted==1){
                                				$qw_submit=$qw_submit+1;
                                				echo'<span class="badge badge-success">submitted</span>';
                                			}
                                			else{
                                				$qw_nsubmit=$qw_nsubmit+1;
                                			echo '<span class="badge badge-danger">not submitted</span>';
                                				}
                                		}
                                	}
                                	?></td>
										<td><?=$que->Description;?></td>
										<td><?=date("d-M-Y", strtotime($que->qw_date)); ?></td>
										<td><?=$que->subject;?></td>
										<td><?=$que->Topic;?></td>
									</tr>
										<?php
										$i++;
									}
									?>
								</tbody>
							</table>
								</div>
							</div>	
						</div>	
						<div class="tab-pane" id="exam-tab">
							<div class="row">
								<div class="col-md-12">
								<div class="row justify-content-between">
									<div class="col-md-3 col-6">
										<div class="alert alert-primary text-center">
											<h3 id="total_exam"><?=count($exam);?></h3>
											<p>Total Exam</p>
										</div>
									</div>
									<?php if (isset($_GET['student_id'])) {
											?>
											<div class="col-md-3 col-12">
											<div class="alert alert-success text-center">
												<h3 id="exam_pass">0</h3>
												<p>Total Pass</p>
											</div>
										</div>
										<div class="col-md-3 col-12">
											<div class="alert alert-danger text-center">
												<h3 id="exam_fail">0</h3>
												<p>Total Fail</p>
											</div>
										</div>
											<?php
										}
										?>
										
							<div class="col-md-2 col-12 ">
							<button id="exam_btn" class="btn btn-success">Create Excel</button>
							</div>
							</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>Select Subject</label>
											<select class="form-control" id="esubject">
												<option value="">Select subject</option>
												<?php 
												foreach ($bsubjects as $sub) {
													?>
													<option value="<?=$sub->Id;?>"><?=$sub->Title;?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>Select Topic</label>
											<select class="form-control" id="etopic">
												<option value="">Select topic</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>Select Student</label>
											<select class="form-control" id="estudent">
												<option value="">Select student</option>
												<?php 
												foreach ($students as $stud) {
													?>
													<option value="<?=$stud->Id;?>" <?php if($stud->Id==$student_id){ echo "selected"; } ?>><?=$stud->FirstName.' '.$stud->LastName;?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>Start Date</label>
											<div class="input-group">

												<input type="date" class="form-control" value="" id="estart_date">

											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 my-3">
									<div class="card">
										<div class="card-body">
											<label>End Date</label>
											<div class="input-group">
										<!-- <i class="fa fa-calendar"></i>&nbsp;
											<span></span> <i class="fa fa-caret-down ml-1"></i>  -->
											<input type="date" class="form-control" value="" id="eend_date">


											<div class="input-group-append">
												<button type="submit" class="btn btn-primary" id="exam_filter"style="font-size: 19px;"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body" id="exam_data">
									<table class="table table-stripped">
									<thead>
										<tr>
											<td>#</td>
											<td>Title</td>
											<td>Exam Date</td>
											<td>Subject</td>
											<td>Topic</td>
											<?php
												     	if(isset($_GET['student_id'])){
												     		?>
												     		<td>Marks</td>
												     		<?php 
												     	}
												     	?>
										</tr>	
									</thead>
									<tbody id="filter_exam">
								
								<?php 
								$i=0;
								$pass=0;
								$fail=0;
								date_default_timezone_set('Asia/Kolkata');
								foreach ($exam as $exams) {
									date_default_timezone_set('Asia/Kolkata');
									$time=date("h:i:sa");
									$date=date("Y-m-d");
									?>
									<tr>
										<td><?=$i+1;?></td>
										<td><a  href="<?=base_url();?>admin/course/exam_result?exam_id=<?=$exams->exam_id;?>&batch_id=<?=$exams->batch_id;?>" ><?=$exams->Title;?></a>
													<?php
												     	if(isset($_GET['student_id'])){
                                		if($exams->marks){
                                			if($exams->marks>=$exams->passing_marks){
                                				$pass=$pass+1;
                                				echo'<span class="badge badge-success">pass</span>';
                                			}
                                			else{
                                				$fail=$fail+1;
                                			echo '<span class="badge badge-danger">fail</span>';
                                				}
                                		}
                                	}
                                	?>
										</td>
										<td><?=date("d-M-Y", strtotime($exams->exam_date)); ?> <?=$exams->start_time;?>-<?=$exams->end_time;?></td>
										<td><?=$exams->subject;?></td>
										<td><?=$exams->subject;?></td>
											<?php
												     	if(isset($_GET['student_id'])){
												     		if($exams->marks){
												     		?>
												     		<td><?=$exams->marks;?></td>
												     		<?php 
												     	}
												     	else{
												     		?>
												     		<td>-</td>
												     		<?php 
												     	}
												     	}
												     	?>
									</tr>
									
									<?php
									$i++;
								}
								?>
							</div>
						</div>	
					</div>	



				</div>
			</div>
		</div>
<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
		<script type="text/javascript">
			$('#total_present').html('<?=$present;?>');
			$('#total_absent').html('<?=$absent;?>');
			$('#worksheet_submit').html('<?=$present;?>');
			$('#worksheet_notsubmit').html('<?=$w_nsubmit;?>');
			$('#assignment_submit').html('<?=$a_submit;?>');
			$('#assignment_notsubmit').html('<?=$a_nsubmit;?>');
			$('#qw_submit').html('<?=$qw_submit;?>');
			$('#qw_notsubmit').html('<?=$qw_nsubmit;?>');
			$('#exam_pass').html('<?=$pass;?>');
			$('#exam_fail').html('<?=$fail;?>');
			$("#transfer").click(function(){
				$("#transfer").attr("disabled", true);
				$.ajax({
					url: "<?= base_url()?>admin/batch/transferstudents",
					data: {cid:$('#tcourse_id').val(),aid:$('#ayear').val(),bid: $('#tbatch_id').val(),id:$(this).val()},
					type: "post",
					dataType:"json",
					success: function(data){
						$("#transfer").attr("disabled", false);

						if(data.code=="200"){
							swal("Students transfer done successfully!", "", "success");
							setTimeout(function () {
								swal.close();
								location.reload();
							}, 3000);
						}
						else{
							$('#tmsg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
						}

					}
				});
			});
			$('#addcourse').click(function() {
				var courses=[];
				$('input[name="courses"]:checked').each(function(checkbox) {
					courses.push($(this).val());
				});
				var bid='<?=$batch[0]->Id;?>';
				$.ajax({
					url: "<?= base_url()?>admin/batch/addcourse",
					data: {bid:bid,cids:courses},
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
				var series=[];
				$('input[name="series"]:checked').each(function(checkbox) {
					series.push($(this).val());
				});
				var bid='<?=$batch[0]->Id;?>';
				$.ajax({
					url: "<?= base_url()?>admin/batch/addseries",
					data: {bid:bid,sids:series},
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
			$('#activate').click(function() {
				var bid='<?=$batch[0]->Id;?>';
				$.ajax({
					url: "<?= base_url()?>admin/batch/activatebatch",
					data: {bid:bid},
					type: "post",
					success:function(data)
					{
						swal("batch activated successfully!", "", "success");
						setTimeout(function () {
							swal.close();
							location.reload();
						}, 2000);
					}
				});
	  //console.log(cname);
	});
			$('#archive').click(function() {
				var bid='<?=$batch[0]->Id;?>';
				$.ajax({
					url: "<?= base_url()?>admin/batch/archivebatch",
					data: {bid:bid},
					type: "post",
					success:function(data)
					{
						swal("batch activated successfully!", "", "success");
						setTimeout(function () {
							swal.close();
							location.reload();
						}, 2000);
					}
				});
	  //console.log(cname);
	});

			$('#lecture_filter').click(function(){

				let start_date = document.querySelector("#start_date").value;
				let batch_id = '<?=$batch[0]->Id;?>';
				let end_date = document.querySelector("#end_date").value;

				var html = '';
				$.ajax({
					url: "<?= base_url()?>admin/batch/filter_lecture",
					data: {start_date:start_date,end_date:end_date,batch_id:batch_id,subject_id:$('#lsubject').val(),topic_id:$('#ltopic').val(),student_id:$('#lstudent').val()},
					type: "post",
					success: function(data){
				// console.log(data);
				// console.log(JSON.parse(data));
				var abab = JSON.parse(data);
				// console.log(abab.lectures.length);
				var total_lectures = abab.lectures.length;
				// html +=
				console.log(abab.lectures);
                                // '<option value="">Please choose an option</option>';
                                for (let i = 0; i < abab.lectures.length; i++) {


                                	html +='<tr>'+
                                	'<td>'+(i+1)+'</td>'+
                                	'<td><a href="<?=base_url();?>admin/course/lecture_attendance?lecture_id="'+abab.lectures[i].lecture_id+'">'+abab.lectures[i].subject+'</a>';
                                	if($('#lstudent').val()!=""){
                                		if(abab.lectures[i].attendance_id){
                                			if(abab.lectures[i].is_absent==1){
                                				html+='<span class="badge badge-danger">absent</span>';
                                			}
                                			else{
                                				html+='<span class="badge badge-success">present</span>';
                                			}
                                		}
                                	}

                                	html+='</td><td>'+abab.lectures[i].lecture_date+'  &nbsp;&nbsp;'+abab.lectures[i].start_time+' - '+abab.lectures[i].end_time+'</td><td>'+abab.lectures[i].FirstName+' '+abab.lectures[i].LastName+''+

                                	'</td>'+'<td>'+abab.lectures[i].subject+'</td>'+
                                	'<td>'+abab.lectures[i].Topic+'</td>'+
                                	'</tr>';

                                }
                                $("#filter_lecture").html(html);
                                $("#total_lectures").html(total_lectures);

                            }
                        });
			});
			$('#worksheet_filter').click(function(){
		// alert('hgfchgc');

		let start_date = document.querySelector("#wstart_date").value;
		let batch_id = '<?=$batch[0]->Id;?>';
		let end_date = document.querySelector("#wend_date").value;

		var html = '';
		$.ajax({
			url: "<?= base_url()?>admin/batch/filter_worksheet",
			data: {start_date:start_date,end_date:end_date,batch_id:batch_id,subject_id:$('#wsubject').val(),topic_id:$('#wtopic').val(),student_id:$('#wstudent').val()},
			type: "post",
			success: function(data){
			   // console.log(data);
			   // console.log(JSON.parse(data));
			   var abab = JSON.parse(data);
			   // console.log(abab.lectures.length);
			   var total_worksheet = abab.worksheet.length;
			   // html +=
							   // '<option value="">Please choose an option</option>';
							   for (let i = 0; i < abab.worksheet.length; i++) {


							//    html +='<div class="row">'+
							// 		   '<div class="col-9">'+
							// 		   '<h4><a href="<?=base_url();?>admin/course/lecture_attendance?lecture_id="'+abab.lectures[i].lecture_id+'">'+abab.lectures[i].Title+'</a></h4>'+

							// 			   '<p><span><i class="fas fa-clock"></i>'+abab.lectures[i].lecture_date+'  &nbsp;&nbsp;'+abab.lectures[i].start_time+' - '+abab.lectures[i].end_time+'</span> &nbsp;&nbsp;<span><i class="fas fa-user"></i> &nbsp;'+abab.lectures[i].FirstName+' '+abab.lectures[i].LastName+''+

							// 			   '</span></p>'+
							// 			   '<p>Topic:-'+abab.lectures[i].Topic+'</p>'+
							// 		   '</div>'+
							// 	   '</div>'	+
							// 	   '<hr>'	;
							html += '<tr>'+
                                	'<td>'+(i+1)+'</td>'+
							'<td><a  href="<?=base_url();?>admin/course/worksheet_submit?worksheet_id='+abab.worksheet[i].worksheet_id+'&batch_id='+abab.worksheet[i].batch_id+'"> <h4 class="card-title"> '+abab.worksheet[i].worksheet_title+'</h4>';
							if($('#wstudent').val()!=""){
								if(abab.worksheet[i].is_submitted){
									if(abab.worksheet[i].is_submitted==0){

										html+='<span class="badge badge-danger">not submitted</span>';
									}
									else{

										html+='<span class="badge badge-success">submitted</span>';
									}
								}	
							}						
							html+='</a></td>'+
							'<td><a href="'+abab.worksheet[i].worksheet_document+'" download><i class="fas fa-file-download"></i> Document</a></td><td>'+abab.worksheet[i].submission_date+'</td>'+
							'<td>'+abab.worksheet[i].subject+'</td>'+
							'<td>'+abab.worksheet[i].Topic+'</td>'+

							'</tr>';

						}
						$("#filter_worksheet").html(html);
						$("#total_worksheet").html(total_worksheet);

					}
				});
	});
			$('#assignment_filter').click(function(){

				let start_date = document.querySelector("#astart_date").value;
				let batch_id = '<?=$batch[0]->Id;?>';
				let end_date = document.querySelector("#aend_date").value;

				var html = '';
				$.ajax({
					url: "<?= base_url()?>admin/batch/filter_assignment",
					data: {start_date:start_date,end_date:end_date,batch_id:batch_id,subject_id:$('#asubject').val(),topic_id:$('#atopic').val(),student_id:$('#astudent').val()},
					type: "post",
					success: function(data){
			   // console.log(data);
			   // console.log(JSON.parse(data));
			   var abab = JSON.parse(data);
			   // console.log(abab.lectures.length);
			   var total_assignment = abab.assignment.length;
			   // html +=
							   // '<option value="">Please choose an option</option>';
							   for (let i = 0; i < abab.assignment.length; i++) {


							//    html +='<div class="row">'+
							// 		   '<div class="col-9">'+
							// 		   '<h4><a href="<?=base_url();?>admin/course/lecture_attendance?lecture_id="'+abab.lectures[i].lecture_id+'">'+abab.lectures[i].Title+'</a></h4>'+

							// 			   '<p><span><i class="fas fa-clock"></i>'+abab.lectures[i].lecture_date+'  &nbsp;&nbsp;'+abab.lectures[i].start_time+' - '+abab.lectures[i].end_time+'</span> &nbsp;&nbsp;<span><i class="fas fa-user"></i> &nbsp;'+abab.lectures[i].FirstName+' '+abab.lectures[i].LastName+''+

							// 			   '</span></p>'+
							// 			   '<p>Topic:-'+abab.lectures[i].Topic+'</p>'+
							// 		   '</div>'+
							// 	   '</div>'	+
							// 	   '<hr>'	;

							html +='<tr>'+
							'<td>'+(i+1)+'</td>'+
							'<td><a  href="<?=base_url();?>admin/course/assignment_submit?assignment_id='+abab.assignment[i].id+'&batch_id='+abab.assignment[i].batch_id+'" >'+

							'<h4 class="card-title"> '+abab.assignment[i].assignment_title+'</h4></a>';
							if($('#astudent').val()!=""){
								if(abab.assignment[i].is_submitted){
									if(abab.assignment[i].is_submitted==0){

										html+='<span class="badge badge-danger">not submitted</span>';
									}
									else{

										html+='<span class="badge badge-success">submitted</span>';
									}
								}
							}						
							html+='</td><td><a href="'+abab.assignment[i].document_upload+'" download><i class="fas fa-file-download"></i> Document</a></td><td>'+abab.assignment[i].submission_date+' </td>'+
							'<td>'+abab.assignment[i].subject+'</td>'+
							'<td>'+abab.assignment[i].Topic+'</td>'+
							'</tr>';

						}
						$("#filter_assignment").html(html);
						$("#total_assignment").html(total_assignment);

					}
				});
			});
			$('#question_filter').click(function(){

				let start_date = document.querySelector("#qstart_date").value;
				let batch_id = '<?=$batch[0]->Id;?>';
				let end_date = document.querySelector("#qend_date").value;

				var html = '';
				$.ajax({
					url: "<?= base_url()?>admin/batch/filter_question",
					data: {start_date:start_date,end_date:end_date,batch_id:batch_id,subject_id:$('#qsubject').val(),topic_id:$('#qtopic').val(),student_id:$('#qstudent').val()},
					type: "post",
					success: function(data){
			   // console.log(data);
			   // console.log(JSON.parse(data));
			   var abab = JSON.parse(data);
			   // console.log(abab.lectures.length);
			   var total_question = abab.question.length;
			   // html +=
							   // '<option value="">Please choose an option</option>';
							   for (let i = 0; i < abab.question.length; i++) {


							//    html +='<div class="row">'+
							// 		   '<div class="col-9">'+
							// 		   '<h4><a href="<?=base_url();?>admin/course/lecture_attendance?lecture_id="'+abab.lectures[i].lecture_id+'">'+abab.lectures[i].Title+'</a></h4>'+

							// 			   '<p><span><i class="fas fa-clock"></i>'+abab.lectures[i].lecture_date+'  &nbsp;&nbsp;'+abab.lectures[i].start_time+' - '+abab.lectures[i].end_time+'</span> &nbsp;&nbsp;<span><i class="fas fa-user"></i> &nbsp;'+abab.lectures[i].FirstName+' '+abab.lectures[i].LastName+''+

							// 			   '</span></p>'+
							// 			   '<p>Topic:-'+abab.lectures[i].Topic+'</p>'+
							// 		   '</div>'+
							// 	   '</div>'	+
							// 	   '<hr>'	;

							html +='<tr>'+
							'<td>'+(i+1)+'</td>'+
							'<td><a  href="<?=base_url();?>admin/course/question_write_submit?question_id='+abab.question[i].question_id+'&batch_id='+abab.question[i].batch_id+'" >'+
							'<h4 class="card-title">'+abab.question[i].Title+'</h4>';
							if($('#wstudent').val()!=""){
								if(abab.question[i].is_submitted){
									if(abab.question[i].is_submitted==0){

										html+='<span class="badge badge-danger">not submitted</span>';
									}
									else{

										html+='<span class="badge badge-success">submitted</span>';
									}
								}
							}						
							html+='</a></td>'+
							'<td>'+abab.question[i].Description+'</td>'+

							'<td>'+abab.question[i].subject+'</td>'+
							'<td>'+abab.question[i].Topic+'</td>'+

							'</td>';

						}
						$("#filter_question").html(html);
						$("#total_question").html(total_question);

					}
				});
			});
			$('#exam_filter').click(function(){

				let start_date = document.querySelector("#estart_date").value;
				let batch_id = '<?=$batch[0]->Id;?>';
				let end_date = document.querySelector("#eend_date").value;

				var html = '';
				$.ajax({
					url: "<?= base_url()?>admin/batch/filter_exam",
					data: {start_date:start_date,end_date:end_date,batch_id:batch_id,subject_id:$('#esubject').val(),topic_id:$('#etopic').val(),student_id:$('#estudent').val()},
					type: "post",
					success: function(data){
			   // console.log(data);
			   // console.log(JSON.parse(data));
			   var abab = JSON.parse(data);
			   // console.log(abab.lectures.length);
			   var total_exam = abab.exam.length;
			   // html +=
			   console.log(abab.exam);
							   // '<option value="">Please choose an option</option>';
							   for (let i = 0; i < abab.exam.length; i++) {


							//    html +='<div class="row">'+
							// 		   '<div class="col-9">'+
							// 		   '<h4><a href="<?=base_url();?>admin/course/lecture_attendance?lecture_id="'+abab.lectures[i].lecture_id+'">'+abab.lectures[i].Title+'</a></h4>'+

							// 			   '<p><span><i class="fas fa-clock"></i>'+abab.lectures[i].lecture_date+'  &nbsp;&nbsp;'+abab.lectures[i].start_time+' - '+abab.lectures[i].end_time+'</span> &nbsp;&nbsp;<span><i class="fas fa-user"></i> &nbsp;'+abab.lectures[i].FirstName+' '+abab.lectures[i].LastName+''+

							// 			   '</span></p>'+
							// 			   '<p>Topic:-'+abab.exam[i].Topic+'</p>'+
							// 		   '</div>'+
							// 	   '</div>'	+
							// 	   '<hr>'	;

							html +='<tr>'+
							'<td>'+(i+1)+'</td>'+
							'<td><a  href="<?=base_url();?>admin/course/exam_result?exam_id='+abab.exam[i].exam_id+'&batch_id='+abab.exam[i].batch_id+'" >   <h4 class="card-title">'+abab.exam[i].Title+'('+abab.exam[i].exam_type+')</h4>';
							if($('#wstudent').val()!=""){
								if(abab.exam[i].marks){
									if(abab.exam[i].marks<abab.exam[i].passing_marks){

										html+='<span class="badge badge-danger">fail</span>';
									}
									else{

										html+='<span class="badge badge-success">pass</span>';
									}
								}	
							}						
							html+='</a></td>'+
							'<td>'+abab.exam[i].exam_date+' '+abab.exam[i].start_time+'-'+abab.exam[i].end_time+'</td>'+
							'<td>'+abab.exam[i].subject+'</td>'+
							'<td>'+abab.exam[i].Topic+'</td>';
if($('#wstudent').val()!=""){
								if(abab.exam[i].marks){
								//	if(abab.exam[i].marks>=abab.exam[i].passing_marks){

										html+='<td>'+abab.exam[i].marks+'</td>';
									
									}
									else{

										html+='<td>-</td>';
									}
								//}	
							}
							html+='</tr>';

						}
						$("#filter_exam").html(html);
						$("#total_exam").html(total_exam);

					}
				});
			});

	$('#esubject').change(function(){
      $.ajax({
        url: "<?= base_url()?>admin/batch/gettopic",
        data: {subject_id:$(this).val()},
        type: "post",
        dataType: 'JSON',
        success: function(data){
          //console.log(data);
		  var html='<option value="">Select Topic</option>';
           
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              html+='<option value="'+data[i].Id+'">'+data[i].Topic+'</option>';
            }
            $('#etopic').html(html);
        }
      });
   })
   $('#wsubject').change(function(){
      $.ajax({
        url: "<?= base_url()?>admin/batch/gettopic",
        data: {subject_id:$(this).val()},
        type: "post",
        dataType: 'JSON',
        success: function(data){
          //console.log(data);
		  var html='<option value="">Select Topic</option>';
           
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              html+='<option value="'+data[i].Id+'">'+data[i].Topic+'</option>';
            }
            $('#wtopic').html(html);
        }
      });
   })
   $('#asubject').change(function(){
      $.ajax({
        url: "<?= base_url()?>admin/batch/gettopic",
        data: {subject_id:$(this).val()},
        type: "post",
        dataType: 'JSON',
        success: function(data){
          //console.log(data);
		  var html='<option value="">Select Topic</option>';
           
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              html+='<option value="'+data[i].Id+'">'+data[i].Topic+'</option>';
            }
            $('#atopic').html(html);
        }
      });
   })
   $('#qsubject').change(function(){
      $.ajax({
        url: "<?= base_url()?>admin/batch/gettopic",
        data: {subject_id:$(this).val()},
        type: "post",
        dataType: 'JSON',
        success: function(data){
          //console.log(data);
		  var html='<option value="">Select Topic</option>';
           
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              html+='<option value="'+data[i].Id+'">'+data[i].Topic+'</option>';
            }
            $('#qtopic').html(html);
        }
      });
   })

   $('#lsubject').change(function(){
      $.ajax({
        url: "<?= base_url()?>admin/batch/gettopic",
        data: {subject_id:$(this).val()},
        type: "post",
        dataType: 'JSON',
        success: function(data){
          //console.log(data);
		  var html='<option value="">Select Topic</option>';
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              html+='<option value="'+data[i].Id+'">'+data[i].Topic+'</option>';
            }
            $('#ltopic').html(html);
        }
      });
   })

   $("#students_btn").click(function(){
        student_table_to_excel('xlsx');
	});
  
	function student_table_to_excel(type)
    {
        var data = document.getElementById('students_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'studentreport.' + type);
    }
	$("#lectures_btn").click(function(){
		lectures_table_to_excel('xlsx');
	});
  
	function lectures_table_to_excel(type)
    {
        var data = document.getElementById('lectures_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'lecturesreport.' + type);
    }
	$("#woorksheet_btn").click(function(){
        woorksheet_table_to_excel('xlsx');
	});
  
	function woorksheet_table_to_excel(type)
    {
        var data = document.getElementById('woorksheet_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'woorksheetreport.' + type);
    }
	$("#assignment_btn").click(function(){
        assignment_table_to_excel('xlsx');
	});
  
	function assignment_table_to_excel(type)
    {
        var data = document.getElementById('assignment_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'assignmentreport.' + type);
    }
	$("#question_btn").click(function(){
        question_table_to_excel('xlsx');
	});
  
	function question_table_to_excel(type)
    {
        var data = document.getElementById('question_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'questionreport.' + type);
    }
	$("#exam_btn").click(function(){
        exam_table_to_excel('xlsx');
	});
  
	function exam_table_to_excel(type)
    {
        var data = document.getElementById('exam_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'examreport.' + type);
    }
	//   $('#student_filter').click(function(){

	//    let start_date = document.querySelector("#sstart_date").value;
	//    let batch_id = '<?=$batch[0]->Id;?>';
	//    let end_date = document.querySelector("#send_date").value;

	//    var html = '';
	//    $.ajax({
	// 	   url: "<?= base_url()?>admin/batch/filter_student",
	// 	   data: {start_date:start_date,end_date:end_date,batch_id:batch_id},
	// 	   type: "post",
	// 	   success: function(data){
	// 		   // console.log(data);
	// 		   // console.log(JSON.parse(data));
	// 		   var abab = JSON.parse(data);
	// 		   // console.log(abab.lectures.length);
	// 		   var total_student = abab.student.length;
	// 		   // html +=
	// 						   // '<option value="">Please choose an option</option>';
	// 					   for (let i = 0; i < abab.student.length; i++) {


	// 						   html +='<div class="row">'+
	// 								   '<div class="col-9">'+
	// 								   '<h4><a href="<?=base_url();?>admin/course/lecture_attendance?lecture_id="'+abab.lectures[i].lecture_id+'">'+abab.lectures[i].Title+'</a></h4>'+

	// 									   '<p><span><i class="fas fa-clock"></i>'+abab.lectures[i].lecture_date+'  &nbsp;&nbsp;'+abab.lectures[i].start_time+' - '+abab.lectures[i].end_time+'</span> &nbsp;&nbsp;<span><i class="fas fa-user"></i> &nbsp;'+abab.lectures[i].FirstName+' '+abab.lectures[i].LastName+''+

	// 									   '</span></p>'+
	// 									   '<p>Topic:-'+abab.exam[i].Topic+'</p>'+
	// 								   '</div>'+
	// 							   '</div>'	+
	// 							   '<hr>'	;

	// 					   }
	// 					   $("#filter_student").html(html);
	// 					   $("#total_student").html(total_student);

	// 	   }
	//    });
	//   });
</script>