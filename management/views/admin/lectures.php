  <link href="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function() {
  tinymce.init({
    selector: ".desc",
    theme: "modern",
    paste_data_images: true,
     menubar: 'edit insert format table tools',
    plugins: [
      "advlist autolink lists image charmap preview hr anchor pagebreak",,
      "insertdatetime nonbreaking save table contextmenu directionality",
      "template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "preview image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    image_advtab: true,
    file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.onchange = function() {
      var file = this.files[0];
      var reader = new FileReader();
      
      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // call the callback and populate the Title field with the file name
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    
    input.click();
  },
    templates: [{
      title: 'Test template 1',
      content: 'Test 1'
    }, {
      title: 'Test template 2',
      content: 'Test 2'
    }]
  });
  });
</script>
<style type="text/css">
	.multiselect{
		border: 1px solid #e3e3e3;
		width: 350px !important;
		text-align: left !important;
	}
	.multiselect-container{
		width: 350px !important;
		height: 300px;
    overflow: auto;
	}
</style>
<div class="sa4d25">
	<div class="container">			
		<div class="row">
			<div class="col-md-10 col-6">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>Lectures</h2><br>
			</div>	
			<div class="col-md-2 col-6 text-right">
				<?php 
        $access=$this->session->userdata('access');
        $alectures=array();
        $alectures=$access->lectures;
        if(in_array("add", $alectures) || in_array("all", $alectures)){
          ?>
				<a href="<?=base_url();?>admin/schedule/newlecture" data-direction="next" class="btn btn-default steps_btn" style="padding-top: 10px !important;">New lecture</a>	
				<?php 
			}
			?>
			</div>					
		</div>	
		<div class="card">
			<div class="card-body">
				<?php 
				$i=0;
