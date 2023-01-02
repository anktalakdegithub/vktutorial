<br>
<div class="row">
  <div class="col-md-8 order-12 order-md-1">
    <div class="panel panel-default">
      <div class="panel-body">
        <div  id="fees"><br>
         <br>
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
        <!--<div class="form-group">
          <label>Batch</label>
          <select class="form-control" id="batch" name="batch">
            <option value="">Select Batch</option>
             <?php
                   foreach ($allbatches as $batch) {
                      ?>
                           <option value="<?php echo $batch->Id;?>"><?php echo $batch->Name;?></option>          
                <?php
                    }
                ?>
          </select>
        </div>-->
        <label>Select Month</label>
         <div class="date-own" id="datepicker">
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   $('body').on('click', '.updateunclear', function(){
    var id=$(this).val();
    var studid=$('#studid_'+id).val();
    var pstatus=$('#pstatus_'+id).val();
    var iamount=$('#iamount_'+id).val();
    var pamount=$('#pamount_'+id).val();
    var pmethod=$('#pmethod_'+id).val();
    var pdate=$('#pdate_'+id).val();
    var remaining=$('#paremaining_'+id).val();
    $.ajax({
        url: "<?= base_url()?>admin/fees/updatefeestatus",
        data: {id:id,studid:studid,pstatus:pstatus,iamount:iamount,pamount:pamount,pmethod:pmethod,pdate:pdate,remaining:remaining},
        type: "post",
        dataType:'json',
        success: function(response){
          if(response.code=="200"){
            $('#unlcearmsg_'+id).html('<div class="alert alert-success"><strong>Success! </strong>'+response.msg+'</div>');
            location.reload();
          }
          else{
            $('#unlcearmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+response.msg+'</div>');
          }
      }
    });
   // alert('ok');
  
});
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
        url: "<?= base_url()?>admin/fees/fetchmonthlyunclearfees",
        data: {month:month,year:year},
        type: "post",
        success: function(data){
          $('#fees').html(data);
      }
    });
});
});
  $('#batch').change(function(){
    fetch_unclear_fees();
  });
  $('#sdate').change(function(){
    fetch_unclear_fees();
  });
  $('#edate').change(function(){
    fetch_unclear_fees();
  });
 function fetch_unclear_fees()
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
        url:"<?php echo base_url(); ?>admin/fees/fetch_unclear_fees",
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