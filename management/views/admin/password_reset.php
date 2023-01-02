<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">      
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=9">
        <meta name="description" content="Gambolthemes">
        <meta name="author" content="Gambolthemes">
        <title>Reliable Academy - Sign In</title>
        
        <!-- Favicon Icon -->
        <link rel="icon" type="image/png" href="images/fav.png">
        
        <!-- Stylesheets -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
        <link href='<?=base_url();?>assets/vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
        <link href="<?=base_url();?>assets/css/vertical-responsive-menu.min.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/css/responsive.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/css/night-mode.css" rel="stylesheet">
        
        <!-- Vendor Stylesheets -->
        <link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/vendor/semantic/semantic.min.css">  
        
    </head> 

<body>
    <div class="row justify-content-center text-center">
      <div class="col-md-4" style="margin-top: 10%;">
        <h3>Reset password</h3>
        <p>Please choose your new password.</p>

        <form method="post" role="form">
          <div class="form-group">
            <input type="email" class="form-control" id="pass" name="pass" placeholder="new password">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="cpass" name="cpass" placeholder="confirm password">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-danger btn-block" name="save" id="save">Save New Password</button>
          </div>
        </form>
        <div id="msg"></div>
        <footer class="page-copyright">
            <?php

             date_default_timezone_set('Asia/Kolkata');
        $date=date("Y");
        ?><br>
          <p>POWERED BY ARKDES</p>
          <p>© <?=$date;?>. All RIGHT RESERVED.</p>
        <!--  <div class="social">
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-twitter" aria-hidden="true"></i>
        </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-facebook" aria-hidden="true"></i>
        </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-dribbble" aria-hidden="true"></i>
        </a>
          </div>-->
        </footer>
      </div>
    </div>
    <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/OwlCarousel/owl.carousel.js"></script>
    <script src="<?=base_url();?>assets/vendor/semantic/semantic.min.js"></script>
    <script src="<?=base_url();?>assets/js/custom.js"></script> 
    <script src="<?=base_url();?>assets/js/night-mode.js"></script> 
    <script>
       $('#save').click(function(){
        var pass=$('#pass').val();
         var cpass=$('#cpass').val();
         if(pass==""){
            $('#msg').html('<p style="color:red;">Please enter password</p>');
         }
         else if(cpass==""){
            $('#msg').html('<p style="color:red;">PLease enter confirm password</p>');
         }
         if(pass!=cpass){
            $('#msg').html('<p style="color:red;">Passwords does not match.</p>');
         }
         else{
            $.ajax({
            url: "<?= base_url()?>admin/forgot_password/savenewpassword",
            data: {pass:pass},
            type: "post",
            success: function(data){
              location.href='<?=base_url();?>admin/login';
            }
        }); 
         }
       
      })
    </script>
    
  </body>
</html>
