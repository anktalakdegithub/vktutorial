
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    
    <title>Set password</title>
    
    <link rel="apple-touch-icon" href="<?=base_url();?>public/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?=base_url();?>public/assets/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?=base_url();?>public/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>public/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?=base_url();?>public/assets/css/site.min.css">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="<?=base_url();?>public/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?=base_url();?>public/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?=base_url();?>public/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?=base_url();?>public/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?=base_url();?>public/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?=base_url();?>public/global/vendor/flag-icon-css/flag-icon.css">
        <link rel="stylesheet" href="<?=base_url();?>public/assets/examples/css/pages/forgot-password.css">
    
    
    <!-- Fonts -->
    <link rel="stylesheet" href="<?=base_url();?>public/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="<?=base_url();?>public/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    
    <!--[if lt IE 9]>
    <script src="<?=base_url();?>public/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="<?=base_url();?>public/global/vendor/media-match/media.match.min.js"></script>
    <script src="<?=base_url();?>public/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src="<?=base_url();?>public/global/vendor/breakpoints/breakpoints.js"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition page-forgot-password layout-full">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
        <h3>Set password</h3>
        <p>Please choose your new password.</p>

        <form method="post" role="form">
          <div class="form-group">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="new password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="cpass" name="cpass" placeholder="confirm password">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" name="save" id="save">Save New Password</button>
          </div>
        </form>
        <div id="msg"></div>
        <footer class="page-copyright">
            <?php

             date_default_timezone_set('Asia/Kolkata');
        $date=date("Y");
        ?>
          <p>POWERED BY RELIABLE ACADEMY</p>
          <p>© <?=$date;?>. All RIGHT RESERVED.</p>
          <!--<div class="social">
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
    <!-- End Page -->


    <!-- Core  -->
    <script src="<?=base_url();?>public/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="<?=base_url();?>public/global/vendor/jquery/jquery.js"></script>
    <script src="<?=base_url();?>public/global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="<?=base_url();?>public/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="<?=base_url();?>public/global/vendor/animsition/animsition.js"></script>
    <script src="<?=base_url();?>public/global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="<?=base_url();?>public/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="<?=base_url();?>public/global/vendor/asscrollable/jquery-asScrollable.js"></script>
    
    <!-- Plugins -->
    <script src="<?=base_url();?>public/global/vendor/switchery/switchery.js"></script>
    <script src="<?=base_url();?>public/global/vendor/intro-js/intro.js"></script>
    <script src="<?=base_url();?>public/global/vendor/screenfull/screenfull.js"></script>
    <script src="<?=base_url();?>public/global/vendor/slidepanel/jquery-slidePanel.js"></script>
    
    <!-- Scripts -->
    <script src="<?=base_url();?>public/global/js/Component.js"></script>
    <script src="<?=base_url();?>public/global/js/Plugin.js"></script>
    <script src="<?=base_url();?>public/global/js/Base.js"></script>
    <script src="<?=base_url();?>public/global/js/Config.js"></script>
    
    <script src="<?=base_url();?>public/assets/js/Section/Menubar.js"></script>
    <script src="<?=base_url();?>public/assets/js/Section/Sidebar.js"></script>
    <script src="<?=base_url();?>public/assets/js/Section/PageAside.js"></script>
    <script src="<?=base_url();?>public/assets/js/Plugin/menu.js"></script>
    
    <!-- Config -->
    <script src="<?=base_url();?>public/global/js/config/colors.js"></script>
    <script src="<?=base_url();?>public/assets/js/config/tour.js"></script>
    <script>Config.set('assets', '<?=base_url();?>public/assets');</script>
    
    <!-- Page -->
    <script src="<?=base_url();?>public/assets/js/Site.js"></script>
    <script src="<?=base_url();?>public/global/js/Plugin/asscrollable.js"></script>
    <script src="<?=base_url();?>public/global/js/Plugin/slidepanel.js"></script>
    <script src="<?=base_url();?>public/global/js/Plugin/switchery.js"></script>
    
    <script>
      (function(document, window, $){
        'use strict';
    
        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
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
          var uid='<?=$user[0]->Id;?>';
            $.ajax({
            url: "<?= base_url()?>admin/users/savenewpassword",
            data: {pass:pass,uid:uid},
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
