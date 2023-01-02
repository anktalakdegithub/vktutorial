   <div class="sa4d25">
 <div class="row">
      <div class="col-md-9 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Send sms</h2><br>
      </div>    
      <div class="col-md-3 col-6 text-right">
<!--<a href="<?=base_url();?>admin/notifications/history" class="btn steps_btn" style="padding-top:10px !important;">view history</a>-->
      </div>      
    </div> 
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-9">
            <div class="card"> 
              <div class="card-body" id="sms_history">
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
      	<div class="col-md-3">
	      	<div class="date-own" id="datepicker">
			</div>
		</div>
  </div>
</div>
</div>
  <script type="text/javascript">
  	$(function() {
     $('.date-own').datepicker({
         minViewMode: 1,
         format: 'MM'
       });
       $('#datepicker').on('changeDate', function (ev) {
    		var date = $(this).datepicker('getDate'),
	            day  = date.getDate(),  
	            month = date.getMonth() + 1,              
	            year =  date.getFullYear();
	            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
				];
        $.ajax({
        url: "<?= base_url()?>admin/sms/fetch_monthly_sms",
        data: {month:month,year:year},
        type: "post",
        success: function(data){
        	//$('#salmonth').html(monthNames[date.getMonth()]+" month salaries")
            $('#sms_history').html(data);
      }
    });
});
});
	var limit=10;
    var action = 'inactive';
	$(document).ready(function(){
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
        url:"<?=base_url();?>admin/sms/fetchsms",
        method:"POST",
        data:{limit:limit},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"> </div> <div class="col-md-4 text-center"><p>not found!!</p> </div> <div class="col-md-4"></div></div></div>');
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