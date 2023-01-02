<div class="container">
  <style type="text/css">
    
  </style>
  <div class="row">
      <div class="col-md-8 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>result</h2><br>
      </div>    
      <div class="col-md-4 col-6">
        <a href="<?=base_url();?>admin/result/category" data-direction="next" class="btn btn-default steps_btn" style="padding-top: 10px !important;">view Category</a>  
        <a href="<?=base_url();?>admin/result/new_result" data-direction="next" class="btn btn-default steps_btn" style="padding-top: 10px !important;">Upload result</a>  
      </div>      
    </div>  
<br>
    <div class="row">
            <div class="col-md-8">
          <div class="card">
            <div class="card-body" id="posts">
    <div id="load_data">
      
    </div>
            <div id="load_data_message"></div>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
      <div class="card-body">
    <h4>Filter by</h4>
    <br>
    <div class="form-group">
      <label>Select category</label>
        <select class="form-control" id="fcategory">
          <option value="">Select category</option>
          <?php 
                  foreach($categories as $cat){
                    ?>
                    <option value="<?=$cat->Id;?>"><?=$cat->Title;?></option>
                    <?php
                  }
                ?>               
        </select>
    </div>
    <div class="form-group">
      

    </div>
    <div class="form-group">
      <label>Select date</label>
       <input type="date" class="form-control" id="fdate">
    </div>
  </div>
</div>
        </div>
      </div>

</div>




<script type="text/javascript">
   $('body').on('change', '#fcategory', function(){ 
    var cid=$(this).val();
    var fdate=$('#fdate').val();
    $.ajax({
      url:"<?=base_url();?>admin/result/filterresult",
      method:"POST",
      data:{cid:cid,fdate:fdate},
      success:function(data)
      {
        $('#posts').html(data);
      }
    });
  })
  $('body').on('change', '#fdate', function(){ 
    var cid=$('#fcategory').val();
    var fdate=$('#fdate').val();
    $.ajax({
      url:"<?=base_url();?>admin/result/filterresult",
      method:"POST",
      data:{cid:cid,fdate:fdate},
      success:function(data)
      {
        $('#posts').html(data);
      }
    });
  })
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
        url: "<?= base_url()?>admin/result/upload",
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
        url:"<?=base_url();?>admin/result/fetchallresult",
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
        url: "<?= base_url()?>admin/result/delete",
        data: {id:id},
        type: "post",
        success: function(response){
           swal("Image deleted successfully!", "", "success");
       setTimeout(function () {
              swal.close();
               window.location.href = "<?= base_url()?>admin/result";
          }, 2000);
        
    }
    });

    //alert('ok');
  
});
    $('body').on('click', '.update', function(){ 
    var id=$(this).val();
    var formData = new FormData();
    image=$('input[name="image_'+id+'"]').get(0).files[0];
    var category=$('#category_'+id).val();
    var eimage=$('#eimage_'+id).val();
    formData.append('image', image);
    formData.append('category', category);
    formData.append('eimage',eimage);
    formData.append('id',id);
   //   $(this).attr("disabled", true);
   $('#msg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait result uploading....</div>');
    $.ajax({
        url: "<?= base_url()?>admin/result/update",
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
            swal("result uploaded successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
        }
  });
})
</script>