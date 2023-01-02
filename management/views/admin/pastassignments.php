<title>Tests</title> 
<style type="text/css">
</style>
 <div class="container">
    <div class="row">
      <div class="col-md-8 col-6">  
        <h2 class="st_title"><i class="uil uil-analysis"></i>Past Assignments</h2><br>
      </div>       
    </div>  
          <div class="row">
            <div class="col-md-8 order-12 order-md-1">
          <div class="panel panel-default">
            <div class="panel-body">
        
       
       <div  id="assignments"><br>
             <div class="row">
                       <div class="col-md-4 col-6">
                                  <div class="alert alert-success">
                                    <h3 id="tplecturest"><?=$assignments;?></h3>
                                    <p>Total assignments</p>
                                  </div>
                                 </div>
                              
                          </div>  <br>
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
                <div class="form-group">
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
                </div>
                 <div class="form-group">
                  <label>Date</label>
                  <input type="date" id="sdate" class="form-control"><br>
                   <input type="date" id="edate" class="form-control">
                </div>
          </div>
        </div>
      </div>
        </div>
  </div>
  
<script type="text/javascript">
  $('#batch').change(function(){
    fetchassignments();
  });
  $('#sdate').change(function(){
    fetchassignments();
  });
  $('#edate').change(function(){
    fetchassignments();
  });
 function fetchassignments()
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/assignment/passignments",
        method:"POST",
        data:{bid:$('#batch').val(), sdate:$('#sdate').val(), edate:$('#edate').val()},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#assignments').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no assignments found!!</p></div><div class="col-md-4"></div></div></div>');
           
          }
          else
          {
            $('#assignments').html(data);
            
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
        url:"<?php echo base_url(); ?>admin/assignment/fetchassignments",
        method:"POST",
        data:{limit:limit, start:start, ayear:$('#ayear').val()},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="card card-default" style="padding: 30px;"><div class="row"><div class="col-md-4"></div><div class="col-md-4 text-center"><p>no more assignments found!!</p></div><div class="col-md-4"></div></div></div>');
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