
	<!-- Video Model Start -->
	<div class="modal vd_mdl fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-body">
				<?php 
					if($course[0]->Promotional_video!=""){
				?>

					<video autoplay controls controlsList="nodownload" id="pvideo" style="width: 100%;">
        <source src="<?=$course[0]->Promotional_video;?>" type="video/mp4">
          <source src="<?=$course[0]->Promotional_video;?>" type="video/mov">
            <source src="<?=$course[0]->Promotional_video;?>" type="video/avi">
      </video>
      <?php 
  }
  else{
  	?>
  	<iframe width="100%" height="200" src="<?=$course[0]->Youtube_url;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  	<?php
  }
  ?>
  <script type="text/javascript">
  	function getDuration() {
            var s = document.getElementById('pvideo');
            alert(s.duration)
        }
  </script>
				</div>
				
			</div>
		</div>
	</div>
	<div class="container">	
	<div class="_215b01" style="background: #fff;">
			<div class="container-fluid">			
				<div class="row">
					<div class="col-lg-12">
						<div class="section3125">							
							<div class="row justify-content-center">						
								<div class="col-xl-2 col-lg-2 col-md-2">						
									<div class="preview_video">						
										<a href="#" class="fcrse_img" data-toggle="modal" data-target="#videoModal">
											<img src="<?=$course[0]->Cover_image;?>" alt="">
											<?php 
												if($course[0]->Promotional_video!="" && $course[0]->Youtube_url!=""){
											?>
											<div class="course-overlay">
												<span class="play_btn1"><i class="uil uil-play"></i></span>
												<span class="_215b02">Preview this course</span>
											</div>
											<?php 
												}
											?>
										</a>
									</div>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8">
									<div class="_215b03">
										<h2 style="color:#000;"><?=$course[0]->Title;?></h2>
									</div>
									<div class="_215b05">
									<?php 
									if($course[0]->Price>0){
									?>										
										<h2 style="color:#000;">&#8377; <?=$course[0]->Price;?></h2>
										<?php 
									}
									else
									{
										?>
										<H2 style="color:#000;">FREE</H2>
										<?php
									}
									?>
									</div>
									<?php 
									?>									

								</div>	
								<div class="col-xl-2 col-lg-2 col-md-2">
							
									     <div class="dropdown">
  <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  	<a class="dropdown-item" href="<?=base_url();?>admin/course/addstudents/<?=$course[0]->Id;?>">Add students</a>
    <a class="dropdown-item" href="<?=base_url();?>admin/course/coursedetail/information/<?=$course[0]->Id;?>">Edit Course</a>
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal">Delete</a>
  </div>
