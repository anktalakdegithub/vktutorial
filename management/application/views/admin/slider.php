<style type="text/css">
  .updatesort
  {
    display: none;
  }
</style>
<div class="container">
  <style type="text/css">
    
  </style>
  <div class="row">
      <div class="col-md-8 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>slider-Sliders</h2><br>
      </div>    
      <div class="col-md-4 col-6 text-right">
        <button type="button" data-direction="next" class="updatesort btn btn-default steps_btn">Update Sorting</button>  
        <?php 
          $access=$this->session->userdata('access');
          $setting=array();
          $setting=$access->setting;
          if(in_array("add", $setting) || in_array("all", $setting))
          {
        ?>
            <a href="<?=base_url();?>admin/slider/new_slider" data-direction="next" class="btn btn-default steps_btn" style="padding-top: 10px !important;">Upload Sliders</a>  
        <?php 
          }
        ?>  
      </div>      
    </div>  
<br>
    <div class="row">
            <div class="col-md-12">
          <div class="card">
            <div class="card-body">
      <div class="row" id="load_data">
        <?php 
        $i=0;
        foreach ($sliders as $slider) {
      ?>
      <div class="col-md-4 slider_images" style="margin-bottom:20px;" id="<?=$slider->Id;?>">
      <img src="<?=base_url();?>assets/images/close.png" style="height:20px;" data-toggle="modal" data-target="#deleteModal_<?=$slider->Id;?>">
      <br>
      <a href="#" class="pop">
          <img src="<?=$slider->SliderImages;?>" style="width: 100%;">
      </a><br/>
      <a data-toggle="modal" data-target="#editModal_<?=$slider->Id;?>" style="cursor:pointer;"><i class="fa fa-pen"></i>&nbsp;Edit</a>
         
      <div class="modal" id="deleteModal_<?=$slider->Id;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                 <!-- Modal body -->
                              <div class="modal-body">
                                  <h3>Are you sure you want to delete this image?</h3>
            <button data-direction="preve" class="delete btn btn-default steps_btn" value="<?=$slider->Id;?>">Delete</button> 
      
          </div>
        </div>
      </div>
    </div>
   
    <div class="modal" id="editModal_<?=$slider->Id;?>">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                <div class="modal-header">
                                <h3>Update slider material</h3>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
            

          <div class="ui search focus mt-30 lbel25">
            <label>Select Image</label>
            <div class="ui left icon input swdh19">
              <input class="prompt srch_explore" type="file" name="image_<?=$slider->Id;?>" data-purpose="edit-course-title">           
              <input type="hidden" id="eimage_<?=$slider->Id;?>" value="<?=$slider->SliderImages;?>">       
            </div>
          </div>  


            <div id="msg_<?=$slider->Id;?>"></div>
            <button data-direction="next" class="update btn btn-default steps_btn" value="<?=$slider->Id;?>">Update</button>  
      
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
            <div id="load_data_message"><div class="row">
      </div></div>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            </div>
          </div>
        </div>

      </div>

</div>


<script type="text/javascript">  
//$('#batches').selectpicker();

 $("#load_data").sortable({
        update: function (event, ui) {
    $('.updatesort').css("display","inline-block");
        }
    });
 $('.updatesort').click(function(){
  var sids=[];
   $( ".slider_images" ).each(function() {
    sids.push($(this).attr('id'));
  });
   $.ajax({
        url: "<?= base_url()?>admin/slider/sort_order_slider",
        data: {sids:sids},
        type: "post",
        success: function(data){
             swal("Sort order updated successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
        }
 });
 });
 
     $('body').on('click', '.delete', function(){ 
    var id=$(this).val();
    
    $.ajax({
        url: "<?= base_url()?>admin/slider/delete",
        data: {id:id},
        type: "post",
        success: function(response){
           swal("Image deleted successfully!", "", "success");
       setTimeout(function () {
              swal.close();
               window.location.href = "<?= base_url()?>admin/slider";
          }, 2000);
        
    }
    });

    //alert('ok');
  
});
    $('body').on('click', '.update', function(){ 
    var id=$(this).val();
    var formData = new FormData();
    image=$('input[name="image_'+id+'"]').get(0).files[0];
    var eimage=$('#eimage_'+id).val();
    formData.append('image', image);
    formData.append('eimage',eimage);
    formData.append('id',id);
   //   $(this).attr("disabled", true);
   $('#msg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait slider uploading....</div>');
    $.ajax({
        url: "<?= base_url()?>admin/slider/update",
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
            $('#msg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("slider uploaded successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
        }
  });
})
</script>