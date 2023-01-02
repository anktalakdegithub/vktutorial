<div class="container">
  <style type="text/css">
    
  </style>
  <div class="row">
      <div class="col-md-10 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Gallery</h2><br>
      </div>    
      <div class="col-md-2 col-6">
        <button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#galleryModel">Upload image</button>  
      </div>      
    </div>  
<br>
	<div class="row" id="load_data">
    </div>
    <div class="row" id="load_data_message"></div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
</div>

<!-- The Modal -->
<div class="modal" id="imagemodal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>

    </div>
  </div>
</div>
   <div class="modal" id="galleryModel">
                          <div class="modal-dialog">
                            <div class="modal-content">
                <div class="modal-header">
                                <h3>New image upload</h3>
                              </div>
                              <div class="modal-body">
            <div class="ui search focus mt-30 lbel25">
              <label>Select images</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" placeholder="Mobile Number" name="images" multiple data-purpose="edit-course-title" maxlength="60" id="images" value="">                  
              </div>
            </div>
            <br>
            <div id="msg"></div>
            <button data-direction="next" class="btn btn-default steps_btn" id="upload">upload</button> 
      </div>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
	$('body').on('click', '.pop', function(){ 
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
			$('#imagemodal').modal('show');   
		});		
//$('#batches').selectpicker();
  $('#upload').click(function() {
     var formData = new FormData();
       $(this).attr("disabled", true);
   $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait images uploading....</div>');
    images=$('input[name="images"]').get(0).files;
    var error = '';
    for(var count = 0; count<images.length; count++)
    {
     formData.append("images[]", images[count]);
    }
    $.ajax({
        url: "<?= base_url()?>admin/gallery/uploadimages",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        dataType: 'json',
        success:function(data)
        {
            $(this).attr("disabled", false);
          if(data.code=="404"){
            $('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
          }
          else{
            swal("Images uploaded successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
        }
  });
})
	$(document).ready(function(){

    var limit = 15;
    var action = 'inactive';

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

    function load_data(limit)
    {
      $.ajax({
        url:"<?=base_url();?>admin/gallery/fetchgallery",
        method:"POST",
        data:{limit:limit},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        setTimeout(function(){
          load_data(limit);
        }, 1000);
      }
    });

  });
     $('body').on('click', '.delete', function(){ 
    var id=$(this).val();
    
    $.ajax({
        url: "<?= base_url()?>admin/gallery/deleteimage",
        data: {id:id},
        type: "post",
        success: function(response){
           swal("Image deleted successfully!", "", "success");
       setTimeout(function () {
              swal.close();
               window.location.href = "<?= base_url()?>admin/gallery";
          }, 2000);
        
    }
    });

    //alert('ok');
  
});
</script>