</div>
								</div>						
							</div>		

						</div>							
					</div>															
				</div>
			</div>
		</div>
		<div class="modal" id="deleteModal">
                          <div class="modal-dialog">
                            <div class="modal-content">
								 <!-- Modal body -->
                              <div class="modal-body">
                              		<h3>Are you sure you want to delete this course?</h3>
						<button data-direction="next" class="delete btn btn-default steps_btn" value="<?=$course[0]->Id;?>">Delete</button>	
			<button data-direction="next" class="btn btn-default steps_btn" style="background: white;border-color: #ed2a26 !important" value="<?=$course[0]->Id;?>"  data-dismiss="modal">Cancel</button>	
			
					</div>
				</div>
			</div>
		</div>
		<div class="_215b15 _byt1458">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<!--<div class="user_dt5">
							<div class="user_dt_left">
								<div class="live_user_dt">
									<div class="user_img5">
										<a href="#"><img src="images/left-imgs/img-1.jpg" alt=""></a>												
									</div>
									<div class="user_cntnt">
										<a href="#" class="_df7852">Johnson Smith</a>
										<button class="subscribe-btn">Subscribe</button>
									</div>
								</div>
							</div>
							<div class="user_dt_right">
								<ul>
									<li>
										<a href="#" class="lkcm152"><i class="uil uil-eye"></i><span>1452</span></a>
									</li>
									<li>
										<a href="#" class="lkcm152"><i class="uil uil-thumbs-up"></i><span>100</span></a>
									</li>
									<li>
										<a href="#" class="lkcm152"><i class="uil uil-thumbs-down"></i><span>20</span></a>
									</li>
									<li>
										<a href="#" class="lkcm152"><i class="uil uil-share-alt"></i><span>9</span></a>
									</li>
								</ul>
							</div>
							  
						</div>-->
						<div class="course_tabs">
							<nav>
								<div class="nav nav-tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
									<a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-selected="true">About</a>
									<a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses" role="tab" aria-selected="false">Courses Content</a>
									<a class="nav-item nav-link" id="nav-students-tab" data-toggle="tab" href="#nav-students" role="tab" aria-selected="false">Students(<?=count($students);?>)</a>
								</div>
							</nav>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div class="_215b17" style="padding-bottom: 50px;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="course_tab_content">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-about" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<?=$course[0]->Description;?>
										</div>
									</div>					
								</div>
								<div class="tab-pane fade" id="nav-students" role="tabpanel">
									<div class="card">
										<div class="card-body">
											 <?php 
    $i=0;
    foreach ($students as $stud) {
      ?>
      <div class="row"> 
        <div class="col-md-12">
          <h4><?=$stud->FirstName.' '.$stud->LastName;?></h4>
          <p><span><i class="fas fa-envelope"></i>&nbsp; <?=$stud->Email;?></span>&nbsp;&nbsp;<span><i class="fas fa-phone"></i>&nbsp; <?=$stud->Phone;?></span></p>
        </div>
      </div>
     <hr>
     <?php 
   }
   ?>
										</div>
									</div>					
								</div>
								<div class="tab-pane fade" id="nav-courses" role="tabpanel">
									<div class="crse_content">
										<h3>Course content</h3>
										<div class="_112456">
											<ul class="accordion-expand-holder">
												<li><span class="_fgr123"><?=count($sections);?> sections</span></li>
											</ul>
										</div>
        <div id="accordion" class="ui-accordion ui-widget ui-helper-reset">
						<?php
	                    $i=0;
	                    foreach ($sections as $section) {
                        ?>
                        <div class="card">
                          <div class="card-header">
                            <div class="row">
                              <div class="col-md-9 col-7">
                                <a class="card-link" data-toggle="collapse" href="#collapselect_<?=$section->Id;?>" style="vertical-align: middle;">
                                  <h4 style="color: black"><?=$section->Title;?></h4>
                                </a>
                              </div>
                              <div class="col-md-3 col-5 text-right">
                              	<p><?=count($lectures[$i]);?> lectures</p>
                               </div>
                            </div>
                          </div>
                          <div id="collapselect_<?=$section->Id;?>" class="collapse <?php if($i==0){ echo "show"; } ?>" data-parent="#accordion">
                            <div class="card-body" id="lectures_<?=$section->Id;?>">
                              <?php 
                              foreach ($lectures[$i] as $lect) {
                                ?>
                                <div class="row">
	                              	<div class="col-md-8 col-8">
	                                	<p><?=$lect->Title;?></p>
		                            </div>
	                                <div class="col-md-4 col-4 text-right">
	                                	<?php 
											$ext=array("mp4", "OGG", "WMV", "WEBM", "FLV", "AVI", "mov");

								        ?>
	                                  	<a href="#" data-toggle="modal" data-target="#videoModal_<?=$lect->Id;?>"><i class="fas fa-play"></i></a>
	                                </div>
                              	</div><hr>
                              	<div class="modal" id="videoModal_<?=$lect->Id;?>">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-body">

				<?php 
				if($lect->ContentName!=""){
					$filearray=explode(".", $lect->ContentName);
					if(in_array($filearray[1], $ext))
					{
						?>
						<video autoplay controls controlsList="nodownload" id="pvideo" style="width: 100%;">
					        <source src="<?=$lect->ContentUrl;?>" type="video/mp4">
					        <source src="<?=$lect->ContentUrl;?>" type="video/mov">
					        <source src="<?=$lect->ContentUrl;?>" type="video/avi">
					    </video>
						<?php
					}
				}
				if($lect->Description!=""){
					?>
					<div class="row">
						<div class="col-md-12 col-12">
							<?=$lect->Description;?>
						</div>
					</div>
					<?php
				}
				if($lect->ContentName!=""){
					$filearray=explode(".", $lect->ContentName);
					if(!in_array($filearray[1], $ext))
					{
						?>
						<a href="<?=$lect->ContentUrl;?>">Open attachment</a>
						<?php
					}
				}
				?>
				</div>
				
			</div>
		</div>
	</div>
                              <?php
                              }
                              ?>
                            </div>
                           </div>
                          </div><br>
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
				</div>
			</div>
		</div>
<script type="text/javascript">
				$('body').on('click', '.delete', function(){ 
		var id=$(this).val();
		$.ajax({
			url:"<?=base_url();?>admin/course/deletecourse",
	        method:"POST",
	        data:{id:id},
	        success:function(data)
	        {
        		swal("course deleted successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.href="<?=base_url();?>admin/course";
	          	}, 2000);
	        }
		});
	})

</script>