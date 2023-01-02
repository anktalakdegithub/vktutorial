<link href="<?=base_url();?>/assets/vendor/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?=base_url();?>/assets/vendor/bootstrap/js/bootstrap-select.min.js"></script>
		
<div class="sa4d25">
	<div class="container-fluid">			
		<div class="row">
			<div class="col-md-9">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>Counsellings</h2><br>
			</div>	
			<div class="col-md-3 col-6 text-right">
				<button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#FacultyModal">New counselling</button>	
				<!--<button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#importModal"><i class="fas fa-upload"></i> Import Students</button>-->	
			</div>					
		</div>	
		<div class="row">
			<div class="col-md-8">
		<div class="card">
			<div class="card-body" id="load_data">
				
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card card-body">
		<h3>Filter By</h3>
		<br>
		<br>
		<div class="form-group">
			<label>Select course</label>
				<select class="form-control filter" id="fcourse">
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
			<label>Select subject</label>
				<select class="form-control filter" id="fsubject">
					<option value="">Select subject</option>
													
				</select>
		</div><br>
		<div class="form-group">
			<label>Select batch</label>
				<select class="form-control filter" id="fbatch">
					<option value="">Select batch</option>
													
				</select>
		</div>
		<br>
		<div class="form-group">
			<label>From Date</label>
			<input type="date" class="form-control filter" name="" id="fstdate">
		</div>
		<br>
		<div class="form-group">
			<label>To Date</label>
			<input type="date" class="form-control filter" name="" id="ftdate">
		</div>
		<input type="hidden" id="page" value="0" name="">
	</div>
	</div>
</div>

<div class="modal fade" id="editexamModal" tabindex="-1" role="dialog" aria-labelledby="editexamModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Counselling</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="examdata">
        ...
      </div>
    </div>
  </div>
