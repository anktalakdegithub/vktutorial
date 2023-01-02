<style type="text/css">
  .bg-default{
    background-color: #ededed;
    font-weight: bold;
  }
</style>
    <div class="_215b17" style="padding-bottom: 50px;background: #fff">
      <div class="container-fluid">
        <div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
  </div>
</div>
        </div>
      </div>
    </div>

    <div class="modal" id="buyModal">
        <div class="modal-dialog" style="top: 30%;">
          <div class="modal-content">

            <!-- Modal body -->
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                      <p>You have not enrolled in this test series yet!</p>
                      <?php 
                        if($this->session->userdata('studid')>0){
                            if($category[0]->Subscription_type>0){
                            ?>
                            
                          <a href="<?=base_url();?>test_series/buytestseries/<?=$category[0]->Id;?>" class="btn" style="background-color: #C72127; border-color: #C72127;color: #ffffff;" id="submit">Enroll Now</a>
                            <?php
                          }
                          else{

                            ?>
                            <a href="#" class="unlock btn" id="<?=$category[0]->Id;?>" style="background-color: #C72127; border-color: #C72127;color: #ffffff;">Enroll Now</a>
                            <?php
                          }
                        }
                      else{
                        ?>
                        <a href="enrollcourse" class="btn_buy"  id="<?=$category[0]->Id;?>" style="padding-top: 15px;padding-bottom: 15px;border-color: #C72127;background: #C72127">Enroll Now</a>
                        <?php
                      }

                      ?>
                  </div>  
                </div>
              </div>
          </div>
        </div>
    </div>
<script type="text/javascript">
   $('body').on('click', '.unlock', function(){ 
                  
   var formData = new FormData();
   var id=this.id;
    formData.append('seriesid', id);
    $.ajax({
        url: "<?= base_url()?>test_series/addstudtestseries",
        data: formData,
        type: "post",
        headers: { 'IsAjax': 'true' },
        processData: false,
        contentType: false,
        success: function(data){
           swal("Test series added successfully!", "", "success");
            setTimeout(function () {
                    swal.close();
              location.reload();
                }, 2000);
    }
    });
  
});
</script>