<div class="sa4d25">
	<div class="container-fluid">		
		<div class="row">
			<div class="col-md-8 col-6">	
				<h2 class="st_title"><i class="uil uil-analysis"></i><?=$adate;?> Attendance Details</h2><br>
			</div>
			<div class="col-md-4 text-center">
				<a href="<?=base_url();?>admin/users/edit_attendance/<?=$adate;?>" class="btn steps_btn" style="padding-top: 10px !important;margin-bottom: 10px !important;">Edit</a>
				<a href="#" class="btn steps_btn" style="padding-top: 10px !important;margin-bottom: 10px !important;" data-toggle="modal" data-target="#deleteModal">Delete</a>
				<div class="modal" id="deleteModal">
                          <div class="modal-dialog">
                            <div class="modal-content">
                 <!-- Modal body -->
                              <div class="modal-body">
                                  <h3>Are you sure you want to delete?</h3>
            <button data-direction="preve" class="btn btn-default steps_btn" id="delete" value="<?=$adate;?>">Delete</button> 
          </div>
        </div>
      </div>
    </div>
			</div>		
		</div>	
     	<div class="row justify-content-center">
     		<div class="col-12">
     			<div class="card">
     				<div class="card-body">
     					<div class="table table-responsive">
		     				<table class="table table-bordered">
		     					<thead class="thead-dark">
		     						<tr>
		     							<th>#</th>
		     							<th>Name</th>
		     							<th>Absent/Present</th>
		     							<th>In Time</th>
		     							<th>Out Time</th>
		     							<th>Remark (if absent)</th>
		     						</tr>
		     					</thead>
		     					<tbody>
		     						<?php 
									date_default_timezone_set('Asia/Kolkata');
		     						$i=1;
		     						foreach ($attendance as $user) {
		     						?>
		     							<tr>
			     							<th><?=$i+1;?></th>
			     							<th><?=$user->FirstName.' '.$user->LastName;?></th>
			     							<th>
			     								<?php 
			     								if ($user->IsAbsent==1) {
			     									?>
			     									<span class="badge badge-danger">absent</span>
			     									<?php
			     								}
			     								else{
			     									?>
			     									<span class="badge badge-success">present</span>
			     									<?php
			     								}
			     								?>
			     							</th>
			     							<th><?=date('h:i a',strtotime($user->InTime));?></th>
			     							<th><?=date('h:i a',strtotime($user->OutTime));?></th>
			     							<th><?=$user->Remark;?></th>
		     							</tr>
		     						<?php
		     						}
		     						?>
		     					</tbody>
		     				</table>
		     			</div>
		     		</div>
		     	</div>
     		</div>
     	</div>
 	</div>
</div>
<script type="text/javascript">
	$("#delete").click(function(){
	    $.ajax({
	        url: "<?= base_url()?>admin/users/delete_attendance",
	        data: {adate:$(this).val()},
	        type: "post",
	        success: function(data){
	           swal("Attendance deleted successfully!", "", "success");
	            setTimeout(function () {
	                    swal.close();
		              	location.href="<?=base_url();?>admin/users/attendance";
		          	}, 2000);
	         
	    }
	    });
	  
	});
</script>