</div>


		<div class="modal" id="FacultyModal">
		    <div class="modal-dialog modal-lg">
			    <div class="modal-content">
					<div class="modal-header">
				        <h4 class="modal-title">New Counselling</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				     </div>

			       <!-- Modal body -->
			       	<div class="modal-body">
				        <div class="row justify-content-md-center">
							<div class="col-12">
								
								<div class="ui search focus mt-30 lbel25">
									<label>Title</label>
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="text" id="etitle">	
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Select course</label>
									<div class="ui left icon input swdh19">
										<select class="form-control"  id="course_id">
											<option>Select course</option>
											<?php 
                                foreach($courses as $course){
                            ?>
                                 <option value="<?=$course->Id; ?>"><?php echo $course->Title; ?></option> 
                            <?php
                                }
                                ?>	
										</select>							
									</div>
								</div>	
								<div class="ui search focus mt-30 lbel25">
									<label>Select subject</label>
									<div class="ui left icon input swdh19">
										<select class="form-control" id="subjects">
											<option>Select subject</option>
												
										</select>							
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Select Batch</label>
									<div class="ui left icon input swdh19">
										<select class="form-control w_branch"  id="batch_id">
											<option>Select batch</option>
																				
										</select>							
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Select Exam</label>
									<div class="ui left icon input swdh19">
										<select class="form-control" id="exam">
											<option>Select exam</option>
												
										</select>							
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Select Student</label>
									<div class="ui left icon input swdh19">
										<select class="form-control w_branch"  id="student">
											<option>Select student</option>
																				
										</select>							
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Counselling Date</label>
									<div class="ui left icon input swdh19">
										<input type="date" class="form-control" id="edate" name="">								
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>Start Time</label>
									<div class="ui left icon input swdh19">
										<input type="time" class="form-control" id="stime" name="">
									</div>
								</div>
								<div class="ui search focus mt-30 lbel25">
									<label>End Time</label>
									<div class="ui left icon input swdh19">
										<input type="time" class="form-control" id="etime" name="">
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

    $('body').on('click', '.deleteexam', function(){ 
        var counselling_id=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/counselling/deletecounselling",
            data: {counselling_id:counselling_id},
            type: "post",
            success: function(data){
                swal("Counselling deleted successfully!", "", "success");
                setTimeout(function () {
                    swal.close();
                    location.reload();
                }, 1000); 
            }
        });
    });
		$('#submit').click(function() {


		var course_id=$('#course_id').val();
		var batch_id=$('#batch_id').val();
		var subjects=$('#subjects').val();
		var exam_id=$('#exam').val();
		var student=$('#student').val();
		var edate=$('#edate').val();
		var stime=$('#stime').val();
		var etime=$('#etime').val();
		
		var etitle = $('#etitle').val();
		var formData = new FormData();
		formData.append('cid', course_id);
		formData.append('bid', batch_id);
		formData.append('sid', subjects);
		formData.append('exam_id', exam_id);
		formData.append('stud_id', student);
		formData.append('date', edate);
		formData.append('stime', stime);
		formData.append('etime', etime);
		formData.append('title', etitle);
		$.ajax({
			url:"<?=base_url();?>admin/counselling/add_counselling",
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
	        		swal("Counselling added successfully!", "", "success");
				    setTimeout(function () {
		              	swal.close();
		              	location.reload();
		          	}, 2000);
		        }
	        }
		});
	})
	$('body').on('click', '#update', function(){ 
		var counselling_id=$(this).val();
		var course_id=$('#ecourse_id').val();
		var batch_id=$('#ebatch_id').val();
		var subjects=$('#esubjects').val();
		var exam_id=$('#eexam_id').val();
		var student=$('#estudent').val();
		var edate=$('#edate').val();
		var stime=$('#stime').val();
		var etime=$('#etime').val();
		
		var etitle = $('#etitle').val();
		var formData = new FormData();
		formData.append('counselling_id', counselling_id);
		formData.append('cid', course_id);
		formData.append('bid', batch_id);
		formData.append('sid', subjects);
		formData.append('exam_id', exam_id);
		formData.append('stud_id', student);
		formData.append('date', edate);
		formData.append('stime', stime);
		formData.append('etime', etime);
		formData.append('title', etitle);
		$.ajax({
			url:"<?=base_url();?>admin/counselling/updatecounselling",
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
	        		swal("Counselling data updated successfully!", "", "success");
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
$('body').on('change', '#course_id', function(){ 
	$.ajax({
		url:"<?=base_url();?>admin/course/fetchcoursebatchsubjects",
        method:"POST",
        data:{'course_id':$('#course_id').val()},
        dataType: 'JSON',
        success:function(data)
        {
    		var html='<option value="">select subject</option>';
    		for(i=0;i<data.subjects.length;i++){
    			html+='<option value="'+data.subjects[i].Id+'">'+data.subjects[i].Title+'</option>'
    		}
    		$('#subjects').html(html);
    		var html1='<option value="">select batch</option>';
    		for(i=0;i<data.batches.length;i++){
    			html1+='<option value="'+data.batches[i].Id+'">'+data.batches[i].Name+'</option>'
    		}
    		$('#batch_id').html(html1);
    		//getbatchstudents();
    		//getsubjecttopics();
        }
	});
});
$('body').on('change', '#fcourse', function(){ 
	$.ajax({
		url:"<?=base_url();?>admin/course/fetchcoursebatchsubjects",
        method:"POST",
        data:{'course_id':$('#fcourse').val()},
        dataType: 'JSON',
        success:function(data)
        {
    		var html='<option value="">select subject</option>';
    		for(i=0;i<data.subjects.length;i++){
    			html+='<option value="'+data.subjects[i].Id+'">'+data.subjects[i].Title+'</option>'
    		}
    		$('#fsubject').html(html);
    		var html1='<option value="">select batch</option>';
    		for(i=0;i<data.batches.length;i++){
    			html1+='<option value="'+data.batches[i].Id+'">'+data.batches[i].Name+'</option>'
    		}
    		$('#fbatch').html(html1);
        }
	});
});
$('body').on('change', '#fcourse', function(){ 
	$.ajax({
		url:"<?=base_url();?>admin/course/fetchcoursebatchsubjects",
        method:"POST",
        data:{'course_id':$('#fcourse').val()},
        dataType: 'JSON',
        success:function(data)
        {
    		var html='<option value="">select subject</option>';
    		for(i=0;i<data.subjects.length;i++){
    			html+='<option value="'+data.subjects[i].Id+'">'+data.subjects[i].Title+'</option>'
    		}
    		$('#fsubject').html(html);
    		var html1='<option value="">select batch</option>';
    		for(i=0;i<data.batches.length;i++){
    			html1+='<option value="'+data.batches[i].Id+'">'+data.batches[i].Name+'</option>'
    		}
    		$('#fbatch').html(html1);
        }
	});
});
$('body').on('change', '#fsubject', function(){ 
	$.ajax({
		url:"<?=base_url();?>admin/course/coursesectiontopics",
	    method:"POST",
	    data:{'subject_id':$('#fsubject').val()},
	    dataType: 'JSON',
	    success:function(data)
	    {
			var html='<option value="">select topic</option>';
			for(i=0;i<data.length;i++){
				html+='<option value="'+data[i].Id+'">'+data[i].Topic+'</option>'
			}
			$('#ftopic').html(html);
	    }
	});
});
$('body').on('change', '#batch_id', function(){ 
	getbatchstudents();
	getsubjecttopics();
});
$('body').on('change', '#subjects', function(){ 
	getsubjecttopics();
});
function getbatchstudents() {
	$.ajax({
		url:"<?=base_url();?>admin/batch/getbatchstudents",
	    method:"POST",
	    data:{'batch_id':$('#batch_id').val()},
	    dataType: 'JSON',
	    success:function(data)
	    {
			var html='';
			for(i=0;i<data.length;i++){
				html+='<option value="'+data[i].Id+'">'+data[i].FirstName+' '+data[i].LastName+'</option>'
			}
			$('#student').html(html);
	    }
	});
}
function getsubjecttopics() {
	$.ajax({
		url:"<?=base_url();?>admin/course/coursesectionexams",
	    method:"POST",
	    data:{'subject_id':$('#subjects').val(), 'batch_id': $('#batch_id').val()},
	    dataType: 'JSON',
	    success:function(data)
	    {
			var html='';
			for(i=0;i<data.length;i++){
				html+='<option value="'+data[i].exam_id+'">'+data[i].Title+'</option>'
			}
			$('#exam').html(html);
	    }
	});
}
$(document).ready(function(){
    var limit = 7;
    var start = 0;
    var action = 'inactive';
    $('.filter').on('change', function() {
		$('#page').val(0);
		$('#load_data').html('');
    	load_data(limit);
    });
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

    function load_data(limit, start)
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/counselling/fetch_counsellings",
        method:"POST",
        data:{limit:limit, start:start, course_id: $('#fcourse').val(), subject_id: $('#fsubject').val(),from_date: $('#fstdate').val(), to_date: $('#ftdate').val(),page:$('#page').val()},
        cache: false,
        dataType: 'json',
        success:function(data)
        {
          	if(data.output == '')
			{
				$('#load_data_message').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no more lectures found!!</p></div><div class="col-md-4"></div></div></div>');
				action = 'active';
			}
			else
			{
				$('#load_data').html(data.output);
				$('#load_data_message').html("");
				action = 'inactive';
			}
        }
      })
    }
    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }
    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });
  });

  $('body').on('click', '.edit_counselling', function(){ 
	//$("#editexamModal").modal();
            // e.preventDefault();
            var id = this.id;
            // alert(id);
            // document.querySelector("#post_id").value = id;
            $.ajax({
                type: "get",
                // url: "{{ url('edit/slider_image') }}" + "/" + id,
				url:"<?php echo base_url(); ?>admin/counselling/get_counselling",
				data:{'id':id},
               
                success: function(data) {

                 //   console.log(data);
				//	console.log(typeof data);
					// const obj = JSON.parse(data);
                    // console.log(obj);

            		 $('#examdata').html(data);
                   
                    // $("#editexamModal").modal('show');
                }
            });
        });


