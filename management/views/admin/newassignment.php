<title>New assignment</title> 

   <div class="container">
       <div class="row">
      <div class="col-md-8 col-6">  
        <h2 class="st_title"><i class="uil uil-analysis"></i>New Assignment</h2><br>
      </div>       
    </div> 
          <div class="row">
                <div class="col-md-8">
          <div class="panel panel-default">
          
            <div class="panel-body"><br>

                   <div class="ui search focus lbel25">
                  <label>Assignment Title</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" placeholder="Title" id="aname" data-purpose="edit-course-title">                  
                  </div>
                </div>
                <div class="ui search focus mt-30 lbel25">
              <label>Batch</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="batch">
                      <option value="">Select batch</option>
                        <?php
                           foreach ($batches as $batch) {
                           ?>
                           <option value="<?php echo $batch->Id;?>"><?php echo $batch->Name;?></option>
                           <?php
                          }
                        ?>
                    </select>
                  </div>
                   <div class="ui search focus mt-30 lbel25">
              <label>Select Faculty</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="teacher"> <option value="">Select Faculty</option>
                             <?php
                          $i=0;
                           foreach ($faculties as $faculty) {
                           ?>
                           <option value="<?php echo $faculty->Id;?>"><?php echo $faculty->FirstName.' '.$faculty->LastName;?></option>
                           <?php
                          }
                        ?>         
                      </select>
                    </div>
                   <div class="ui search focus mt-30 lbel25">
                  <label>Attachments</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="file" id="Attachments" name="Attachments" data-purpose="edit-course-title">                  
                  </div>
                </div>
                 <div class="ui search focus mt-30 lbel25">
                  <label>Submission date</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="date" id="sdate" name="sdate" data-purpose="edit-course-title">                  
                  </div>
                </div>
                <div class="ui search focus mt-30 lbel25">
                  <label>Note</label>
                  <div class="ui left icon input swdh19">
                     <textarea class="form-control" id="note" style="border-radius: 50px"></textarea>
                  </div>
                </div>
                 <br>
                  <div id="msg" style="width: 80%;"></div>
                  <br>
                 <button type="button" class="steps_btn" id="submit" value="submit" name="submit">submit</button>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
  
<script type="text/javascript">


  $('body').on('click', '#submit', function(){
    //$("#submit").attr("disabled", true);
    $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait assignment creating....</div>');
 
    var formData = new FormData();
      batch=$('#batch').val();
      
      teacher=$('#teacher').val();
      aname=$('#aname').val();
     
      sdate=$('#sdate').val();
      note=$('#note').val();
      
      files=$('input[name="Attachments"]').get(0).files[0];
    formData.append('file', files);

      formData.append('batch', batch);
    
      formData.append('teacher', teacher);
      formData.append('aname', aname);
      formData.append('sdate', sdate);
      formData.append('note', note);
     
    $.ajax({
        url: "<?= base_url()?>admin/assignment/addassignment",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data){
    //      $("#submit").attr("disabled", false);
 
        if(data.code=="200"){
          swal("Assignment Created successfully!", "", "success");
          setTimeout(function () {
              swal.close();
              location.href="<?=base_url();?>admin/assignment";
          }, 2000);  
        }
        else{
           $('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
        }

      }
    });
 // alert('ok');
});
</script>