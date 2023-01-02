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
			<div class="col-md-12">
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

</div>
<div class="container" style="position: fixed;bottom: 0px;box-shadow: 0px -2px 3px rgba(58, 58, 146, 0.35); background-color:#ffffff;padding: 10px;">
			<div class="row">
				<div class="col-8"></div>
				<div class="col-3 text-center">
					<button data-direction="next" class="btn btn-default steps_btn" id="add" value="<?=$bid;?>">Add</button>  
				</div>
			</div>
		</div>
</div>
</div>
<script type="text/javascript">
	
		$('body').on('click', '#add', function(){ 
		var bid=$(this).val();
		var students = [];
      $('input[name="student"]:checked').each(function(checkbox) {
        students.push($(this).val());
      });
		$.ajax({
			url:"<?=base_url();?>admin/batch/addbatchstudent",
	        method:"POST",
	        data:{bid:bid,students:students},
	        success:function(data)
	        {
        		swal("Students added successfully!", "", "success");
			    setTimeout(function () {
	              	swal.close();
	              	location.href="<?=base_url();?>admin/batch";
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
        url:"<?=base_url();?>admin/batch/fetchstudents",
        method:"POST",
        data:{limit:limit,bid:'<?=$bid;?>'},
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