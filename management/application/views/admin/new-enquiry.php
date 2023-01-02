  <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script>
    <style type="text/css">
  .multiselect{
    border: 1px solid #e3e3e3;
    width: 400px !important;
    text-align: left !important;
  }
  .multiselect-container{
    width: 400px !important;
  }
</style>
    <div class="sa4d25">
	<div class="container">			
		<div class="row">
			<div class="col-md-8 col-6">	
				<h2 class="st_title"><i class="uil uil-analysis"></i>New Enquiry</h2><br>
			</div>				
		</div>	
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">

           <div class="ui search mt-30 focus lbel25">
            <div class="row">
              <div class="col-md-4">
                <label>First Name</label>
                <div class="ui left icon input swdh19">
                  <input class="prompt srch_explore" type="text" placeholder="Enter first name" id="fname" data-purpose="enter-first-name" maxlength="60">                  
                </div>
              </div>
              <div class="col-md-4">
                <label>Middle Name</label>
                <div class="ui left icon input swdh19">
                  <input class="prompt srch_explore" type="text" placeholder="Enter middle name" id="mname" data-purpose="enter-middle-name" maxlength="60">                  
                </div>
              </div>
              <div class="col-md-4">
                <label>Last Name</label>
                <div class="ui left icon input swdh19">
                  <input class="prompt srch_explore" type="text" placeholder="Enter last name" id="lname" data-purpose="enter-last-nam" maxlength="60">                  
                </div>
              </div>
            </div>

          </div>	
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="ui search mt-30 focus lbel25">
                <label>Date</label>
                <div class="ui left icon input swdh19">
                  <input class="prompt srch_explore" type="date" id="bdate">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <br>
              <label>Gender</label><br>
              <input type="radio" name="gender" value="female">Female
              <input type="radio" name="gender" value="male">Male
           </div>
         </div>
         <div class="row">
          <div class="col-6">
            <div class="ui search mt-30 focus lbel25">
              <label>Phone Number</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" id="pnumber">
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="ui search mt-30 focus lbel25">
              <label>Alternate Number</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" id="anumber">
              </div>
            </div>
          </div>  
        </div>
          <div class="ui search mt-30 focus lbel25">
              <label>E-mail</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="email" id="email" placeholder="ex: myname@example.com">
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Photo</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" placeholder="Profile" name="photo" data-purpose="edit-course-title" id="photo" value="">                 
              </div>
            </div>
          <div class="ui search focus mt-30 lbel25">
              <label>Address</label>
              <div class="ui left icon input swdh19">
                <textarea class="prompt srch_explore" style="width: 100%;" id="address"></textarea>     
              </div>
            </div>
          <div class="ui search focus mt-30 lbel25">
            <label>Select course</label>
            <select class="multiselectdrop ui hj145 dropdown swdh19 prompt srch_explore selection" id="course" multiple>
              <?php 
              foreach($courses as $crs){
                ?>
                <option value="<?=$crs->Id;?>"><?=$crs->Title;?></option>
                <?php
              }
              ?>                
            </select>
          </div>
          <div class="ui search focus mt-30 lbel25">
            <label>Enquiry source</label>
            <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="source">
              <?php 
              foreach($sources as $src){
                ?>
                <option value="<?=$src->Id;?>"><?=$src->Source;?></option>
                <?php
              }
              ?>                
            </select>
          </div>

          <br>
          <div id="msg"></div>
          <button data-direction="next" class="btn btn-default steps_btn" id="upload">Add</button>	
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $(function () {
        $('.multiselectdrop').multiselect({
            //includeSelectAllOption: true
        });
    });
  $('body').on('click', '#upload', function(){ 
    var formData = new FormData();
    var fname=$('#fname').val();
    var mname=$('#mname').val();
    var lname=$('#lname').val();
    var bdate=$('#bdate').val();
    var gender=$('input[name="gender"]:checked').val();
    var pnumber=$('#pnumber').val();
    var anumber=$('#anumber').val();
    var email=$('#email').val();
    var address=$('#address').val();
    var course=$('#course').val();
    var source=$('#source').val();
    var photo=$('input[name="photo"]').get(0).files[0];
    formData.append('fname', fname);
    formData.append('mname', mname);
    formData.append('lname', lname);
    formData.append('bdate', bdate);
    formData.append('gender', gender);
    formData.append('pnumber', pnumber);
    formData.append('anumber', anumber);
    formData.append('email', email);
    formData.append('address', address);
    formData.append('course', course);
    formData.append('source', source);
    formData.append('photo', photo);
   //   $(this).attr("disabled", true);
   $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait enquiry is uploading....</div>');
   $.ajax({
    url: "<?= base_url()?>admin/enquiry/addenquiry",
    data: formData,
    type: "post",
    headers: { 'IsAjax': 'true' },
    processData: false,
    contentType: false,
    dataType: 'json',
    success:function(data)
    {
           // $(this).attr("disabled", false);
           if(data.code=="404"){
            $('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("Enquiry added successfully!", "", "success");
            setTimeout(function () {
              swal.close();
              location.reload();
            }, 2000);
          }
        }
      });
 })
</script>