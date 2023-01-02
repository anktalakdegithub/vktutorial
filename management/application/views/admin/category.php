<style type="text/css">
  .updatesort
  {
    display: none;
  }
</style>
<div class="sa4d25">
  <div class="container">   
    <div class="row">
      <div class="col-md-8 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Category</h2><br>
      </div>    
      <div class="col-md-4 col-6 text-right">
        <button type="button" data-direction="next" class="updatesort btn btn-default steps_btn">Update Sorting</button> 
        <button data-direction="next" class="btn btn-default steps_btn"data-toggle="modal" data-target="#categoryModel">New category</button> 
      </div>      
    </div>  
    <div class="container">
  <div class="row" id="sortable">
    <?php foreach ($categories as $cat): ?>
      <div class="col-4 categories" id="<?=$cat->CategoryId;?>">
        <div class="card" style="width:100%;box-shadow: 0 .1rem 1rem rgba(0,0,0,.15)!important;">
          <div class="card-body">
            <a href="#" class="pop"><img class="card-img-top" src="<?=$cat->Thumbnail;?>" alt="Card image" style="width: 100%;height: 140px;"></a>
            <div class="row">
              <div class="col-10">
                 <a href="<?=base_url();?>admin/category/category/<?=$cat->CategoryId;?>">
                <h4 style="padding-top: 5px;"><?=$cat->CategoryName;?></h4></a>
              </div>
              <div class="col-2 text-center">
                <div class="dropdown">
                  <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#editModal_<?=$cat->CategoryId;?>">Edit</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal_<?=$cat->CategoryId;?>">Delete</a>
                  </div>
                </div>
                <div class="modal" id="editModal_<?=$cat->CategoryId;?>">
                  <div class="modal-dialog">
                    <div class="modal-content modal-lg">
                      <div class="modal-header">
                        <h3>Edit Category</h3>
                      </div>
                      <!-- Modal body -->
                      <div class="modal-body">
                        <div class="ui search focus lbel25">
                          <label>Name</label>
                          <div class="ui left icon input swdh19">
                            <input class="prompt srch_explore" type="text" id="title_<?=$cat->CategoryId;?>" value="<?=$cat->CategoryName;?>">                  
                          </div>
                        </div>
                        <div class="ui search focus mt-30 lbel25">
                          <label>Select Image</label>
                          <div class="ui left icon input swdh19">
                            <input class="prompt srch_explore" type="file" name="image_<?=$cat->CategoryId;?>" id="image_<?=$cat->CategoryId;?>" value="">
                             <input class="prompt srch_explore" type="hidden" id="eimage_<?=$cat->CategoryId;?>" value="<?=$cat->Thumbnail;?>">                    
                          </div>
                        </div>
                        <br>
                        <div id="msg_<?=$cat->CategoryId;?>"></div>
                        <button data-direction="next" class="update btn btn-default steps_btn" value="<?=$cat->CategoryId;?>">Update</button> 
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal" id="deleteModal_<?=$cat->CategoryId;?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal body -->
                      <div class="modal-body">
                          <h3>Are you sure you want to delete?</h3>
                          <div id="dmsg_<?=$cat->CategoryId;?>"></div>
                        <button data-direction="preve" class="delete btn btn-default steps_btn" value="<?=$cat->CategoryId;?>">Delete</button> 
                  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
      </div>
    <?php endforeach; ?>
  </div>
</div></div>
</div>
<div class="modal" id="categoryModel">
                          <div class="modal-dialog">
                            <div class="modal-content">
                <div class="modal-header">
                                <h3>New Category</h3>
                              </div>
                              <div class="modal-body">
                                <div class="ui search focus mt-30 lbel25">
              <label>Category Name</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="text" name="cname" id="cname">                  
              </div>
            </div>
            <div class="ui search focus mt-30 lbel25">
              <label>Select image</label>
              <div class="ui left icon input swdh19">
                <input class="prompt srch_explore" type="file" name="image" id="image">                  
              </div>
            </div>
            <br>
            <div id="msg"></div>
            <button data-direction="next" class="btn btn-default steps_btn" id="add">Add</button> 
      </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
            $("#sortable").sortable({
        update: function (event, ui) {
    $('.updatesort').css("display","inline-block");
        }
    });
 $('.updatesort').click(function(){
  var sids=[];
   $( ".categories" ).each(function() {
    sids.push($(this).attr('id'));
  });
   console.log(sids);
   $.ajax({
        url: "<?= base_url()?>admin/category/sort_order_category",
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
        $('#add').click(function() {
          var formData = new FormData();
          $('#add').attr("disabled", true);
          $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait category creating....</div>');
          file=$('input[name="image"]').get(0).files[0];
          var cname=$('#cname').val();
          formData.append("cname", cname);
          formData.append('file',file);
          $.ajax({
            url: "<?= base_url()?>admin/category/addcategory",
            data: formData,
            type: "post",
            headers: { 'IsAjax': 'true' },
            processData: false,
            contentType: false,
            dataType: 'json',
            success:function(data)
            {
                $('#add').attr("disabled", false);
              if(data.code=="404"){
                $('#msg').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
              }
              else{
                swal("Category added successfully!", "", "success");
              setTimeout(function () {
                      swal.close();
                      location.reload();
                  }, 2000);
              }
            }
          });
        })
        $('.update').click(function() {
   var id=$(this).val();
           $(this).attr("disabled", true);
    $('#msg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait category updating....</div>');
 
     var formData = new FormData();
    var title=$('#title_'+id).val();
    var eimage=$('#eimage_'+id).val();
    thumbnail=$('input[name="image_'+id+'"]').get(0).files[0];
    formData.append('file', thumbnail);
      formData.append('eimage', eimage);
    formData.append('cname', title);
    formData.append('id', id);
    $.ajax({
        url: "<?= base_url()?>admin/category/updatecategory",
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
            swal("Category updated successfully!", "", "success");
          setTimeout(function () {
                  swal.close();
                  location.reload();
              }, 2000);
          }
        }
  });
})
     $(".delete").click(function(){
                 $(this).attr("disabled", true);
   var formData = new FormData();
   var id=$(this).val();
   $('#dmsg_'+id).html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait category deleting....</div>');
    formData.append('id', id);
    $.ajax({
        url: "<?= base_url()?>admin/category/deletecategory",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
           swal("Category deleted successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
                     $(this).attr("disabled", false);
              location.reload();
                }, 2000);
         
    }
    });
  
});
      </script>