<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">
		<title>LMS - Sign In</title>
		
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
	<!-- Signup Start -->
	<div class="sign_in_up_bg">
		<div class="container">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-12">
					<div class="main_logo25" id="logo">
						<a href="index.html"><img src="images/logo.svg" alt=""></a>
						<a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a>
					</div>
				</div>
			
				<div class="col-lg-6 col-md-8">
					<div class="sign_form">
						<h2>Welcome Back</h2>
						<p>Log In to Your Learning Management System!</p>
						<form action="" method="post">
							<div class="ui search focus mt-15">
								<div class="ui left icon input swdh95">
									<input class="prompt srch_explore" type="email" value="" name="email" required="" maxlength="64" placeholder="Email Address">	<i class="uil uil-envelope icon icon2"></i>
								</div>
								  <?php echo form_error('email','<p class="help-block text-danger">','</p>'); ?>
							</div>
							<div class="ui search focus mt-15">
								<div class="ui left icon input swdh95">
									<input class="prompt srch_explore" type="password" value="" name="pass" required="" maxlength="64" placeholder="Password">
									<i class="uil uil-key-skeleton-alt icon icon2"></i>
								</div>
								  <?php echo form_error('pass','<p class="help-block text-danger">','</p>'); ?>
							</div>
							<?php  
        if(!empty($success_msg)){ 
            echo '<p class="status-msg success text-success">'.$success_msg.'</p>'; 
        }elseif(!empty($error_msg)){ 
            echo '<p class="status-msg error text-danger">'.$error_msg.'</p>'; 
        } 
    ?>
							 <input type="submit" class="login-btn" name="loginSubmit" value="LOGIN">
						</form>
						<a href="<?=base_url();?>admin/forgot_password">Forgot Password?</a>
					</div>
					<div class="sign_footer"><img src="images/sign_logo.png" alt="">© 2020 <strong>Acceron</strong>. All Rights Reserved.</div>
				</div>				
			</div>				
		</div>				
	</div>
	<!-- Signup End -->	

	<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url();?>assets/vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="<?=base_url();?>assets/vendor/semantic/semantic.min.js"></script>
	<script src="<?=base_url();?>assets/js/custom.js"></script>	
	<script src="<?=base_url();?>assets/js/night-mode.js"></script>	
	
</body>
</html>