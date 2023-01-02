<style type="text/css">
  .updatesort
  {
    display: none;
  }
</style>
<div class="title-icon">
  <div class="row">
    <div class="col-md-6">
     <a href="<?=base_url();?>admin/course/coursedetail/curriculum/<?=$section[0]->CourseId;?>" class="title" style="display: inline-block;"><i class="fas fa-arrow-left"></i></a>&nbsp;&nbsp;
    <h3 class="title" style="display: inline-block;"><i class="uil uil-film"></i>Course Topics</h3>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" data-direction="next" class="updatesort btn btn-default steps_btn">Update Sorting</button>  
    </div>
  </div>
</div>
  <div class="container">
		<div class="row">
			  <div class="col-md-12" id="sortable">
				  <?php
          $i=0;

          foreach ($topics as $topic) {
          ?>
          <div class="topics" id="<?=$topic->Id;?>">
      
            <div class="card">
              <div class="card-body">
                <h3><?=$topic->Topic;?></h3>
              </div>
            </div>
          </div>
          <?php 
          $i++;
        }
        ?>
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
    var tids=[];
    $( ".topics" ).each(function() {
      tids.push($(this).attr('id'));
    });
    $.ajax({
      url: "<?= base_url()?>admin/course/sort_order_topic",
      data: {tids:tids},
      type: "post",
      success: function(data){
           swal("Sort order updated successfully!", "", "success");
        setTimeout(function () {
                swal.close();
                location.href="<?=base_url();?>admin/course/coursedetail/curriculum/<?=$section[0]->CourseId;?>";
            }, 2000);
      }
    });
  });
  
  </script>

