<div class="container-fluid">
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
								<button data-direction="next" class="btn btn-default steps_btn" data-toggle="modal" data-target="#archiveModal" style="margin-bottom: 5px;">Archive Batch</button>
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
								</div>
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
									              		<input type="checkbox" name="courses" value="<?=$course->Id;?>" <?php if (in_array($course->Id, $cids)) { echo "checked"; }?>>
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
									              		<input type="checkbox" name="series" <?php if (in_array($ser->Id, $sids)) { echo "checked"; }?> value="<?=$ser->Id;?>">
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
			<ul class="nav nav-pills">
				<li class="nav-item">
			    	<a class="nav-link active" data-toggle="pill" href="#students-tab">Students</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="pill" href="#lectures-tab">Lectures</a>
			  	</li>
			</ul>
			<br>
			<div class="tab-content">
				<div class="tab-pane active" id="students-tab">
					<div class="row">
		                <div class="col-md-2 col-6">
		                  <div class="alert alert-primary text-center">
		                    <h3 id="tpstudurest"><?=count($students);?></h3>
		                    <p>Total students</p>
		                  </div>
		                </div>
		            </div>
					<div class="card">
						<div class="card-body">
							<?php 
								$i=0;
								foreach ($students as $stud) {
									date_default_timezone_set('Asia/Kolkata');
									$date=date("h:i:sa");	
									?>
									<div class="row">
										<div class="col-12">
											<a href="<?=base_url();?>admin/student/studentdetails/<?=$stud->Id;?>"><h4><?=$stud->FirstName.' '.$stud->MiddleName.' '.$stud->LastName;?></h4></a>
											<p><span><i class="fas fa-envelope"></i> <?=$stud->Email;?> &nbsp;&nbsp;<i class="fas fa-phone"></i> <?=$stud->Phone;?></span></p>
										</div>
									</div>	
									<hr>
									<?php
									$i++;
								}
							?>
						</div>
					</div>
				</div>
				<div class="tab-pane active" id="lectures-tab">
						<div class="card">
			<div class="card-body">
				<?php 
				$i=0;
date_default_timezone_set('Asia/Kolkata');
				foreach ($lectures['lectures'] as $lect) {
					$sbatches=explode(",", $lect->BatchIds);
					$sfaculties=explode(",", $lect->Faculty);
					date_default_timezone_set('Asia/Kolkata');
					$time=date("h:i:sa");
					$date=date("Y-m-d");
					?>
					<div class="row">
						<div class="col-9">
							<h4><a href="<?=base_url();?>admin/schedule/lecturedetails/<?=$lect->Id;?>"><?=$lect->Title;?></a></h4>
							<p><span><i class="fas fa-clock"></i> <?=$lect->Lecture_date;?> &nbsp;&nbsp;<?=date('h:i A',strtotime($lect->Start_time));?> - <?=date('h:i A',strtotime($lect->End_time));?></span> &nbsp;&nbsp;<span><i class="fas fa-user"></i> &nbsp;
								<?php
								foreach ($lectures['faculties'][$i] as $faculty) {
									if(count($faculty)>0){
									?>
									<?=$faculty[0]->FirstName.' '. $faculty[0]->LastName;?>,
									<?php
								}
								}
								?>
							</span></p>
							<p>Batches: 
							<?php
								foreach ($lectures['batches'][$i] as $batch) {
									if(count($batch)>0){
									?>
									<?=$batch[0]->Name;?>,
									<?php
								}
								}
								?>
									
								</p>
						</div>
						<div class="col-3 text-right">
							<br>
							<?php 
								if($lect->Lecture_date>=$date){
							?>
						<!--	<a href="<?=$lect->Meeting_url;?>" target="_blank" class="btn btn-outline-success">Start</a >-->
							 <button class="start btn btn-success" value="<?=$lect->Id;?>">Start</button>
                          
							<?php 
							}
							?>
						</div>
					</div>	
					<hr>
				
					<?php
					$i++;
				}
				?>
			</div>
		</div>	
				</div>
				<div class="tab-pane" id="course-tab">
					<br>
					<div class="row">
						<?php 
						foreach ($bcourses as $course) {
							?>
							<div class="col-md-3">
								<div class="card">
									<img src="<?=$course->Cover_image;?>" class="card-img">
									<div class="card-body">
										<h4><?=$course->Title;?></h4>
									</div>
								</div>
							</div>
							<?php 
						}
						?>
					</div>
				</div>
				<div class="tab-pane" id="series-tab">
					<br>
					<div class="row">
						<?php 
						foreach ($bseries as $ser) {
							?>
							<div class="col-md-3">
								<div class="card">
									<img src="<?=$ser->Thumbnail;?>" class="card-img">
									<div class="card-body">
										<h4><?=$ser->Title;?></h4>
									</div>
								</div>
							</div>
							<?php 
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
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
</script>