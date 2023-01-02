<div class="container-fluid">	
	<div class="_215b01" style="background: #fff;">
			<div class="container-fluid">			
				<div class="row">
					<div class="col-lg-12">
						<div class="section3125">							
							<div class="row justify-content-center">						
								<div class="col-xl-2 col-lg-2 col-md-2">						
									<div class="preview_video">						
										<a href="#" class="fcrse_img">
											<img src="<?=$course[0]->Cover_image;?>" alt="">
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
								<?php 
						        $access=$this->session->userdata('access');
						        $courses=array();
						        $courses=$access->courses;
						        if(in_array("add", $courses) || in_array("all", $courses)){
						          ?>
									<a class="btn steps_btn" style="padding-top: 10px !important" href="<?=base_url();?>admin/course/addstudents/<?=$course[0]->Id;?>">Add students</a>
								<?php 
								}
								?>
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
	</div>
		<div class="_215b17" style="padding-bottom: 50px;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="course_tab_content">
							<div class="tab-content" id="nav-tabContent"><br>
								<h3>Students: </h3>
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