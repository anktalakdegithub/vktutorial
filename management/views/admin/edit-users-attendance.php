<div class="sa4d25">
	<div class="container-fluid">		
		<div class="row">
			<div class="col-md-10 col-6">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>Attendance</h2><br>
			</div>		
		</div>	
     	<div class="row justify-content-center">
     		<div class="col-12">
     			<div class="card">
     				<div class="card-body">
     					<p class="text-right">select Date: <input type="date" name="" value="<?=$adate;?>" id="adate"></p>
		     			<div class="table table-responsive">
		     				<table class="table table-bordered">
		     					<thead class="thead-dark">
		     						<tr>
		     							<th>#</th>
		     							<th>Name</th>
		     							<th>Is Absent?</th>
		     							<th>In Time</th>
		     							<th>Out Time</th>
		     							<th>Remark (if absent)</th>
		     						</tr>
		     					</thead>
		     					<tbody>
		     						<?php 
		     						$i=1;
		     						foreach ($attendance as $user) {
		     						?>
		     							<tr>
			     							<th><?=$i;?></th>
			     							<th><?=$user->FirstName.' '.$user->LastName;?></th>
			     							<th><input type="checkbox" name="absent" id="absent_<?=$user->UserId;?>" value="<?=$user->UserId;?>" <?php if ($user->IsAbsent==1) { echo "checked"; } ?>>
			     								<input type="hidden" name="uid" id="uid_<?=$user->UserId;?>" value="<?=$user->UserId;?>"></th>
			     							<th><input type="time" name="itime" id="itime_<?=$user->UserId;?>" value="<?=$user->InTime;?>"></th>
			     							<th><input type="time" name="otime" id="otime_<?=$user->UserId;?>" value="<?=$user->OutTime;?>"></th>
			     							<th><input type="text" name="remark" id="remark_<?=$user->UserId;?>" class="form-control" value="<?=$user->Remark;?>"></th>
		     							</tr>
		     						<?php
		     						$i++;
		     						}
		     						?>
		     					</tbody>
		     				</table>
		     				<br>
		     				<button type="button" class="btn btn-primary" id="update" value="<?=$adate;?>">Update</button>
		     				<div id="msg"></div>
		     			</div>
		     		</div>
		     	</div>
     		</div>
     	</div>
 	</div>
</div>
<script type="text/javascript">
	$('#update').click(function() {
    	$('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait attendance adding....</div>');
 		var uids=[];
 		var absents=[];
 		var itime=[];
 		var otime=[];
 		var remarks=[];
 		var absents=[];
 		var adate=$('#adate').val();
 		var edate=$(this).val();
 		$('input[name="uid"]').each(function(checkbox) {
	      	uids.push($(this).val());
	    });
 		$('input[name="otime"]').each(function(checkbox) {
	      	otime.push($(this).val());
	    });
 		$('input[name="itime"]').each(function(checkbox) {
	      	itime.push($(this).val());
	    });
 		$('input[name="remark"]').each(function(checkbox) {
	      	remarks.push($(this).val());
	    });
 		$('input[name="absent"]:checked').each(function(checkbox) {
	      	absents.push($(this).val());
	    });
	    $.ajax({
	        url: "<?= base_url()?>admin/users/update_attendance",
	        data: {uids:uids,otime:otime,itime:otime,remarks:remarks,absents:absents,adate:adate,edate:edate},
	        type: "post",
	       	dataType: 'json',
	        success:function(data)
	        {
	        	if(data.code=="404"){
	        		$('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
	        	}
	        	else{
	        		swal("Attendance updated successfully!", "", "success");
				    setTimeout(function () {
		              	swal.close();
		              	location.href="<?=base_url();?>admin/users/attendance";
		          	}, 2000);
		        }
	        }
		});
	});
</script>