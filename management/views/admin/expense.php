 <div class="container">
            <div class="row">
      <div class="col-md-8 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Expense</h2><br>
      </div>    
      <div class="col-md-4 col-6 text-right">
        <?php 
          $access=$this->session->userdata('access');
          $accounts=array();
          $accounts=$access->accounts;
          if(in_array("add", $accounts) || in_array("all", $accounts))
          {
        ?>
        <button data-direction="next" class="btn btn-default steps_btn" data-toggle="collapse" data-target="#demo">Add Expense</button>  
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
              <h3>New Expense</h3><br>
                    <div class="ui search focus lbel25">
                  <label>Expense Date</label>
                  <div class="ui left icon input swdh19">
                    <input class="prompt srch_explore" type="text" name="date" id="date" value="<?=$date;?>">                  
                  </div>
                </div>
          
                 <div class="ui search focus mt-30 lbel25">
              <label>Select category</label>
              <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="category">
                    <option value="">select category</option>
                     
                 <?php
                          foreach ($expenses as $category) {
                            if($category->ExpenseCategory!=""){
                            ?>
                <option value="<?=$category->Id;?>"><?=$category->ExpenseCategory;?></option>
                   
                 <?php
                          }
                          }
                          ?> 
                        </select>
                  </div>
                    <div class="ui search mt-30 focus lbel25">
                  <label>Amount</label>
                  <div class="ui left icon input swdh19">
                   <input type="text" class="prompt srch_explore" name="amount" id="amount" placeholder="amount (in INR)">
                  </div>
                   <div class="ui search mt-30 focus lbel25">
                  <label>Payment Method</label>
                  <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="paymentid" >
                    <option  value="">select method</option>
                       <?php
                         $i=0;
                      foreach ($paymentid as  $row) {
                      ?>
                      <option value="<?=$row->Id;?>"><?php echo $row->PaymentCategory; ?></option>
                      <?php
                      $i++;
                       } 
                      ?>
                    </select>
                  </div>
                 <div class="ui search mt-30 focus lbel25">
                  <label>Select Vendor</label>
                  <select class="ui hj145 dropdown swdh19 prompt srch_explore selection" id="vendor">
                    <option value="">select vendor</option>
                      
                <?php
                foreach ($expenses as $category) {
                  if($category->Vendor!=""){
                  ?>
                <option value="<?=$category->Id;?>"><?=$category->Vendor;?></option>
                 <?php
                          }
                          }
                          ?> 
                  </select>
                  </div>
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
                    <button type="button" class="btn btn-default" style="border-radius: 25px!important;border: 1px solid #ed2a26 !important;" data-toggle="collapse" data-target="#demo">close</button>
                  </div>
                  <div id="msg1" style="width: 100%;"></div>
                </div>
              </div>
             </div>
          </div>
          </div>
         <div class="row">
          <div class="col-md-8 order-12 order-md-1">
          <div class="panel panel-default">
            <div class="panel-body" id="expense">
                <div class="row">
                       <div class="col-md-3 col-6"><br>
                                  <div class="alert alert-success">
                                    <h3><?=$amount;?>/- &#8377; </h3>
                                    <p>Total expense</p>
                                  </div>
                                 </div>
                               
                              
                          </div> 
              <br>

             
                  <?php
  $i=0;
     foreach ($expense as $row) {
    ?>
    <div class="row">
      <div class="col-md-10">
        <h4 class="text-primary"><?=$row->Amount;?> &#8377; paid by <?=$paymode[$i]->PaymentCategory;?> 
        <?php
        if($evendor[$i]!=""){
          echo $evendor[$i]->Vendor;
        }
        ?></h4>
        <p><?php
        if($ecategory[$i]!=""){
          ?>
          <i class="fa fa-list"></i>  
          <?=$ecategory[$i]->ExpenseCategory;?>
          <?php
        }

        ?>&nbsp;&nbsp;&nbsp;<i class="fas fa-calendar-alt"></i>&nbsp;<?=$row->ExpenseDate;?>
      <?php
        if($row->Notes!=""){
          ?>
          &nbsp;&nbsp;&nbsp;<a href="#" data-toggle="collapse" data-target="#notescol_<?=$row->Id;?>">Note&nbsp;<i class="fas fa-chevron-down"></i></a>
          <?php
        }
        ?></p>

      </div>
              <div class="col-md-2 text-right">  
             <div class="dropdown">
              <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <?php 
                  if(in_array("edit", $accounts) || in_array("all", $accounts)){
                  ?>
                  <a class="dropdown-item" href="<?=base_url();?>admin/expense/editexpense/<?=$row->Id;?>" >Edit</a>
                  <?php 
                    }
                    if(in_array("delete", $accounts) || in_array("all", $accounts)){
                  ?> 
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deletemodal_<?=$row->Id;?>">Delete</a>
                  <?php 
                    }
                  ?>
              </div>
            </div>
              </div>
              <div class="col-md-12">
                <div id="notescol_<?=$row->Id;?>" class="collapse"><br>
  <p><?=$row->Notes;?></p>
  </div>
                </div>
              </div><hr>
               <div id="deletemodal_<?php echo $row->Id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
       <h4>Are you sure?</h4> 
      </div>

      <div class="modal-footer">
        <button type="button" class="delete steps_btn" value="<?php echo $row->Id;?>">Delete</button>
      </div>
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
       <div class="col-md-4 order-1 order-md-12">
        <div class="panel panel-default">
            <div class="panel-body"><br>
              <h3>Filter By</h3>
               <br>
                       
                         
                           <div class="form group">
                            
                              <select class="form-control" id="cid">
                                <option value="">select category</option>
                               
                           <?php
                                    foreach ($expenses as $category) {
                                      if($category->ExpenseCategory!=""){
                                      ?>
                          <option value="<?=$category->Id;?>"><?=$category->ExpenseCategory;?></option>
                             
                           <?php
                                    }
                                    }
                                    ?> 
                                  </select>
                            
                          </div>
                          <br>
                          <div class="form group">
                          
                           <select class="form-control" id="vid">
                            <option value="">select vendor</option>
                              
                        <?php
                        foreach ($expenses as $category) {
                          if($category->Vendor!=""){
                          ?>
                        <option value="<?=$category->Id;?>"><?=$category->Vendor;?></option>
                          
                         <?php
                                  }
                                  }
                                  ?> 
                        </select>
                         
                        </div>
                          <br>
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
  $("#save").click(function(){
    $.ajax({
        url: "<?= base_url()?>admin/expense/insertdata",
        data: {'date':$('#date').val(),'category':$('#category').val(),'amount':$('#amount').val(),'paymentid':$('#paymentid').val(),'vendor':$('#vendor').val(),'note':$('#note').val()},
        type: "post",
        dataType: "json",
        success: function(data){
        if(data.code=="200"){
          $('#msg1').html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>')
          location.reload();
        }
        else{
           $('#msg1').html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>')
        }

      }
    });
 // alert('ok');
});
   $(".delete").click(function(){
    $id=$(this).val();
    $.ajax({
        url: "<?= base_url()?>admin/expense/deleteexpense",
        data: {id:$id},
        type: "post",
        success: function(data){
          location.reload();
      }
    });
   // alert('ok');
  
});
  $('#cid').change(function(){
fetchexpensedata();
});
$('#vid').change(function(){
fetchexpensedata();
});  
$('#sdate').change(function(){
fetchexpensedata();
});
$('#edate').change(function(){
fetchexpensedata();
});
 function fetchexpensedata()
    {
      $.ajax({
        url:"<?php echo base_url(); ?>admin/expense/fetchexpensedata",
        method:"POST",
        data:{cid:$('#cid').val(), vid:$('#vid').val(),sdate:$('#sdate').val(), edate:$('#edate').val()},
        cache: false,
        success:function(data)
        {
         
            $('#expense').html(data);
            
          
        }
      })
    }
</script>
