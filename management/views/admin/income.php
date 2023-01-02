<div class="container">
            <div class="row">
      <div class="col-md-8 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Income</h2><br>
      </div>    
      <div class="col-md-4 col-6 text-right">
        <?php 
          $access=$this->session->userdata('access');
          $accounts=array();
          $accounts=$access->accounts;
          if(in_array("add", $accounts) || in_array("all", $accounts))
          {
        ?>
        <button data-direction="next" class="btn btn-default steps_btn" data-toggle="collapse" data-target="#demo">Add Income</button>  
        <?php 
        }
        ?>
      </div>      
    </div>  
          <?php
          date_default_timezone_set('Asia/Kolkata');
    $date=date("Y-m-d");
          ?>
          <div class="row">
            <div class="col-md-12">
            <div class="collapse panel panel-default" id="demo">
          
            <div class="panel-body"><br>
              <h3>New Income</h3><br>
                  <div class="ui search focus lbel25">
                  <label>Income Date</label>
                  <div class="ui left icon input swdh19">
                    <input type="date" class="prompt srch_explore" name="date" id="date" value="<?=$date;?>">
                  </div>
                </div>
                  <div class="ui search focus mt-30 lbel25">
              <label>Income Source</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="sourceid"> <option value="">select source</option>
                      <?php
                         $i=0;
                      foreach ($source as  $sourceid) {
                      ?>
                      <option value="<?=$sourceid->Id;?>"><?php echo $sourceid->Source; ?></option>
                      <?php
                      $i++;
                       } 
                      ?>
                    </select>
                  </div>
                 <div class="ui search mt-30 focus lbel25">
                  <label>Amount</label>
                  <div class="ui left icon input swdh19">
                   <input type="text" class="prompt srch_explore" name="amount" id="amount" placeholder="amount (in INR)">
                  </div>
                </div>
                  <div class="ui search focus mt-30 lbel25">
              <label>Payment Method</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="paymentid"><option  value="">select method</option>
                       <?php
                         $i=0;
                      foreach ($payment as  $row) {
                      ?>
                      <option value="<?=$row->Id;?>"><?php echo $row->PaymentCategory; ?></option>
                      <?php
                      $i++;
                       } 
                      ?>
                    </select>
                  </div>
                  <div class="ui search mt-30 focus lbel25">
                  <label>Note</label>
                  <div class="ui left icon input swdh19">
                   <textarea class="form-control" id="note" name="note" style="border-radius: 500rem"></textarea>
                 </div>
                </div><br>
                <div class="row">
                  <div class="col-md-10"></div>
                  <div class="col-md-2">
                    <button type="button" class="steps_btn" id="save">save</button>
                    <button type="button" class="btn btn-default" style="border-radius: 25px!important;border: 1px solid #ed2a26 !important;" data-toggle="collapse" data-target="#demo">close</button><br>
                    
                  </div>
                   <div id="msg1" style="width: 100%;"></div>
                </div>
              </div>
             </div>
          </div>
          </div>
         <div class="row">
          <div class="col-md-8 col-12 order-12 order-md-1">
          <div class="panel panel-default">
            <div class="panel-body" id="income"><br>
                 <div class="row">
                       <div class="col-md-3 col-6">
                                  <div class="alert alert-success">
                                    <h3><?=$total[0]->income;?>/- &#8377; </h3>
                                    <p>Total income</p>
                                  </div>
                                 </div>
                               
                              
                          </div> 
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
       <div class="col-md-4 col-12 order-1 order-md-12">
        <div class="panel panel-default">
            <div class="panel-body"><br>
              <h4>Filter By</h4>
               <br>
               
                          <div class="form-group">
                         <select class="form-control" id="incomeid" name="incomeid">
                            <option value="">select source</option>
                            <?php
                            foreach ($source as $row) {
                              ?>
                              <option value="<?=$row->Id;?>"><?=$row->Source;?></option>
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
<script type="text/javascript">
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
        url:"<?php echo base_url(); ?>admin/income/fetchincome",
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
   $("#save").click(function(){
    $.ajax({
        url: "<?= base_url()?>admin/income/insertdata",
        data: {'date':$('#date').val(),'sourceid':$('#sourceid').val(),'amount':$('#amount').val(),'paymentid':$('#paymentid').val(),'note':$('#note').val()},
        type: "post",
        dataType: "json",
        success: function(data){
        if(data.code=="200"){
          $('#msg1').html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>')
         //location.reload();
        }
        else{
           $('#msg1').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
        }

      }
    });
 // alert('ok');
});
  $('body').on('click', '.delete', function(){ 
    $id=$(this).val();
    $.ajax({
        url: "<?= base_url()?>admin/income/deleteincome",
        data: {id:$id},
        type: "post",
        success: function(data){
          location.reload();
      }
    });
   // alert('ok');
  
});
  $('#incomeid').change(function(){
fetchincome();
});
$('#sdate').change(function(){
fetchincome();
});
$('#edate').change(function(){
fetchincome();
});
 function fetchincome()
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/income/fetchincomedata",
        method:"POST",
        data:{id:$('#incomeid').val(), sdate:$('#sdate').val(), edate:$('#edate').val()},
        cache: false,
        success:function(data)
        {
         
            $('#income').html(data);
            
          
        }
      })
    }   
</script>