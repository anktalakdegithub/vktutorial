<br>
          <div class="row">
            <div class="col-md-8 order-12 order-md-1">
          <div class="panel panel-default">
            <div class="panel-body">
        
       <br>
               <br>
       <div  id="fees">
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
        <div class="col-md-4 order-1 order-md-12">
          <div class="panel panel-default">
            <div class="panel-body"><br>
                <h3>Filter by</h3>
                <br>
                <label>Select Month</label>
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
        url: "<?= base_url()?>admin/fees/fetchmonthlypaidfees",
        data: {month:month,year:year},
        type: "post",
        success: function(data){
          $('#fees').html(data);
      }
    });
});
});
  $('#batch').change(function(){
    fetch_paid_fees();
  });
  $('#sdate').change(function(){
    fetch_paid_fees();
  });
  $('#edate').change(function(){
    fetch_paid_fees();
  });
 function fetch_paid_fees()
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/fees/pfees",
        method:"POST",
        data:{bid:$('#batch').val(), sdate:$('#sdate').val(), edate:$('#edate').val()},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#fees').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no fees found!!</p></div><div class="col-md-4"></div></div></div>');
          }
          else
          {
            $('#fees').html(data);
            
          }
        }
      })
    }
  $(document).ready(function(){

    var limit = 7;
    var start = 0;
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

    function load_data(limit, start)
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/fees/fetch_paid_fees",
        method:"POST",
        data:{limit:limit},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no more fees found!!</p></div><div class="col-md-4"></div></div></div>');
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
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });

  });
</script>