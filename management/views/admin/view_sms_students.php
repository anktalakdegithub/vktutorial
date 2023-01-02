   <div class="sa4d25">
 <div class="row">
      <div class="col-md-9 col-6"> 
        <h2 class="st_title"><i class="uil uil-analysis"></i>Students List</h2><br>
      </div>    
      <div class="col-md-3 col-6 text-right">
<!--<a href="<?=base_url();?>admin/notifications/history" class="btn steps_btn" style="padding-top:10px !important;">view history</a>-->
      </div>      
    </div> 
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card"> 
              <div class="card-body" id="sms_history">
                <?php 
                $i=0;
                foreach ($students as $stud) {
                  ?>
                  <div class="row">
                    <div class="col-md-12">
                      <h4><?=$stud->FirstName.' '.$stud->LastName;?></h4>
                      <p><i class="fas fa-phone"></i> &nbsp;&nbsp;<?=$stud->Phone;?> &nbsp;&nbsp; 
                        <?php 
                        if ($status[$i]=="DELIVRD") {
                          ?>
                          <span class="badge badge-success">Delivered</span>
                          <?php 
                        }
                        else if ($status[$i]=="Rejected") {
                          ?>
                          <span class="badge badge-danger">Rejected</span>
                          <?php 
                        }
                        else{
                          ?>
                          <span class="badge badge-primary">Submitted</span>
                          <?php
                        }
                        ?>
                      </p>
                    </div>
                  </div>
                  <?php
                }
                ?>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>