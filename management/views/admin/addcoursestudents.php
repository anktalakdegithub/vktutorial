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
			<div class="col-md-8">
          <div class="row">
        <div class="col-md-10 col-7">
          <input type="checkbox" class="select">&nbsp;&nbsp;<Strong>Select All</Strong>
        </div>
        <div class="col-md-2 col-5">
          <p id="count">0 Selected</p>
        </div>
      </div>
		<div class="card">
			<div class="card-body" id="students">

				<div id="load_data"></div>
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
    <h4>Filter by batch</h4>
    <br>
    <div class="form-group">
      <label>Select batch</label>
        <select class="form-control" id="fbatch">
          <option value="">Select batch</option>
          <?php 
            foreach($batches as $batch){
              ?>
              <option value="<?=$batch->Id;?>"><?=$batch->Name;?></option>
              <?php
            }
          ?>                  
        </select>
    </div>
  </div>
</div>
</div>
</div>
<div class="container" style="position: fixed;bottom: 0px;box-shadow: 0px -2px 3px rgba(58, 58, 146, 0.35); background-color:#ffffff;padding: 10px;">
			<div class="row">
				<div class="col-8">
      <div id="msg"></div>    
        </div>
				<div class="col-3 text-center">
					<button data-direction="next" class="btn btn-default steps_btn" id="add" value="<?=$cid;?>">Add</button>  
				</div>
			</div>
		</div>
</div>
</div>
<script type="text/javascript">
   $('body').on('click', '.select', function(){
    if ($(this).is(':checked')) {
        $("input[name='student']").attr('checked', true);
    } else {
        $("input[name='student']").attr('checked', false);
    }
    $('#count').html($("input[name='student']:checked").length+" selected");
});
	 $('body').on('change', '#fbatch', function(){ 
    var bid=$(this).val();
    $.ajax({
      url:"<?=base_url();?>admin/course/filterbatchstudent",
          method:"POST",
          data:{id:bid,cid:'<?=$cid;?>'},
          success:function(data)
          {
            $('#students').html(data);
          }
    });
  })
		$('body').on('click', '#add', function(){ 
		var cid=$(this).val();
		var students = [];
      $('input[name="student"]:checked').each(function(checkbox) {
        students.push($(this).val());
      });
        $(this).attr("disabled", true);
   $('#msg').html('<div class="alert alert-primary"><i class="fa fa-spinner fa-spin"></i> Please wait students adding to the course....</div>');
		$.ajax({
			url:"<?=base_url();?>admin/course/addcoursestudents",
	        method:"POST",
	        data:{cid:cid,students:students},
	        success:function(data)
	        {
        		swal("Students added successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.href="<?=base_url();?>admin/course/coursedetail/"+cid;
	          	}, 2000);
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
        url:"<?=base_url();?>admin/course/fetchstudents",
        method:"POST",
        data:{limit:limit,cid:'<?=$cid;?>'},
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
</script>