$('body').on('change', '#ecourse_id', function(){ 
	$.ajax({
		url:"<?=base_url();?>admin/course/fetchcoursebatchsubjects",
        method:"POST",
        data:{'course_id':$('#ecourse_id').val()},
        dataType: 'JSON',
        success:function(data)
        {
    		var html='<option value="">select subject</option>';
    		for(i=0;i<data.subjects.length;i++){
    			html+='<option value="'+data.subjects[i].Id+'">'+data.subjects[i].Title+'</option>'
    		}
    		$('#esubjects').html(html);
    		var html1='<option value="">select batch</option>';
    		for(i=0;i<data.batches.length;i++){
    			html1+='<option value="'+data.batches[i].Id+'">'+data.batches[i].Name+'</option>'
    		}
    		$('#ebatch_id').html(html1);
        }
	});
});
$('body').on('change', '#esubjects', function(){ 
	$.ajax({
		url:"<?=base_url();?>admin/course/coursesectiontopics",
	    method:"POST",
	    data:{'subject_id':$('#esubjects').val()},
	    dataType: 'JSON',
	    success:function(data)
	    {
			var html='<option value="">select topic</option>';
			for(i=0;i<data.length;i++){
				html+='<option value="'+data[i].Id+'">'+data[i].Topic+'</option>'
			}
			$('#etopics').html(html);
	    }
	});
});
	 $('body').on('click', '.publishexamm', function(){ 
        var counselling_id=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/counselling/publishcounselling",
            data: {counselling_id:counselling_id},
            type: "post",
            success: function(data){
                 swal("Counselling publish successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                        location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.unpublishexamm', function(){ 
        var counselling_id=$(this).val();
        
        $.ajax({
            url: "<?= base_url()?>admin/counselling/unpublishcounselling",
            data: {counselling_id:counselling_id},
            type: "post",
            success: function(data){
                 swal("Counselling Unpublish successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                        location.reload();
                    }, 1000); 
            }
        });
    });
    $('body').on('click', '.addworksheet', function(){ 
        var counselling_id=$(this).val();
        	var counselling_id=$(this).val();
		var eworksheet=$('#eworksheet_'+counselling_id).val();
		var issubmitted=0;
		var worksheet=$('#worksheet_'+counselling_id).get(0).files[0];
		var comment=$('#comment_'+counselling_id).val();
		if($('#issubmitted_' + counselling_id).is(":checked")){
			issubmitted=1;
		}
		var formData = new FormData();
		formData.append('counselling_id', counselling_id);
		formData.append('eworksheet', eworksheet);
		formData.append('worksheet', worksheet);
		formData.append('issubmitted', issubmitted);
		formData.append('comment', comment);
		$.ajax({
			url:"<?=base_url();?>admin/counselling/add_counselling_worksheet",
			method:"POST",
			data: formData,
			type: "post",
			headers: { 'IsAjax': 'true' },
			processData: false,
			contentType: false,
			dataType: 'json',
            success: function(data){
                 swal("Data updated successfully!", "", "success");
                    setTimeout(function () {
                        swal.close();
                       // location.reload();
                    }, 1000); 
            }
        });
    });
     $(function () {       
        $.ajax({
            type: "GET",
            url: "http://164.52.212.19:6005//api/v2/SendSMS?ApiKey=NH+W/OCqlPh8H/ydSpwJPsZd0JY15p8iRIX3Bv9/rEo=&ClientId=097be2ac-703f-4211-9857-ac5a7a297113&SenderId=SMSADS&Message=Hello, you are requested to pay the due fees. Ignore if already paid. - VK Tutorials&MobileNumbers=+917039135090",
            contentType: "application/json",
            dataType: 'json',           
            success: function (response) {                
            }
        });
    });
</script>