date_default_timezone_set('Asia/Kolkata');
				foreach ($lectures as $lect) {
					$sbatches=explode(",", $lect->BatchIds);
					$sfaculties=explode(",", $lect->Faculty);
					date_default_timezone_set('Asia/Kolkata');
					$time=date("h:i:sa");
					$date=date("Y-m-d");
					?>
					<div class="row">
						<div class="col-7">
							<h4><a href="<?=base_url();?>admin/schedule/lecturedetails/<?=$lect->Id;?>"><?=$lect->Title;?></a></h4>
							<p><span><i class="fas fa-clock"></i> <?=$lect->Lecture_date;?> &nbsp;&nbsp;<?=date('h:i A',strtotime($lect->Start_time));?> - <?=date('h:i A',strtotime($lect->End_time));?></span> &nbsp;&nbsp;<span><i class="fas fa-user"></i> &nbsp;
								<?php
								foreach ($faculties[$i] as $faculty) {
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
								foreach ($batches[$i] as $batch) {
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
						  <div class="col-2 text-center"><br>
              <div class="dropleft">
  <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <?php 
    if(in_array("edit", $alectures) || in_array("all", $alectures)){
          ?>
          <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#editModal_<?=$lect->Id;?>">Edit</a>
          <?php 
      }
      if(in_array("delete", $alectures) || in_array("all", $alectures)){
          ?>
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal_<?=$lect->Id;?>">Delete</a>
    <?php 
}
?>
  </div>
</div>
            </div>
					</div>	
					<hr>
					   <div class="modal" id="deleteModal_<?=$lect->Id;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                 <!-- Modal body -->
                              <div class="modal-body">
                                  <h3>Are you sure you want to delete?</h3>
            <button data-direction="preve" class="delete btn btn-default steps_btn" value="<?=$lect->Id;?>">Delete</button> 
      
          </div>
        </div>
      </div>
    </div>
					         <div class="modal" id="editModal_<?=$lect->Id;?>">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                 <!-- Modal body -->
                 <div class="modal-header">
                                <h3>Edit lecture</h3>
                              </div>
                              <div class="modal-body">
                                  <div class="row justify-content-md-center">
					<div class="col-12">
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture Thumbnail</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="file" placeholder="Lecture  title" name="thumbnail_<?=$lect->Id;?>" data-purpose="edit-course-title" id="thumbnail">
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture Title</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Lecture  title" name="title_<?=$lect->Id;?>" data-purpose="edit-course-title" id="title_<?=$lect->Id;?>" value="<?=$lect->Title;?>">
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture Description</label>
							<div class="ui left icon input swdh19">
								<textarea class="desc form-control" id="desc_<?=$lect->Id;?>"><?=$lect->Description;?></textarea>
							</div>
						</div>	
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture date & time</label>
							<div class="row">
								<div class="col-md-4">
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="date" name="title" data-purpose="edit-course-title" id="ldate_<?=$lect->Id;?>" value="<?=$lect->Lecture_date;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="time" name="title" data-purpose="edit-course-title" id="stime_<?=$lect->Id;?>" value="<?=$lect->Start_time;?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="ui left icon input swdh19">
										<input class="prompt srch_explore" type="time" name="title" data-purpose="edit-course-title" id="etime_<?=$lect->Id;?>" value="<?=$lect->End_time;?>">
									</div>
								</div>
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
								<div class="row">
								<div class="col-md-3">
							<label>Select Batches</label>
						</div>
						<div class="col-md-9">
							
							<select class="multiselectdrop btn btn-primary ui hj145 swdh19 prompt srch_explore selection" multiple id="batches_<?=$lect->Id;?>" style="width: 100%;">
								<option value="0" <?php if(in_array(0, $sbatches)){ echo "selected";} ;?>>Open lecture</option>
								
								<?php 
									foreach($abatches as $batch){
										?>
										<option value="<?=$batch->Id;?>" <?php if(in_array($batch->Id, $sbatches)){ echo "selected";} ;?>><?=$batch->Name;?></option>
										<?php
									}
								?>								
							</select>
						</div>
					</div>
				</div>
						<div class="ui search focus mt-30 lbel25">
							<div class="row">
								<div class="col-md-3">
							<label>Select Faculty</label>
						</div>
						<div class="col-md-9">
							<select class="multiselectdrop btn btn-primary ui hj145 swdh19 prompt srch_explore" multiple id="faculties_<?=$lect->Id;?>" style="width: 100%;">
								<?php 
									foreach($afaculties as $faculty){
										?>
										<option value="<?=$faculty->Id;?>" <?php if(in_array($faculty->Id, $sfaculties)){ echo "selected";} ;?>><?=$faculty->FirstName.' '.$faculty->LastName;?></option>
										<?php
									}
								?>								
							</select>
						</div>
					</div>
				</div>

						<div class="ui search focus mt-30 lbel25">
							<label>Lecuture Start URL</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Lecuture Start URL" name="title" data-purpose="edit-course-title" id="starturl_<?=$lect->Id;?>" value="<?=$lect->Meeting_url;?>">									
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecuture Id</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Lecture Id" name="title" data-purpose="edit-course-title" id="lectid_<?=$lect->Id;?>" value="<?=$lect->Meeting_id;?>">									
							</div>
						</div>
						<div class="ui search focus mt-30 lbel25">
							<label>Lecture Password</label>
							<div class="ui left icon input swdh19">
								<input class="prompt srch_explore" type="text" placeholder="Password" name="title" data-purpose="edit-course-title" id="pass_<?=$lect->Id;?>" value="<?=$lect->Password;?>">									
							</div>
						</div>	
						<br>
						<div id="msg_<?=$lect->Id;?>"></div>
						<div class="text-left">
							<button class="update btn btn-default steps_btn" value="<?=$lect->Id;?>">Update</button>	
						</div>
					</div>		
				</div>
          
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
		<p><a href="<?=base_url();?>admin/schedule/past_lectures" style="text-decoration: underline;">click here to view past lectures</a></p>	
	</div>
</div>

<script type="text/javascript">
	//$('#batches').selectpicker();
	 $(function () {
        $('.multiselectdrop').multiselect({
            //includeSelectAllOption: true
        });
    });

$('body').on('click', '.delete', function(){
    $(this).attr("disabled", true);
    var formData = new FormData();
    var id=$(this).val();
    formData.append('id', id);
    $.ajax({
        url: "<?= base_url()?>admin/schedule/deletelecture",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
            swal("Lecture deleted successfully!", "", "success");
            setTimeout(function () {
                swal.close();
                $(this).attr("disabled", false);
              	location.reload();
            }, 2000);
    	}
    });
});
	$('body').on('click', '.update', function(){

		var id=$(this).val();
		var title=$('#title_'+id).val();
		var desc=tinyMCE.editors[$('#desc_'+id).attr('id')].getContent();
		var lectid=$('#lectid_'+id).val();
		var pass=$('#pass_'+id).val();
		var ldate=$('#ldate_'+id).val();
		var stime=$('#stime_'+id).val();
		var etime=$('#etime_'+id).val();
		var surl=$('#starturl_'+id).val();
		var sbatches = $("#batches_"+id+" option:selected");
        var batches = [];
        sbatches.each(function () {
           	batches.push($(this).val());
        });
        var sfaculties = $("#faculties_"+id+" option:selected");
        var faculties = [];
        sfaculties.each(function () {
           	faculties.push($(this).val());
        });
          $(this).attr("disabled", true);
   $('#msg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait lecture updating....</div>');
		     var formData = new FormData();
    thumbnail=$('input[name="thumbnail_'+id+'"]').get(0).files[0];
    formData.append('thumbnail', thumbnail);
    formData.append('id', id);
    formData.append('title', title);
    formData.append('desc',desc);
    formData.append('batches', batches);
    formData.append('faculties', faculties);
    formData.append('lectid',lectid);
    formData.append('pass', pass);
    formData.append('ldate', ldate);
    formData.append('stime',stime);
    formData.append('etime',etime);
    formData.append('surl',surl);
    $.ajax({
      url: "<?=base_url();?>admin/schedule/updatelecture",
      data: formData,
      method: "post",
      dataType: 'json',
      headers: { 'IsAjax': 'true' },
      processData: false,
      contentType: false,
	        success:function(data)
	        {
	        	  $(this).attr("disabled", false);
	        	if(data.code=="404"){
	        		$('#msg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
	        	}
	        	else{
	        		swal("Lecture updated successfully!", "", "success");
				    setTimeout(function () {
		              	swal.close();
		              	location.href="<?=base_url();?>admin/schedule";
		          	}, 2000);
		        }
	        }
		});
	})
	$('body').on('click', '.start', function(){
$(this).attr("disabled", true);
var id=$(this).val();
  $.ajax({
    url:"<?php echo base_url(); ?>admin/schedule/startlecture",
    method:"POST",
    data:{id:id},
    dataType:'json',
    success:function(data)
    {
$(this).attr("disabled", false);
      //setInterval(setTime, 1000);
           // $('#endmeetingmodal').toggle('show');
           // $('#end').val(room);
  var size=$(window).width();
 swal("Lecture started successfully!", "", "success");
        setTimeout(function () {
                    swal.close();
                }, 2000);     
      if(size<768){
      location.href=data.meetingurl;
  }
  else{
      window.open(data.meetingurl, '_blank');
  }
    }
  })
});
</script>