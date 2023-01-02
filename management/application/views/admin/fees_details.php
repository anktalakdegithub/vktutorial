<title>Tests</title> 
<style type="text/css">
  .nav-link.active{
          font-size: 14px !important;
            font-weight: 500 !important;
            font-family: 'Roboto', sans-serif !important;
            color: #fff !important;
            background: #ed2a26 !important;
            border-radius: 25px !important;
            border: 0 !important;
            height: 40px !important;
            padding-top: 10px;
        }
</style>
 <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-6">  
        <h2 class="st_title"><i class="uil uil-analysis"></i>Fees Details</h2><br>
      </div>       
    </div>  
          <div class="row">
            <div class="col-md-8 ">
              <div class="row">
                <div class="col-md-3 col-6">
                  <div class="alert alert-primary">
                    <?php 
                    if($total!=""){
                      ?>
                        <h3 id="tplecturest"><?=$total;?></h3>
                    <?php
                    }else{
                      ?>
                        <h3 id="tplecturest">0</h3>
                    <?php
                    }
                    ?>
                    <p>Total Fees</p>
                  </div>
                 </div>
                <div class="col-md-3 col-6">
                  <div class="alert alert-success">
                    <?php 
                    if($paid!=""){
                      ?>
                        <h3 id="tplecturest"><?=$paid;?></h3>
                    <?php
                    }else{
                      ?>
                        <h3 id="tplecturest">0</h3>
                    <?php
                    }
                    ?>
                    <p>Total Paid</p>
                  </div>
                 </div>
                <div class="col-md-3 col-6">
                  <div class="alert alert-warning">
                    <?php 
                    if($unclear!=""){
                      ?>
                        <h3 id="tplecturest"><?=$unclear;?></h3>
                    <?php
                    }else{
                      ?>
                        <h3 id="tplecturest">0</h3>
                    <?php
                    }
                    ?>
                    <p>Total Unclear</p>
                  </div>
                 </div>
                <div class="col-md-3 col-6">
                  <div class="alert alert-danger">
                    <?php 
                    if($unpaid!=""){
                      ?>
                        <h3 id="tplecturest"><?=$unpaid;?></h3>
                    <?php
                    }else{
                      ?>
                        <h3 id="tplecturest">0</h3>
                    <?php
                    }
                    ?>
                    <p>Total Unpaid</p>
                  </div>
                 </div>
              </div>
            </div>
          <div class="col-md-12">
            <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link active show" data-toggle="pill" href="#paid">Paid Fees</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#unclear">Unclear Fees</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#unpaid">Unpaid Fees</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="sfees">
        </div>
      </div>
          </div>
        </div>
  </div>
  
<script type="text/javascript">
  $('#sfees').load('<?=base_url();?>admin/fees/paid_fees');
  $('.nav-link').click(function(){
    var type=$(this).attr('href');
    if(type=="#paid"){
       $('#sfees').load('<?=base_url();?>admin/fees/paid_fees');
    }
    else if(type=="#unclear"){
       $('#sfees').load('<?=base_url();?>admin/fees/unclear_fees');
    }
    else if(type=="#unpaid"){
       $('#sfees').load('<?=base_url();?>admin/fees/unpaid_fees');
    }

  });
   $('body').on('click', '.sendsms', function(){
    var id=$(this).val();
    var studid=this.id;
    var phone=$('#phone_'+id).val();
    var msg=$('#smsg_'+id).val();
    var indiaTime = new Date().toLocaleString("en-US", {timeZone: "Asia/Kolkata"});
    current = new Date(indiaTime);
    var c = current.getTime();

    start = setDateTime(new Date(current), '09:00:00');
    end = setDateTime(new Date(current), '21:00:00');

    if ( c < start.getTime() || c > end.getTime())
    {
      $('#ssmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>please send sms between 09:00 AM to 09:00 PM.</div>');
    }
    else if(msg==""){
      $('#ssmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>please enter your message.</div>');
    }
    else{
      $.ajax({
          url: "<?= base_url()?>SendSms/sendfeesms",
          data: {studid:studid,phone:phone,msg:msg},
          type: "post",
          dataType:"json",
          success: function(data){
            //console.log(data.code);

            if(data.code=="404")
            {
              $('#ssmsg_'+id).html('<div class="alert alert-danger"><strong>Error! </strong>'+data.msg+'</div>');
            }
            else{
              $('#ssmsg_'+id).html('<div class="alert alert-success"><strong>Success! </strong>'+data.msg+'</div>');
            }
        }
      });
   }
});
$('body').on('click', '.sendemail', function(){
    var id=$(this).val();
    var sub=$('#sub_'+id).val();
    var msg=$('#emsg_'+id).val();
    var email=$('#email_'+id).val();
    $.ajax({
        url: "<?= base_url()?>SendEmail/sendfeeemail",
        data: {email:email,sub:sub,msg:msg},
        type: "post",
        success: function(data){
          $('#esmsg_'+id).html('<div class="alert alert-success"><strong>Success! </strong>Email send successfully..</div>');
   
      }
    });
   // alert('ok');
  
});
</script>